<?php

  function verifica_menu_ativo_admin( $valor_padrao, $valor_controller ) {
    return ($valor_padrao == $valor_controller) ? ' active in' : '';
  }

  function verifica_submenu_ativo_admin( $valor_padrao, $valor_controller ) {
    return ($valor_padrao == $valor_controller) ? ' active in' :  '';
  }

  function monta_box_mensagem_status_admin(Array $msg_status ) {
    switch( $msg_status['status'] ) {
      case 'erro':
      case 'danger':
        $status = 'alert-danger';
        $icone = 'fa-warning';
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
        $icone = 'fa-check-circle';
        $titulo = 'Aviso!';
      break;
      case 'info':
        $status = 'alert-info';
        $icone = 'fa-info-circle';
        $titulo = 'Informação!';
      break;
      default:
        $status = 'alert-default';
        $icone = 'fa-info';
        $titulo = 'Aviso!';
      break;
    }

    $box = '<div class="row"><div class="col-md-12">';
      $box .= '<div class="box-alerta-erro alert '.$status.'" role="alert">';
        $box .= '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>';
        $box .= '<p><i class="fa '.$icone.'"></i> <strong>'.$titulo.'</strong></p>';
        $box .= '<p>'.$msg_status['msg'].'</p>';
      $box .= '</div>';
    $box .= '</div></div>';

    return $box;
  }

  function monta_box_mensagem_aviso_admin( $msg, $status = 'info' ) {
    switch( $status ) {
      case 'erro':
      case 'danger':
        $status = 'alert-danger';
        $icone  = 'fa-warning';
        $titulo = 'Aviso!';
      break;
      case 'ok':
      case 'success':
        $status = 'alert-success';
        $icone  = 'fa-check-circle';
        $titulo = 'Sucesso!';
      break;
      case 'aviso':
      case 'warning':
        $status = 'alert-warning';
        $icone  = 'fa-check-circle';
        $titulo = 'Aviso!';
      break;
      case 'info':
        $status = 'alert-info';
        $icone  = 'fa-info-circle';
        $titulo = 'Informação!';
      break;
      default:
        $status = 'alert-default';
        $icone  = 'fa-info';
        $titulo = 'Aviso!';
    }

    $box = '<div class="row"><div class="col-md-12">';
      $box .= '<div class="box-alerta-aviso alert ' . $status . '" role="alert">';
        $box .= '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>';
        $box .= '<p><i class="fa ' . $icone . '"></i> <strong>' . $titulo . '</strong></p>';
        $box .= '<p>' . $msg . '</p>';
      $box .= '</div>';
    $box .= '</div></div>';

    return $box;
  }
