<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-08-31
 * @version 2018-08-31
 */
class Perfil extends MY_Controller
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
        $this->meu_perfil();
    }

    function meu_perfil()
    {
      $cidade = $this->_usu_admin_cidade;
      $uf = $this->session->userdata('adm_cid_sigla');

      $dados['_usu_telefone'] = $this->session->userdata('adm_usu_telefone');
      $dados['_usu_logradouro'] = $cidade.'/'.$uf;

      // Valores obrigatórios e defaults para a view
      $this->load->library('Make_bread_admin', $this->_modulo, 'breadcrumb');

      $this->breadcrumb->add('Perfil');
      $this->breadcrumb->add($this->_usu_admin_nome);

      $dados['_breadcrumb'] = $this->breadcrumb->output();

      $dados['_titulo'] = 'Perfil';
      $dados['_titulo_page'] = 'Meu Perfil';

      $dados['_menu_left'] = 'dashboard';

      $dados['_view'] = __METHOD__;
      $this->_template_admin( $dados );
    }
}
