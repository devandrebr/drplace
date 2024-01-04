<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-08-31
 * @version 2018-08-31
 */
class Ajax extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_ADMIN;
    $this->_controller = strtolower( __CLASS__ );

    $this->_valida_usuario_logado_admin();
  }

  function gerar_xml_teste()
  {
    die('acesso negado.');
    $this->load->model($this->_modulo.'Diretoria_model', 'mdash');

    $res = $this->mdash->getTodasOcorrencias( $this->_cli_app_id );
    $qtd = is_array($res) ? count($res) : 0;

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;

    if( $qtd > 0 )
    {
      $xml .= '<markers>'.PHP_EOL;
        for( $i=0; $i<$qtd; $i++):
          $emp_id = $res[$i]['emp_id'];
          $oco_id = $res[$i]['oco_id'];
          $oco_titulo = $res[$i]['oco_titulo'];
          $oco_status = $res[$i]['ocst_titulo'];
          $endereco = $res[$i]['emp_endereco'];
          $numero = $res[$i]['emp_numero'];
          $bairro = $res[$i]['emp_bairro'];
          $complemento = $res[$i]['emp_complemento'];
          $cep = $res[$i]['emp_cep'];
          $uf = $res[$i]['cid_sigla'];
          $cidade = $res[$i]['cid_nome'];
          $latitude = $res[$i]['emp_latitude'];
          $longitude = $res[$i]['emp_longitude'];
          $nome = parse_to_xml($res[$i]['emp_razaoSocial']);
          $logradouro = parse_to_xml($endereco.', '.$numero.' - '.$complemento.' - '.$bairro.', '.$cep.' - '.$cidade.'/'.$uf);
          $tipo = strtolower(str_replace(' ', '', $oco_status));

          $xml .= '<marker ';
            $xml .= 'nome="'.$nome.'" ';
            $xml .= 'logradouro="'.$logradouro.'" ';
            $xml .= 'lat="'.$latitude.'" ';
            $xml .= 'lng="'.$longitude.'" ';
            $xml .= 'tipo="'.$tipo.'" ';
            $xml .= 'idemp="'.$emp_id.'" ';
            $xml .= 'idoco="'.$oco_id.'" ';
          $xml .= ' />'.PHP_EOL;
        endfor;
      $xml .= '</markers>'.PHP_EOL;
    }

    header("Content-Type: text/xml; charset=UTF-8");
    echo $xml;
  }

  function get_historico_ocorrencia_teste( $id_oco = 0 )
  {
    die('acesso negado.');
    $this->load->model(MODULO_APP.'Diretoria_model', 'mdash');

    $id_oco = (int)$id_oco;

    $res = $this->mdash->getOcorrenciaHistorico( $this->_cli_app_id, $id_oco );
    $qtd = is_array($res) ? count($res) : 0;

    $html = '<p id="aviso"><i class="fas fa-sync"></i> Nenhum relato informado até o momento.</p>';
    if( $qtd > 0 )
    {
      $html = '';
      for($i=0; $i<$qtd; $i++):
        $id = $res[$i]['ocand_id'];
        $descricao = $res[$i]['ocand_descricao'];
        $data_cad = converte_data($res[$i]['ocand_dataCadastro']);
        $periodo = $res[$i]['ocand_periodo']!='' ? combo_periodo($res[$i]['ocand_periodo']) : '';
        $box_periodo = ($periodo != '') ? '<div class="periodo-img">'.$periodo.'</div>' : '';
        $img_arquivo = $res[$i]['ocand_imgArquivo'];
        $img_legenda = ($res[$i]['ocand_imgLegenda']!='') ? '<br><span class="legenda">'.$res[$i]['ocand_imgLegenda'].'</span>' : '';

        $path = $this->_cli_dir_upload.$img_arquivo;
        $img = '<img src="'.base_url(DIR_UPLOAD.$this->_cli_app_id.'/'.$img_arquivo).'" class="img-responsive" >';
        $bg = ($i%2) ? 'bg-alt' : '';

        $html .= ($i==0) ? '' : '<hr>';

        $html .= '<div class="box-info '.$bg.'">';
          if( is_file($path) && !is_dir($path) )
            $html .= '<div class="box-img">'.$box_periodo.$img.$img_legenda.'</div>';
          if( $descricao != '' )
            $html .= '<p class="descricao">'.$descricao.'</p>';
          $html .= '<p class="relato"><i class="far fa-clock p-r-5"></i> Enviado em '.$data_cad.'</p>';
        $html .= '</div>';
      endfor;
    }

    header("Content-Type: text/html; charset=UTF-8");
    echo $html;
  }

}
