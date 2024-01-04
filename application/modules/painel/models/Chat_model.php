<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://andrewd.com.br/
 *
 * @date    2018-07-12
 * @version 2018-07-12
 */
class Chat_model extends MY_Model
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
              imo.imo_id, imo.imo_titulo,
              imsg.imomsg_id, imsg.imomsg_dataCadastro, imsg.imomsg_nome,
              imsg.imomsg_telefone, imsg.imomsg_visualizada, imsg.fk_id_usuarioEnvio,
              (
              	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id
                LIMIT 1
              ) AS imo_img,
              (
    				  	SELECT
    				  		COUNT(*)
    				  	FROM imovel_mensagem_conversa AS imc
    				    WHERE imc.fk_id_imovelMensagem = imsg.imomsg_id AND imc.fk_id_usuario != {$id_usu}
    				  ) AS qtd_conversa,
              (
    				  	SELECT
    				  		immsco.mcoim_visualizada
    				  	FROM imovel_mensagem_conversa AS immsco
    				    WHERE immsco.fk_id_imovelMensagem = imsg.imomsg_id
    				   ORDER BY immsco.mcoim_dataCadastro DESC, immsco.mcoim_visualizada DESC
    				   LIMIT 1
    				  ) AS convmsg_visualizada,
              (
    				  	SELECT
    				  		immsco.fk_id_usuario
    				  	FROM imovel_mensagem_conversa AS immsco
    				    WHERE immsco.fk_id_imovelMensagem = imsg.imomsg_id
    				   ORDER BY immsco.mcoim_dataCadastro DESC, immsco.mcoim_visualizada DESC
    				   LIMIT 1
    				  ) AS convmsg_usuario
            FROM imovel_mensagem AS imsg
            INNER JOIN imovel AS imo
             ON (imsg.fk_id_imovel = imo.imo_id)
            WHERE (imo.fk_id_usuario = {$id_usu} OR imsg.fk_id_usuarioEnvio = {$id_usu})
            ORDER BY imsg.imomsg_visualizada ASC, imsg.imomsg_dataCadastro DESC
            LIMIT {$off}, {$ini}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->result_array() : array();
    return $res;
  }

  function qtdTotalMensagens( $id_usu )
  {
    $id_usu = $this->db->escape_str($id_usu);

    $sql = "SELECT
              COUNT(*) AS qtd
            FROM imovel_mensagem AS imsg
            INNER JOIN imovel AS imo
             ON (imsg.fk_id_imovel = imo.imo_id)
            WHERE (imo.fk_id_usuario = {$id_usu} OR imsg.fk_id_usuarioEnvio = {$id_usu})";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();
    $qtd = isset($res['qtd']) ? (int)$res['qtd'] : 0;

    return $qtd;
  }

  function conversa( $id, $id_usu )
  {
    $id = $this->db->escape_str($id);
    $id_usu = $this->db->escape_str($id_usu);

    $sql = "SELECT
              imo.imo_id, imo.imo_titulo, imo.fk_id_usuario AS imo_id_usuario,
              imsg.imomsg_id, imsg.imomsg_nome, imsg.imomsg_email,
              imsg.imomsg_telefone, imsg.imomsg_visualizada,
              imsg.imomsg_mensagem, imsg.imomsg_dataCadastro,
              (
              	SELECT
                  imft.imoft_arquivo
                FROM imovel_foto AS imft
                WHERE imft.fk_id_imovel = imo.imo_id
                LIMIT 1
              ) AS imo_img,
              (
      				  SELECT
      					  mcoim.fk_id_usuario
                  -- mcoim.mcoim_dataCadastro
      					FROM imovel_mensagem_conversa AS mcoim
      					WHERE mcoim.mcoim_visualizada = TRUE AND mcoim.fk_id_imovelMensagem = imsg.imomsg_id
      					ORDER BY mcoim.mcoim_dataCadastro DESC
                LIMIT 1
    				  ) AS mcoim_id_usuario
            FROM imovel_mensagem AS imsg
            INNER JOIN imovel AS imo
             ON (imsg.fk_id_imovel = imo.imo_id)
            WHERE (imo.fk_id_usuario = {$id_usu} OR imsg.fk_id_usuarioEnvio = {$id_usu}) AND imsg.imomsg_id = {$id}";
    $qry = $this->db->query($sql);
    $res = ($qry) ? $qry->row_array() : array();

    return $res;
  }
}
