<?php defined('BASEPATH') OR exit('No direct script access allowed');

set_time_limit(0);

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-10-25
 * @version 2018-10-25
 */
class Email extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_ADMIN;
    $this->_controller = strtolower( __CLASS__ );
  }

  function index()
  {
    $this->valida();
  }

  function valida()
  {
    $arquivo = PATH_SISTEMA.'Arquivos e documentos/email-mkt/e-mail-sp_10.csv';

    $this->load->model( $this->_modulo . 'Diretoria_model', 'memkt' );

    $id_origem = 1; # 1 - Base E-mail - André
    $c = 0;
    if(($handle = fopen($arquivo, "r")) !== FALSE) {
      while (!feof($handle)) {
        if($c>0){
          $nome = $data[0];
          $email = $data[6];
          list($user,$domain) = explode('@',$email);
          $domain = isset($domain) ? $domain : '';

          // Domain has valid MX records
          if(checkdnsrr($domain, 'MX') && ($domain != '')) {
            $this->memkt->set_table('email_mkt');
            $where = array('emkt_email'=>$email,'emkt_status'=>TRUE);
            $qtd = $this->memkt->count_results($where);
            if( $qtd == 0 ) {
              $dadosins = array();
              $dadosins['emkt_nome'] = $nome;
              $dadosins['emkt_email'] = $email;
              $dadosins['emkt_dataCadastro'] = date('Y-m-d H:i:s');

              $this->memkt->set_table('email_mkt');
              $id_email = $this->memkt->insert($dadosins,TRUE);
            } else {
              $this->memkt->set_table('email_mkt');
              $this->memkt->set_return('row');
              $field = array('emkt_id');
              $res = $this->memkt->get($field,$where);

              $id_email = $res['emkt_id'];
            }

            if( $id_email > 0 ) {
              $this->memkt->set_table('email_mkt_origem');

              $where2 = array('fk_id_email'=>$id_email,'fk_id_origem'=>$id_origem);
              $qtd2 = $this->memkt->count_results($where2);
              if( $qtd2 == 0 ) {
                $dadosins2 = array();
                $dadosins2['fk_id_email'] = $id_email;
                $dadosins2['fk_id_origem'] = $id_origem;

                $this->memkt->insert($dadosins2);
              }
            }
          }
        $c++;
        }
      }
      fclose($handle);
    }
  }

  function valida_txt()
  {
    $arquivo = PATH_SISTEMA.'Arquivos e documentos/email-mkt/SP-04_41955_Valid.txt';

    $this->load->model( $this->_modulo . 'Diretoria_model', 'memkt' );

    $id_origem = 1; # 1 - Base E-mail - André
    $c = 0;
    if(($handle = fopen($arquivo, "r")) !== FALSE) {
      while (!feof($handle)) {
        $email = trim(fgets($handle));
        $nome = NULL;

        list($user,$domain) = explode('@',$email);
        $domain = isset($domain) ? $domain : '';

        // Domain has valid MX records
        if(checkdnsrr($domain, 'MX') && ($domain != '')) {
          $this->memkt->set_table('email_mkt');
          $where = array('emkt_email'=>$email,'emkt_status'=>TRUE);
          $qtd = $this->memkt->count_results($where);
          if( $qtd == 0 ) {
            $dadosins = array();
            $dadosins['emkt_nome'] = $nome;
            $dadosins['emkt_email'] = $email;
            $dadosins['emkt_dataCadastro'] = date('Y-m-d H:i:s');

            $this->memkt->set_table('email_mkt');
            $id_email = $this->memkt->insert($dadosins,TRUE);
          } else {
            $this->memkt->set_table('email_mkt');
            $this->memkt->set_return('row');
            $field = array('emkt_id');
            $res = $this->memkt->get($field,$where);

            $id_email = $res['emkt_id'];
          }

          if( $id_email > 0 ) {
            $this->memkt->set_table('email_mkt_origem');

            $where2 = array('fk_id_email'=>$id_email,'fk_id_origem'=>$id_origem);
            $qtd2 = $this->memkt->count_results($where2);
            if( $qtd2 == 0 ) {
              $dadosins2 = array();
              $dadosins2['fk_id_email'] = $id_email;
              $dadosins2['fk_id_origem'] = $id_origem;

              $this->memkt->insert($dadosins2);
            }
          }
        }
        $c++;
      }
      fclose($handle);
    }
  }

}
