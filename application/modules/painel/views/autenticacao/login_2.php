<div class="login-page cnt-bg-photo overview-bgi" style="background-image: url(<?php echo base_url(ASSETS_PORTAL.'img/banner-1.jpg'); ?>)">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="content-form-box forgot-box clearfix">
          <div class="login-header clearfix">
            <div class="pull-left">
              <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/auth-logo-drplace-dark.png'); ?>" alt="Dr.Place - Direto com o proprietário">
            </div>
            <div class="pull-right">
              <h4>Acessar</h4>
            </div>
          </div>
          <?php
            if( validation_errors() != '' )
              echo '<div class="alert alert-danger" role="alert">'.validation_errors('<p>', '</p>').'</div>';

            if( $_msg_status )
              echo monta_box_mensagem_status( $_msg_status );
          ?>
          <div class="text-center">
            Não tem uma conta ?
            <a class="btn btn-border btn-sm" href="<?php echo base_url('criar-conta') ?>" role="button">
              Cadastre-se
            </a>
          </div>
          <hr>
          <div class="text-center">
            <a class="btn btn-info btn-sm" href="<?php echo $fb_loginUrl ?>"><i class="fab fa-facebook"></i> Entrar com Facebook</a>
          </div>
          <hr>
          <p>Ou utilize seus dados de acesso para logar</p>
          <?php
            $form_act = base_url( MODULO_PAINEL . 'autenticacao/logar' );
            $form_atr = array( 'method' => 'post', 'id' => 'form', 'name' => 'form',
                                'class' => 'form form-bv', 'autocomplete' => 'off', 'role' => 'form' );

            $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'seu.email@provedor.com.br', 'class' => 'form-control afocus', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );
            $form_inp_senha = array('name' => 'inp_senha', 'id' => 'inp_senha', 'placeholder' => 'Senha', 'class' => 'form-control', 'data-bv-notempty' => 'true' );

            $form_val_inp_email = set_value( 'inp_email' );
            $form_val_inp_senha = set_value( 'inp_senha' );

            echo form_open( $form_act, $form_atr );
          ?>
            <div class="form-group">
              <label><i class="fa fa-envelope pr-1"></i> E-mail</label>
              <?php echo form_email($form_inp_email, $form_val_inp_email); ?>
            </div>
            <div class="form-group">
              <label><i class="fa fa-lock pr-1"></i> Senha</label>
              <?php echo form_password($form_inp_senha, $form_val_inp_senha); ?>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-color btn-md">Entrar</button>
            </div>
            <hr>
            <p class="text-right">
              <a href="<?php echo base_url(MODULO_PAINEL.'autenticacao/recuperar-senha'); ?>">Esqueceu a senha ?</a>
            </p>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
