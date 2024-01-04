<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-10
 * @version 2018-06-08
 */
class Ajuda extends MY_Controller
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

    $this->breadcrumb->add('FAQ - Ajuda');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Ajuda - FAQ';
    $dados['_titulo_page'] = 'Ajuda - FAQ';

    $dados['_menu_ativo'] = 'ajuda';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function politica_privacidade()
  {
    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Política de Privacidade');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Política de Privacidade';
    $dados['_titulo_page'] = 'Política de Privacidade';

    $dados['_menu_ativo'] = 'ajuda';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function termos_de_uso()
  {
    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Termos de Uso');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Termos de Uso';
    $dados['_titulo_page'] = 'Termos de Uso';

    $dados['_menu_ativo'] = 'ajuda';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function faq_como_vender()
  {
    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('FAQ');
    $this->breadcrumb->add('Ajuda Para Vender');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Ajuda - FAQ';
    $dados['_titulo_page'] = 'FAQ - Como Vender';

    $dados['_menu_ativo'] = 'ajuda';
    $dados['_submenu_ativo'] = 'como_vender';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

  function faq_como_comprar()
  {
    $this->load->library('Make_bread_front', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('FAQ');
    $this->breadcrumb->add('Ajuda Para Comprar');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Ajuda - FAQ';
    $dados['_titulo_page'] = 'FAQ - Como Comprar';

    $dados['_menu_ativo'] = 'ajuda';
    $dados['_submenu_ativo'] = 'como_comprar';

    $dados['_view'] = __METHOD__;
    $this->_template_portal( $dados );
  }

}
