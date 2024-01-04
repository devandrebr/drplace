<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-06-08
 * @version 2018-10-04
 */
class Quem_somos extends MY_Controller
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

    $this->breadcrumb->add('Quem Somos');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Quem Somos';
    $dados['_titulo_page'] = 'Quem Somos';

    $dados['_menu_ativo'] = 'quem_somos';

    $dados['_view'] = __METHOD__;
    $dados['_tipo'] = 2;
    $this->_template_portal( $dados );
  }

}
