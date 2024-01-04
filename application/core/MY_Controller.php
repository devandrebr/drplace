<?php defined('BASEPATH') OR exit('No direct script access allowed');

  class MY_Controller extends MX_Controller
  {
    protected $_modulo;
    protected $_controller;
    protected $_modulo_url;
    protected $_controller_url;

    protected $url_logado;

    protected $_usu_painel_id;
    protected $_usu_painel_nome;
    protected $_usu_painel_token;
    protected $_usu_painel_email;
    protected $_usu_painel_senha;
    protected $_usu_painel_telefone;
    protected $_usu_painel_logado;
    protected $_usu_painel_perfil;
    protected $_usu_painel_foto;

    protected $_usu_admin_id;
    protected $_usu_admin_nome;
    protected $_usu_admin_token;
    protected $_usu_admin_dataCadastro;
    protected $_usu_admin_email;
    protected $_usu_admin_senha;
    protected $_usu_admin_logado;
    protected $_usu_admin_cidade;

    protected $_parceiro_id;
    protected $_parceiro_nome;
    protected $_parceiro_email;
    protected $_parceiro_urlRedirect;
    protected $_parceiro_id_acesso;

    private $_prefixo_titulo_erro = 'Erro - ';
    private $_prefixo_titulo_portal = 'Dr. Place - ';
    private $_prefixo_titulo_painel = 'Dr. Place - ';
    private $_prefixo_titulo_camp_01 = 'Dr. Place - ';
    private $_prefixo_titulo_camp_02 = 'Dr. Place - ';
    private $_prefixo_titulo_admin = '[DIRETORIA] Dr.Place - ';

    // Títulos
    protected $_tit_controller;
    protected $_tit_page_header;
    protected $_tit_padrao_lista = 'Lista com todos os registros cadastrados no sistema';
    protected $_tit_padrao_novo = 'Adicionar novo registro no sistema';
    protected $_tit_padrao_atualizar = 'Editar o registro';

    // E-mails
    protected $_nome_from_default = 'Dr.Place Notificações';
    protected $_email_from_default = 'contato@drplace.com.br';
    protected $_email_return_path = 'contato@drplace.com.br';

    function __construct()
    {
      parent::__construct();

      $this->_controller_url = str_replace( '_', '-', $this->_controller );
      $this->_modulo_url = str_replace( '_', '-', $this->_modulo );

      $this->url_logado = base_url( MODULO_PAINEL . 'home/minha-conta' );

      $this->_usu_painel_id = $this->session->userdata('drplace_usu_id');
      $this->_usu_painel_nome = $this->session->userdata('drplace_usu_nome');
      $this->_usu_painel_email = $this->session->userdata('drplace_usu_email');
      $this->_usu_painel_senha = $this->session->userdata('drplace_usu_senha');
      $this->_usu_painel_telefone = $this->session->userdata('drplace_usu_telefone');
      $this->_usu_painel_logado = $this->session->userdata('drplace_usu_logado');
      $this->_usu_painel_perfil = $this->session->userdata('drplace_usu_perf_nome');
      $this->_usu_painel_foto = $this->session->userdata('drplace_usu_foto');

      $this->_usu_admin_id = $this->session->userdata('adm_usu_id');
      $this->_usu_admin_nome = $this->session->userdata('adm_usu_nome');
      $this->_usu_admin_token = $this->session->userdata('adm_usu_token');
      $this->_usu_admin_dataCadastro = $this->session->userdata('adm_usu_dataCadastro');
      $this->_usu_admin_email = $this->session->userdata('adm_usu_email');
      $this->_usu_admin_senha = $this->session->userdata('adm_usu_senha');
      $this->_usu_admin_logado = $this->session->userdata('adm_usu_logado');
      $this->_usu_admin_cidade = $this->session->userdata('adm_cid_nome');

      $this->_parceiro_id = $this->session->userdata('parceiro_id');
      $this->_parceiro_nome = $this->session->userdata('parceiro_nome');
      $this->_parceiro_email = $this->session->userdata('parceiro_email');
      $this->_parceiro_urlRedirect = $this->session->userdata('parceiro_urlRedirect');
      $this->_parceiro_id_acesso = $this->session->userdata('parceiro_id_acesso');
    }

    protected function _valida_usuario_logado_painel()
    {
      $url = base_url( MODULO_PAINEL . 'autenticacao' );
      if( !$this->_usu_painel_logado )
        $this->_mensagem_status( 'danger', 'Acesso negado! Você precisa se autenticar no portal antes de continuar, faça seu login ou crie uma conta.', $url );
    }

    protected function _valida_usuario_logado_admin()
    {
      $url = base_url( MODULO_ADMIN . 'autenticacao' );
      if( !$this->_usu_admin_logado )
        $this->_mensagem_status( 'danger', 'Acesso negado! Você precisa se logar como gestor(administrador), faça seu login.', $url );
    }

    private function _get_view_name( $view )
    {
      $view = (isset($view)) ? $view : '';

      return str_replace( '::', '/', strtolower($view) );
    }

    protected function _mensagem_status( $status, $msg, $url, $type_box = 1 )
    {
      $url_sess = $this->session->userdata('sess_redirect');
      $url = ($url_sess == '') ? $url : $url_sess;

      $array = array( 'status' => $status,
                      'msg' => $msg,
                      'box' => $type_box );
      $this->session->set_flashdata( 'msg_status', $array );
      redirect( $url );
    }

    protected function _template_portal( $dados = array() )
    {
      $dados['_msg_status'] = NULL;
      if( $this->session->flashdata('msg_status') != '' )
        $dados['_msg_status'] = $this->session->flashdata('msg_status');

      $dados['_titulo'] = (isset($dados['_titulo'])) ? $this->_prefixo_titulo_portal . $dados['_titulo'] : $this->_prefixo_titulo_portal . 'Seja bem vindo';
      $dados['_titulo_page'] = (isset($dados['_titulo_page'])) ? $dados['_titulo_page'] : 'Dr.Place';
      $dados['_description'] = (isset($dados['_description'])) ? $dados['_description'] : 'Dr.Place Direto Com Proprietário';
      $dados['_breadcrumb'] = (isset($dados['_breadcrumb'])) ? $dados['_breadcrumb'] : '';
      $dados['_menu_ativo'] = (isset($dados['_menu_ativo'])) ? $dados['_menu_ativo'] : '';
      $dados['_menu_painel'] = (isset($dados['_menu_painel'])) ? $dados['_menu_painel'] : '';
      $dados['_enable_map_imovel'] = (isset($dados['_enable_map_imovel'])) ? $dados['_enable_map_imovel'] : FALSE;
      $dados['_topo'] = (isset($dados['_topo'])) ? (int)$dados['_topo'] : 2;
      $dados['_css_topo'] = (isset($dados['_css_topo'])) ? css_topo($dados['_css_topo']) : css_topo(0);
      $dados['_class_link_painel'] = 'link-topo-painel';
      $dados['_controller'] = $this->_controller_url;
      $dados['_modulo'] = $this->_modulo_url;

      $dados['_nav_bar_topo'] = (isset($dados['_nav_bar_topo'])) ? $dados['_nav_bar_topo'] : (($dados['_topo'] != 1) ? 'navbar-pagina' : '');

      $dados['_usu_id'] = $this->_usu_painel_id;
      $dados['_usu_logado'] = $this->_usu_painel_logado;
      $dados['_usu_logado_nome'] = get_primeiro_nome($this->_usu_painel_nome);
      $dados['_usu_telefone'] = $this->_usu_painel_telefone;
      $dados['_usu_nome'] = $this->_usu_painel_nome;
      $dados['_usu_email'] = $this->_usu_painel_email;

      $tipo = (isset($dados['_tipo'])) ? (int)$dados['_tipo'] : 1;
      $view = (isset($dados['_view'])) ? $this->_get_view_name($dados['_view']) : '';
      $mod_view  = (isset($dados['_mod_view'])) ? $dados['_mod_view'] : $this->_modulo;

      if( $tipo <= 1 ) {
        $res_ult_art = $this->_get_ultimos_artigos_cadastrados();
        $qtd_ult_art = is_array($res_ult_art) ? count($res_ult_art) : 0;

        $res_ult_imo = $this->_get_ultimos_imoveis_cadastrados();
        $qtd_ult_imo = is_array($res_ult_imo) ? count($res_ult_imo) : 0;

        $p_res_tipo = $this->_get_tipo_imoveis();
        $p_qtd_tipo = is_array($p_res_tipo) ? count($p_res_tipo) : 0;

        $dados['res_ult_art'] = $res_ult_art;
        $dados['qtd_ult_art'] = $qtd_ult_art;

        $dados['res_ult_imo'] = $res_ult_imo;
        $dados['qtd_ult_imo'] = $qtd_ult_imo;

        $dados['p_res_tipo'] = $p_res_tipo;
        $dados['p_qtd_tipo'] = $p_qtd_tipo;

        $this->load->view( MODULO_PORTAL . 'topo', $dados );
        $this->load->view( MODULO_PORTAL . 'menu', $dados );
        $this->load->view( MODULO_PORTAL . $view, $dados );
        $this->load->view( MODULO_PORTAL . 'rodape', $dados );
      } else if( $tipo == 2 ) {
        $this->load->view( $mod_view . $view, $dados );
      } else if( $tipo == 3 ) { # Landing Page
        $this->load->view( MODULO_PORTAL . 'topo', $dados );
        $this->load->view( MODULO_PORTAL . $view, $dados );
        $this->load->view( MODULO_PORTAL . 'rodape2', $dados );
      }
    }

    protected function _template_painel( $dados = array() )
    {
      $dados['_msg_status'] = NULL;
      if( $this->session->flashdata('msg_status') != '' )
        $dados['_msg_status'] = $this->session->flashdata('msg_status');

      $dados['_titulo'] = (isset($dados['_titulo'])) ? $this->_prefixo_titulo_portal . $dados['_titulo'] : $this->_prefixo_titulo_portal . 'Seja bem vindo';
      $dados['_titulo_page'] = (isset($dados['_titulo_page'])) ? $dados['_titulo_page'] : 'Dr.Place';
      $dados['_description'] = (isset($dados['_description'])) ? $dados['_description'] : 'Dr.Place Direto Com Proprietário';
      $dados['_breadcrumb'] = (isset($dados['_breadcrumb'])) ? $dados['_breadcrumb'] : '';
      $dados['_menu_ativo'] = (isset($dados['_menu_ativo'])) ? $dados['_menu_ativo'] : '';
      $dados['_menu_painel'] = (isset($dados['_menu_painel'])) ? $dados['_menu_painel'] : '';
      $dados['_enable_map_imovel'] = (isset($dados['_enable_map_imovel'])) ? $dados['_enable_map_imovel'] : FALSE;
      $dados['_topo'] = (isset($dados['_topo'])) ? (int)$dados['_topo'] : 2;
      $dados['_css_topo'] = (isset($dados['_css_topo'])) ? css_topo($dados['_css_topo']) : css_topo(0);
      $dados['_class_link_painel'] = 'open-offcanvas';
      $dados['_controller'] = $this->_controller_url;
      $dados['_modulo'] = $this->_modulo_url;

      $dados['_usu_id'] = $this->_usu_painel_id;
      $dados['_usu_nome'] = $this->_usu_painel_nome;
      $dados['_usu_perfil'] = $this->_usu_painel_perfil;
      $dados['_usu_email'] = $this->_usu_painel_email;
      $dados['_usu_foto'] = $this->_usu_painel_foto;
      $dados['_usu_logado'] = $this->_usu_painel_logado;
      $dados['_usu_logado_nome'] = get_primeiro_nome($this->_usu_painel_nome);
      $dados['_usu_avatar'] = ($this->_usu_painel_foto != '') ? base_url(ASSETS_AVATAR.$this->_usu_painel_id.'/'.$this->_usu_painel_foto) : base_url(ASSETS_AVATAR.'avatar-default.jpg');

      $dados['_nav_bar_topo'] = ($dados['_topo'] != 1) ? 'navbar-pagina' : '';

      $tipo = (isset($dados['_tipo'])) ? (int)$dados['_tipo'] : 1;
      $view = (isset($dados['_view'])) ? $this->_get_view_name($dados['_view']) : '';
      $mod_view  = (isset($dados['_mod_view'])) ? $dados['_mod_view'] : $this->_modulo;

      if( $tipo <= 1 ) {
        $res_ult_art = $this->_get_ultimos_artigos_cadastrados();
        $qtd_ult_art = is_array($res_ult_art) ? count($res_ult_art) : 0;

        $res_ult_imo = $this->_get_ultimos_imoveis_cadastrados();
        $qtd_ult_imo = is_array($res_ult_imo) ? count($res_ult_imo) : 0;

        $p_res_tipo = $this->_get_tipo_imoveis();
        $p_qtd_tipo = is_array($p_res_tipo) ? count($p_res_tipo) : 0;

        $dados['res_ult_art'] = $res_ult_art;
        $dados['qtd_ult_art'] = $qtd_ult_art;

        $dados['res_ult_imo'] = $res_ult_imo;
        $dados['qtd_ult_imo'] = $qtd_ult_imo;

        $dados['p_res_tipo'] = $p_res_tipo;
        $dados['p_qtd_tipo'] = $p_qtd_tipo;

        $this->load->view( MODULO_PORTAL . 'topo', $dados );
        $this->load->view( MODULO_PORTAL . 'menu', $dados );
        $this->load->view( MODULO_PAINEL . 'aside', $dados );
        $this->load->view( MODULO_PAINEL . $view, $dados );
        $this->load->view( MODULO_PAINEL . 'sidebar', $dados );
        $this->load->view( MODULO_PORTAL . 'rodape', $dados );
      } else if( $tipo == 2 ) {
        $this->load->view( MODULO_PORTAL . 'topo', $dados );
        $this->load->view( MODULO_PAINEL . $view, $dados );
        $this->load->view( MODULO_PORTAL . 'rodape2', $dados );
      }
    }

    protected function _template_admin( $dados = array() )
    {
      $dados['_msg_status'] = NULL;
      if( $this->session->flashdata('msg_status') != '' )
        $dados['_msg_status'] = $this->session->flashdata('msg_status');

      $dados['_titulo']           = (isset($dados['_titulo'])) ? $this->_prefixo_titulo_admin . $dados['_titulo'] : $this->_prefixo_titulo_admin . 'Seja bem vindo';
      $dados['_titulo_page']      = (isset($dados['_titulo_page'])) ? $dados['_titulo_page'] : 'Doutor.Place';
      $dados['_description']      = (isset($dados['_description'])) ? $dados['_description'] : 'Doutor.Place - Gestão da dr.place';
      $dados['_breadcrumb']       = (isset($dados['_breadcrumb'])) ? $dados['_breadcrumb'] : '';
      $dados['_termo_pesquisa']   = (isset($dados['_termo_pesquisa'])) ? $dados['_termo_pesquisa'] : $this->session->userdata('adm_termo_pesquisa');
      $dados['_menu_ativo']       = (isset($dados['_menu_ativo'])) ? $dados['_menu_ativo'] : '';
      $dados['_submenu_ativo']    = (isset($dados['_submenu_ativo'])) ? $dados['_submenu_ativo'] : '';
      $dados['_enable_chart']     = (isset($dados['_enable_chart'])) ? TRUE : FALSE;
      $dados['_enable_gmaps']     = (isset($dados['_enable_gmaps'])) ? TRUE : FALSE;
      $dados['_css_gmaps']        = (isset($dados['_css_gmaps'])) ? $dados['_css_gmaps'] : '';

      $ex = explode(' ', $this->_usu_admin_nome);
      $primeiro_nome = isset($ex[0]) ? trim($ex[0]) : trim($this->_usu_admin_nome);
      $dados['_usu_nome_topo']    = $primeiro_nome;

      $dados['_usu_id']           = $this->_usu_admin_id;
      $dados['_usu_nome']         = $this->_usu_admin_nome;
      $dados['_usu_email']        = $this->_usu_admin_email;
      $dados['_usu_dataCadastro'] = $this->_usu_admin_dataCadastro;
      $dados['_usu_saudacao']     = get_saudacao();

      $dados['_controller']       = str_replace( '_', '-', $this->_controller );
      $dados['_modulo']           = str_replace( '_', '-', $this->_modulo );

      $dados['_data_hoje'] = get_string_data_atual( $this->_usu_admin_cidade );

      $icone_dark  = base_url(ASSETS_ADMIN.'images/icone-logo.png');
      $icone_light = base_url(ASSETS_ADMIN.'images/icone-logo-branca.png');
      $logo_dark   = base_url(ASSETS_ADMIN.'images/logo.png');
      $logo_light  = base_url(ASSETS_ADMIN.'images/logo-branca.png');

      $dados['_logo_icone_dark']  = $icone_dark;
      $dados['_logo_icone_light'] = $icone_light;
      $dados['_logo_dark']  = $logo_dark;
      $dados['_logo_light'] = $logo_light;
      $dados['_favicon']    = base_url('favicon.ico');

      $dados['_cli_logo'] = $logo_dark;

      $tipo       = (isset($dados['_tipo'])) ? (int)$dados['_tipo'] : 1;
      $view       = (isset($dados['_view'])) ? $this->_get_view_name($dados['_view']) : '';
      $mod_view   = (isset($dados['_mod_view'])) ? $dados['_mod_view'] : $this->_modulo;

      if( $tipo <= 1 ) {
        $this->load->view( MODULO_ADMIN . 'topo', $dados );
        $this->load->view( MODULO_ADMIN . 'menu', $dados );
        $this->load->view( MODULO_ADMIN . $view, $dados );
        $this->load->view( MODULO_ADMIN . 'rodape', $dados );
      } else if( $tipo == 2 ) {
        $this->load->view( $mod_view . $view, $dados );
      }
    }

    protected function _template_campanha1( $dados = array() )
    {
      $dados['_msg_status'] = NULL;
      if( $this->session->flashdata('msg_status') != '' )
        $dados['_msg_status'] = $this->session->flashdata('msg_status');

      $dados['_titulo'] = (isset($dados['_titulo'])) ? $this->_prefixo_titulo_camp_01 . $dados['_titulo'] : 'Dr.Place | Pré-Lançamento - Novembro/'.date('Y');
      $dados['_titulo_page'] = (isset($dados['_titulo_page'])) ? $dados['_titulo_page'] : 'Dr.Place';
      $dados['_description'] = (isset($dados['_description'])) ? $dados['_description'] : 'Dr.Place | Pré-Lançamento - Novembro/'.date('Y');
      $dados['_og_image'] = (isset($dados['_og_image'])) ? $dados['_og_image'] : base_url(ASSETS_PORTAL.'img/og-drplace.jpg');

      $tipo = (isset($dados['_tipo'])) ? (int)$dados['_tipo'] : 1;
      $view = (isset($dados['_view'])) ? $this->_get_view_name($dados['_view']) : '';
      $mod_view = (isset($dados['_mod_view'])) ? $dados['_mod_view'] : $this->_modulo;

      if( $tipo <= 1 ) {
        $this->load->view( MODULO_CAMPANHA_1 . 'topo', $dados );
        $this->load->view( MODULO_CAMPANHA_1 . $view, $dados );
        $this->load->view( MODULO_CAMPANHA_1 . 'rodape', $dados );
      } else if( $tipo == 2 ) {
        $this->load->view( $mod_view . $view, $dados );
      }
    }

    protected function _template_campanha2( $dados = array() )
    {
      $dados['_msg_status'] = NULL;
      if( $this->session->flashdata('msg_status') != '' )
        $dados['_msg_status'] = $this->session->flashdata('msg_status');

      $dados['_titulo'] = (isset($dados['_titulo'])) ? $this->_prefixo_titulo_camp_02 . $dados['_titulo'] : $this->_prefixo_titulo_camp_02 . ' Anuncie Meu Imóvel';
      $dados['_titulo_page'] = (isset($dados['_titulo_page'])) ? $dados['_titulo_page'] : $this->_prefixo_titulo_camp_02 . ' Anuncie Meu Imóvel';
      $dados['_description'] = (isset($dados['_description'])) ? $dados['_description'] : $this->_prefixo_titulo_camp_02 . ' Anuncie Meu Imóvel';
      $dados['_og_image'] = (isset($dados['_og_image'])) ? $dados['_og_image'] : base_url(ASSETS_PORTAL.'img/og-drplace.jpg');

      $tipo = (isset($dados['_tipo'])) ? (int)$dados['_tipo'] : 1;
      $view = (isset($dados['_view'])) ? $this->_get_view_name($dados['_view']) : '';
      $mod_view = (isset($dados['_mod_view'])) ? $dados['_mod_view'] : $this->_modulo;

      if( $tipo <= 1 ) {
        $this->load->view( MODULO_CAMPANHA_2 . 'topo', $dados );
        $this->load->view( MODULO_CAMPANHA_2 . $view, $dados );
        $this->load->view( MODULO_CAMPANHA_2 . 'rodape', $dados );
      } else if( $tipo == 2 ) {
        $this->load->view( $mod_view . $view, $dados );
      }
    }

    private function _get_ultimos_artigos_cadastrados($limit=2)
    {
      $this->load->model(MODULO_PORTAL.'Partigo_model', 'martord');
      return $this->martord->listaRodape($limit);
    }

    private function _get_ultimos_imoveis_cadastrados($limit=3)
    {
      $this->load->model(MODULO_PORTAL.'Pimovel_model', 'mimord');
      return $this->mimord->listaRodape($limit);
    }

    private function _get_tipo_imoveis()
    {
      $this->load->model(MODULO_PORTAL.'Pimovel_model', 'mimord');
      return $this->mimord->listaTipoImoveis();
    }

    protected function _email_usuario_boas_vindas($nome,$email,$senha)
    {
      $nome = trim($nome);

      $ex = explode(' ',$nome);
      $primeiro_nome = isset($ex[0]) ? trim($ex[0]) : $nome;

      $assunto = 'Bem Vindo, '.$primeiro_nome.'! Cadastro Realizado com Sucesso na Dr.Place';
      $titulo_topo = $assunto;
      $data_rodape = get_string_data_atual();
      $saudacao = get_saudacao();

      $emails_enviar = array();
      $emails_enviar['email'][0] = $email;
      $emails_enviar['nome'][0] = $nome;

      # DADOS PARA O TEMPLATE
      $this->load->library( 'notificacao/template/N_Usuario', NULL, 'tp_email' );

      $this->tp_email->setTituloTopo( $titulo_topo );
      $this->tp_email->setDataRodape( $data_rodape );
      $this->tp_email->setSaudacaoEmail( $saudacao );
      $this->tp_email->setNome( $nome );
      $this->tp_email->setEmail( $email );
      $this->tp_email->setSenha( $senha );

      $html = $this->tp_email->boas_vindas();

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

    protected function _log_imovel($id)
    {
      $ip = (!EXEC_CLI) ? $_SERVER['REMOTE_ADDR'] : '';
      $ua = (!EXEC_CLI) ? $_SERVER['HTTP_USER_AGENT'] : '';
      $usu_id = (int)$this->_usu_painel_id;

      $this->load->model(MODULO_PORTAL.'Plog_model', 'mclog');

      $qtd = $this->mclog->checkLogAcessoImovel($id,$ip,$ua);
      if($qtd == 0) { // if( ($qtd == 0) && ($ip != '') && ($ua != '') ) {
        $datains = array();
        $datains['fk_id_imovel'] = $id;
        $datains['fk_id_usuario'] = ($usu_id > 0) ? $usu_id : NULL;
        $datains['imace_data'] = date('Y-m-d H:i:s');
        $datains['imace_enderecoIp'] = ($ip != '') ? $ip : '#$ EXEC_CLI';
        $datains['imace_userAgent'] = ($ua != '') ? $ua : 'Browser EXEC_CLI';

        $this->mclog->set_table('imovel_acesso');
        $this->mclog->insert($datains);
      }
    }

    protected function _log_mensagem($id)
    {
      $ip = (!EXEC_CLI) ? $_SERVER['REMOTE_ADDR'] : '';
      $ua = (!EXEC_CLI) ? $_SERVER['HTTP_USER_AGENT'] : '';
      $usu_id = (int)$this->_usu_painel_id;

      $this->load->model(MODULO_PORTAL.'Plog_model', 'mclog');

      $qtd = $this->mclog->checkLogAcessoMensagem($id,$ip,$ua);
      if($qtd == 0) { // if( ($qtd == 0) && ($ip != '') && ($ua != '') ) {
        $datains = array();
        $datains['fk_id_imovelMensagem'] = $id;
        $datains['fk_id_usuario'] = ($usu_id > 0) ? $usu_id : NULL;
        $datains['imace_data'] = date('Y-m-d H:i:s');
        $datains['imsgac_enderecoIp'] = ($ip != '') ? $ip : '#$ EXEC_CLI';
        $datains['imsgac_userAgent'] = ($ua != '') ? $ua : 'Browser EXEC_CLI';

        $this->mclog->set_table('imovel_mensagem_acesso');
        $this->mclog->insert($datains);
      }
    }

    protected function _log_parceiro($id)
    {
      $ip = (!EXEC_CLI) ? $_SERVER['REMOTE_ADDR'] : '';
      $ua = (!EXEC_CLI) ? $_SERVER['HTTP_USER_AGENT'] : '';

      $this->load->model(MODULO_ADMIN.'Diretoria_model', 'mclog');

      $url_redirect = (int)$this->session->userdata('parceiro_urlRedirect');

      $datains = array();
      $datains['fk_id_parceiro'] = $id;
      $datains['parace_data'] = date('Y-m-d H:i:s');
      $datains['parace_enderecoIp'] = ($ip != '') ? $ip : '#$ EXEC_CLI';
      $datains['parace_navegador'] = ($ua != '') ? $ua : 'Browser EXEC_CLI';

      $this->mclog->set_table('parceiro_acesso');
      $id = $this->mclog->insert($datains, true);

      $session = array('parceiro_id_acesso'=>(int)$id);
      $this->session->set_userdata($session);

      $url1 = base_url(MODULO_PORTAL);
      $url2 = base_url(MODULO_CAMPANHA_2.'meu-imovel');
      $url3 = base_url();

      if($url_redirect <= 1 )
        redirect($url1);
      else if($url_redirect == 2)
        redirect($url2);
      else if($url_redirect == 3)
        redirect($url3);
    }
  }
