<?php
  $nome = $res_usu['usu_nome'];
  $email1 = $res_usu['usu_email1'];
  $cpf = $res_usu['usu_cpf'];
  $rg = $res_usu['usu_rg'];
  $endereco = $res_usu['usu_endereco'];
  $numero = $res_usu['usu_numero'];
  $bairro = $res_usu['usu_bairro'];
  $complemento = $res_usu['usu_complemento'];
  $cep = $res_usu['usu_cep'];
  $telefone1 = $res_usu['usu_telefone1'];
  $celular1 = $res_usu['usu_celular1'];
  $whatsapp1 = $res_usu['usu_whatsapp1'];
  $radio1 = $res_usu['usu_radio1'];
  $site = $res_usu['usu_site'];
  $facebook = $res_usu['usu_facebook'];
  $instagram = $res_usu['usu_instagram'];
  $twitter = $res_usu['usu_twitter'];
?>
  <div class="user-page">
    <div class="container">
      <h3 class="heading">Atualizar Meu Perfil</h3>
      <?php
        if( validation_errors() != '' )
          echo '<div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div>';

        if( $_msg_status )
          echo monta_box_mensagem_status($_msg_status);

        $form_act = base_url(MODULO_PAINEL.'perfil/atualizar');
        $form_atr = array('method' => 'post', 'id' => 'form_meu_perfil', 'name' => 'form',
                            'class' => 'form-bv', 'autocomplete' => 'off', 'role' => 'form' );

        $form_label = array('class' => 'control-label');

        $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'class' => 'form-control', 'data-bv-notempty' => 'true' );
        $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );
        $form_inp_telefone1 = array('name' => 'inp_telefone1', 'id' => 'inp_telefone1', 'class' => 'form-control m_telefone', 'placeholder' => 'Seu Telefone' );
        $form_inp_celular1 = array('name' => 'inp_celular1', 'id' => 'inp_celular1', 'class' => 'form-control m_telefone', 'placeholder' => 'Celular' );
        $form_inp_whatsapp1 = array('name' => 'inp_whatsapp1', 'id' => 'inp_whatsapp1', 'class' => 'form-control m_telefone', 'placeholder' => 'WhatsApp' );
        $form_inp_radio1 = array('name' => 'inp_radio1', 'id' => 'inp_radio1', 'class' => 'form-control', 'placeholder' => 'Rádio' );
        $form_inp_site = array('name' => 'inp_site', 'id' => 'inp_site', 'class' => 'form-control', 'placeholder' => 'Link Site' );
        $form_inp_facebook = array('name' => 'inp_facebook', 'id' => 'inp_facebook', 'class' => 'form-control', 'placeholder' => 'Link Facebook' );
        $form_inp_twitter = array('name' => 'inp_twitter', 'id' => 'inp_twitter', 'class' => 'form-control', 'placeholder' => 'Link Twitter' );
        $form_inp_instagram = array('name' => 'inp_instagram', 'id' => 'inp_instagram', 'class' => 'form-control', 'placeholder' => 'Link Instagram' );
        $form_inp_senha1 = array('name' => 'inp_senha1', 'id' => 'inp_senha1', 'placeholder' => 'Nova Senha', 'class' => 'form-control', 'data-bv-identical-field' => 'inp_senha2', 'data-bv-identical-message' => 'As senhas não conferem.' );
        $form_inp_senha2 = array('name' => 'inp_senha2', 'id' => 'inp_senha2', 'placeholder' => 'Confirme Sua Nova Senha', 'class' => 'form-control',  'data-bv-identical-field' => 'inp_senha1', 'data-bv-identical-message' => 'As senhas não conferem.' );

        $form_val_inp_nome = set_value( 'inp_nome', $nome );
        $form_val_inp_email = set_value( 'inp_email', $email1 );
        $form_val_inp_telefone1 = set_value( 'inp_telefone1', $telefone1 );
        $form_val_inp_celular1 = set_value( 'inp_celular1', $celular1 );
        $form_val_inp_whatsapp1 = set_value( 'inp_whatsapp1', $whatsapp1 );
        $form_val_inp_radio1 = set_value( 'inp_radio1', $radio1 );
        $form_val_inp_facebook = set_value( 'inp_facebook', $facebook );
        $form_val_inp_twitter = set_value( 'inp_twitter', $twitter );
        $form_val_inp_site = set_value( 'inp_site', $site );
        $form_val_inp_instagram = set_value( 'inp_instagram', $instagram );
        $form_val_inp_senha1 = set_value( 'inp_senha1' );
        $form_val_inp_senha2 = set_value( 'inp_senha2' );

        echo form_open_multipart( $form_act, $form_atr );
      ?>

        <div class="row">
          <div class="col-lg-8 col-xs-9">
            <div class="form-group">
              <?php
                echo form_label('<b>*</b> Nome completo', 'inp_nome', $form_label);
                echo form_input($form_inp_nome, $form_val_inp_nome);
              ?>
            </div>
            <div class="form-group">
              <?php
                echo form_label('<b>*</b> E-mail', 'inp_email', $form_label);
                echo form_email($form_inp_email, $form_val_inp_email);
              ?>
            </div>
          </div>
          <div class="col-lg-4 col-xs-3 text-center">
            <img src="<?php echo $_usu_avatar; ?>" alt="Avatar" class="img-fluid" style="max-height:78px;">
            <hr>
            <input type="file" name="inp_avatar" id="inp_avatar" class="form-control" />
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Nova senha', 'inp_senha1', $form_label);
                echo form_password($form_inp_senha1, $form_val_inp_senha1);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Confirme a nova senha', 'inp_senha2', $form_label);
                echo form_password($form_inp_senha2, $form_val_inp_senha2);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Telefone', 'inp_telefone1', $form_label);
                echo form_input($form_inp_telefone1, $form_val_inp_telefone1);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Celular', 'inp_celular1', $form_label);
                echo form_input($form_inp_celular1, $form_val_inp_celular1);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('WhatsApp', 'inp_whatsapp1', $form_label);
                echo form_input($form_inp_whatsapp1, $form_val_inp_whatsapp1);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Rádio', 'inp_radio1', $form_label);
                echo form_input($form_inp_radio1, $form_val_inp_radio1);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Facebook', 'inp_facebook', $form_label);
                echo form_input($form_inp_facebook, $form_val_inp_facebook);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Instagram', 'inp_instagram', $form_label);
                echo form_input($form_inp_instagram, $form_val_inp_instagram);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Site', 'inp_site', $form_label);
                echo form_input($form_inp_site, $form_val_inp_site);
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <?php
                echo form_label('Twitter', 'inp_twitter', $form_label);
                echo form_input($form_inp_twitter, $form_val_inp_twitter);
              ?>
            </div>
          </div>
          <div class="col-lg-12 text-right">
            <br><hr><br>
            <button type="submit" name="bt-submit" class="btn btn-md btn-color">
              Atualizar
            </button>
          </div>
        </div>
    <?php
      echo form_close();
    ?>
  </div>
</div>
