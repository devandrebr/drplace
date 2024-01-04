<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://andrewd.com.br/
 *
 * @date    2018-07-10
 * @version 2018-07-10
 */
class Plog_model extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function checkLogAcessoImovel($id,$ip,$ua)
  {
    $id = $this->db->escape_str($id);
    $ip = $this->db->escape_str($ip);
    $ua = $this->db->escape_str($ua);

    $sql = "SELECT
              COUNT(*) AS qtd
            FROM imovel_acesso AS imac
            WHERE imac.imace_data < DATE_SUB(NOW(), INTERVAL 30 MINUTE)
            AND imac.fk_id_imovel = {$id} AND imac.imace_enderecoIp = '{$ip}'
            AND imac.imace_userAgent = '{$ua}'";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();
    $qtd = isset($res['qtd']) ? $res['qtd'] : 0;

    return $qtd;
  }

  function checkLogAcessoMensagem($id,$ip,$ua)
  {
    $id = $this->db->escape_str($id);
    $ip = $this->db->escape_str($ip);
    $ua = $this->db->escape_str($ua);

    $sql = "SELECT
              COUNT(*) AS qtd
            FROM imovel_mensagem_acesso AS imsac
            WHERE imsac.imsgac_data < DATE_SUB(NOW(), INTERVAL 30 MINUTE)
            AND imsac.fk_id_imovelMensagem = {$id} AND imsac.imsgac_enderecoIp = '{$ip}'
            AND imsac.imsgac_userAgent = '{$ua}'";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();
    $qtd = isset($res['qtd']) ? $res['qtd'] : 0;

    return $qtd;
  }
}
