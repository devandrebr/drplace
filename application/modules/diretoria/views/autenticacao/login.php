<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8" />
    <meta name="description" content="Doutor Place - Negocie Direto com Proprietário e Interessados" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Doutor.Place - Negocie Direto com Proprietário e Interessados" />
    <meta name="developer" content="André Severino - andre@andrewd.com.br" />

    <meta property="og:type" content="website">
    <meta property="og:title" content="Doutor Place - Negocie Direto com Proprietário e Interessados">
    <meta property="og:description" content="Doutor.Place - Negocie Direto com Proprietário e Interessados">
    <meta property="og:url" content="<?php echo base_url(); ?>">
    <meta property="og:image" content="<?php echo base_url(ASSETS_ADMIN.'images/og-drplace.jpg'); ?>">
    <meta property="og:image:alt" content="Dr.Place">

    <!-- <meta property="fb:app_id" content="183105849162101"> -->

    <title><?php echo $_titulo; ?></title>

    <link href="<?php echo $_favicon; ?>" rel="shortcut icon">

    <link href="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap-validator/css/bootstrapValidator.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_ADMIN.'css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_ADMIN.'css/temas/laranja-preto.css') ?>" id="theme" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_ADMIN.'css/login.css') ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="preloader">
      <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Doutor.Place</p>
      </div>
    </div>

    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?php echo base_url(ASSETS_ADMIN.'images/background/login.jpg') ?>);">
      <div class="login-box card">
        <div class="card-body">
          <a href="javascript:void(0)" class="text-center db logo">
            <img src="<?php echo $_logo_light ?>" height="90" alt="iEasy" />
          </a>
          <?php
            if( validation_errors() != '' )
              echo br(2).'<div class="alert alert-danger" role="alert">'.validation_errors('<p>', '</p>').'</div>';

            if( $_msg_status )
              echo br(2).monta_box_mensagem_status_admin( $_msg_status );

            $form_act = base_url( $_modulo . $_controller . '/logar' );
            $form_atr = array( 'method' => 'post', 'id' => 'loginform', 'name' => 'form',
                                'class' => 'form-horizontal form-material form-bv', 'role' => 'form' );

            $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'E-mail', 'class' => 'form-control afocus', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true', 'autocomplete' => 'off' );
            $form_inp_senha = array('name' => 'inp_senha', 'id' => 'inp_senha', 'placeholder' => 'Senha', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'autocomplete' => 'off' );

            $form_val_inp_email = set_value( 'inp_email', 'andre@andrewd.com.br' );
            $form_val_inp_senha = set_value( 'inp_senha', '123' );

            echo form_open( $form_act, $form_atr );
          ?>
              <div class="form-group m-t-20">
                <div class="col-xs-12">
                  <?php echo form_email($form_inp_email,$form_val_inp_email); ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <?php echo form_password($form_inp_senha,$form_val_inp_senha); ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right">
                    <i class="fa fa-lock m-r-5"></i> Esqueceu sua senha ?
                  </a>
                </div>
              </div>
              <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                  <button class="btn btn-warning btn-lg btn-block text-uppercase btn-rounded" type="submit">Logar</button>
                </div>
              </div>

              <!-- <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                  Não tem uma conta ? <a href="#" class="text-primary"><b>Cadastre-se</b></a>
                </div>
              </div> -->
          <?php
            echo form_close();

            $form_act = base_url( $_modulo . $_controller . '/enviar-solicitacao-senha' );
            $form_atr = array( 'method' => 'post', 'id' => 'recoverform', 'name' => 'form',
                                'class' => 'form-horizontal form-material form-bv', 'role' => 'form' );

            $form_inp_email_recuperacao = array('name' => 'inp_email_recuperacao', 'id' => 'inp_email_recuperacao', 'placeholder' => 'E-mail', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true', 'autocomplete' => 'off' );

            $form_val_inp_email_recuperacao = set_value( 'inp_email_recuperacao' );

            echo form_open( $form_act, $form_atr );
          ?>
            <div class="form-group ">
              <div class="col-xs-12">
                <h3>Redefinir Minha Senha</h3>
                <p class="text-muted">Digite o seu e-mail pra receber as instruções de como criar uma nova senha!</p>
              </div>
            </div>
            <div class="form-group ">
              <div class="col-xs-12">
                <?php echo form_email( $form_inp_email_recuperacao, $form_val_inp_email_recuperacao ); ?>
              </div>
            </div>
            <div class="form-group text-center m-t-20">
              <div class="col-xs-12">
                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Enviar Instruções</button>
              </div>
            </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </section>

    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap-validator/js/bootstrapValidator.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap-validator/js/language/pt_BR.js'); ?>"></script>

    <script type="text/javascript">
      $(function() {
        $('.afocus').focus();
        $(".preloader").fadeOut();
        $('[data-toggle="tooltip"]').tooltip();


        $('.form-bv').bootstrapValidator({
          live: 'disabled'
        });
      });

      $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
      });
    </script>

  </body>

</html>
