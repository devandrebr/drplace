<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-08
 * @version 2018-05-11
 */
class Home extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PORTAL;
    $this->_controller = strtolower( __CLASS__ );
  }

  function index()
  {
    $this->load->model($this->_modulo.'Pimovel_model', 'mimo');

    $res = $this->mimo->listaHome();
    $qtd = is_array($res) ? count($res) : 0;

    $res2 = $this->mimo->listaRodape(4);
    $qtd2 = is_array($res2) ? count($res2) : 0;

    $res3 = $this->mimo->listaHomeInteressados(4);
    $qtd3 = is_array($res3) ? count($res3) : 0;

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    $dados['res2'] = $res2;
    $dados['qtd2'] = $qtd2;

    $dados['res3'] = $res3;
    $dados['qtd3'] = $qtd3;

    $dados['_titulo'] = 'Seja Bem Vindo';
    $dados['_titulo_page'] = 'Seja bem vindo';
    $dados['_topo'] = 1;

    $dados['_menu_ativo'] = 'home';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function pesquisa($situacao='V',$str=0,$off=0)
  {
    $off = (int)$off;
    $ini = 9;

    $p_situacao = $this->input->post('sel_pesq_situacao');
    // $p_tipo = (int)$this->input->post('sel_pesq_tipo');
    $p_str = $this->input->post('inp_pesq_string');

    $usituacao = ($p_situacao != '') ? $p_situacao : $situacao;
    $ustr = ($p_str != '') ? $p_str : base64_decode($str);

    $this->load->model($this->_modulo.'Pimovel_model','mimo');

    $res = $this->mimo->resPesquisa($usituacao, $ustr, $off, $ini);
    $qtd = is_array($res) ? count($res) : 0;
    $qtd_total = $this->mimo->resPesquisaQtdTotal($usituacao, $ustr);

    $this->load->library('pagination');

    $config['base_url'] = base_url($this->_modulo.$this->_controller.'/pesquisa/'.$usituacao.'/'.base64_encode($ustr));
    $config['total_rows'] = $qtd_total;
    $config['per_page'] = $ini;
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

    $this->breadcrumb->add('Pesquisa');
    $this->breadcrumb->add('Imóveis Encontrados');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Imóvel';
    $dados['_titulo_page'] = 'Imóvel';

    $dados['_menu_ativo'] = 'pesquisa';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

}
