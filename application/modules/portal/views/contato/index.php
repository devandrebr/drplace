<div class="contact-3 content-area-7">
  <div class="container">
    <div class="main-title">
      <h1>Diz aí! Como podemos ajudar você ?</h1>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-5">
        <div class="contact-info">
          <h3>Canais de Atendimento</h3>
          <ul class="contact-list">
            <li><i class="fab fa-skype"></i> <?php echo CONTATO_SKYPE ?></li>
            <li><i class="fa fa-phone"></i> <?php echo CONTATO_TELEFONE ?></li>
            <li><i class="mr-3 fa fa-envelope"></i> <a href="mailto:<?php echo CONTATO_EMAIL ?>"><?php echo CONTATO_EMAIL ?></a></li>
          </ul>
          <h3>Siga-nos</h3>
          <ul class="social-list clearfix">
            <li><a href="<?php echo LINK_RS_FACEBOOK ?>" class="facebook"><i class="fab fa-facebook"></i></a></li>
            <li><a href="<?php echo LINK_RS_INSTAGRAM ?>" class="instagram"><i class="fab fa-instagram"></i></a></li>
            <li><a href="<?php echo LINK_RS_LINKEDIN ?>" class="linkedin"><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-8 col-md-7">
        <?php
          if( validation_errors() != '' )
            echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div></div></div>';

          if( $_msg_status )
            echo monta_box_mensagem_status( $_msg_status );

          $form_act = base_url(MODULO_PORTAL.'contato/enviar-contato');
          $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form',
                              'class' => 'form form-bv', 'autocomplete' => 'off', 'role' => 'form' );

          $form_label = array('class' => 'control-label');

          $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'class' => 'form-control afocus', 'placeholder' => 'Nome', 'maxlength' => '120', 'data-bv-notempty' => 'true' );
          $form_inp_telefone = array('name' => 'inp_telefone', 'id' => 'inp_telefone', 'class' => 'form-control m_telefone', 'placeholder' => 'Telefone' );
          $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'E-mail', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );
          $form_tex_msg = array('name' => 'tex_msg', 'id' => 'tex_msg', 'class' => 'form-control', 'placeholder' => 'Escreva sua mensagem...', 'data-bv-notempty' => 'true' );

          $form_val_inp_nome = set_value( 'inp_nome' );
          $form_val_inp_telefone = set_value( 'inp_telefone' );
          $form_val_inp_email = set_value( 'inp_email' );
          $form_val_tex_msg = set_value( 'tex_msg' );

          echo form_open( $form_act, $form_atr );
        ?>
          <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group name">
                <?php echo form_input($form_inp_nome,$form_val_inp_nome) ?>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group email">
                <?php echo form_email($form_inp_email,$form_val_inp_email) ?>
              </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group message">
                <?php echo form_textarea($form_tex_msg,$form_val_tex_msg) ?>
              </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group telefone">
                <?php echo form_input($form_inp_telefone,$form_val_inp_telefone) ?>
              </div>
              <hr>
              <div class="box-recaptcha">
                <script src='https://www.google.com/recaptcha/api.js'></script>
                <div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_SITE_RECAPTCHA ?>"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="send-btn text-center">
                <br>
                <button type="submit" class="btn btn-theme btn-lg">Enviar Mensagem</button>
              </div>
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
