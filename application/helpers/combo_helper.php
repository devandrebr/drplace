<?php

  function combo_uf( $str = NULL )
  {
    $array_valor = array( 'AD', 'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PE', 'PR', 'PI', 'RJ', 'RN', 'RS', 'RR', 'RO', 'SC', 'SP', 'SE', 'TO' );
    $array_nome  = array( 'A DEFINIR', 'ACRE', 'ALAGOAS', 'AMAPÁ', 'AMAZONAS', 'BAHIA', 'CEARÁ', 'DISTRITO FEDERAL', 'ESPIRITO SANTO', 'GOIÁS', 'MARANHÃO', 'MATO GROSSO', 'MATO GROSSO DO SUL', 'MINAS GERAIS', 'PARÁ', 'PARAÍBA', 'PERNAMBUCO', 'PARANÁ', 'PIAUÍ', 'RIO DE JANEIRO', 'RIO GRANDE DO NORTE', 'RIO GRANDE DO SUL', 'RORAIMA', 'RONDONIA', 'SANTA CATARINA', 'SÃO PAULO', 'SERGIPE', 'TOCANTINS' );

    if( $str == '' ) {
      $qtd = count($array_valor);
      $arr = array();
      for($i=0;$i<$qtd;$i++) {
        $arr[$i]['valor'] = $array_valor[$i];
        $arr[$i]['nome']  = $array_nome[$i];
      }

      return $arr;
    } else {
      $key = array_keys( $array_valor, $str );
      return isset($array_nome[$key[0]]) ? $array_nome[$key[0]] : '';
    }
  }

  function combo_situacao( $str = NULL )
  {
    $array_valor = array( 'V', 'A', '0' );
    $array_nome  = array( 'Vender', 'Alugar', 'Indiferente' );

    if( $str == '' ) {
      $qtd = count($array_valor);
      $arr = array();
      for($i=0;$i<$qtd;$i++) {
        $arr[$i]['valor'] = $array_valor[$i];
        $arr[$i]['nome']  = $array_nome[$i];
      }

      return $arr;
    } else {
      $key = array_keys( $array_valor, $str );
      return isset($array_nome[$key[0]]) ? $array_nome[$key[0]] : '';
    }
  }

  function combo_categoriaImovel( $str = NULL )
  {
    $array_valor = array( 'R', 'C' );
    $array_nome  = array( 'Residencial', 'Comercial' );

    if( $str == '' ) {
      $qtd = count($array_valor);
      $arr = array();
      for($i=0;$i<$qtd;$i++) {
        $arr[$i]['valor'] = $array_valor[$i];
        $arr[$i]['nome']  = $array_nome[$i];
      }

      return $arr;
    } else {
      $key = array_keys( $array_valor, $str );
      return isset($array_nome[$key[0]]) ? $array_nome[$key[0]] : '';
    }
  }

  function combo_emailDiretoria( $str = NULL )
  {
    // $array_valor = array( 'drplace@andrewd.com.br', 'victor.prmss@gmail.com', 'jhonatanabner@gmail.com' );
    // $array_nome  = array( 'Dr.Place | André', 'Dr.Place | Victor', 'Dr.Place | Jhonatan' );
    $array_valor = array( 'drplace@andrewd.com.br' );
    $array_nome  = array( 'Dr.Place | André' );

    if( $str == '' ) {
      $qtd = count($array_valor);
      $arr = array();
      for($i=0;$i<$qtd;$i++) {
        $arr[$i]['valor'] = $array_valor[$i];
        $arr[$i]['nome']  = $array_nome[$i];
      }

      return $arr;
    } else {
      $key = array_keys( $array_valor, $str );
      return isset($array_nome[$key[0]]) ? $array_nome[$key[0]] : '';
    }
  }

  function combo_emailContato( $str = NULL )
  {
    return combo_emailDiretoria($str);
  }

  function combo_emailCampanha1( $str = NULL )
  {
    return combo_emailDiretoria($str);
  }
