<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-10-08
 * @version 2018-10-08
 */
class Artigo extends MY_Controller
{
  private $ini;

  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PORTAL;
    $this->_controller = strtolower( __CLASS__ );

    $this->ini = 2;
  }

  function index(){
    $this->lista();
  }

  function lista($off=0){
    $off = (int)$off;

    $this->load->model(MODULO_PORTAL.'Partigo_model', 'mart');
    $res = $this->mart->lista($off, $this->ini);
    $qtd = is_array($res) ? count($res) : 0;
    $qtd_total = $this->mart->qtdLista();

    $this->load->library('pagination');

    $config['base_url'] = base_url($this->_modulo.$this->_controller.'/lista/');
    $config['total_rows'] = $qtd_total;
    $config['per_page'] = $this->ini;
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
    $dados['qtd_total'] = $qtd_total;

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Artigos');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Todos os artigos do site';
    $dados['_titulo_page'] = 'Todos os artigos do site';

    $dados['_menu_ativo'] = 'artigo';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function detalhe($slug=NULL){
    $url_er = base_url('artigos');

    $slug = str_replace('_','-',$slug);

    $this->load->model(MODULO_PORTAL.'Partigo_model', 'mart');
    $res = $this->mart->detalheSlug($slug);
    $qtd = is_array($res) ? count($res) : 0;
    if($qtd<=0)
      $this->_mensagem_status( 'info', 'Artigo não encontrado, tente novamente.', $url_er );

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    $titulo = $res['art_titulo'];

    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Artigo');
    $this->breadcrumb->add($titulo);

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = $titulo;
    $dados['_titulo_page'] = $titulo;

    $dados['_menu_ativo'] = 'artigo';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }
}
