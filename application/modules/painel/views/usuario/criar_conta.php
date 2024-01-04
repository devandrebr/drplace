<div class="register-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 cnt-bg-photo d-none d-xl-block d-lg-block d-md-block" style="background-image: url(<?php echo base_url(ASSETS_PORTAL.'img/img-31.jpg'); ?>)">
        <div class="register-info">
          <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/logo-drplace-dark.png'); ?>" alt="Dr.Place - Direto com o proprietário">
          </a>
          <p>Dr.Place - Solução de venda de imóveis direto com o proprietário, sem intermerdiários com muito mais agilidade e certeza de um excelente negócio.</p>
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12 align-self-center">
        <div class="content-form-box register-box">
          <div class="login-header"><h4>Crie Sua Conta</h4></div>
          <div class="text-center">
            <a class="btn btn-info btn-sm" href="<?php echo $fb_loginUrl ?>"><i class="fab fa-facebook"></i> Criar com Facebook</a>
          </div>
          <br>
          <div class="text-center">
            <p>ou</p>
          </div>
          <hr>
          <?php
            if( validation_errors() != '' )
              echo '<div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div>';

            if( $_msg_status )
              echo monta_box_mensagem_status( $_msg_status );

            $form_act = base_url(MODULO_PAINEL.'usuario/registro');
            $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form',
                                'class' => 'form-bv', 'autocomplete' => 'off', 'role' => 'form' );

            $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'placeholder' => 'Nome Completo', 'class' => 'form-control afocus', 'data-bv-notempty' => 'true' );
            $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'xxxxx@provedor.com.br', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );
            $form_inp_senha1 = array('name' => 'inp_senha1', 'id' => 'inp_senha1', 'placeholder' => 'Senha', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-identical-field' => 'inp_senha2', 'data-bv-identical-message' => 'As senhas não conferem.' );
            $form_inp_senha2 = array('name' => 'inp_senha2', 'id' => 'inp_senha2', 'placeholder' => 'Confirme Sua Senha', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-identical-field' => 'inp_senha1', 'data-bv-identical-message' => 'As senhas não conferem.' );

            $form_val_inp_nome = set_value( 'inp_nome' );
            $form_val_inp_email = set_value( 'inp_email' );
            $form_val_inp_senha1 = set_value( 'inp_senha1' );
            $form_val_inp_senha2 = set_value( 'inp_senha2' );
            $form_val_opt_cidade = set_value( 'opt_cidade' );
            $form_val_opt_estado = set_value( 'opt_estado', $_uf );
            $form_val_opt_perfil = set_value( 'opt_perfil' );

            $form_opt_cidade = array( '' => 'Escolha um Estado' );
            $form_opt_estado = array( '' => 'UF' );
            $form_opt_perfil = array( '' => 'Seu Perfil' );

            for($i=0; $i<$qtd_perf; $i++):
              $id = $res_perf[$i]['uperf_id'];
              $nome = $res_perf[$i]['uperf_nome'];
              $form_opt_perfil[$id] = $nome;
            endfor;

            for($i=0; $i<$qtd_uf; $i++):
              $valor = $combo_uf[$i]['valor'];
              $nome = $combo_uf[$i]['nome'];
              $form_opt_estado[$valor] = $nome;
            endfor;

            for($i=0; $i<$qtd_cid; $i++):
              $id = $res_cid[$i]['cid_id'];
              $nome = $res_cid[$i]['cid_nome'];
              $form_opt_cidade[$id] = $nome;
            endfor;

            echo form_open( $form_act, $form_atr );
          ?>
              <div class="form-group">
                <label>Seu Nome</label>
                <?php echo form_input($form_inp_nome, $form_val_inp_nome); ?>
              </div>
              <div class="form-group">
                <label>O que você deseja ?</label>
                <br>
                <!-- <?php echo form_dropdown('opt_perfil',$form_opt_perfil,$form_val_opt_perfil,'id="opt_perfil" class="form-control select-text-1" data-bv-notempty="true"'); ?> -->

                <input class="form-radio-1" type="radio" value="1" name="rd_perfil" id="rd_perfil_1">
                <label class="form-radio-label" for="rd_perfil_1">
                  Anunciar
                </label>

                <input class="form-radio-1" type="radio" value="2" name="rd_perfil" id="rd_perfil_2">
                <label class="form-radio-label" for="rd_perfil_2">
                  Comprar
                </label>
              </div>
              <div class="form-group">
                <label>E-mail Principal</label>
                <?php echo form_email($form_inp_email, $form_val_inp_email); ?>
              </div>
              <div class="form-group">
                <label>Senha</label>
                <?php echo form_password($form_inp_senha1, $form_val_inp_senha1); ?>
              </div>
              <div class="form-group">
                <label>Digite Novamente Sua Senha</label>
                <?php echo form_password($form_inp_senha2, $form_val_inp_senha2); ?>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-color btn-md btn-block">Criar Nova Conta</button>
              </div>
              <div class="login-footer text-center">
                <p>Já possui uma conta? <a href="<?php echo base_url(MODULO_PAINEL.'autenticacao') ?>">Entrar</a></p>
              </div>
          <?php
            echo form_close();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
