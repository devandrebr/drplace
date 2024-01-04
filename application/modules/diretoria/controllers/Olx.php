<?php defined('BASEPATH') OR exit('No direct script access allowed');

set_time_limit(0);

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-10-15
 * @version 2018-10-15
 */
class Olx extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_ADMIN;
    $this->_controller = strtolower( __CLASS__ );
  }

  function index()
  {
    $this->imoveis();
  }

  function imoveis()
  {
    $user_agent = random_uagent();

    $this->load->model( $this->_modulo . 'Diretoria_model', 'molx' );

    $this->load->library( 'crawler/Imoveis_olx', NULL, 'imo_olx' );

    $this->imo_olx->setUserAgent($user_agent);
    $this->imo_olx->consulta(6);

    $imoveis = $this->imo_olx->getImoveis();
    $qtd = count($imoveis);

    if( $qtd > 0 ) {
      for( $i=1; $i<$qtd; $i++ ):
        $link = $imoveis[$i]['link'];
        $thumb = $imoveis[$i]['thumb'];
        $qtd_thumb = $imoveis[$i]['qtd_thumb'];
        $titulo = $imoveis[$i]['titulo'];
        $desc = $imoveis[$i]['desc'];
        $local = $imoveis[$i]['local'];
        $categoria = $imoveis[$i]['categoria'];
        $valor = $imoveis[$i]['valor'];
        $data = $imoveis[$i]['data'];
        $hora = $imoveis[$i]['hora'].':00';
        $data_atual = date('Y-m-d H:i:s');
        $data_hoje = date('Y-m-d').' '.$hora;
        if($link != ''){
          if($data=='Hoje') {
            $data = $data_hoje;
          } else if($data=='Ontem') {
            $date = new DateTime($data_hoje);
            $date->sub(new DateInterval('P1D'));
            $data_ontem = $date->format('Y-m-d H:i:s');
            $data = $data_ontem;
          } else {
            list($dia,$mes) = explode(' ',$data);
            $data = date('Y').'-'.$mes.'-'.$dia.' '.$hora;
          }

          $this->molx->set_table('olx_imoveis');
          $whereqtd = array('olimo_link'=>$link);
          $qtd_imo = $this->molx->count_results($whereqtd);
          if( $qtd_imo == 0 ) {
            $datains1 = array();
            $datains1['olimo_titulo'] = $titulo;
            $datains1['olimo_descricao'] = $desc;
            $datains1['olimo_resumo'] = NULL;
            $datains1['olimo_local'] = $local;
            $datains1['olimo_categoria'] = $categoria;
            $datains1['olimo_valor'] = converte_moeda(str_replace('R$ ','',$valor));
            $datains1['olimo_data'] = $data;
            $datains1['olimo_dataCadastro'] = $data_atual;
            $datains1['olimo_link'] = $link;
            $datains1['olimo_thumb'] = $thumb;
            $datains1['olimo_qtdThumb'] = $qtd_thumb;

            $this->molx->insert( $datains1 );
          }
        }

      endfor;

    }
  }

}
