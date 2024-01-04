<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://andrewd.com.br/
 *
 * @date    2018-05-10
 * @version 2018-05-10
 */
class Autenticacao_Model extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function login( $email, $senha, $token = NULL )
  {
    $email = $this->db->escape_str($email);
    $senha = $this->db->escape_str($senha);
    $token = $this->db->escape_str($token);
    $param_login = "usu.usu_email1 = '{$email}' AND usu.usu_senha = '{$senha}'";
    if( $token != '' )
      $param_login = "usu.usu_token = '{$token}'";

    $sql = "SELECT
              usu.*,
              cid.cid_id, cid.cid_sigla, cid.cid_nome,
              perf.uperf_nome
            FROM usuario AS usu
            LEFT JOIN cidade AS cid
             ON (cid.cid_id = usu.fk_id_cidade)
            LEFT JOIN usuario_perfil AS perf
             ON (perf.uperf_id = usu.fk_id_perfil)
            WHERE {$param_login}
            AND usu.usu_statusAtivo = TRUE
            LIMIT 1";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();

    return $res;
  }

  function loginFacebook( $email, $face_id )
  {
    $email = $this->db->escape_str($email);
    $face_id = $this->db->escape_str($face_id);

    $sql = "SELECT
              usu.*,
              cid.cid_id, cid.cid_sigla, cid.cid_nome,
              perf.uperf_nome
            FROM usuario AS usu
            LEFT JOIN cidade AS cid
             ON (cid.cid_id = usu.fk_id_cidade)
            LEFT JOIN usuario_perfil AS perf
             ON (perf.uperf_id = usu.fk_id_perfil)
            WHERE usu.usu_email1 = '{$email}' AND usu.usu_facebookId = '{$face_id}' AND usu.usu_statusAtivo = TRUE
            LIMIT 1";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();

    return $res;
  }
}
