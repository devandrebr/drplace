<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-06-08
 * @version 2018-06-08
 */
class Vantagens extends MY_Controller
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

    $this->breadcrumb->add('Vantagens');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Vantagens';
    $dados['_titulo_page'] = 'Vantagens';

    $dados['_menu_ativo'] = 'vantagens';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

}
