<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-06-18
 * @version 2018-08-31
 */
class Ajax extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PORTAL;
    $this->_controller = strtolower(__CLASS__);
  }

  function get_cidade($uf)
  {
    if( strlen($uf) == 2 ) {
      $this->load->model($this->_modulo.'Pimovel_model', 'majax');

      $this->majax->set_table('cidade');
      $this->majax->set_return('result');

      $field = array('cid_id','cid_sigla','cid_nome');
      $where = array('cid_sigla'=>$uf,'cid_status'=>TRUE,'cid_statusAtivo'=>TRUE);
      $order = 'cid_nome ASC';
      $res = $this->majax->get($field,$where,$order);
      $qtd = is_array($res) ? count($res) : 0;
      if( $qtd > 0 ) {
        header('Content-type: application/json; charset="UTF-8"');
        echo json_encode($res);
      }
    }
  }

  function imovel_favorito($id_imovel, $id_imo_favorito=0,$msg=NULL)
  {
    if($id_imo_favorito>0)
      $this->_del_imo_favorito($id_imovel,$id_imo_favorito);
    else
      $this->_set_imo_favorito($id_imovel);
  }

  private function _set_imo_favorito($id_imovel){
    $this->load->model($this->_modulo.'Pimovel_model', 'majax');
    $id_usuario = (int)$this->_usu_painel_id;
    $status = 'logar';
    $url = base_url(MODULO_PAINEL);
    $msg = 'Você precisa acessar o painel, para logar no portal, antes de continuar.';
    if($id_usuario > 0)
    {
      $status = 'erro';
      $url = '';
      $this->majax->set_table('imovel');

      $where = array('imo_id'=>$id_imovel,'imo_status'=>TRUE);
      $qtd = $this->majax->count_results($where);
      if( $qtd == 1 )
      {
        $this->majax->set_table('imovel_favorito');

        $where = array('fk_id_imovel'=>$id_imovel,'fk_id_usuario'=>$id_usuario,'imfav_statusAtivo'=>TRUE);
        $qtd = $qtd = $this->majax->count_results($where);
        if( $qtd == 0 )
        {
          $dadosins = array();
          $dadosins['fk_id_imovel'] = $id_imovel;
          $dadosins['fk_id_usuario'] = $id_usuario;
          $dadosins['imfav_dataCadastro'] = date('Y-m-d H:i:s');

          $id = $this->majax->insert($dadosins, TRUE);
          if($id>0) {
            $msg = 'Imóvel adicionado como favorito com sucesso.';
            $status = 'ok';
          }
          else
            $msg = 'Erro de conexão com o servidor, tente novamente.';
        }
        else
          $msg = 'Este imóvel já está favoritado, para esse potencial inquilino ou comprador.';
      }
      else
        $msg = 'Imóvel não localizado, tente novamente.';
    }
    $json = array('status'=>$status,'msg'=>$msg, 'url'=>$url);

    header('Content-type: application/json; charset="UTF-8"');
    echo json_encode($json);
  }

  private function _del_imo_favorito($id_imovel,$id_imo_favorito){
    $this->load->model($this->_modulo.'Pimovel_model', 'majax');
    $id_usuario = (int)$this->_usu_painel_id;
    $status = 'logar';
    $url = '';
    $msg = 'Você precisa acessar o painel, para logar no portal, antes de continuar.';
    if($id_usuario > 0)
    {
      $status = 'erro';
      $url = '';
      $this->majax->set_table('imovel');

      $where = array('imo_id'=>$id_imovel,'imo_status'=>TRUE);
      $qtd = $this->majax->count_results($where);
      if( $qtd == 1 )
      {
        $this->majax->set_table('imovel_favorito');

        $where = array('imfav_id'=>(int)$id_imo_favorito,'fk_id_imovel'=>$id_imovel,'fk_id_usuario'=>$id_usuario,'imfav_statusAtivo'=>TRUE);
        $qtd = $qtd = $this->majax->count_results($where);
        if( $qtd == 1 )
        {
          $whereupd = array('imfav_id'=>$id_imo_favorito,'fk_id_usuario'=>$id_usuario);

          // $dadosupd = array();
          // $dadosupd['imfav_dataExclusao'] = date('Y-m-d H:i:s');
          // $dadosupd['imfav_statusAtivo'] = FALSE;
          //
          // $st = $this->majax->update($dadosupd,$whereupd);
          $st = $this->majax->delete($whereupd);
          if($st) {
            $msg = 'Imóvel removido dos favoritos com sucesso.';
            $status = 'ok';
          }
          else
            $msg = 'Erro de conexão com o servidor, tente novamente.';
        }
        else
          $msg = 'Imóvel e código do favorito não localizado, tente novamente.';
      }
      else
        $msg = 'Imóvel não localizado, tente novamente.';
    }
    $json = array('status'=>$status,'msg'=>$msg, 'url'=>$url);

    header('Content-type: application/json; charset="UTF-8"');
    echo json_encode($json);
  }

}
