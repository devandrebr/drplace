<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://andrewd.com.br/
 *
 * @date    2018-05-20
 * @version 2018-09-01
 */
class Pimovel_model extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function listaHome( $limit = 4 )
  {
    $sql = "SELECT
              imo.imo_id, imo.imo_titulo, imo.imo_valor, imo.imo_logradouro, imo.imo_numero,
              imo.imo_bairro, imo.imo_complemento, imo.imo_situacao, imo.imo_dataCadastro,
              imoc.imcar_garagem, imoc.imcar_dormitorio, imoc.imcar_banheiro, imoc.imcar_area,
              imtip.imtip_id, imtip.imtip_titulo,
              usu.usu_id, usu.usu_nome, usu.usu_foto, usu.usu_email1,
              cid.cid_sigla, cid.cid_nome,
              (
              	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id
                LIMIT 1
              ) as imo_img
            FROM imovel AS imo
            INNER JOIN usuario AS usu
             ON (usu.usu_id = imo.fk_id_usuario)
            INNER JOIN imovel_caracteristica AS imoc
             ON (imoc.fk_id_imovel = imo.imo_id)
            INNER JOIN imovel_tipo AS imtip
             ON (imo.fk_id_tipo = imtip.imtip_id)
            LEFT JOIN cidade AS cid
             ON (cid.cid_id = imo.fk_id_cidade)
            WHERE imo.imo_status = TRUE
            ORDER BY RAND()
            LIMIT {$limit}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function listaRodape( $limit = 3 )
  {
    $sql = "SELECT
              imo.imo_id, imo.imo_titulo, imo.imo_dataCadastro,
              imtip.imtip_titulo,
              usu.usu_id,
              (
              	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id
                LIMIT 1
              ) as imo_img
            FROM imovel AS imo
            INNER JOIN usuario AS usu
             ON (usu.usu_id = imo.fk_id_usuario)
            INNER JOIN imovel_tipo AS imtip
             ON (imo.fk_id_tipo = imtip.imtip_id)
            WHERE imo.imo_status = TRUE
            ORDER BY imo.imo_dataCadastro DESC
            LIMIT {$limit}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function listaHomeInteressados( $limit = 4 )
  {
    $sql = "SELECT
              imin.imint_id, imin.imint_nome, imin.imint_email, imin.imint_msg, imin.imint_dataCadastro,
              usu.usu_id, usu.usu_nome, usu.usu_foto, usu.usu_email1
            FROM imovel_interesse AS imin
            INNER JOIN usuario AS usu
             ON (usu.usu_id = imin.fk_id_usuario)
            WHERE imin.imint_status = TRUE
            ORDER BY imin.imint_dataCadastro DESC
            LIMIT {$limit}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function listaCampanha2( $limit = 10 )
  {
    $sql = "SELECT
              imo.imo_id, imo.imo_valor, imo.imo_titulo, imo.imo_dataCadastro,
              imtip.imtip_titulo,
              usu.usu_id,
              (
              	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id
                LIMIT 1
              ) as imo_img
            FROM imovel AS imo
            INNER JOIN usuario AS usu
             ON (usu.usu_id = imo.fk_id_usuario)
            INNER JOIN imovel_tipo AS imtip
             ON (imo.fk_id_tipo = imtip.imtip_id)
            WHERE imo.imo_status = TRUE
            ORDER BY imo.imo_dataCadastro DESC
            LIMIT {$limit}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function listaTipoImoveis()
  {
    $sql = "SELECT
              imtip.imtip_id, imtip.imtip_tipo, imtip.imtip_titulo
            FROM imovel_tipo AS imtip
            WHERE imtip.imtip_statusAtivo = TRUE";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function detalhe( $id, $id_usu = 0 )
  {
    $id = $this->db->escape_str($id);
    $id_usu = (int)$this->db->escape_str($id_usu);

    $sql = "SELECT
              imo.*,
              cid.cid_sigla, cid.cid_nome,
              imtip.imtip_titulo,
              imfav.imfav_id, imfav.imfav_dataCadastro,
              usu.usu_id, usu.usu_nome, usu.usu_foto, usu.usu_email1, usu.usu_dataCadastro,
              ucid.cid_nome AS usu_cid_nome,
              ucid.cid_sigla AS usu_cid_sigla,
              (	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id LIMIT 1 ) AS imo_img,
              ( SELECT
                imomsg.imomsg_id
                FROM imovel_mensagem AS imomsg
                WHERE imomsg.fk_id_imovel = imo.imo_id AND imomsg.fk_id_usuarioEnvio = {$id_usu} LIMIT 1 ) AS imomsg_id
            FROM imovel AS imo
            INNER JOIN usuario AS usu
             ON (usu.usu_id = imo.fk_id_usuario)
            INNER JOIN imovel_tipo AS imtip
             ON (imo.fk_id_tipo = imtip.imtip_id)
            LEFT JOIN imovel_favorito AS imfav
             ON (imo.imo_id = imfav.fk_id_imovel)
            LEFT JOIN cidade AS cid
             ON (imo.fk_id_cidade = cid.cid_id)
            LEFT JOIN cidade AS ucid
             ON (usu.fk_id_cidade = cid.cid_id)
            WHERE imo.imo_status = TRUE AND imo.imo_id = {$id}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();
    // dump($sql);
    // die;
    return $res;
  }

  function resPesquisa($situacao='V',$string=NULL,$off=0,$ini=0)
  {
    $situacao = $this->db->escape_str($situacao);
    $tipo = 0;
    $string = $this->db->escape_str($string);
    $off = $this->db->escape_str($off);
    $ini = $this->db->escape_str($ini);

    $limit = ((int)$off>0) ? "LIMIT {$off}, {$ini}" : '';

    $qry_pesq = '';

    if( strlen($string) > 2 ) {
      $termos = explode(' ',$string);
      $termo = join('%',$termos);

      $qry_pesq .= "AND (
                      cid.cid_nome LIKE '%{$termo}%' OR cid.cid_sigla LIKE '%{$termo}%'
                      OR cid.cid_nome LIKE '%{$string}%' OR cid.cid_sigla LIKE '%{$string}%'
                      OR imo.imo_titulo LIKE '%{$termo}%' OR imo.imo_titulo LIKE '%{$string}%'
                    )";
    }

    if( $situacao != '' )
      $qry_pesq .= " AND imo.imo_situacao = '{$situacao}' OR imo.imo_situacao = '0'";

    if( (int)$tipo > 0 )
      $qry_pesq .= " AND imo.fk_id_tipo = {$tipo}";

    $sql = "SELECT
              imo.imo_id, imo.imo_titulo, imo.imo_valor, imo.imo_valorVenda, imo.imo_logradouro, imo.imo_numero,
              imo.imo_bairro, imo.imo_complemento, imo.imo_situacao, imo.imo_dataCadastro,
              imoc.imcar_garagem, imoc.imcar_dormitorio, imoc.imcar_banheiro, imoc.imcar_area,
              imfav.imfav_id, imfav.imfav_dataCadastro,
              imtip.imtip_id, imtip.imtip_titulo,
              usu.usu_id, usu.usu_nome, usu.usu_foto,
              cid.cid_sigla, cid.cid_nome,
              (
              	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id
                LIMIT 1
              ) as imo_img
            FROM imovel AS imo
            INNER JOIN usuario AS usu
             ON (usu.usu_id = imo.fk_id_usuario)
            INNER JOIN imovel_caracteristica AS imoc
             ON (imoc.fk_id_imovel = imo.imo_id)
            INNER JOIN imovel_tipo AS imtip
             ON (imo.fk_id_tipo = imtip.imtip_id)
            LEFT JOIN imovel_favorito AS imfav
             ON (imo.imo_id = imfav.fk_id_imovel)
            LEFT JOIN cidade AS cid
             ON (cid.cid_id = imo.fk_id_cidade)
            WHERE imo.imo_status = TRUE {$qry_pesq} {$limit}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }

  function resPesquisaQtdTotal($situacao='V',$string=NULL)
  {
    $situacao = $this->db->escape_str($situacao);
    $tipo = 0;
    $string = $this->db->escape_str($string);

    $qry_pesq = '';

    if( strlen($string) > 2 ) {
      $termos = explode(' ',$string);
      $termo = join('%',$termos);

      $qry_pesq .= "AND (
                      cid.cid_nome LIKE '%{$termo}%' OR cid.cid_sigla LIKE '%{$termo}%'
                      OR cid.cid_nome LIKE '%{$string}%' OR cid.cid_sigla LIKE '%{$string}%'
                      OR imo.imo_titulo LIKE '%{$termo}%' OR imo.imo_titulo LIKE '%{$string}%'
                    )";
    }

    if( $situacao != '' )
      $qry_pesq .= " AND imo.imo_situacao = '{$situacao}' OR imo.imo_situacao = '0'";

    if( (int)$tipo > 0 )
      $qry_pesq .= " AND imo.fk_id_tipo = {$tipo}";

    $sql = "SELECT
              COUNT(*) AS qtd
            FROM imovel AS imo
            INNER JOIN usuario AS usu
             ON (usu.usu_id = imo.fk_id_usuario)
            INNER JOIN imovel_caracteristica AS imoc
             ON (imoc.fk_id_imovel = imo.imo_id)
            INNER JOIN imovel_tipo AS imtip
             ON (imo.fk_id_tipo = imtip.imtip_id)
            LEFT JOIN cidade AS cid
             ON (cid.cid_id = imo.fk_id_cidade)
            WHERE imo.imo_status = TRUE {$qry_pesq}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();
    $qtd = isset($res['qtd']) ? $res['qtd'] : 0;

    return $qtd;
  }
}
