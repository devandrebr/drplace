<?php
  $id_imo_usu = (int)$res['imo_id_usuario'];
  $id_imo = (int)$res['imo_id'];

  $class_usu_box = ( ($id_imo_usu >= 1) && ($id_imo_usu == $_usu_id) ) ? ' box-msg-proprietario' : ' box-msg-prospect';

  $id = $res['imomsg_id'];
  $data_cad = converte_data($res['imomsg_dataCadastro']);
  $nome = $res['imomsg_nome'];
  $telefone = $res['imomsg_telefone'];
  $msg = $res['imomsg_mensagem'];
  $email = $res['imomsg_email'] == '' ? '------' : $res['imomsg_email'];
?>
<div class="user-page page-chat-conversa<?php echo $class_usu_box ?>">
  <div class="container">
    <h3 class="heading">Detalhes da mensagem recebida/enviada</h3>
    <?php
      if( $_msg_status )
        echo monta_box_mensagem_status( $_msg_status );
    ?>
    <div class="row">
      <div class="col-md-7 col-sm-6 col-xs-12">
        <table cellspacing="0" cellpadding="0" border="0" class="tb-msg">
          <tbody>
            <tr>
              <td><b>Nome:</b><?php echo $nome ?></td>
              <td><b>Envio em:</b><?php echo $data_cad ?></td>
            </tr>
            <tr>
              <td><b>Telefone:</b><?php echo $telefone ?></td>
              <td><b>E-mail:</b><?php echo $email ?></td>
            </tr>
            <tr>
              <td colspan="2"><b>Mensagem:</b><?php echo $msg ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5 col-sm-6 col-xs-12">
        <?php
          $form_act = base_url(MODULO_PAINEL.'chat/enviar-mensagem');
          $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form',
                              'class' => 'form form-bv', 'autocomplete' => 'off', 'role' => 'form' );

          $form_label = array('class' => 'control-label');

          $form_tex_msg = array('name' => 'tex_msg', 'id' => 'tex_msg', 'class' => 'form-control', 'placeholder' => 'Responda aqui...', 'rows' => 3, 'data-bv-notempty' => 'true');

          $form_val_tex_msg = set_value('tex_msg');

          $form_hidden = array('msg_id'=>$id,'imo_id'=>$id_imo,'imo_usu_id'=>$id_imo_usu);
          echo form_open($form_act,$form_atr,$form_hidden);
        ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <?php
                    echo form_label('<b>*</b> Continue a conversa! Envie uma mensagem', 'tex_msg', $form_label);
                    echo form_textarea($form_tex_msg, $form_val_tex_msg);
                  ?>
                </div>
                <hr>
              </div>
              <div class="col-md-12 text-right">
                <div class="form-group">
                  <button type="submit" name="bt-submit" class="btn btn-md btn-color">
                    Enviar
                  </button>
                </div>
              </div>
            </div>
        <?php
          echo form_close();
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?php
          if( $qtd_con == 0 ) {
            $status = 'info';
            $msg = 'Nenhuma mensagem enviada através da plataforma para esta conversa.';
            echo monta_box_mensagem_status( array('status'=>$status,'msg'=>$msg) );
          } else {
            $html = '<hr><div class="row">';
              for($i=0; $i<$qtd_con; $i++):
                $usu_id = $res_con[$i]['fk_id_usuario'];
                $mcoim_dataCadastro = converte_data($res_con[$i]['mcoim_dataCadastro']);
                $mcoim_nome = $res_con[$i]['mcoim_nome'];
                $mcoim_mensagem = $res_con[$i]['mcoim_mensagem'];
                $mcoim_visualizada = $res_con[$i]['mcoim_visualizada'];

                $class_conv = ( ($id_imo_usu >= 1) && ($id_imo_usu == $_usu_id) ) ? ' resp-usu-prop' : '';
                $icon_view = ($mcoim_visualizada) ? 'fa-check-circle ico-view-ok' : 'fa-user ico-view-new';
                $icon_view_msg = ($mcoim_visualizada) ? 'Visualizada' : 'Nova Conversa';

                $html .= '<div class="col-md-12">';
                  $html .= '<div class="box-resposta'.$class_conv.'">';
                    $html .= '<div class="titulo">';
                      $html .= '<i class="fa '.$icon_view.'" data-toggle="tooltip" data-placement="top" title="'.$icon_view_msg.'" aria-hidden="true"></i>';
                      $html .= '<span class="nome">'.$mcoim_nome.'</span>';
                      $html .= '<span class="datacad">'.$mcoim_dataCadastro.'</span>';
                    $html .= '</div>';
                    $html .= '<p class="msg">'.$mcoim_mensagem.'</p>';
                  $html .= '</div>';
                $html .= '</div>';

              endfor;

            $html .= '</div>';

            echo $html;
          }
        ?>
      </div>
    </div>
  </div>
</div>
