<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-10
 * @version 2018-10-04
 */
class Contato extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PORTAL;
    $this->_controller = strtolower( __CLASS__ );
  }

  function index()
  {
    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Contato');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Contato';
    $dados['_titulo_page'] = 'Fale Conosco';

    $dados['_menu_ativo'] = 'contato';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function enviar_contato()
  {
    $this->load->library('form_validation');

    $config = array(
                   array('field'=>'inp_nome', 'label'=>'Seu Nome', 'rules'=>'required'),
                   array('field'=>'inp_email', 'label'=>'E-mail', 'rules'=>'required'),
                   array('field'=>'inp_telefone', 'label'=>'Telefone', 'rules'=>'required'),
                   array('field'=>'tex_msg', 'label'=>'Mensagem', 'rules'=>'required')
                );
    $this->form_validation->set_rules($config);

    $url_ok = base_url('contato');
    $url_er = $url_ok;

    if ( ! $this->form_validation->run($this) )
     $this->_mensagem_status('erro', 'Todos os campos são obrigatórios.', $url_er);
    else
    {
      $nome = $this->input->post('inp_nome');
      $email = $this->input->post('inp_email');
      $telefone = $this->input->post('inp_telefone');
      $mensagem = $this->input->post('tex_msg');
      $recaptcha = $this->input->post('g-recaptcha-response');

      // VERIFICA O reCaptcha
      $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLE_KEY_RECAPTCHA."&response=".$recaptcha );
      $g_response = json_decode($response);
      if($g_response->success !== true)
        $this->_mensagem_status('erro', 'Captcha não verificado! Tente novamente.', $url_er);

      $endereco_ip = $_SERVER['REMOTE_ADDR'];
      $user_agent = $_SERVER['HTTP_USER_AGENT'];

      $assunto = 'Contato Recebido - Portal';
      $data_rodape = get_string_data_atual();
      $saudacao = get_saudacao();
      $os = get_OS($user_agent);
      $browser = get_browser_modificado($user_agent);
      $email_return = (($email != '') && strlen($email) > 5) ? $email : $this->_email_return_path;

      $emails = combo_emailContato();
      $qtd_emails = is_array($emails) ? count($emails) : 0;

      $emails_enviar = array();
      for($i=0; $i<$qtd_emails; $i++){
        $emails_enviar['email'][$i] = $emails[$i]['valor'];
        $emails_enviar['nome'][$i] = $emails[$i]['nome'];
      }

      # DADOS PARA O TEMPLATE
      $this->load->library( 'notificacao/template/N_Contato', NULL, 'tp_email' );

      $this->tp_email->setDataRodape( $data_rodape );
      $this->tp_email->setSaudacaoEmail( $saudacao );
      $this->tp_email->setEnderecoIp( $endereco_ip );
      $this->tp_email->setUserAgent( $user_agent );
      $this->tp_email->setNavegador( $browser );
      $this->tp_email->setSistemaOperacional( $os );
      $this->tp_email->setFormNome( $nome );
      $this->tp_email->setFormEmail( $email );
      $this->tp_email->setFormTelefone( $telefone );
      $this->tp_email->setFormMensagem( $mensagem );
      $this->tp_email->setDadosIp();

      $html = $this->tp_email->fale_conosco();

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
        $this->_mensagem_status( 'ok', 'Sua mensagem foi enviada com sucesso. Brevemente entraremos em contato.', $url_ok );
      else
        $this->_mensagem_status( 'erro', 'Ops! Não foi possível enviar a solicitação devido a um erro desconhecido no servidor, entre em contato via telefone.<br>' . $envio['codigo'] . ' - ' . $envio['codigoMsg'], $url_er );
    }
  }

  function enviar_contato_proprietario()
  {
    $this->load->library('form_validation');

    $config = array(
                   array('field'=>'inp_nome', 'label'=>'Seu Nome', 'rules'=>'required'),
                   array('field'=>'inp_telefone', 'label'=>'Telefone', 'rules'=>'required'),
                   array('field'=>'tex_msg', 'label'=>'Mensagem', 'rules'=>'required')
                );
    $this->form_validation->set_rules($config);

    $this->load->model($this->_modulo.'Pimovel_model','mimo');

    $url_er = base_url('portal');

    $imo_id = (int)$this->input->post('imo_id');
    $chat_id = (int)$this->input->post('imsg_id');
    $nova_conversa = ($chat_id >= 1) ? TRUE : FALSE;

    $res = $this->mimo->detalhe($imo_id);
    $qtd = is_array($res) ? count($res) : 0;
    if($qtd<=0)
      $this->_mensagem_status( 'info', 'Imóvel não encontrado, tente novamente.', $url_er );

    $usu_id = $res['usu_id'];
    $usu_nome = $res['usu_nome'];
    $usu_email = $res['usu_email1'];
    $imo_titulo = $res['imo_titulo'];
    $imo_img = $res['imo_img'];
    $imo_link = base_url(MODULO_PORTAL.'imovel/detalhe-anuncio/'.$imo_id.'/'.url_slug($imo_titulo));

    $path_img = PATH_UPLOAD.$usu_id.'/'.$imo_img;
    $img_link = (!is_dir($path_img) && is_file($path_img)) ? BASE_URL_EMAIL.ASSETS_UPLOADS.$usu_id.'/'.$imo_img : BASE_URL_EMAIL.ASSETS_UPLOADS.'imovel_sem_foto.jpg';

    $url_ok = $imo_link;
    $url_er = $url_ok;

    if ( ! $this->form_validation->run($this) )
     $this->_mensagem_status('erro', 'Todos os campos são obrigatórios.', $url_er);
    else
    {
      $nome = $this->input->post('inp_nome');
      $email = $this->input->post('inp_email');
      $telefone = $this->input->post('inp_telefone');
      $mensagem = $this->input->post('tex_msg');
      $recaptcha = $this->input->post('g-recaptcha-response');
      $usu_id_logado = ((int)$this->_usu_painel_id > 0) ? $this->_usu_painel_id : 0;

      // VERIFICA O reCaptcha
      $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLE_KEY_RECAPTCHA."&response=".$recaptcha );
      $g_response = json_decode($response);
      if($g_response->success !== true)
        $this->_mensagem_status('erro', 'Captcha não verificado! Tente novamente.', $url_er);

      $endereco_ip = $_SERVER['REMOTE_ADDR'];
      $user_agent = $_SERVER['HTTP_USER_AGENT'];

      $imo_usuario = ($usu_id != $usu_id_logado && ($usu_id_logado >= 1)) ? FALSE : TRUE;
      if( $imo_usuario) {
        $url_er = $url_er;
        if(($chat_id >= 1) && ($this->_usu_painel_logado))
          $url_er = base_url(MODULO_PAINEL.'chat/conversa/'.$id_chat.'/'.url_slug($imo_titulo));

        $this->_mensagem_status( 'erro', 'Ops! Você não pode iniciar uma conversa no seu próprio imóvel! Tente um imóvel diferente.', $url_er );
      } else if( !$nova_conversa ) {
        $datains = array();
        $datains['fk_id_usuarioEnvio'] = ($usu_id_logado > 0) ? $usu_id_logado : NULL;
        $datains['fk_id_imovel'] = $imo_id;
        $datains['imomsg_dataCadastro'] = date('Y-m-d H:i:s');
        $datains['imomsg_nome'] = $nome;
        $datains['imomsg_email'] = $email;
        $datains['imomsg_telefone'] = $telefone;
        $datains['imomsg_mensagem'] = $mensagem;
        $datains['imomsg_enderecoIp'] = $endereco_ip;
        $datains['imomsg_userAgent'] = $user_agent;

        $this->mimo->set_table('imovel_mensagem');
        $this->mimo->insert($datains);

        $assunto = 'Mensagem de um visitante do portal para você! Veja mais acessando seu painel.';
      } else if( ($chat_id >= 1) && ($usu_id_logado >= 1) && ($nova_conversa) ) {
        $datains = array();
        $datains['fk_id_imovelMensagem'] = $chat_id;
        $datains['fk_id_usuario'] = $usu_id_logado;
        $datains['mcoim_nome'] = $this->_usu_painel_nome;
        $datains['mcoim_mensagem'] = $mensagem;
        $datains['mcoim_dataCadastro'] = date('Y-m-d H:i:s');

        $this->mimo->set_table('imovel_mensagem_conversa');
        $this->mimo->insert($datains);

        $assunto = 'Resposta no seu imóvel, através da Doutor Place! Veja mais acessando seu painel.';
      }

      $data_rodape = get_string_data_atual();
      $saudacao = get_saudacao();
      $os = get_OS($user_agent);
      $browser = get_browser_modificado($user_agent);
      // $email_return = (($email != '') && strlen($email) > 5) ? $email : $this->_email_return_path;
      $email_return = $this->_email_return_path;

      $emails_enviar = array();
      $emails_enviar['email'][0] = $usu_email;
      $emails_enviar['nome'][0] = $usu_nome;

      # Cópia do e-mail p/ os admins
      // $emails = combo_emailContato();
      // $qtd_emails = is_array($emails) ? count($emails) : 0;
      // $emails_enviar_copia = array();
      // for($i=0; $i<$qtd_emails; $i++){
      //   $emails_enviar_copia['email'][$i] = $emails[$i]['valor'];
      //   $emails_enviar_copia['nome'][$i] = $emails[$i]['nome'];
      // }

      # DADOS PARA O TEMPLATE
      $this->load->library( 'notificacao/template/N_Contato', NULL, 'tp_email' );

      $this->tp_email->setDataRodape( $data_rodape );
      $this->tp_email->setSaudacaoEmail( $saudacao );
      $this->tp_email->setEnderecoIp( $endereco_ip );
      $this->tp_email->setUserAgent( $user_agent );
      $this->tp_email->setNavegador( $browser );
      $this->tp_email->setSistemaOperacional( $os );
      $this->tp_email->setFormNome( $nome );
      $this->tp_email->setFormEmail( $email );
      $this->tp_email->setFormTelefone( $telefone );
      $this->tp_email->setFormMensagem( $mensagem );
      $this->tp_email->setAnuncioTitulo( $imo_titulo );
      $this->tp_email->setAnuncioImagem( $img_link );
      $this->tp_email->setAnuncioLink( $imo_link );
      $this->tp_email->setDadosIp();

      if( $nova_conversa )
        $html = $this->tp_email->anuncio_proprietario();
      else
        $html = $this->tp_email->anuncio_proprietario_resposta();

      $conteudo = remove_espaco_html( $html );

      # INFORMAÇÕES PARA O ENVIO
      $this->load->library( 'notificacao/lib/Envio_email_phpmailer', NULL, 'nenvio_php' );

      $this->nenvio_php->setEmailsEnviarCopiaOculta( $emails_enviar_copia );
      $this->nenvio_php->setEmailsEnviar( $emails_enviar );
      $this->nenvio_php->setAssunto( $assunto );
      $this->nenvio_php->setNomeFrom( $this->_nome_from_default );
      $this->nenvio_php->setEmailFrom( $this->_email_from_default );
      $this->nenvio_php->setEmailReturnPath( $email_return );
      $this->nenvio_php->setHtml( $conteudo );

      $envio = $this->nenvio_php->enviar();
      $st = ($envio['codigo'] == 200) ? TRUE : FALSE;

      if( $st )
        $this->_mensagem_status( 'ok', 'Sua mensagem foi enviada com sucesso. Aguarde o retorno do proprietário.', $url_ok );
      else
        $this->_mensagem_status( 'erro', 'Ops! Não foi possível enviar a solicitação devido a um erro desconhecido no servidor.<br>' . $envio['codigo'] . ' - ' . $envio['codigoMsg'], $url_er );
    }
  }

}
