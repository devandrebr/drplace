<?php
  function dump($s){echo'<pre>';var_dump($s);echo'</pre>';}

  function somente_numero( $str ) {
    return preg_replace( '/[^0-9]/', '', (string)$str );
  }

  function css_topo($tema){
    return ((int)$tema<=1) ? 'custom.css' : 'lpage.css';
  }

  function verifica_menu_site( $menu, $menu_atual ) {
    return ($menu == $menu_atual) ? ' active' : '';
  }

  function get_primeiro_nome($nome) {
    $ex = explode(' ', $nome);
    $primeiro_nome = isset($ex[0]) ? trim($ex[0]) : trim($nome);

    return $primeiro_nome;
  }

  function get_saudacao() {
      $hr = date("H");

      if( $hr >= 0 && $hr < 12 )
          $ret = 'Bom dia';
      else if( $hr >= 12 && $hr < 18 )
          $ret = 'Boa tarde';
      else
          $ret = 'Boa noite';

      return $ret;
  }

  function converte_data( $data ) {
    $retorno = NULL;

    if( $data != '' ) {
      $hora = NULL;
      if( strpos( $data, ' ' ) )
        list( $data, $hora ) = explode( ' ', $data );

      if( strpos( $data, '-' ) )
        $data = implode( '/', array_reverse( explode( '-', $data ) ) );
      else if( strpos( $data, '/' ) )
        $data = implode( '-', array_reverse( explode( '/', $data ) ) );

      if( !is_null( $hora ) )
        $retorno = $data . ' ' . $hora;
      else
        $retorno = $data;
    }

    return $retorno;
  }

  function get_string_data_atual( $cidade = NULL ) {
    // {$cidade}Limeira, 03 de março de 2015.
    $cidade = ($cidade != '') ? mb_ucfirst($cidade, 'UTF-8', true) . ', ' : '';
    $string = $cidade . date("d") . ' ';

    switch( date("m") )
    {
       case 1: $string .= "de Janeiro de"; break;
       case 2: $string .= "de Fevereiro de"; break;
       case 3: $string .= "de Março de"; break;
       case 4: $string .= "de Abril de"; break;
       case 5: $string .= "de Maio de"; break;
       case 6: $string .= "de Junho de"; break;
       case 7: $string .= "de Julho de"; break;
       case 8: $string .= "de Agosto de"; break;
       case 9: $string .= "de Setembro de"; break;
       case 10: $string .= "de Outubro de"; break;
       case 11: $string .= "de Novembro de"; break;
       case 12: $string .= "de Dezembro de"; break;
    }

    $string .= ' '.date("Y");

    return $string;
  }

  function get_string_data($data)
  {
    list($ldata, $lhora) = explode(' ',$data);
    list($dia, $mes, $ano) = explode('/',$ldata);

    $string = $dia . ' ';
    switch( $mes ) {
       case 1: $string .= "de Janeiro de"; break;
       case 2: $string .= "de Fevereiro de"; break;
       case 3: $string .= "de Março de"; break;
       case 4: $string .= "de Abril de"; break;
       case 5: $string .= "de Maio de"; break;
       case 6: $string .= "de Junho de"; break;
       case 7: $string .= "de Julho de"; break;
       case 8: $string .= "de Agosto de"; break;
       case 9: $string .= "de Setembro de"; break;
       case 10: $string .= "de Outubro de"; break;
       case 11: $string .= "de Novembro de"; break;
       case 12: $string .= "de Dezembro de"; break;
    }

    $string .= ' '.$ano;

    return $string;
  }

  function get_data_artigo($data)
  {
    list($ldata, $lhora) = explode(' ',$data);
    list($dia, $mes, $ano) = explode('/',$ldata);

    $str_mes = '';
    
    switch( $mes ) {
       case 1: $str_mes = "Jan"; break;
       case 2: $str_mes = "Fev"; break;
       case 3: $str_mes = "Mar"; break;
       case 4: $str_mes = "Abr"; break;
       case 5: $str_mes = "Mai"; break;
       case 6: $str_mes = "Jun"; break;
       case 7: $str_mes = "Jul"; break;
       case 8: $str_mes = "Ago"; break;
       case 9: $str_mes = "Set"; break;
       case 10: $str_mes = "Out"; break;
       case 11: $str_mes = "Nov"; break;
       case 12: $str_mes = "Dez"; break;
    }

    $ret = array('dia'=>$dia,'mes'=>$str_mes,'ano'=>$ano);

    return $ret;
  }

  function monta_box_mensagem_status_camp1(Array $msg_status)
  {
    switch( $msg_status['status'] )
    {
      case 'erro':
      case 'danger':
        $status = 'alert-danger';
        $titulo = 'Ops, algo deu errado!';
      break;
      case 'ok':
      case 'success':
        $status = 'alert-success';
        $titulo = 'OK!';
      break;
      case 'aviso':
      case 'warning':
        $status = 'alert-warning';
        $titulo = 'Aviso!';
      break;
      default:
        $status = 'alert-info';
        $titulo = 'Aviso!';
      break;
    }

    $box = '<div class="row"><div class="col-md-12"><div class="box-alerta-camp1 alert '.$status.'" role="alert">';
      $box .= '<p class="al-titulo"><strong>'.$titulo.'</strong></p>';
      $box .= $msg_status['msg'];
    $box .= '</div></div></div><br class="clearfix">';

    return $box;
  }

  function monta_box_mensagem_status(Array $msg_status)
  {
    switch( $msg_status['status'] )
    {
      case 'erro':
      case 'danger':
        $status = 'alert-danger';
        $icone = 'fa-ban';
        $titulo = 'Ops, algo deu errado!';
      break;
      case 'ok':
      case 'success':
        $status = 'alert-success';
        $icone = 'fa-check-circle';
        $titulo = 'OK!';
      break;
      case 'aviso':
      case 'warning':
        $status = 'alert-warning';
        $icone = 'fa-exclamation-circle';
        $titulo = 'Aviso!';
      break;
      default:
        $status = 'alert-info';
        $icone = 'fa-info-circle';
        $titulo = 'Aviso!';
      break;
    }

    $box = '<div class="row"><div class="col-md-12"><div class="box-alerta-portal alert '.$status.'" role="alert">';
      $box .= '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>';
      $box .= '<p class="al-titulo"><i class="fas '.$icone.'"></i><strong>'.$titulo.'</strong></p>';
      $box .= $msg_status['msg'];
    $box .= '</div></div></div><br class="clearfix">';

    return $box;
  }

  function verifica_diretorio( $dir ) {
    if( ! is_dir($dir) && ! is_file($dir) )
      mkdir( $dir, 0777, true );

    return $dir;
  }

  function crypt_senha( $senha ) {
    $salt = SALT_SENHA_USUARIO;
    return hash('sha256',sha1($salt.$senha));
  }

  function gerar_token() {
    $str = md5(microtime().uniqid());
    return hash('sha512',sha1($str));
  }

  function valida_token($token) {
    return (strlen($token)==64) ? $token : NULL;
  }

  function remove_espaco_html( $s ) {
    $s = preg_replace('(\r|\n|\t)', '', $s);
    $s = preg_replace('(\r|\t)', '', $s);
    $s = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $s);
    $s = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $s);
    $s = preg_replace('/\s(?=\s)/', '', $s);

    return trim($s);
  }

  function get_OS( $user_agent ) {
    $os_platform = "Sistema desconhecido";

    $os_array = array(
                    '/windows nt 10.0/i'    =>  'Windows 10',
                    '/windows nt 6.2/i'     =>  'Windows 8',
                    '/windows nt 6.1/i'     =>  'Windows 7',
                    '/windows nt 6.0/i'     =>  'Windows Vista',
                    '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                    '/windows nt 5.1/i'     =>  'Windows XP',
                    '/windows xp/i'         =>  'Windows XP',
                    '/windows nt 5.0/i'     =>  'Windows 2000',
                    '/windows me/i'         =>  'Windows ME',
                    '/win98/i'              =>  'Windows 98',
                    '/win95/i'              =>  'Windows 95',
                    '/win16/i'              =>  'Windows 3.11',
                    '/macintosh|mac os x/i' =>  'Mac OS X',
                    '/mac_powerpc/i'        =>  'Mac OS 9',
                    '/linux/i'              =>  'Linux',
                    '/ubuntu/i'             =>  'Ubuntu',
                    '/iphone/i'             =>  'iPhone',
                    '/ipod/i'               =>  'iPod',
                    '/ipad/i'               =>  'iPad',
                    '/android/i'            =>  'Android',
                    '/blackberry/i'         =>  'BlackBerry',
                    '/webos/i'              =>  'Mobile'
                );

    foreach( $os_array as $regex => $value ) {
      if( preg_match($regex, $user_agent) )
        $os_platform = $value;
    }

    return $os_platform;
  }

  function get_browser_modificado( $user_agent ) {
    $browser = "Navegador desconhecido";

    $browser_array = array(
                          '/msie/i' => 'Internet Explorer',
                          '/firefox/i' => 'Firefox',
                          '/safari/i' => 'Safari',
                          '/chrome/i' => 'Google Chrome',
                          '/edge/i' => 'Edge',
                          '/opera/i' => 'Opera',
                          '/netscape/i' => 'Netscape',
                          '/maxthon/i' => 'Maxthon',
                          '/konqueror/i' => 'Konqueror',
                          '/mobile/i' => 'Navegador Mobile'
                      );

    foreach( $browser_array as $regex => $value ) {
      if( preg_match($regex, $user_agent) )
        $browser = $value;
    }

    return $browser;
  }
