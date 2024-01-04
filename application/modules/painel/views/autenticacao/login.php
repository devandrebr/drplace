<div class="login-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-8 col-lg-8 col-md-7 overview-bgi cnt-bg-photo cnt-bg-photo-2 d-none d-xl-block d-lg-block d-md-block" style="background-image: url(<?php echo base_url(ASSETS_PORTAL.'img/banner-2.jpg'); ?>)">
        <div class="login-info">
          <h3>Direto com o proprietário</h3>
          <p>Dr.Place - Solução de venda de imóveis direto com o proprietário, sem intermerdiários com muito mais agilidade e certeza de um excelente negócio.</p>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-5 content-box">
        <div class="content-form-box">
          <div class="login-header clearfix">
            <div class="pull-left">
              <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/auth-logo-drplace-dark.png'); ?>" alt="Dr.Place - Direto com o proprietário">
            </div>
            <div class="pull-right">
              <h4>Acessar</h4>
            </div>
          </div>
          <hr>
          <?php
            if( validation_errors() != '' )
              echo '<div class="alert alert-danger" role="alert">'.validation_errors('<p>', '</p>').'</div>';

            if( $_msg_status )
              echo monta_box_mensagem_status( $_msg_status );
          ?>
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
          <div class="text-center">
            Não tem uma conta ?
            <a class="btn btn-border btn-sm" href="<?php echo base_url('criar-conta') ?>" role="button">
              Cadastre-se
            </a>
          </div>
        </div>
        <div class="login-footer clearfix" style="border-top:none;">
          <div class="pull-left">
            <p><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i> Voltar</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
