<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-08-31
 * @version 2018-08-31
 */
class Home extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_ADMIN;
    $this->_controller = strtolower( __CLASS__ );

    $this->_valida_usuario_logado_admin();
  }

  function index()
  {
    $this->dashboard();
  }

  function dashboard()
  {
    // Valores obrigatórios e defaults para a view
    $this->load->library('Make_bread_admin', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Dashboard');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Dashboard';
    $dados['_titulo_page'] = 'Seja bem vindo, '.$this->_usu_admin_nome;

    $dados['_menu_left'] = 'dashboard';

    $dados['_view'] = __METHOD__;
    $this->_template_admin( $dados );
  }

}