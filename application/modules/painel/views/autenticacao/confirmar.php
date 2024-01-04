<div class="register-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 cnt-bg-photo d-none d-xl-block d-lg-block d-md-block" style="background-image: url(<?php echo base_url(ASSETS_PORTAL.'img/img-28.jpg'); ?>)">
        <?php
          if( validation_errors() != '' )
            echo '<div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div>';

          if( $_msg_status )
            echo monta_box_mensagem_status( $_msg_status );
        ?>
        <div class="col-md-12">
          <div class="register-info">
            <a href="<?php echo base_url(); ?>">
              <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/logo-drplace-dark.png'); ?>" alt="Dr.Place - Direto com o proprietário">
            </a>
            <p>Dr.Place - Solução de venda de imóveis direto com o proprietário, sem intermerdiários com muito mais agilidade e certeza de um excelente negócio.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12 align-self-center">
        <div class="content-form-box register-box">

          <div class="login-header"><h4><?php echo $_usu_nome ?>, conta confirmada!</h4></div>
          <hr>
          <p class="text-center">
            <a href="<?php echo base_url(MODULO_PAINEL.'autenticacao/logar/'.$_usu_token) ?>">Acesse Agora</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
