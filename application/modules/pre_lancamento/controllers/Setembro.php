<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-09-05
 * @version 2018-09-05
 */
class Setembro extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_CAMPANHA_1;
    $this->_controller = strtolower( __CLASS__ );
  }

  function index()
  {
    $dados['_titulo'] = 'Cadastre-se! Dr.place Está Vindo Em Breve';

    $dados['_view'] = __METHOD__;
    $this->_template_campanha1( $dados );
  }

  function cadastro_antecipado()
  {
    $this->load->library('form_validation');

    $config = array(
                   array('field'=>'inp_nome', 'label'=>'Seu Nome', 'rules'=>'required'),
                   array('field'=>'inp_email', 'label'=>'E-mail', 'rules'=>'required')
                );
    $this->form_validation->set_rules($config);

    $url_ok = base_url(MODULO_CAMPANHA_1.$this->_controller);
    $url_er = $url_ok;

    if ( ! $this->form_validation->run($this) )
     $this->_mensagem_status('erro', 'Todos os campos são obrigatórios.', $url_er);
    else
    {
      $nome = $this->input->post('inp_nome');
      $email = $this->input->post('inp_email');

      $this->load->model(MODULO_PAINEL.'Imovel_model','mcamp1');

      $this->mcamp1->set_table('camp1_prelancamento');

      $where = array('c1prelanc_email'=>$email,'c1prelanc_status'=>TRUE,'c1prelanc_codigo'=>CAMPANHA_01_CODIGO);
      $qtd = $this->mcamp1->count_results($where);
      if( $qtd >= 1 )
        $this->_mensagem_status( 'info', 'Ops! Seu e-mail já está cadastrado.', $url_er );
      else
      {
        $dadosins1 = array();
        $dadosins1['c1prelanc_nome'] = $nome;
        $dadosins1['c1prelanc_email'] = $email;
        $dadosins1['c1prelanc_dataCadastro'] = date('Y-m-d H:i:s');
        $dadosins1['c1prelanc_codigo'] = CAMPANHA_01_CODIGO;

        $this->mcamp1->insert($dadosins1);

        $this->_email_usuario_camp1($nome,$email);

        $endereco_ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $assunto = 'Cadastro Realizado - Pré-lançamento | Dr.Place';
        $titulo_topo = $assunto;
        $data_rodape = get_string_data_atual();
        $saudacao = get_saudacao();
        $os = get_OS($user_agent);
        $browser = get_browser_modificado($user_agent);
        $email_return = (($email != '') && strlen($email) > 5) ? $email : $this->_email_return_path;

        $emails = combo_emailCampanha1();
        $qtd_emails = is_array($emails) ? count($emails) : 0;

        $emails_enviar = array();
        for($i=0; $i<$qtd_emails; $i++){
          $emails_enviar['email'][$i] = $emails[$i]['valor'];
          $emails_enviar['nome'][$i] = $emails[$i]['nome'];
        }

        # DADOS PARA O TEMPLATE
        $this->load->library( 'notificacao/template/N_Campanha1', NULL, 'tp_email' );

        $this->tp_email->setTituloTopo( $titulo_topo );
        $this->tp_email->setDataRodape( $data_rodape );
        $this->tp_email->setSaudacaoEmail( $saudacao );
        $this->tp_email->setEnderecoIp( $endereco_ip );
        $this->tp_email->setUserAgent( $user_agent );
        $this->tp_email->setNavegador( $browser );
        $this->tp_email->setSistemaOperacional( $os );
        $this->tp_email->setFormNome( $nome );
        $this->tp_email->setFormEmail( $email );
        $this->tp_email->setDadosIp();

        $html = $this->tp_email->pre_lancamento_cadastro();

        $conteudo = remove_espaco_html( $html );

        # INFORMAÇÕES PARA O ENVIO
        $this->load->library( 'notificacao/lib/Envio_email_phpmailer', NULL, 'nenvio_php' );

        $this->nenvio_php->setEmailsEnviar( $emails_enviar );
        $this->nenvio_php->setAssunto( $assunto );
        $this->nenvio_php->setNomeFrom( $this->_nome_from_default );
        $this->nenvio_php->setEmailFrom( $this->_email_from_default );
        $this->nenvio_php->setEmailReturnPath( $email_return );
        $this->nenvio_php->setHtml( $conteudo );

        $envio = $this->nenvio_php->enviar();
        $st = ($envio['codigo'] == 200) ? TRUE : FALSE;

        if( $st )
          $this->_mensagem_status( 'ok', 'Pré-cadastro realizado com sucesso. Brevemente entraremos em contato.', $url_ok );
        else
          $this->_mensagem_status( 'erro', 'Ops! Não foi possível enviar a solicitação.<br>'.$envio['codigo'] . ' - ' . $envio['codigoMsg'], $url_er );
      }
    }
  }

  private function _email_usuario_camp1($nome,$email)
  {
    $assunto = 'Cadastro Realizado | Dr.Place';
    $titulo_topo = $assunto;
    $data_rodape = get_string_data_atual();
    $saudacao = get_saudacao();

    $emails_enviar = array();
    $emails_enviar['email'][0] = $email;
    $emails_enviar['nome'][0] = $nome;

    # DADOS PARA O TEMPLATE
    $this->load->library( 'notificacao/template/N_Campanha1', NULL, 'tp_email' );

    $this->tp_email->setTituloTopo( $titulo_topo );
    $this->tp_email->setDataRodape( $data_rodape );
    $this->tp_email->setSaudacaoEmail( $saudacao );
    $this->tp_email->setFormNome( $nome );
    $this->tp_email->setFormEmail( $email );

    $html = $this->tp_email->pre_lancamento_usuario_copia();

    $conteudo = remove_espaco_html( $html );

    # INFORMAÇÕES PARA O ENVIO
    $this->load->library( 'notificacao/lib/Envio_email_phpmailer', NULL, 'nenvio_php' );

    $this->nenvio_php->setEmailsEnviar( $emails_enviar );
    $this->nenvio_php->setAssunto( $assunto );
    $this->nenvio_php->setNomeFrom( $this->_nome_from_default );
    $this->nenvio_php->setEmailFrom( $this->_email_from_default );
    $this->nenvio_php->setEmailReturnPath( $email_return );
    $this->nenvio_php->setHtml( $conteudo );

    $this->nenvio_php->enviar();
  }
}
