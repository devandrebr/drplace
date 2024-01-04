<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://andrewd.com.br/
 *
 * @date    2018-05-20
 * @version 2018-06-15
 */
class Imovel_Model extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function lista( $id_usu, $off, $ini )
  {
    $id_usu = $this->db->escape_str($id_usu);
    $off = $this->db->escape_str($off);
    $ini = $this->db->escape_str($ini);

    $sql = "SELECT
              imo.*,
              cid.cid_sigla, cid.cid_nome,
              (
              	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id
                LIMIT 1
              ) as imo_img
            FROM imovel AS imo
            LEFT JOIN cidade AS cid
             ON (cid.cid_id = imo.fk_id_cidade)
            WHERE imo.fk_id_usuario = {$id_usu} AND imo.imo_status = TRUE
            LIMIT {$off}, {$ini}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function listaFavoritos( $id_usu, $off, $ini )
  {
    $id_usu = $this->db->escape_str($id_usu);
    $off = $this->db->escape_str($off);
    $ini = $this->db->escape_str($ini);

    $sql = "SELECT
              imo.*,
              cid.cid_sigla, cid.cid_nome,
              (
              	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id
                LIMIT 1
              ) as imo_img,
              imfav.imfav_id, imfav.imfav_dataCadastro
            FROM imovel AS imo
            LEFT JOIN cidade AS cid
             ON (cid.cid_id = imo.fk_id_cidade)
            LEFT JOIN imovel_favorito AS imfav
             ON (imo.imo_id = imfav.fk_id_imovel)
            WHERE imfav.fk_id_usuario = {$id_usu}
            AND imo.imo_status = TRUE
            LIMIT {$off}, {$ini}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function listaInteressados( $off, $ini )
  {
    $off = $this->db->escape_str($off);
    $ini = $this->db->escape_str($ini);

    $sql = "SELECT
              imoim.*
            FROM imovel_interesse AS imoim
            INNER JOIN usuario AS usu
             ON (imoim.fk_id_usuario = usu.usu_id)
            WHERE imoim.imint_status = TRUE
            LIMIT {$off}, {$ini}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function listaInteressadosById( $id )
  {
    $id = $this->db->escape_str($id);

    $sql = "SELECT
              imoim.*
            FROM imovel_interesse AS imoim
            INNER JOIN usuario AS usu
             ON (imoim.fk_id_usuario = usu.usu_id)
            WHERE imoim.imint_status = TRUE AND imoim.fk_id_usuario = {$id}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function editar( $id_imo, $id_usu )
  {
    $id_imo = $this->db->escape_str($id_imo);
    $id_usu = $this->db->escape_str($id_usu);

    $sql = "SELECT
              imo.*,
              cid.cid_sigla, cid.cid_nome,
              imtip.imtip_titulo,
              usu.usu_id, usu.usu_nome
            FROM imovel AS imo
            INNER JOIN usuario AS usu
             ON (usu.usu_id = imo.fk_id_usuario)
            INNER JOIN imovel_tipo AS imtip
             ON (imo.fk_id_tipo = imtip.imtip_id)
            LEFT JOIN cidade AS cid
             ON (imo.fk_id_cidade = cid.cid_id)
            WHERE imo.imo_status = TRUE AND imo.imo_id = {$id_imo} AND imo.fk_id_usuario = {$id_usu}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();

    return $res;
  }

  function verificaFoto( $id_imo, $id_foto, $id_usu )
  {
    $id_imo = $this->db->escape_str($id_usu);
    $id_foto = $this->db->escape_str($id_foto);
    $id_usu = $this->db->escape_str($id_usu);

    $sql = "SELECT
              imoft.imoft_arquivo
            FROM imovel AS imo
            INNER JOIN imovel_foto AS imoft
             ON (imoft.fk_id_imovel = imo.imo_id)
            WHERE imo.imo_status = TRUE AND imoft.imoft_id = {$id_foto} AND imo.imo_id = {$id_imo} AND imo.fk_id_usuario = {$id_usu}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();

    return $res;
  }
}
