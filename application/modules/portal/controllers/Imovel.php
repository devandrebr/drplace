<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-06-05
 * @version 2018-07-19
 */
class Imovel extends MY_Controller
{
  private $ini;

  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PORTAL;
    $this->_controller = strtolower( __CLASS__ );

    $this->ini = 9;
  }

  function alugar($tipo=0,$str=NULL,$off=0)
  {
    $off = (int)$off;

    $p_tipo = (int)$this->input->post('sel_pesq_tipo');
    $p_str = $this->input->post('inp_pesq_string');

    $usituacao = 'A';
    $utipo = ($p_tipo > 0) ? $p_tipo : (int)$tipo;
    $ustr = ($p_str != '') ? $p_str : base64_decode($str);

    $this->load->model($this->_modulo.'Pimovel_model','mimo');

    $res = $this->mimo->resPesquisa($usituacao, $utipo, $ustr, $off, $this->ini);
    $qtd = is_array($res) ? count($res) : 0;
    $qtd_total = $this->mimo->resPesquisaQtdTotal($usituacao, $utipo, $ustr);

    $this->load->library('pagination');

    $config['base_url'] = base_url($this->_modulo.$this->_controller.'/alugar/'.$utipo.'/'.base64_encode($ustr));
    $config['total_rows'] = $qtd_total;
    $config['per_page'] = $this->ini;
    $config['uri_segment'] = 6;
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
    $dados['qtd_total'] = $qtd_total;

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Imóveis disponíveis para locação');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Imóveis para locação';
    $dados['_titulo_page'] = 'Imóveis para locação';

    $dados['_menu_ativo'] = 'alugar';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function comprar($tipo=0,$str=NULL,$off=0)
  {
    $off = (int)$off;

    $p_tipo = (int)$this->input->post('sel_pesq_tipo');
    $p_str = $this->input->post('inp_pesq_string');

    $usituacao = 'V';
    $utipo = ($p_tipo > 0) ? $p_tipo : (int)$tipo;
    $ustr = ($p_str != '') ? $p_str : base64_decode($str);

    $this->load->model($this->_modulo.'Pimovel_model','mimo');

    $res = $this->mimo->resPesquisa($usituacao, $utipo, $ustr, $off, $this->ini);
    $qtd = is_array($res) ? count($res) : 0;
    $qtd_total = $this->mimo->resPesquisaQtdTotal($usituacao, $utipo, $ustr);

    $this->load->library('pagination');

    $config['base_url'] = base_url($this->_modulo.$this->_controller.'/comprar/'.$utipo.'/'.base64_encode($ustr));
    $config['total_rows'] = $qtd_total;
    $config['per_page'] = $this->ini;
    $config['uri_segment'] = 6;
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
    $dados['qtd_total'] = $qtd_total;

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Imóveis disponíveis para compra');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Imóveis à venda';
    $dados['_titulo_page'] = 'Imóveis à venda';

    $dados['_menu_ativo'] = 'comprar';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function detalhe_anuncio($id,$slug=NULL)
  {
    $this->load->model($this->_modulo.'Pimovel_model','mimo');

    $url_er = base_url('portal');

    $res = $this->mimo->detalhe($id,$this->_usu_painel_id);
    $qtd = is_array($res) ? count($res) : 0;
    if($qtd<=0)
      $this->_mensagem_status( 'info', 'Imóvel não encontrado, tente novamente.', $url_er );

    $this->_log_imovel($id);

    $this->mimo->set_return('row');

    $fieldcar = NULL;
    $wherecar = array('fk_id_imovel'=>$id);
    $this->mimo->set_table('imovel_caracteristica');
    $res_car = $this->mimo->get($fieldcar,$wherecar);

    $this->mimo->set_return('result');
    $fieldft = array('imoft_arquivo');
    $whereft = array('fk_id_imovel'=>$id);
    $this->mimo->set_table('imovel_foto');
    $res_ft = $this->mimo->get($fieldft,$whereft);

    $dados['res'] = $res;
    $dados['res_car'] = $res_car;
    $dados['res_ft'] = $res_ft;
    $dados['qtd_ft'] = is_array($res_ft) ? count($res_ft) : 0;

    $endereco = ($res['imo_logradouro'] != '') ? $res['imo_logradouro'] : '';
    $endereco .= ($res['imo_numero'] != '') ? ', n '.$res['imo_numero'] : '';
    $endereco .= ($res['imo_bairro'] != '') ? ', '.$res['imo_bairro'] : '';
    $endereco .= ($res['imo_complemento'] != '') ? ', '.$res['imo_complemento'] : '';
    $endereco .= ($res['imo_cep'] != '') ? ', '.$res['imo_cep'] : '';
    $endereco .= ($res['cid_nome'] != '') ? ' - '.$res['cid_nome'].'/'.$res['cid_sigla'] : '';

    $dados['map_lat'] = '';
    $dados['map_lng'] = '';
    $dados['map_address'] = $endereco;
    $dados['map_user'] = $res['usu_nome'];

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Imóvel');
    $this->breadcrumb->add($res['imo_titulo']);

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Imóvel';
    $dados['_titulo_page'] = 'Imóvel';

    $dados['_menu_ativo'] = 'detalhe';
    $dados['_enable_map_imovel'] = TRUE;

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function novo_interesse()
  {
    if( $this->_usu_painel_logado )
      redirect( base_url(MODULO_PAINEL.'imovel/novo-interesse') );

    $this->load->model($this->_modulo.'Pimovel_model', 'mimo');

    $res = $this->mimo->listaHomeInteressados(4);
    $qtd = is_array($res) ? count($res) : 0;

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Imóvel');
    $this->breadcrumb->add('Criar Interesse');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Publicar Seu Interesse';
    $dados['_titulo_page'] = 'Publicar Seu Interesse';

    $dados['_nav_bar_topo'] = '';

    $dados['_menu_ativo'] = 'novo_interesse';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function cadastrar_interesse()
  {
    if( $this->_usu_painel_logado )
      redirect( base_url(MODULO_PAINEL.'imovel/novo-interesse') );

    $this->load->library('form_validation');

    $config = array(
                   array('field'=>'inp_nome', 'label'=>'Seu Nome', 'rules'=>'required'),
                   array('field'=>'inp_email', 'label'=>'E-mail', 'rules'=>'required'),
                   array('field'=>'tex_msg', 'label'=>'Mensagem de interesse com no mínimo 50 letras.', 'rules'=>'required')
                );
    $this->form_validation->set_rules($config);

    $url_ok = base_url($this->_modulo.$this->_controller.'/comprar');
    $url_er = base_url($this->_modulo.$this->_controller.'/novo-interesse');

    if ( ! $this->form_validation->run($this) )
      $this->novo_interesse();
    else
    {
      $nome = $this->input->post('inp_nome');
      $email = $this->input->post('inp_email');
      $msg = $this->input->post('tex_msg');
      $cidade = $this->input->post('inp_cidade');
      $situacao = $this->input->post('opt_situacao');
      $perfil = 2;
      $senha1 = senha_aleatoria();
      $recaptcha = $this->input->post('g-recaptcha-response');

      // VERIFICA O reCaptcha
      $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLE_KEY_RECAPTCHA."&response=".$recaptcha );
      $g_response = json_decode($response);
      if($g_response->success !== true)
        $this->_mensagem_status('erro', 'Captcha não verificado! Tente novamente.', $url_er);

      $endereco_ip = $_SERVER['REMOTE_ADDR'];
      $user_agent = $_SERVER['HTTP_USER_AGENT'];

      $primeiro_nome = get_primeiro_nome($nome);

      $this->load->model(MODULO_PAINEL.'Imovel_model','musu');

      $this->musu->set_table('usuario');

      $where = array('usu_email1'=>$email,'usu_statusAtivo'=>TRUE);
      $qtd = $this->musu->count_results($where);
      if( $qtd >= 1 )
        $this->_mensagem_status( 'info', 'Ops! E-mail já está cadastrado, acesse o painel e faça seu cadastro.', $url_er );
      else
      {
        $data_atual = date('Y-m-d H:i:s');

        $datains1 = array();
        $datains1['fk_id_perfil'] = $perfil;
        $datains1['usu_nome'] = $nome;
        $datains1['usu_email1'] = $email;
        $datains1['usu_token'] = gerar_token();
        $datains1['usu_dataCadastro'] = $data_atual;
        $datains1['usu_senha'] = crypt_senha( $senha1 );
        $datains1['usu_confirmado'] = TRUE;
        $datains1['usu_admin'] = FALSE;

        $this->musu->set_table('usuario');
        $id_usu = $this->musu->insert( $datains1, TRUE );
        if( $id_usu > 0 )
        {
          $datains2 = array();
          $datains2['fk_id_usuario'] = $id_usu;
          $datains2['imint_nome'] = $nome;
          $datains2['imint_email'] = $email;
          $datains2['imint_msg'] = $msg;
          $datains2['imint_dataCadastro'] = $data_atual;

          $this->musu->set_table('imovel_interesse');
          $this->musu->insert( $datains2 );

          $this->_email_usuario_novo_interesse($nome,$email,$senha1);

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

             $url_ok = base_url(MODULO_PAINEL.'imovel/novo-interesse');
             $this->_mensagem_status( 'ok', 'Seu interesse foi cadastrado com sucesso.', $url_ok );
          }
        }
      }
    }
  }

  private function _email_usuario_novo_interesse($nome,$email,$senha)
  {
    $assunto = 'Cadastro | Dr.Place';
    $titulo_topo = 'Novo Cadastro na Plataforma';
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

    $html = $this->tp_email->confirmacao_cadastro_interesse();
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

  function enviar_procura_por_imovel()
  {
    $this->load->library('form_validation');

    $config = array(
                   array('field'=>'inp_nome', 'label'=>'Seu Nome', 'rules'=>'required'),
                   array('field'=>'tex_msg', 'label'=>'Mensagem', 'rules'=>'required')
                );
    $this->form_validation->set_rules($config);

    $url_ok = base_url($this->_modulo.'home');
    $url_er = $url_ok;

    if ( ! $this->form_validation->run($this) )
     $this->_mensagem_status('erro', 'Todos os campos são obrigatórios.', $url_er);
    else
    {
      $nome = $this->input->post('inp_nome');
      $mensagem = $this->input->post('tex_msg');

      $st = true;
      if( $st )
        $this->_mensagem_status( 'ok', '[não está acontecendo nada apenas essa msg de teste] Sua mensagem foi salva com sucesso. Brevemente entraremos em contato.', $url_ok );
      else
        $this->_mensagem_status( 'erro', 'Ops! Não foi possível enviar a solicitação devido a um erro desconhecido no servidor, entre em contato via telefone.<br>' . $envio['codigo'] . ' - ' . $envio['codigoMsg'], $url_er );
    }
  }
}
