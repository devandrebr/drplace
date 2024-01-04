<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once( PATH_VENDOR . 'autoload.php' );

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-10
 * @version 2018-05-12
 */
class Usuario extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PAINEL;
    $this->_controller = strtolower( __CLASS__ );
  }

  function criar_conta()
  {
    if( $this->_usu_painel_logado )
      redirect( $this->url_logado );

    $fb = new \Facebook\Facebook([
      'app_id' => FACEBOOK_APP_ID,
      'app_secret' => FACEBOOK_APP_SECRET,
      'default_graph_version' => 'v3.1',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $url_login = base_url($this->_modulo.'autenticacao/facebook-callback');

    $dados['fb_loginUrl'] = $helper->getLoginUrl($url_login, ['email']);

    $this->load->model( $this->_modulo . 'Autenticacao_model', 'musu' );

    $uf = 'SP';

    $this->musu->set_table('cidade');
    $field = array('cid_id','cid_sigla','cid_nome');
    $where = array('cid_sigla' => $uf, 'cid_status'=>TRUE,'cid_statusAtivo'=>TRUE);
    $res_cid = $this->musu->get($field, $where);
    $qtd_cid = is_array($res_cid) ? count($res_cid) : 0;

    $this->musu->set_table('usuario_perfil');
    $field = array('uperf_id','uperf_nome');
    $where = array('uperf_status'=>TRUE,'uperf_statusAtivo'=>TRUE);
    $res_perf = $this->musu->get($field, $where);
    $qtd_perf = is_array($res_perf) ? count($res_perf) : 0;

    $dados['res_cid'] = $res_cid;
    $dados['qtd_cid'] = $qtd_cid;

    $dados['res_perf'] = $res_perf;
    $dados['qtd_perf'] = $qtd_perf;

    $dados['combo_uf'] = combo_uf();
    $dados['qtd_uf'] = count($dados['combo_uf']);

    $dados['_uf'] = $uf;

    $dados['_titulo'] = 'Crie Sua Conta Agora Mesmo';
    $dados['_tipo'] = 2;

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function registro()
  {
    $this->load->library('form_validation');

    $config = array(
                    array( 'field' => 'rd_perfil', 'label' => 'Você quer anunciar ou procura algum imóvel para investir ?', 'rules' => 'required' ),
                    array( 'field' => 'inp_nome', 'label' => 'Nome', 'rules' => 'required' ),
                    array( 'field' => 'inp_email', 'label' => 'E-mail', 'rules' => 'required' ),
                    array( 'field' => 'inp_senha1', 'label' => 'Senha', 'rules' => 'required' ),
                    array( 'field' => 'inp_senha2', 'label' => 'Confirmação da Senha', 'rules' => 'required' )
                );
    $this->form_validation->set_rules( $config );

    $url_ok     = base_url( $this->_modulo . $this->_controller . '/criar-conta' );
    $url_erro   = base_url( $this->_modulo . $this->_controller . '/criar-conta' );
    $url_rsenha = base_url( $this->_modulo . 'autenticacao/solicitacao-senha' );

    if( $this->form_validation->run() == FALSE )
     $this->criar_conta();
    else
    {
      #$perfil     = (int)$this->input->post('opt_perfil');
      $perfil = (int)$this->input->post('rd_perfil');
      $nome       = mb_convert_case( $this->input->post('inp_nome'), MB_CASE_TITLE, "UTF-8" );
      $email      = mb_strtolower($this->input->post('inp_email'));
      $senha1     = $this->input->post('inp_senha1');
      $senha2     = $this->input->post('inp_senha2');
      $token      = gerar_token();
      $data_atual = date('Y-m-d H:i:s');

      if( $perfil <= 0 )
        $this->_mensagem_status( 'aviso', 'Você procura investir em um imóvel ou quer anunciar seu imóvel ? Escolha seu perfil.', $url_erro );

      if( $senha1 != $senha2 )
        $this->_mensagem_status( 'erro', 'As senhas não conferem, tente novamente.', $url_erro );

      $this->load->model( $this->_modulo . 'Autenticacao_model', 'musu' );

      $this->musu->set_table( 'usuario' );

      $where = array( 'usu_email1' => $email, 'usu_statusAtivo' => TRUE );
      $qtd = $this->musu->count_results( $where );
      if( $qtd > 0 )
        $this->_mensagem_status( 'erro', 'Já existe um usuário com o e-mail <b>'.$email.'</b>, se você esqueceu a senha <a href="'.$url_rsenha.'">clique aqui</a>.', $url_erro );

      $this->musu->set_table( 'usuario_perfil' );

      $this->musu->set_return( 'row' );

      $field = array('uperf_nome');
      $where = array('uperf_id' => $perfil);
      $res_perf = $this->musu->get($field,$where);

      $perf_id = $perfil;
      $perf_nome = isset($res_perf['uperf_nome']) ? $res_perf['uperf_nome'] : '';

      $admin = FALSE;

      $datains1['fk_id_perfil'] = $perfil;
      $datains1['usu_nome'] = $nome;
      $datains1['usu_email1'] = $email;
      $datains1['usu_token'] = $token;
      $datains1['usu_dataCadastro'] = $data_atual;
      $datains1['usu_senha'] = crypt_senha( $senha1 );
      $datains1['usu_confirmado'] = TRUE;
      $datains1['usu_admin'] = $admin;

      $this->musu->set_table( 'usuario' );
      $usu_id = $this->musu->insert( $datains1, TRUE );
      if( $usu_id > 0 )
      {
        $this->_email_usuario_boas_vindas($nome,$email,$senha1);
        // $endereco_ip = $_SERVER['REMOTE_ADDR'];
        // $user_agent = $_SERVER['HTTP_USER_AGENT'];
        //
        // $primeiro_nome = get_primeiro_nome($nome);
        //
        // $assunto = $primeiro_nome . ', seja bem vindo a Dr.Place';
        // $titulo_topo = '';
        // $data_rodape = get_string_data_atual();
        // $saudacao = get_saudacao();
        // $os = get_OS( $user_agent );
        // $browser = get_browser_modificado( $user_agent );
        //
        // $emails_enviar = array();
        // $emails_enviar['email'][0] = $email;
        // $emails_enviar['nome'][0] = $nome;
        //
        // # DADOS PARA O TEMPLATE
        // $this->load->library( 'notificacao/template/N_Usuario', NULL, 'tp_email' );
        //
        // $this->tp_email->setModulo( $this->_modulo );
        // $this->tp_email->setTituloTopo( $titulo_topo );
        // $this->tp_email->setDataRodape( $data_rodape );
        // $this->tp_email->setSaudacaoEmail( $saudacao );
        // $this->tp_email->setEnderecoIp( $endereco_ip );
        // $this->tp_email->setUserAgent( $user_agent );
        // $this->tp_email->setNavegador( $browser );
        // $this->tp_email->setSistemaOperacional( $os );
        // $this->tp_email->setUsuarioToken( $token );
        // $this->tp_email->setUsuarioNome( $primeiro_nome );
        // $this->tp_email->setUsuarioEmail( $email );
        // $this->tp_email->setDadosIp();
        //
        // $conteudo = $this->tp_email->confirmacao_cadastro();
        //
        // $this->load->library( 'notificacao/lib/Envio_email_phpmailer', NULL, 'nenvio_php' );
        //
        // $this->nenvio_php->setEmailsEnviar( $emails_enviar );
        // $this->nenvio_php->setAssunto( $assunto );
        // $this->nenvio_php->setNomeFrom( $this->_nome_from_default );
        // $this->nenvio_php->setEmailFrom( $this->_email_from_default );
        // $this->nenvio_php->setEmailReturnPath( $this->_painel_email_return_path );
        // $this->nenvio_php->setHtml( $conteudo );
        //
        // $envio = $this->nenvio_php->enviar();

        // $this->_mensagem_status( 'ok', 'Conta criada com sucesso, acesse seu e-mail <b>'.$email.'</b> e confirme seu cadastro.', $url_ok );

        $session = array(
                      'drplace_usu_id' => $usu_id,
                      'drplace_usu_token' => $token,
                      'drplace_usu_nome' => $nome,
                      'drplace_usu_email' => $email,
                      'drplace_usu_senha' => $senha1,
                      'drplace_usu_telefone' => '',
                      'drplace_usu_dataCadastro' => converte_data( $data_atual ),
                      'drplace_usu_perf_id' => $perf_id,
                      'drplace_usu_perf_nome' => $perf_nome,
                      'drplace_usu_admin' => $admin,
                      'drplace_usu_foto' => '',
                      'drplace_usu_logado' => TRUE
                  );

        $this->session->set_userdata( $session );
        if( !EXEC_CLI )
        {
          $datains = array();
          $datains['fk_id_usuario'] = $usu_id;
          $datains['logace_data'] = date('Y-m-d H:i:s');
          $datains['logace_enderecoIp'] = $_SERVER['REMOTE_ADDR'];
          $datains['logace_navegador'] = $_SERVER['HTTP_USER_AGENT'];

          $this->musu->set_table('log_acesso');
          $this->musu->insert($datains);
        }

        $url_ok = base_url('novo-anuncio');
        $this->_mensagem_status( 'ok', 'Cadastro realizado com sucesso.', $url_ok );
      }
      else
        $this->_mensagem_status( 'erro', 'Ops! Ocorreu um erro interno no servidor, pedimos desculpa pelo incoveniente e tente novamente assim que possível.', $url_erro );
    }
  }

}
