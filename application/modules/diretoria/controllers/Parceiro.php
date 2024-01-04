<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-09-27
 * @version 2018-09-27
 */
class Parceiro extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_ADMIN;
    $this->_controller = strtolower( __CLASS__ );
  }

  function index()
  {
    $this->_valida_usuario_logado_admin();

    $this->load->model( $this->_modulo . 'Parceiro_model', 'mparc' );

    $res = $this->mparc->lista();
    $qtd = is_array($res) ? count($res) : 0;

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    // Valores obrigatórios e defaults para a view
    $this->load->library('Make_bread_admin', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Parceiro');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Parceiro';
    $dados['_titulo_page'] = 'Lista dos Parceiros';

    $dados['_menu_left'] = 'parceiro';

    $dados['_view'] = __METHOD__;
    $this->_template_admin( $dados );
  }

  function acessos($id_parceiro,$slug=NULL)
  {
    $this->_valida_usuario_logado_admin();

    $this->load->model( $this->_modulo . 'Parceiro_model', 'mparc' );

    $this->mparc->set_table('parceiro_acesso');

    $field = array('parace_id','parace_data','parace_enderecoIp','parace_navegador');
    $where = array('fk_id_parceiro'=>$id_parceiro);
    $order = 'parace_data DESC';
    $res = $this->mparc->get($field,$where,$order);
    $qtd = is_array($res) ? count($res) : 0;

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    // Valores obrigatórios e defaults para a view
    $this->load->library('Make_bread_admin', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Parceiro');
    $this->breadcrumb->add('Acessos');
    if($slug!='')
      $this->breadcrumb->add(str_replace('_','-',$slug));

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Parceiro Acessos';
    $dados['_titulo_page'] = 'Lista dos Acessos do Parceiro';

    $dados['_menu_left'] = 'parceiro';

    $dados['_view'] = __METHOD__;
    $this->_template_admin( $dados );
  }

  function set_info($slug,$slug_campanha=NULL)
  {
    $slug = str_replace(array('_','+'),'-',trim($slug));
    $slug_campanha = str_replace(array('_','+'),'-',trim($slug_campanha));

    $this->load->model($this->_modulo.'Diretoria_model','mparc');

    $this->mparc->set_table('parceiro');
    $this->mparc->set_return('row');

    $field = array('parc_id','parc_nome','parc_email','parc_urlRedirect');
    $where = array('parc_slug'=>$slug);
    $res = $this->mparc->get($field,$where);
    $qtd = is_array($res) ? count($res) : 0;

    if( $qtd > 0 ) {
      $id = $res['parc_id'];

      $session = array(
        'parceiro_id' => $id,
        'parceiro_nome' => $res['parc_nome'],
        'parceiro_email' => $res['parc_email'],
        'parceiro_urlRedirect' => (int)$res['parc_urlRedirect']
      );
      $this->session->set_userdata($session);

      $this->_log_parceiro($id);
    }
  }

}
