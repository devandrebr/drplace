<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-09-19
 * @version 2018-09-19
 */
class Meu_imovel extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_CAMPANHA_2;
    $this->_controller = strtolower( __CLASS__ );
  }

  function index()
  {
    $this->load->model(MODULO_PORTAL.'Pimovel_model', 'mimo');

    $res = $this->mimo->listaCampanha2(6);
    $qtd = is_array($res) ? count($res) : 0;

    $res2 = $this->mimo->listaHomeInteressados(4);
    $qtd2 = is_array($res2) ? count($res2) : 0;

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    $dados['res2'] = $res2;
    $dados['qtd2'] = $qtd2;

    $dados['_og_image'] = base_url(ASSETS_CAMPANHA_2.'images/files/parallax-bg/img-5.jpg');

    $dados['_titulo'] = 'Cadastre Seu Imóvel e Tenha Vantagens Para Negociar Direto com o Comprador';

    $dados['_view'] = __METHOD__;
    $this->_template_campanha2( $dados );
  }

  function video()
  {
    $this->load->model(MODULO_PORTAL.'Pimovel_model', 'mimo');

    $res = $this->mimo->listaCampanha2(6);
    $qtd = is_array($res) ? count($res) : 0;

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    $dados['_og_image'] = base_url(ASSETS_CAMPANHA_2.'images/files/parallax-bg/img-5.jpg');

    $dados['_titulo'] = 'Cadastre Seu Imóvel e Tenha Vantagens Para Negociar Direto com o Comprador';

    $dados['_view'] = __METHOD__;
    $this->_template_campanha2( $dados );
  }

  function cadastro()
  {
    $this->load->library('form_validation');

    $config = array(
                   array('field'=>'inp_nome', 'label'=>'Seu Nome', 'rules'=>'required'),
                   array('field'=>'inp_email', 'label'=>'E-mail', 'rules'=>'required')
                );
    $this->form_validation->set_rules($config);

    $url_ok = base_url(MODULO_CAMPANHA_2.$this->_controller);
    $url_er = $url_ok;

    if ( ! $this->form_validation->run($this) )
     $this->_mensagem_status('erro', 'Todos os campos são obrigatórios.', $url_er);
    else
    {
      $nome = $this->input->post('inp_nome');
      $email = $this->input->post('inp_email');
      $perfil = 2;
      $senha1 = senha_aleatoria();

      $endereco_ip = $_SERVER['REMOTE_ADDR'];
      $user_agent = $_SERVER['HTTP_USER_AGENT'];

      $primeiro_nome = get_primeiro_nome($nome);

      $this->load->model(MODULO_PAINEL.'Imovel_model','mcamp2');

      $this->mcamp2->set_table('camp2_novo_anuncio');

      $where = array('c2nvanu_email'=>$email,'c2nvanu_status'=>TRUE,'c2nvanu_codigo'=>CAMPANHA_02_CODIGO);
      $qtd = $this->mcamp2->count_results($where);
      if( $qtd >= 1 )
        $this->_mensagem_status( 'info', 'Ops! Seu e-mail já está cadastrado.', $url_er );
      else
      {
        $data_atual = date('Y-m-d H:i:s');

        $dadosins1 = array();
        $dadosins1['c2nvanu_nome'] = $nome;
        $dadosins1['c2nvanu_email'] = $email;
        $dadosins1['c2nvanu_dataCadastro'] = $data_atual;
        $dadosins1['c2nvanu_codigo'] = CAMPANHA_02_CODIGO;
        $dadosins1['c2nvanu_enderecoIp'] = $endereco_ip;
        $dadosins1['c2nvanu_userAgent'] = $user_agent;

        $st = $this->mcamp2->insert($dadosins1);

        if( $st )
        {
          $datains2 = array();
          $datains2['fk_id_perfil'] = $perfil;
          $datains2['usu_nome'] = $nome;
          $datains2['usu_email1'] = $email;
          $datains2['usu_token'] = gerar_token();
          $datains2['usu_dataCadastro'] = $data_atual;
          $datains2['usu_senha'] = crypt_senha( $senha1 );
          $datains2['usu_confirmado'] = TRUE;
          $datains2['usu_admin'] = FALSE;

          $this->mcamp2->set_table('usuario');
          $st = $this->mcamp2->insert( $datains2 );
          if( $st )
          {
            $this->_email_usuario_camp2($nome,$email,$senha1);

            $this->load->model( MODULO_PAINEL . 'Autenticacao_model', 'mauth' );

            $res = $this->mauth->login( $email, crypt_senha($senha1) );
            $qtd = is_array($res) ? count($res) : 0;
            if( $qtd > 0 )
            {
              $usu_id = $res['usu_id'];
              $usu_token = $res['usu_token'];
              $usu_nome = $res['usu_nome'];
              $usu_email = $res['usu_email1'];
              $usu_senha = $res['usu_senha'];
              $usu_dataCadastro = converte_data( $res['usu_dataCadastro'] );
              $usu_admin = $res['usu_admin'];
              $perf_nome = $res['uperf_nome'];
              $perf_id = $res['fk_id_perfil'];
              $usu_foto = $res['usu_foto'];
              $usu_telefone = $res['usu_telefone1'];
              $usu_celular = $res['usu_celular1'];

              $session = array(
                            'drplace_usu_id' => $usu_id,
                            'drplace_usu_token' => $usu_token,
                            'drplace_usu_nome' => $usu_nome,
                            'drplace_usu_email' => $usu_email,
                            'drplace_usu_senha' => $usu_senha,
                            'drplace_usu_telefone' => ($usu_celular != '') ? $usu_celular : $usu_telefone,
                            'drplace_usu_dataCadastro' => $usu_dataCadastro,
                            'drplace_usu_perf_id' => $perf_id,
                            'drplace_usu_perf_nome' => $perf_nome,
                            'drplace_usu_admin' => $usu_admin,
                            'drplace_usu_foto' => $usu_foto,
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

                $this->mauth->set_table('log_acesso');
                $this->mauth->insert($datains);
              }

               $url_ok = base_url('novo-anuncio');
               $this->_mensagem_status( 'ok', 'Cadastro realizado com sucesso.', $url_ok );
            }
          }
        }
        else
          $this->_mensagem_status( 'erro', 'Ops! Não foi possível enviar a solicitação.', $url_er );
      }
    }
  }

  private function _email_usuario_camp2($nome,$email,$senha)
  {
    $assunto = 'Cadastro Realizado | Dr.Place';
    $titulo_topo = $assunto;
    $data_rodape = get_string_data_atual();
    $saudacao = get_saudacao();

    $emails_enviar = array();
    $emails_enviar['email'][0] = $email;
    $emails_enviar['nome'][0] = $nome;

    # DADOS PARA O TEMPLATE
    $this->load->library( 'notificacao/template/N_Campanha2', NULL, 'tp_email' );

    $this->tp_email->setTituloTopo( $titulo_topo );
    $this->tp_email->setDataRodape( $data_rodape );
    $this->tp_email->setSaudacaoEmail( $saudacao );
    $this->tp_email->setNome( $nome );
    $this->tp_email->setEmail( $email );
    $this->tp_email->setSenha( $senha );

    #$html = $this->tp_email->dados_de_acesso();
    $html = $this->tp_email->confirmacao_cadastro();
    $conteudo = remove_espaco_html( $html );

    # INFORMAÇÕES PARA O ENVIO
    $this->load->library( 'notificacao/lib/Envio_email_phpmailer', NULL, 'nenvio_php' );

    $this->nenvio_php->setEmailsEnviar( $emails_enviar );
    $this->nenvio_php->setAssunto( $assunto );
    $this->nenvio_php->setNomeFrom( $this->_nome_from_default );
    $this->nenvio_php->setEmailFrom( $this->_email_from_default );
    $this->nenvio_php->setEmailReturnPath( $this->_email_return_path );
    $this->nenvio_php->setHtml( $conteudo );

    $this->nenvio_php->enviar();
  }

}
