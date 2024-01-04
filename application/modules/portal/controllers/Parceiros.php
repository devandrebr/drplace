<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-10
 * @version 2018-06-30
 */
class Parceiros extends MY_Controller
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

    $this->breadcrumb->add('Parceiros');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Parceiros';
    $dados['_titulo_page'] = 'Parceiros';

    $dados['_menu_ativo'] = 'parceiros';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function contate_advogado()
  {
    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Parceiros', base_url('parceiros'));
    $this->breadcrumb->add('Contate Um Advogado');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Contate Um Advogado Parceiro da Dr.Place';
    $dados['_titulo_page'] = 'Contate Um Advogado';

    $dados['_menu_ativo'] = 'parceiros';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

}
