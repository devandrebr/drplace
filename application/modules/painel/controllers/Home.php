<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-13
 * @version 2018-05-13
 */
class Home extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PAINEL;
    $this->_controller = strtolower( __CLASS__ );

    $this->_valida_usuario_logado_painel();
  }

  function index(){ $this->minha_conta(); }

  function minha_conta()
  {
    $this->load->model( $this->_modulo . 'Usuario_model', 'musu' );
    $res_usu = $this->musu->editar($this->_usu_painel_id);
    $qtd_usu = is_array($res_usu) ? count($res_usu) : 0;

    $id_cid = isset($res_usu['fk_id_cidade']) ? $res_usu['fk_id_cidade'] : 0;

    $uf = '';
    $res_cid = array();
    if( (int)$id_cid > 0 ) {
      $uf = $res_usu['cid_sigla'];

      $this->musu->set_table('cidade');
      $field = array('cid_id','cid_sigla','cid_nome');
      $where = array('cid_sigla' => $uf, 'cid_status'=>TRUE,'cid_statusAtivo'=>TRUE);
      $order = 'cid_nome ASC';
      $res_cid = $this->musu->get($field, $where, $order);
    }

    $qtd_cid = is_array($res_cid) ? count($res_cid) : 0;

    $dados['res_cid'] = $res_cid;
    $dados['qtd_cid'] = $qtd_cid;

    $dados['combo_uf'] = combo_uf();
    $dados['qtd_uf'] = count($dados['combo_uf']);

    $dados['res_usu'] = $res_usu;

    $dados['_uf'] = $uf;

    $this->load->library('Make_bread_painel', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Minha Conta');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Seja Bem Vindo, '.$this->_usu_painel_nome;
    $dados['_titulo_page'] = 'Seja bem vindo, '.$this->_usu_painel_nome;

    $dados['_menu_painel'] = 'minha_conta';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function compartilhe()
  {
    $this->load->library('Make_bread_painel', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Compartilhe com um amigo');
    $this->breadcrumb->add($this->_usu_painel_nome);

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Compartilhe com um amigo Sr(a)., '.$this->_usu_painel_nome;
    $dados['_titulo_page'] = 'Compartilhe com um amigo Sr(a)., '.$this->_usu_painel_nome;

    #$dados['_menu_painel'] = 'indicacao';
    $dados['_menu_painel'] = 'compartilhe';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }
}
