<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://andrewd.com.br/
 *
 * @date    2018-09-28
 * @version 2018-09-28
 */
class Parceiro_model extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function lista()
  {
    $sql = "SELECT
              par.parc_id, par.parc_slug, par.parc_nome, par.parc_dataCadastro,
              (
              	SELECT
                  COUNT(*)
                FROM parceiro_acesso AS parac
                WHERE parac.fk_id_parceiro = par.parc_id
              ) AS qtd_acesso
            FROM parceiro AS par
            ORDER BY par.parc_dataCadastro DESC";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();

    return $res;
  }
}
