<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://andrewd.com.br/
 *
 * @date    2018-09-13
 * @version 2018-09-13
 */
class Artigo_model extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function lista()
  {
    $sql = "SELECT
              art.art_id, art.art_titulo, art.art_slug, art.art_dataCadastro,
              usu.usu_id, usu.usu_nome, usu.usu_admin, usu.usu_status, usu.usu_statusAtivo,
              (
              	SELECT
                  COUNT(*)
                FROM artigo_anexo AS artane
                WHERE artane.fk_id_artigo = art.art_id
              ) as qtd_anexo
            FROM artigo AS art
            INNER JOIN usuario AS usu
             ON (usu.usu_id = art.fk_id_usuario)
            WHERE art.art_statusAtivo = TRUE
            ORDER BY art.art_dataCadastro DESC";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }
}
