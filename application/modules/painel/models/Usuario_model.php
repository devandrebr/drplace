<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://andrewd.com.br/
 *
 * @date    2018-05-26
 * @version 2018-05-26
 */
class Usuario_Model extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function editar( $id )
  {
    $id = $this->db->escape_str($id);

    $sql = "SELECT
              usu.*,
              cid.cid_sigla, cid.cid_nome,
              perf.uperf_nome
            FROM usuario AS usu
            LEFT JOIN cidade AS cid
             ON (cid.cid_id = usu.fk_id_cidade)
            LEFT JOIN usuario_perfil AS perf
             ON (perf.uperf_id = usu.fk_id_perfil)
            WHERE usu.usu_id = {$id} AND usu.usu_statusAtivo = TRUE
            LIMIT 1";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();

    return $res;
  }
}
