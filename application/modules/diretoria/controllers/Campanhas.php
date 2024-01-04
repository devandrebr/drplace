<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-09-05
 * @version 2018-09-05
 */
class Campanhas extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_ADMIN;
    $this->_controller = strtolower( __CLASS__ );

    $this->_valida_usuario_logado_admin();
  }

  function pre_lancamento()
  {
    $this->load->model($this->_modulo.'Diretoria_model','mcamp1');

    $this->mcamp1->set_table('camp1_prelancamento');

    $field = array('c1prelanc_id','c1prelanc_nome','c1prelanc_email','c1prelanc_dataCadastro');
    $where = array('c1prelanc_status'=>TRUE,'c1prelanc_codigo'=>CAMPANHA_01_CODIGO);
    $res = $this->mcamp1->get($field,$where);
    $qtd = is_array($res) ? count($res) : 0;

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    // Valores obrigatórios e defaults para a view
    $this->load->library('Make_bread_admin', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Campanhas');
    $this->breadcrumb->add('Pré-Lançamento 09/2018');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Campanha 1 - Pré-Lançamento em Setembro/2018';
    $dados['_titulo_page'] = 'Pré-Lançamento em Setembro/2018';

    $dados['_menu_left'] = 'campanhas';

    $dados['_view'] = __METHOD__;
    $this->_template_admin( $dados );
  }

}
