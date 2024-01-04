<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    require_once( '../application/config/constants.php' );
    require_once( '../application/helpers/portal_helper.php' );

    $padding = '65px';
    $array_arquivo = explode( '/', str_replace( '\\', '/', __FILE__) );
    $nome_arquivo = end( $array_arquivo );

    $senha = isset($_GET['s']) ? $_GET['s'] : '123456';
    $hash  = crypt_senha( $senha );

    $token = hash('sha512', sha1(microtime().uniqid()) );

    echo '<p>'.$nome_arquivo.'?<b>s</b>=novasenha</p><hr><br>';
    echo '<b>SENHA:</b> '.$senha.'<br>';
    echo '<span style="padding-left:'.$padding.';">'.$hash.'</span>';
    echo '<br><br>';
    echo '<b>TOKEN</b><br>';
    echo '<span style="padding-left:'.$padding.';">'.$token.'</span>';
