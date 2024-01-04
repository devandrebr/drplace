<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-07-12
 * @version 2018-07-19
 */
class Chat extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PAINEL;
    $this->_controller = strtolower( __CLASS__ );

    $this->_valida_usuario_logado_painel();

    $this->load->library('form_validation');
  }

  function index($off=0){
    $this->lista_mensagens($off);
  }

  function lista_mensagens($off=0)
  {
    $ini = 10;

    $this->load->model($this->_modulo.'Chat_model','mchat');

    $qtd_total = $this->mchat->qtdTotalMensagens($this->_usu_painel_id);

    $res = $this->mchat->lista($this->_usu_painel_id,$off,$ini);
    $qtd = is_array($res) ? count($res) : 0;

    $this->load->library('pagination');

    $config['base_url'] = base_url($this->_modulo.$this->_controller.'/lista-mensagens/');
    $config['total_rows'] = $qtd_total;
    $config['per_page'] = $ini;
    $config['uri_segment'] = 4;
    $config['first_link'] = 'Início';
    $config['last_link'] = 'Fim';
    $config['prev_link'] = '<span aria-hidden="true">«</span>';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '<span aria-hidden="true">»</span>';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['full_tag_open'] = '<div class="pagination-box"><nav aria-label="Paginação"><ul class="pagination">';
    $config['full_tag_close'] = '</ul></nav></div>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item"><a class="page-link active" href="javascript:void(0);">';
    $config['cur_tag_close'] = '</a></li>';
    $config['attributes'] = array('class' => 'page-link');

    $this->pagination->initialize($config);

    $dados['paginacao'] = $this->pagination->create_links();
    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Chat');
    $this->breadcrumb->add('Lista das Mensagens');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Lista das Mensagens';
    $dados['_titulo_page'] = 'Lista das Mensagens';

    $dados['_menu_ativo'] = 'chat';
    $dados['_menu_painel'] = 'chat';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function conversa($id,$slug=NULL)
  {
    $url_er = base_url($this->_modulo.$this->_controller.'/lista-mensagens');

    $this->load->model($this->_modulo.'Chat_model','mchat');

    $res = $this->mchat->conversa($id,$this->_usu_painel_id);
    $qtd = is_array($res) ? count($res) : 0;
    if($qtd<=0)
      $this->_mensagem_status( 'info', 'Conversa não encontrada, tente novamente.', $url_er );

    $imo_id_usuario = (int)$res['imo_id_usuario'];
    $conv_id_usuario = (int)$res['mcoim_id_usuario'];

    $this->mchat->set_table('imovel_mensagem_conversa');
    $field = array('fk_id_usuario','mcoim_dataCadastro','mcoim_nome','mcoim_mensagem','mcoim_visualizada');
    $where = array('fk_id_imovelMensagem'=>$id);
    $order = 'mcoim_dataCadastro DESC';
    $res_con = $this->mchat->get($field,$where,$order);
    $qtd_con = is_array($res_con) ? count($res_con) : 0;

    $conv_usuario = isset($res_con[0]['fk_id_usuario']) ? $res_con[0]['fk_id_usuario'] : 0;
    $conv_id_usuario = ($conv_usuario>0) ? $conv_usuario : $conv_id_usuario;

    $dados['res'] = $res;
    $dados['res_con'] = $res_con;
    $dados['qtd_con'] = $qtd_con;

    # Verificar a última mensagem (conversa) com o usuário que abriu e o que está acessando agora (se são os mesmos)
    # #Se não forem marcar a conversa como visualizada (removendo o novo da home)
    # no vice-versa se for falso
    # #usuários diferentes não faz nada
    if( $this->_usu_painel_id != $imo_id_usuario) {
      # Mensagem - visualizada
      $dataupd = array('imomsg_visualizada'=>TRUE);
      $whereupd = array('imomsg_id'=>$id);
      $this->mchat->set_table('imovel_mensagem');
      $this->mchat->update($dataupd,$whereupd);
    }

    # Verificar se a última resposta não é do mesmo usuário logado
    # parecido com a lógica acima
    if( ($conv_usuario > 0) && ($this->_usu_painel_id != $conv_id_usuario) )
    {
      $conv_visualizada = $res_con[0]['mcoim_visualizada'];
      // if(!$conv_visualizada) {
      # Conversas - visualizada
      $dataupd = array('mcoim_visualizada'=>TRUE);
      $whereupd = array('fk_id_imovelMensagem'=>$id);
      $this->mchat->set_table('imovel_mensagem_conversa');
      $this->mchat->update($dataupd,$whereupd);
    // }
    }

    # Acesso - freedom all liberdade
    $datains = array();
    $datains['fk_id_imovelMensagem'] = $id;
    $datains['fk_id_usuario'] = $this->_usu_painel_id;
    $datains['imsgac_data'] = date('Y-m-d H:i:s');
    $datains['imsgac_enderecoIp'] = $_SERVER['REMOTE_ADDR'];
    $datains['imsgac_userAgent'] = $_SERVER['HTTP_USER_AGENT'];

    $this->mchat->set_table('imovel_mensagem_acesso');
    $this->mchat->insert($datains);

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Chat',base_url($this->_modulo.$this->_controller));
    $this->breadcrumb->add('Conversa');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Conversa';
    $dados['_titulo_page'] = 'Conversa';

    $dados['_menu_ativo'] = 'chat';
    $dados['_menu_painel'] = 'chat';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function enviar_mensagem()
  {
    $config = array(
                     array('field'=>'tex_msg', 'label'=>'Mensagem', 'rules'=>'required'),
                     array('field'=>'msg_id', 'label'=>'Parâmetro inválido, acesse o painel novamente.', 'rules'=>'required')
                );
    $this->form_validation->set_rules( $config );

    $id_msg = (int)$this->input->post('msg_id');
    $imo_id = (int)$this->input->post('imo_id');
    $id_imo_usu = (int)$this->input->post('imo_usu_id');

    $url_ok = base_url($this->_modulo.$this->_controller.'/conversa/'.$id_msg);
    $url_er = $url_ok;

    if ( ! $this->form_validation->run($this) )
     $this->conversa($id_msg);
    else
    {
      if( $id_msg == 0 )
        $this->_mensagem_status( 'erro', 'Mensagem não localizada, tente novamente.', base_url(MODULO_PAINEL.'home') );

      $this->load->model(MODULO_PORTAL.'PImovel_model','mimo');

      $res = $this->mimo->detalhe($imo_id);
      $qtd = is_array($res) ? count($res) : 0;
      if($qtd<=0)
        $this->_mensagem_status( 'info', 'Imóvel não encontrado, tente novamente.', $url_er );

      $msg = $this->input->post('tex_msg');

      $this->load->model($this->_modulo.'Chat_model','mchat');

      $dadosins = array();
      $dadosins['fk_id_imovelMensagem'] = $id_msg;
      $dadosins['fk_id_usuario'] = $this->_usu_painel_id;
      $dadosins['mcoim_nome'] = $this->_usu_painel_nome;
      $dadosins['mcoim_mensagem'] = $msg;
      $dadosins['mcoim_dataCadastro'] = date('Y-m-d H:i:s');

      $this->mchat->set_table('imovel_mensagem_conversa');
      $st = $this->mchat->insert($dadosins);
      if( $st ) {
        $status = 'ok';
        $msg = 'Conversa salva, aguarde um retorno embreve. Mas o e-mail de notificação não foi enviado a si mesmo!';
        $url_red = $url_ok;

        if( $id_imo_usu != $this->_usu_painel_id )
        {
          $usu_id = $res['usu_id'];
          $usu_nome = $res['usu_nome'];
          $usu_email = $res['usu_email1'];
          $imo_titulo = $res['imo_titulo'];
          $imo_img = $res['imo_img'];
          $imo_link = base_url(MODULO_PORTAL.'imovel/detalhe-anuncio/'.$imo_id.'/'.url_slug($imo_titulo));

          $path_img = PATH_UPLOAD.$usu_id.'/'.$imo_img;
          $img_link = (!is_dir($path_img) && is_file($path_img)) ? BASE_URL_EMAIL.ASSETS_UPLOADS.$usu_id.'/'.$imo_img : BASE_URL_EMAIL.ASSETS_UPLOADS.'imovel_sem_foto.jpg';

          $endereco_ip = $_SERVER['REMOTE_ADDR'];
          $user_agent = $_SERVER['HTTP_USER_AGENT'];

          $assunto = 'Resposta no seu imóvel, através da Doutor Place! Veja mais acessando seu painel.';

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

          if( $st ) {
            $status = 'ok';
            $msg = 'Sua mensagem foi enviada com sucesso. Aguarde o retorno do proprietário.';
          }
          else
          {
            $status = 'ok';
            $msg = 'Não foi possível enviar o e-mail: ' . $envio['codigo'] . ' - ' . $envio['codigoMsg'];
          }
        }

        $this->_mensagem_status($status,$msg,$url_red);
      }
      else
        $this->_mensagem_status( 'erro', 'Erro de conexão com o servidor, tente novamente.', $url_er );
    }
  }

}
