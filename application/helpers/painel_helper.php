<?php
  function senha_aleatoria() {
    $alphabet = '1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }

  function verifica_menu_painel( $menu_atual, $menu ) {
    return ($menu == $menu_atual) ? 'class="active"' : '';
  }

  function get_latLong($address){
    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
    $json = json_decode($json);

    $lat = isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}) ? $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'} : '';
    $long = isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}) ? $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'} : '';

    $ret = array('lat'=>$lat,'lng'=>$long);
    return $ret;
  }

  function converte_moeda( $valor, $tipo = 'EN' ) {
    $ret = NULL;
    if( $valor != '' ) {
      if($tipo == 'BRL')
        $ret = number_format($valor, 2, ',', '.');
      else
      {
        $v = explode( ' ', $valor );
        if(str_replace(array(',','.',' '), '', @$v[1]) > 0 && @$v[1] != '')
          $ret = trim($v[1]);

        if( str_replace(array(',','.',' '), '', $valor) > 0 && $valor != '' ) {
          $ret = str_replace('.', '', $valor);
          $ret = str_replace(',', '.', $ret);
        }
        else
          $ret = NULL;
      }
    }

    return $ret;
  }

  function url_slug( $string, $type = '-' ) {
    $ext = array( '.jpg', '.bmp', '.jpeg', '.png', '.gif', 'jpg', 'bmp', 'jpeg', 'png', 'gif' );
    return url_remove_acento( str_replace( $ext, '', $string), $type );
  }

  function string_remove_acento( $string ) {
    $string = html_entity_decode($string);
    $string = url_remove_acento( $string );
    $string = preg_replace( '/[^A-Za-z0-9\_\-\.]/', '', $string );

    return $string;
  }

  function url_remove_acento( $string, $type = '-' ) {
    $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ`´:_\'&~[]{}!/$#%*?';
    $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                   ';

    $string = strip_tags( $string );
    $string = utf8_decode( $string );
    $string = strtr( $string, utf8_decode($a), $b );
    $string = str_replace(' ', $type, $string );

    $lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
    $spacesDuplicateHypens = '/[\-\s]+/';

    $string = preg_replace( $lettersNumbersSpacesHyphens, '', $string );
    $string = preg_replace( $spacesDuplicateHypens, $type, $string );

    $string = trim( $string, $type );

    return mb_strtolower( $string, 'UTF-8' );
  }

  function get_nome_arquivo( $nome, $max = 45, $hash = FALSE ) {
    $nome = trim($nome);
    $return = '';
    if( $nome != '' ) {
      $ex = explode('.',$nome);
      $extensao = strtolower(end($ex));
      $novo_nome = string_remove_acento(str_replace(".$extensao",'',substr($nome,0, strlen($nome))));
      if( $hash )
        $novo_nome = sha1($novo_nome);

      if(strlen($novo_nome) > $max)
        $novo_nome = substr($novo_nome,$max);

      $return = $novo_nome.".$extensao";
    }

    return $return;
  }

  function cortar_string( $string, $qtd_cortar, $reticencia = true )
  {
      $return = $string;
      $ret    = ($reticencia) ? ' ...' : '';

      if( is_string($string) && is_int($qtd_cortar) )
      {
          $qtd_add = $ret == '' ? 0 : 4;
          if( strlen($string) <= ($qtd_cortar+$qtd_add) )
              $return = $string;
          else
              $return = mb_substr($string, 0, $qtd_cortar).$ret;
      }

      return $return;
  }
