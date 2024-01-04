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
class Partigo_model extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function listaRodape( $limit = 3 )
  {
    $sql = "SELECT
              art.*,
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
            ORDER BY art.art_dataCadastro DESC
            LIMIT {$limit}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function lista($off=0,$ini=0)
  {
    $off = $this->db->escape_str($off);
    $ini = $this->db->escape_str($ini);

    $limit = "LIMIT {$off}, {$ini}";

    $sql = "SELECT
              art.*,
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
            ORDER BY art.art_dataCadastro DESC
            {$limit}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function detalheSlug($slug)
  {
    $slug = $this->db->escape_str($slug);

    $sql = "SELECT
              art.*,
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
            WHERE art.art_statusAtivo = TRUE AND art.art_slug = '{$slug}'";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();

    return $res;
  }

  function qtdLista()
  {
    $sql = "SELECT
              COUNT(*) AS qtd
            FROM artigo AS art
            INNER JOIN usuario AS usu
             ON (usu.usu_id = art.fk_id_usuario)
            WHERE art.art_statusAtivo = TRUE";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();
    $qtd = isset($res['qtd']) ? $res['qtd'] : 0;

    return $qtd;
  }

}
