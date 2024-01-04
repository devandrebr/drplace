<div class="forgot-password">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-8 col-lg-8 col-md-7 overview-bgi cnt-bg-photo cnt-bg-photo-2 d-none d-xl-block d-lg-block d-md-block" style="background-image: url(<?php echo base_url(ASSETS_PORTAL.'img/banner-2.jpg'); ?>)">
        <div class="login-info">
          <h3>Direto com o proprietário</h3>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-5 content-box">
        <div class="content-form-box">
          <h1 class="login-header">Esqueceu a Senha ?</h1>
          <p>Acontece! Por favor, digite seu endereço de e-mail para receber as próximas instruções nele.</p>
          <?php
            if( validation_errors() != '' )
              echo '<div class="alert alert-danger" role="alert">'.validation_errors('<p>', '</p>').'</div>';

            if( $_msg_status )
              echo monta_box_mensagem_status( $_msg_status );

            $form_act = base_url( $_modulo . $_controller . '/solicitacao-recuperar-senha' );
            $form_atr = array( 'method' => 'post', 'id' => 'form', 'name' => 'form',
                                'class' => 'form-bv', 'autocomplete' => 'off', 'role' => 'form' );

            $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'seu.email@provedor.com.br', 'class' => 'form-control afocus', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );

            $form_val_inp_email = set_value( 'inp_email' );

            echo form_open( $form_act, $form_atr );
          ?>
            <div class="form-group">
              <label><i class="fa fa-question pr-1"></i> E-mail</label>
              <?php echo form_email($form_inp_email, $form_val_inp_email); ?>
            </div>
            <button type="submit" class="btn btn-color btn-md">Recuperar</button>
          <?php echo form_close(); ?>
        </div>
        <div class="login-footer clearfix">
          <div class="pull-left">
            <a href="<?php echo base_url(); ?>">
              <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/logo-drplace.png'); ?>" alt="Dr.Place - Direto com o proprietário">
            </a>
          </div>
          <div class="pull-right">
            <p>Não tem uma conta? <a href="<?php echo base_url('criar-conta'); ?>">Criar Conta</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
