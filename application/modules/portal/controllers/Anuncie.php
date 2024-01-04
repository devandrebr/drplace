<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-21
 * @version 2018-05-21
 */
class Anuncie extends MY_Controller
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

    $this->breadcrumb->add('Página Inicial');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Seja Bem Vindo';
    $dados['_titulo_page'] = 'Seja bem vindo';

    $dados['_css_topo'] = 2; 
    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

}
