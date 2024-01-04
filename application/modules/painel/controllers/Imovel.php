<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-10
 * @version 2018-07-19
 */
class Imovel extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PAINEL;
    $this->_controller = strtolower( __CLASS__ );

    $this->_valida_usuario_logado_painel();

    $this->load->library('form_validation');
  }

  function novo_anuncio()
  {
    $this->load->model( $this->_modulo . 'Imovel_model', 'mimo' );

    $uf = 'SP';

    $this->mimo->set_table('cidade');
    $field = array('cid_id','cid_sigla','cid_nome');
    $where = array('cid_sigla' => $uf, 'cid_status'=>TRUE,'cid_statusAtivo'=>TRUE);
    $res_cid = $this->mimo->get($field, $where);
    $qtd_cid = is_array($res_cid) ? count($res_cid) : 0;

    $this->mimo->set_table('imovel_tipo');
    $field = array('imtip_id', 'imtip_titulo', 'imtip_tipo');
    $where = array('imtip_statusAtivo' => TRUE);
    $order = 'imtip_tipo DESC, imtip_titulo ASC';
    $res_imtipo = $this->mimo->get($field, $where, $order);
    $qtd_imtipo = is_array($res_imtipo) ? count($res_imtipo) : 0;

    $url_er = base_url($this->_modulo.$this->_controller.'/meus-imoveis');

    $this->mimo->set_table('imovel');
    $where = array('fk_id_usuario'=>$this->_usu_painel_id,'imo_status' => TRUE);
    $qtd_imo = $this->mimo->count_results($where);
    if( $qtd_imo >= 1 )
      $this->_mensagem_status( 'info', 'Você já possui um imóvel cadastrado, o limite é de 1(um) anúncio por proprietário.', $url_er );

    $dados['res_imtipo'] = $res_imtipo;
    $dados['qtd_imtipo'] = $qtd_imtipo;

    $dados['res_cid'] = $res_cid;
    $dados['qtd_cid'] = $qtd_cid;

    $dados['combo_uf'] = combo_uf();
    $dados['qtd_uf'] = count($dados['combo_uf']);
    $dados['combo_situacao'] = combo_situacao();
    $dados['qtd_situacao'] = count($dados['combo_situacao']);

    $dados['_uf'] = $uf;

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Anunciar');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Anunciar Meu Imóvel';
    $dados['_titulo_page'] = 'Anunciar Meu Imóvel';

    $dados['_menu_ativo'] = 'novo_anuncio';
    $dados['_menu_painel'] = 'novo_anuncio';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function novo_interesse()
  {
    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Cadastrar Nova Procura de Imóvel');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Cadastrar Novo Interesse';
    $dados['_titulo_page'] = 'Anunciar meu novo interesse e procura por imóvel';

    $dados['_menu_ativo'] = 'novo_interesse';
    $dados['_menu_painel'] = 'novo_interesse';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function editar_anuncio($id,$slug=NULL)
  {
    $url_er = base_url($this->_modulo.$this->_controller.'/meus-imoveis');

    $this->load->model( $this->_modulo . 'Imovel_model', 'mimo' );

    $res = $this->mimo->editar($id,$this->_usu_painel_id);
    $qtd = is_array($res) ? count($res) : 0;
    if($qtd<=0)
      $this->_mensagem_status( 'info', 'Imóvel não encontrado, tente novamente.', $url_er );

    $this->mimo->set_return('row');

    $fieldcar = NULL;
    $wherecar = array('fk_id_imovel'=>$id);
    $this->mimo->set_table('imovel_caracteristica');
    $res_car = $this->mimo->get($fieldcar,$wherecar);

    $this->mimo->set_return('result');

    $this->mimo->set_table('imovel_foto');
    $field = array('imoft_id','imoft_arquivo');
    $where = array('fk_id_imovel' => $id);
    $res_imoft = $this->mimo->get($field, $where);
    $qtd_imoft = is_array($res_imoft) ? count($res_imoft) : 0;

    $dados['res'] = $res;
    $dados['res_car'] = $res_car;
    $dados['res_imoft'] = $res_imoft;
    $dados['qtd_imoft'] = $qtd_imoft;

    $uf = ($res['cid_sigla']=='') ? 'SP' : $res['cid_sigla'];

    $this->mimo->set_table('cidade');
    $field = array('cid_id','cid_sigla','cid_nome');
    $where = array('cid_sigla' => $uf, 'cid_status'=>TRUE,'cid_statusAtivo'=>TRUE);
    $res_cid = $this->mimo->get($field, $where);
    $qtd_cid = is_array($res_cid) ? count($res_cid) : 0;

    $this->mimo->set_table('imovel_tipo');
    $field = array('imtip_id', 'imtip_titulo', 'imtip_tipo');
    $where = array('imtip_statusAtivo' => TRUE);
    $order = 'imtip_tipo DESC, imtip_titulo ASC';
    $res_imtipo = $this->mimo->get($field, $where, $order);
    $qtd_imtipo = is_array($res_imtipo) ? count($res_imtipo) : 0;

    $dados['res_imtipo'] = $res_imtipo;
    $dados['qtd_imtipo'] = $qtd_imtipo;

    $dados['res_cid'] = $res_cid;
    $dados['qtd_cid'] = $qtd_cid;

    $dados['combo_uf'] = combo_uf();
    $dados['qtd_uf'] = count($dados['combo_uf']);
    $dados['combo_situacao'] = combo_situacao();
    $dados['qtd_situacao'] = count($dados['combo_situacao']);

    $dados['_uf'] = $uf;

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Anunciar');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Editar Meu Imóvel';
    $dados['_titulo_page'] = 'Editar Meu Imóvel';

    $dados['_menu_ativo'] = 'meus_imoveis';
    $dados['_menu_painel'] = 'meus_imoveis';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function lista_interessados($off=0)
  {
    $off = (int)$off;
    $ini = 12;

    $this->load->model($this->_modulo.'Imovel_model','mimo');

    $res = $this->mimo->listaInteressados($off, $ini);
    $qtd = is_array($res) ? count($res) : 0;

    $res2 = $this->mimo->listaInteressadosById($this->_usu_painel_id);
    $qtd2 = is_array($res2) ? count($res2) : 0;

    $this->mimo->set_table('imovel');
    $where = array('fk_id_usuario' => $this->_usu_painel_id, 'imo_status' => TRUE);
    $qtd_total = $this->mimo->count_results($where);

    $this->load->library('pagination');

    $config['base_url'] = base_url($this->_modulo.$this->_controller.'/lista-interessados/');
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

    $dados['res2'] = $res2;
    $dados['qtd2'] = $qtd2;

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Lista dos Interessados');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Lista dos Interessados';
    $dados['_titulo_page'] = 'Lista dos Interessados';

    $dados['_menu_ativo'] = 'lista_interesse';
    $dados['_menu_painel'] = 'lista_interesse';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function meus_imoveis($off=0)
  {
    $off = (int)$off;
    $ini = 6;

    $this->load->model($this->_modulo.'Imovel_model','mimo');

    $res = $this->mimo->lista($this->_usu_painel_id, $off, $ini);
    $qtd = is_array($res) ? count($res) : 0;

    $this->mimo->set_table('imovel');
    $where = array('fk_id_usuario' => $this->_usu_painel_id, 'imo_status' => TRUE);
    $qtd_total = $this->mimo->count_results($where);

    $this->load->library('pagination');

    $config['base_url'] = base_url($this->_modulo.$this->_controller.'/meus-imoveis/');
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

    $this->breadcrumb->add('Meus Imóveis');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Meus Imóveis';
    $dados['_titulo_page'] = 'Meus Imóveis';

    $dados['_menu_ativo'] = 'meus_imoveis';
    $dados['_menu_painel'] = 'meus_imoveis';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function favoritos($off=0)
  {
    $off = (int)$off;
    $ini = 6;

    $this->load->model($this->_modulo.'Imovel_model','mimo');

    $res = $this->mimo->listaFavoritos($this->_usu_painel_id, $off, $ini);
    $qtd = is_array($res) ? count($res) : 0;

    $this->mimo->set_table('imovel_favorito');
    $where = array('fk_id_usuario' => $this->_usu_painel_id, 'imfav_statusAtivo' => TRUE);
    $qtd_total = $this->mimo->count_results($where);

    $this->load->library('pagination');

    $config['base_url'] = base_url($this->_modulo.$this->_controller.'/favoritos/');
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

    $this->breadcrumb->add('Meus Imóveis',base_url(MODULO_PAINEL.'imovel/meus-imoveis'));
    $this->breadcrumb->add('Favoritos');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Imóveis Favoritos';
    $dados['_titulo_page'] = 'Favoritos';

    $dados['_menu_ativo'] = 'imoveis_favoritos';
    $dados['_menu_painel'] = 'imoveis_favoritos';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function registro_interesse($url_red=1)
  {
    $config = array(
                     array('field'=>'inp_nome', 'label'=>'Nome', 'rules'=>'required'),
                     array('field'=>'inp_email', 'label'=>'E-mail', 'rules'=>'required'),
                     array('field'=>'tex_msg', 'label'=>'Mensagem', 'rules'=>'required'),
                );
    $this->form_validation->set_rules( $config );

    $url_red = (int)$url_red;

    if( $url_red <= 1 )
      $url_ok = base_url(MODULO_PAINEL.'home/minha-conta');
    else if( $url_red == 2 )
      $url_ok = base_url('criar-interesse');

    $url_er = $url_ok;

    if ( ! $this->form_validation->run($this) ) {
      if( $url_red <= 1 )
        $this->novo_interesse();
      else
       $this->_mensagem_status( 'erro', 'Todos os campos são obrigatórios.', $url_er );
    }
    else
    {
      $this->load->model($this->_modulo.'Imovel_model','mimo');

      $nome = $this->input->post('inp_nome');
      $email = $this->input->post('inp_email');
      $msg = $this->input->post('tex_msg');
      $data_cad = date('Y-m-d H:i:s');

      $dadosins = array();
      $dadosins['fk_id_usuario'] = $this->_usu_painel_id;
      $dadosins['imint_nome'] = $nome;
      $dadosins['imint_email'] = $email;
      $dadosins['imint_msg'] = $msg;
      $dadosins['imint_dataCadastro'] = $data_cad;

      $this->mimo->set_table('imovel_interesse');
      $st = $this->mimo->insert($dadosins);
      if( $st )
        $this->_mensagem_status( 'ok', 'Interesse adicionado com sucesso.', $url_ok );
      else
        $this->_mensagem_status( 'erro', 'Erro de conexão com o servidor, tente novamente.', $url_er );
    }
  }

  function registro()
  {
    $this->load->model($this->_modulo.'Imovel_model','mimo');

    $url_er = base_url($this->_modulo.$this->_controller.'/meus-imoveis');

    $this->mimo->set_table('imovel');
    $where = array('fk_id_usuario'=>$this->_usu_painel_id,'imo_status' => TRUE);
    $qtd_imo = $this->mimo->count_results($where);
    if( $qtd_imo >= 1 )
      $this->_mensagem_status( 'info', 'Você já possui um imóvel cadastrado, o limite é de 1(um) anúncio por proprietário.', $url_er );

    $config = array(
                     array('field'=>'inp_titulo', 'label'=>'Título do Anúncio', 'rules'=>'required'),
                     array('field'=>'opt_situacao', 'label'=>'Situação', 'rules'=>'required'),
                     array('field'=>'opt_tipo', 'label'=>'Tipo do Imóvel', 'rules'=>'required'),
                );
    $this->form_validation->set_rules( $config );

    if ( ! $this->form_validation->run($this) )
     $this->novo_anuncio();
    else
    {
      $url_ok = base_url($this->_modulo.$this->_controller.'/novo-anuncio');
      $url_er = $url_ok;

      $titulo = $this->input->post('inp_titulo');
      $codigo = NULL; // $codigo = $this->input->post('inp_codigo');
      $situacao = $this->input->post('opt_situacao');
      $tipo = $this->input->post('opt_tipo');
      $cidade = $this->input->post('opt_cidade');
      $cidade = (int)$cidade <= 0 ? NULL : $cidade;
      $logradouro = $this->input->post('inp_endereco');
      $numero = $this->input->post('inp_numero');
      $bairro = $this->input->post('inp_bairro');
      $cep = $this->input->post('inp_cep');
      $complemento = $this->input->post('inp_complemento');
      $descricao = $this->input->post('tex_obs');
      $dt_construcao = converte_data($this->input->post('inp_construcao'));
      $dt_reforma = converte_data($this->input->post('inp_reforma'));
      $valor = converte_moeda($this->input->post('inp_valor'));
      $valorVenda = converte_moeda($this->input->post('inp_valorVenda'));
      $dormitorio = $this->input->post('inp_dormitorio');
      $banheiro = $this->input->post('inp_banheiro');
      $area = $this->input->post('inp_area');
      $suite = $this->input->post('inp_suite');
      $garagem = $this->input->post('inp_garagem');
      $cozinha = $this->input->post('inp_cozinha');
      $valor_iptu = NULL;
      $valor_cond = NULL;
      $data_cad = date('Y-m-d H:i:s');

      $ck_viaAcesso = $this->input->post('ck_viaAcesso');
      $ck_shopping = $this->input->post('ck_shopping');
      $ck_sacada = $this->input->post('ck_sacada');
      $ck_quintal = $this->input->post('ck_quintal');
      $ck_espGourmet = $this->input->post('ck_espGourmet');
      $ck_quadraPolies = $this->input->post('ck_quadraPolies');
      $ck_piscina = $this->input->post('ck_piscina');
      $ck_churrasqueira = $this->input->post('ck_churrasqueira');
      $ck_jardim = $this->input->post('ck_jardim');
      $ck_circSeg = $this->input->post('ck_circSeg');
      $ck_condFechado = $this->input->post('ck_condFechado');
      $ck_condAberto = $this->input->post('ck_condAberto');
      $ck_areaServico = $this->input->post('ck_areaServico');
      $ck_segFullTime = $this->input->post('ck_segFullTime');
      $ck_hospital = $this->input->post('ck_hospital');
      $ck_parque = $this->input->post('ck_parque');
      $ck_transPub = $this->input->post('ck_transPub');
      $ck_escola = $this->input->post('ck_escola');
      $ck_internet = $this->input->post('ck_internet');
      $ck_interfone = $this->input->post('ck_interfone');
      $ck_arCondicionado = $this->input->post('ck_arCondicionado');

      $latitude = $longitude = '';
      if((int)$cidade > 0) {
        $this->mimo->set_table('cidade');
        $this->mimo->set_return('row');
        $res = $this->mimo->get(array('cid_sigla','cid_nome'),array('cid_id'=>$cidade));
        $cid_sigla = $res['cid_sigla'];
        $cid_nome = $res['cid_nome'];

        $endereco = ($logradouro != '') ? $logradouro : '';
        $endereco .= ($numero != '') ? ', n '.$numero : '';
        $endereco .= ($bairro != '') ? ', '.$bairro : '';
        $endereco .= ($complemento != '') ? ', '.$complemento : '';
        $endereco .= ($cep != '') ? ', '.$cep : '';
        $endereco .= ($cid_nome != '') ? ' - '.$cid_nome.'/'.$cid_sigla : '';

        $r_latLng = get_latLong($endereco);

        $latitude = $r_latLng['lat'];
        $longitude = $r_latLng['lng'];
      }

      $dadosins = array();
      $dadosins['fk_id_usuario'] = $this->_usu_painel_id;
      $dadosins['fk_id_cidade'] = $cidade;
      $dadosins['fk_id_tipo'] = $tipo;
      $dadosins['imo_codigo'] = $codigo;
      $dadosins['imo_titulo'] = $titulo;
      $dadosins['imo_descricao'] = $descricao;
      $dadosins['imo_logradouro'] = $logradouro;
      $dadosins['imo_numero'] = $numero;
      $dadosins['imo_bairro'] = $bairro;
      $dadosins['imo_complemento'] = $complemento;
      $dadosins['imo_cep'] = $cep;
      $dadosins['imo_valor'] = $valor;
      $dadosins['imo_valorVenda'] = $valorVenda;
      $dadosins['imo_dataCadastro'] = $data_cad;
      $dadosins['imo_dataEdicao'] = NULL;
      $dadosins['imo_ultimaReforma'] = $dt_reforma;
      $dadosins['imo_construcao'] = $dt_construcao;
      $dadosins['imo_situacao'] = $situacao;
      $dadosins['imo_valorIptu'] = $valor_iptu;
      $dadosins['imo_valorCondominio'] = $valor_cond;
      $dadosins['imo_latitude'] = $latitude;
      $dadosins['imo_longitude'] = $longitude;

      $img_imovel = isset($_FILES['inp_imagem']['name']) ? $_FILES['inp_imagem'] : array();

      $this->mimo->set_table('imovel');
      $id_imovel = $this->mimo->insert($dadosins, TRUE);
      if( $id_imovel > 0 )
      {
        $this->_upload_foto_imovel($img_imovel,$id_imovel);

        $dadosins2 = array();
        $dadosins2['fk_id_imovel'] = $id_imovel;
        $dadosins2['imcar_proxViaAcesso'] = (int)$ck_viaAcesso;
        $dadosins2['imcar_proxEscola'] = (int)$ck_escola;
        $dadosins2['imcar_proxTransPub'] = (int)$ck_transPub;
        $dadosins2['imcar_proxHospital'] = (int)$ck_hospital;
        $dadosins2['imcar_proxShopping'] = (int)$ck_shopping;
        $dadosins2['imcar_quintal'] = (int)$ck_quintal;
        $dadosins2['imcar_sacada'] = (int)$ck_sacada;
        $dadosins2['imcar_areaServico'] = (int)$ck_areaServico;
        $dadosins2['imcar_condominioFechado'] = (int)$ck_condFechado;
        $dadosins2['imcar_condominioAberto'] = (int)$ck_condAberto;
        $dadosins2['imcar_churrasqueira'] = (int)$ck_churrasqueira;
        $dadosins2['imcar_jardim'] = (int)$ck_jardim;
        $dadosins2['imcar_piscina'] = (int)$ck_piscina;
        $dadosins2['imcar_parque'] = (int)$ck_parque;
        $dadosins2['imcar_quadraPoliesportiva'] = (int)$ck_quadraPolies;
        $dadosins2['imcar_espacoGourmet'] = (int)$ck_espGourmet;
        $dadosins2['imcar_segurancaFullTime'] = (int)$ck_segFullTime;
        $dadosins2['imcar_circuitoSeguranca'] = (int)$ck_circSeg;
        $dadosins2['imcar_internet'] = (int)$ck_internet;
        $dadosins2['imcar_interfone'] = (int)$ck_interfone;
        $dadosins2['imcar_arCondicionado'] = (int)$ck_arCondicionado;

        if( $dormitorio != '' )
          $dadosins2['imcar_dormitorio'] = $dormitorio;
        if( $banheiro != '' )
          $dadosins2['imcar_banheiro'] = $banheiro;
        if( $area != '' )
          $dadosins2['imcar_area'] = $area;
        if( $suite != '' )
          $dadosins2['imcar_suite'] = $suite;
        if( $garagem != '' )
          $dadosins2['imcar_garagem'] = $garagem;
        if( $cozinha != '' )
          $dadosins2['imcar_cozinha'] = $cozinha;

        $this->mimo->set_table('imovel_caracteristica');
        $this->mimo->insert($dadosins2);

        $this->_mensagem_status( 'ok', 'Imóvel adicionado com sucesso.', $url_ok );
      }
      else
        $this->_mensagem_status( 'erro', 'Erro de conexão com o servidor, tente novamente.', $url_er );
    }
  }

  function atualizar()
  {
    $config = array(
                     array('field'=>'inp_titulo', 'label'=>'Título do Anúncio', 'rules'=>'required'),
                     array('field'=>'opt_situacao', 'label'=>'Situação', 'rules'=>'required'),
                     array('field'=>'opt_tipo', 'label'=>'Tipo do Imóvel', 'rules'=>'required'),
                );
    $this->form_validation->set_rules( $config );

    $titulo = $this->input->post('inp_titulo');
    $slug = url_slug($titulo);

    $id_imovel = $this->input->post('id');

    if ( ! $this->form_validation->run($this) )
     $this->editar($id_imovel);
    else
    {
      $url_ok = base_url($this->_modulo.$this->_controller.'/editar-anuncio/'.$id_imovel.'/'.$slug);
      $url_er = $url_ok;

      $codigo = NULL; // $codigo = $this->input->post('inp_codigo');
      $situacao = $this->input->post('opt_situacao');
      $tipo = $this->input->post('opt_tipo');
      $cidade = $this->input->post('opt_cidade');
      $cidade = (int)$cidade <= 0 ? NULL : $cidade;
      $endereco = $this->input->post('inp_endereco');
      $numero = $this->input->post('inp_numero');
      $bairro = $this->input->post('inp_bairro');
      $cep = $this->input->post('inp_cep');
      $complemento = $this->input->post('inp_complemento');
      $descricao = $this->input->post('tex_obs');
      $dt_construcao = converte_data($this->input->post('inp_construcao'));
      $dt_reforma = converte_data($this->input->post('inp_reforma'));
      $valor = converte_moeda($this->input->post('inp_valor'));
      $valorVenda = converte_moeda($this->input->post('inp_valorVenda'));
      $dormitorio = $this->input->post('inp_dormitorio');
      $banheiro = $this->input->post('inp_banheiro');
      $area = $this->input->post('inp_area');
      $suite = $this->input->post('inp_suite');
      $garagem = $this->input->post('inp_garagem');
      $cozinha = $this->input->post('inp_cozinha');
      $valor_iptu = NULL;
      $valor_cond = NULL;
      $data_atual = date('Y-m-d H:i:s');

      $ck_viaAcesso = $this->input->post('ck_viaAcesso');
      $ck_shopping = $this->input->post('ck_shopping');
      $ck_sacada = $this->input->post('ck_sacada');
      $ck_quintal = $this->input->post('ck_quintal');
      $ck_espGourmet = $this->input->post('ck_espGourmet');
      $ck_quadraPolies = $this->input->post('ck_quadraPolies');
      $ck_piscina = $this->input->post('ck_piscina');
      $ck_churrasqueira = $this->input->post('ck_churrasqueira');
      $ck_jardim = $this->input->post('ck_jardim');
      $ck_circSeg = $this->input->post('ck_circSeg');
      $ck_condFechado = $this->input->post('ck_condFechado');
      $ck_condAberto = $this->input->post('ck_condAberto');
      $ck_areaServico = $this->input->post('ck_areaServico');
      $ck_segFullTime = $this->input->post('ck_segFullTime');
      $ck_hospital = $this->input->post('ck_hospital');
      $ck_parque = $this->input->post('ck_parque');
      $ck_transPub = $this->input->post('ck_transPub');
      $ck_escola = $this->input->post('ck_escola');
      $ck_internet = $this->input->post('ck_internet');
      $ck_interfone = $this->input->post('ck_interfone');
      $ck_arCondicionado = $this->input->post('ck_arCondicionado');

      $this->load->model($this->_modulo.'Imovel_model','mimo');

      $latitude = $longitude = '';
      if((int)$cidade > 0) {
        $this->mimo->set_table('cidade');
        $this->mimo->set_return('row');
        $res = $this->mimo->get(array('cid_sigla','cid_nome'),array('cid_id'=>$cidade));
        $cid_sigla = $res['cid_sigla'];
        $cid_nome = $res['cid_nome'];

        $enderecoTmp = ($endereco != '') ? $endereco : '';
        $enderecoTmp .= ($numero != '') ? ', n '.$numero : '';
        $enderecoTmp .= ($bairro != '') ? ', '.$bairro : '';
        $enderecoTmp .= ($complemento != '') ? ', '.$complemento : '';
        $enderecoTmp .= ($cep != '') ? ', '.$cep : '';
        $enderecoTmp .= ($cid_nome != '') ? ' - '.$cid_nome.'/'.$cid_sigla : '';

        $r_latLng = get_latLong($enderecoTmp);

        $latitude = $r_latLng['lat'];
        $longitude = $r_latLng['lng'];
      }

      $dadosupd = array();
      $dadosupd['fk_id_usuario'] = $this->_usu_painel_id;
      $dadosupd['fk_id_cidade'] = $cidade;
      $dadosupd['fk_id_tipo'] = $tipo;
      $dadosupd['imo_codigo'] = $codigo;
      $dadosupd['imo_titulo'] = $titulo;
      $dadosupd['imo_descricao'] = $descricao;
      $dadosupd['imo_logradouro'] = $endereco;
      $dadosupd['imo_numero'] = $numero;
      $dadosupd['imo_bairro'] = $bairro;
      $dadosupd['imo_complemento'] = $complemento;
      $dadosupd['imo_cep'] = $cep;
      $dadosupd['imo_valor'] = $valor;
      $dadosupd['imo_valorVenda'] = $valorVenda;
      $dadosupd['imo_dataEdicao'] = $data_atual;
      $dadosupd['imo_ultimaReforma'] = $dt_reforma;
      $dadosupd['imo_construcao'] = $dt_construcao;
      $dadosupd['imo_situacao'] = $situacao;
      $dadosupd['imo_valorIptu'] = $valor_iptu;
      $dadosupd['imo_valorCondominio'] = $valor_cond;
      $dadosupd['imo_latitude'] = $latitude;
      $dadosupd['imo_longitude'] = $longitude;

      $img_imovel = isset($_FILES['inp_imagem']['name']) ? $_FILES['inp_imagem'] : array();
      $qtd_imgImo = is_array($img_imovel['name']) ? count($img_imovel['name']) : 0;

      $this->mimo->set_table('imovel');

      $whereqtd = array('imo_id'=>$id_imovel,'fk_id_usuario'=>$this->_usu_painel_id,'imo_status'=>1);
      $qtd = $this->mimo->count_results($whereqtd);
      if($qtd<=0)
        $this->_mensagem_status('erro', 'Imóvel não encontrado.', $url_er);

      $where = array('imo_id'=>$id_imovel, 'fk_id_usuario'=>$this->_usu_painel_id);
      $st = $this->mimo->update($dadosupd, $where);
      if( $st )
      {
        if($qtd_imgImo > 0)
          $this->_upload_foto_imovel($img_imovel,$id_imovel);

        $this->mimo->set_table('imovel_caracteristica');
        $this->mimo->delete(array('fk_id_imovel'=>$id_imovel));

        $dadosins2 = array();
        $dadosins2['fk_id_imovel'] = $id_imovel;
        $dadosins2['imcar_proxViaAcesso'] = (int)$ck_viaAcesso;
        $dadosins2['imcar_proxEscola'] = (int)$ck_escola;
        $dadosins2['imcar_proxTransPub'] = (int)$ck_transPub;
        $dadosins2['imcar_proxHospital'] = (int)$ck_hospital;
        $dadosins2['imcar_proxShopping'] = (int)$ck_shopping;
        $dadosins2['imcar_quintal'] = (int)$ck_quintal;
        $dadosins2['imcar_sacada'] = (int)$ck_sacada;
        $dadosins2['imcar_areaServico'] = (int)$ck_areaServico;
        $dadosins2['imcar_condominioFechado'] = (int)$ck_condFechado;
        $dadosins2['imcar_condominioAberto'] = (int)$ck_condAberto;
        $dadosins2['imcar_churrasqueira'] = (int)$ck_churrasqueira;
        $dadosins2['imcar_jardim'] = (int)$ck_jardim;
        $dadosins2['imcar_piscina'] = (int)$ck_piscina;
        $dadosins2['imcar_parque'] = (int)$ck_parque;
        $dadosins2['imcar_quadraPoliesportiva'] = (int)$ck_quadraPolies;
        $dadosins2['imcar_espacoGourmet'] = (int)$ck_espGourmet;
        $dadosins2['imcar_segurancaFullTime'] = (int)$ck_segFullTime;
        $dadosins2['imcar_circuitoSeguranca'] = (int)$ck_circSeg;
        $dadosins2['imcar_internet'] = (int)$ck_internet;
        $dadosins2['imcar_interfone'] = (int)$ck_interfone;
        $dadosins2['imcar_arCondicionado'] = (int)$ck_arCondicionado;

        if( $dormitorio != '' )
          $dadosins2['imcar_dormitorio'] = $dormitorio;
        if( $banheiro != '' )
          $dadosins2['imcar_banheiro'] = $banheiro;
        if( $area != '' )
          $dadosins2['imcar_area'] = $area;
        if( $suite != '' )
          $dadosins2['imcar_suite'] = $suite;
        if( $garagem != '' )
          $dadosins2['imcar_garagem'] = $garagem;
        if( $cozinha != '' )
          $dadosins2['imcar_cozinha'] = $cozinha;

        $this->mimo->set_table('imovel_caracteristica');
        $this->mimo->insert($dadosins2);

        $this->_mensagem_status( 'ok', 'Imóvel atualizado com sucesso.', $url_ok );
      }
      else
        $this->_mensagem_status( 'erro', 'Erro de conexão com o servidor, tente novamente.', $url_er );
    }
  }

  function remover_anuncio($id_imovel)
  {
    $url_ok = base_url($this->_modulo.'meus-imoveis/');
    $url_er = $url_ok;

    $this->load->model(MODULO_PAINEL.'Imovel_model', 'mimo' );

    $this->mimo->set_table('imovel');
    $where = array('imo_id'=>(int)$id_imovel,'fk_id_usuario'=>$this->_usu_painel_id,'imo_status'=>TRUE);
    $qtd = $this->mimo->count_results($where);
    if( $qtd == 0 )
      $this->_mensagem_status( 'info', 'Ops! Imóvel não localizado, tente novamente.', $url_er );

    # Del as fotos do imóvel
    $this->mimo->set_table('imovel_foto');
    $field = array('imoft_arquivo');
    $where = array('fk_id_imovel'=>$id_imovel);
    $res = $this->mimo->get($field,$where);
    $qtd = is_array($res) ? count($res) : 0;
    if( $qtd > 0 ) {
      for($i=0; $i<$qtd; $i++):
        $img = $res[$i]['imoft_arquivo'];
        $path = PATH_UPLOAD.$this->_usu_painel_id.'/'.$img;
        if( is_file($path) && !is_dir($path) )
          @unlink($path);
      endfor;
    }

    $this->mimo->delete($where);

    $dadosupd = array();
    $dadosupd['imo_status'] = FALSE;
    $dadosupd['imo_dataEdicao'] = date('Y-m-d H:i:s');

    $this->mimo->set_table('imovel');

    $where = array('imo_id'=>$id_imovel);
    $st = $this->mimo->update($dadosupd, $where);
    if($st)
      $this->_mensagem_status( 'ok', 'Imóvel removido com sucesso.', $url_ok );
    else
      $this->_mensagem_status( 'erro', 'Erro de conexão com o servidor, tente novamente.', $url_er );
  }

  function remover_favorito($imo_id_favorito)
  {
    $imo_id_favorito = (int)$imo_id_favorito;

    $url_ok = base_url($this->_modulo.'imoveis-favoritos');
    $url_er = $url_ok;

    $this->load->model(MODULO_PAINEL.'Imovel_model', 'mimo' );

    $this->mimo->set_table('imovel_favorito');

    $where = array('imfav_id'=>$imo_id_favorito,'fk_id_usuario'=>$this->_usu_painel_id);
    $qtd = $this->mimo->count_results($where);
    if( $qtd == 0 )
      $this->_mensagem_status( 'info', 'Ops! Código do imóvel favoritado não localizado, tente novamente.', $url_er );

    $st = $this->mimo->delete($where);
    if($st)
      $this->_mensagem_status( 'ok', 'Imóvel removido da lista de favoritos.', $url_ok );
    else
      $this->_mensagem_status( 'erro', 'Erro de conexão com o servidor, tente novamente.', $url_er );
  }

  function remover_foto($id_imovel,$id_foto)
  {
    $url_ok = base_url($this->_modulo.$this->_controller.'/editar-anuncio/'.$id_imovel.'/#boximg');
    $url_er = $url_ok;

    $this->load->model(MODULO_PAINEL.'Imovel_model', 'mimo' );

    $res = $this->mimo->verificaFoto($id_imovel,$id_foto,$this->_usu_painel_id);
    $qtd = is_array($res) ? count($res) : 0;
    if( $qtd == 0 )
      $this->_mensagem_status( 'info', 'Ops! Foto não localizada, tente novamente.', $url_er );

    $path = PATH_UPLOAD.$this->_usu_painel_id.'/'.$res['imoft_arquivo'];
    if( is_file($path) && !is_dir($path) )
      @unlink($path);

    $this->mimo->set_table('imovel_foto');

    $where = array('imoft_id'=>$id_foto);
    $st = $this->mimo->delete($where);
    if($st)
      $this->_mensagem_status( 'ok', 'Foto removida com sucesso.', $url_ok );
    else
      $this->_mensagem_status( 'erro', 'Erro de conexão com o servidor, tente novamente.', $url_er );
  }

  private function _upload_foto_imovel($imagens,$id)
  {
    $this->load->library('upload/Imagem',NULL,'upimg');

    $diretorio = PATH_UPLOAD.$this->_usu_painel_id.'/';
    verifica_diretorio($diretorio);

    $qtd = is_array($imagens) ? count((array)$imagens['name']) : 0;
    $up_ok = array();
    if( $qtd > 0 ) {
      for( $i=0; $i<$qtd; $i++ ):
        $name = isset($imagens['name'][$i]) ? $imagens['name'][$i] : '';
        if( $name != '' ) {
          $arquivo = array();
          $arquivo['name'] = $imagens['name'][$i];
          $arquivo['type'] = $imagens['type'][$i];
          $arquivo['tmp_name'] = $imagens['tmp_name'][$i];
          $arquivo['error'] = $imagens['error'][$i];
          $arquivo['size'] = $imagens['size'][$i];

          $arq_nome = get_nome_arquivo($arquivo['name'], 70, TRUE);

          list( $width, $height ) = getimagesize($arquivo['tmp_name']);

          $size = $this->upimg->getTamanhoRedimensionado($width,$height,UP_FOTO_IMOVEL_MAX_LARG,UP_FOTO_IMOVEL_MAX_ALT);

          $this->upimg->setRedimensionar();
          $this->upimg->setArquivo($arquivo);
          $this->upimg->setNomeArquivoImg($arq_nome);
          $this->upimg->setDiretorio($diretorio);
          $this->upimg->setAltura($size['h']);
          $this->upimg->setLargura($size['w']);
          $this->upimg->upload();

          $st = $this->upimg->getStatusError();
          if( $st->cod == 1 )
            $up_ok[] = $st->nome_arquivo;
        }
      endfor;

      $qtd_ok = count($up_ok);
      if($qtd_ok > 0) {
        $this->load->model($this->_modulo.'Imovel_model','mupimg');

        for( $i=0; $i<$qtd_ok; $i++ ):
          $datains = array();
          $datains['fk_id_imovel'] = $id;
          $datains['imoft_arquivo'] = $up_ok[$i];
          $datains['imoft_dataCadastro'] = date('Y-m-d H:i:s');

          $this->mupimg->set_table('imovel_foto');
          $this->mupimg->insert($datains);
        endfor;
      }
    }
  }
}
