<div class="row page-titles">
  <div class="col-lg-12 align-self-center">
    <h3 class="text-themecolor"><?php echo $_titulo_page; ?></h3>
    <?php echo $_breadcrumb; ?>
  </div>
</div>

<?php
  if( validation_errors() != '' )
    echo '<div class="alert alert-danger" role="alert">'.validation_errors('<p>', '</p>').'</div>';
?>

<div class="row box-perfil">

  <div class="col-lg-4 col-xlg-3 col-md-5">
    <div class="card">
      <div class="card-body">
        <center class="m-t-30">
          <img src="<?php echo $_cli_logo ?>" alt="ieasy" height="120" />

          <h4 class="card-title m-t-10"><?php echo $_usu_nome ?></h4>
          <h6 class="card-subtitle">Comprador ou Anunciante</h6>
          <div class="row text-center justify-content-md-center">
            <div class="col-4">
              <a href="javascript:void(0)" class="link">
                <i class="mdi mdi-access-point"></i> <font class="font-medium">483 visitas</font>
              </a>
            </div>
            <div class="col-4">
              <a href="javascript:void(0)" class="link">
                <i class="mdi mdi-account-multiple"></i> <font class="font-medium">89 clientes</font>
              </a>
            </div>
          </div>
        </center>
      </div>
      <div>
        <hr>
      </div>
      <div class="card-body">
        <small class="text-muted">Email</small>
        <h6><?php echo $_usu_email ?></h6>
        <small class="text-muted">Localidade</small>
        <h6><?php echo $_usu_logradouro ?></h6>
      </div>
    </div>
  </div>


  <div class="col-lg-8 col-xlg-9 col-md-7">
    <div class="card">
      <ul class="nav nav-tabs profile-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#tab-atividade" role="tab">Atividades da Sua Conta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tab-editar-perfil" role="tab">Atualizar Perfil/Senha</a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="tab-atividade" role="tabpanel">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h3 class="text-info">Timeline de Atividade</h3>
              </div>
            </div>
            <div class="profiletimeline">
              <div class="sl-item">
                <div class="sl-left">
                  <img src="<?php echo base_url( ASSETS_ADMIN . 'images/users/1.jpg') ?>" alt="user" class="img-circle" />
                </div>
                <div class="sl-right">
                    <div>
                      <a href="javascript:void(0);" class="link"><?php echo $_usu_nome ?></a> <span class="sl-date">45 minutos atrás</span>
                      <p>Adicionou um novo imóvel.</p>
                    </div>
                </div>
              </div>
              <hr>
              <div class="sl-item">
                <div class="sl-left">
                  <img src="<?php echo base_url( ASSETS_ADMIN . 'images/users/3.jpg') ?>" alt="user" class="img-circle" />
                </div>
                <div class="sl-right">
                    <div>
                      <a href="javascript:void(0);" class="link"><?php echo $_usu_nome ?></a> <span class="sl-date">15/10/2018 às 14:38</span>
                      <p>Publicou um novo interesse.</p>
                    </div>
                </div>
              </div>
              <hr>
              <div class="sl-item">
                <div class="sl-left">
                  <img src="<?php echo base_url( ASSETS_ADMIN . 'images/users/2.jpg') ?>" alt="user" class="img-circle" />
                </div>
                <div class="sl-right">
                  <div>
                    <a href="javascript:void(0);" class="link"><?php echo $_usu_nome ?></a> <span class="sl-date">13/10/2018 às 20:32</span>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="tab-pane" id="tab-editar-perfil" role="tabpanel">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h3 class="text-info">Editar Meu Perfil</h3>
              </div>
            </div>
              <?php
                $form_act = base_url( $_modulo . $_controller . '/atualizar-meu-perfil' );
                $form_atr = array( 'method' => 'post', 'id' => 'form-perfil', 'name' => 'form',
                                    'class' => 'form-material form-bv', 'role' => 'form' );

                $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'class' => 'form-control form-control-line', 'data-bv-notempty' => 'true', 'autocomplete' => 'off' );
                $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'class' => 'form-control form-control-line', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true', 'autocomplete' => 'off' );
                $form_inp_senha1 = array( 'name' => 'inp_senha1', 'id' => 'inp_senha1', 'class' => 'form-control form-control-line', 'data-bv-identical-field' => 'inp_senha2', 'data-bv-identical-message' => 'As senhas não conferem.', 'autocomplete' => 'off' );
                $form_inp_senha2 = array( 'name' => 'inp_senha2', 'id' => 'inp_senha2', 'class' => 'form-control form-control-line', 'data-bv-identical-field' => 'inp_senha1', 'data-bv-identical-message' => 'As senhas não conferem.', 'autocomplete' => 'off' );

                $form_val_inp_nome = set_value( 'inp_nome', $_usu_nome );
                $form_val_inp_email = set_value( 'inp_email', $_usu_email );
                $form_val_inp_senha1 = set_value( 'inp_senha1' );
                $form_val_inp_senha2 = set_value( 'inp_senha2' );

                echo form_open( $form_act, $form_atr );
              ?>
                <div class="form-group">
                  <label class="col-md-12"><i class="fa fa-user m-r-5"></i> Nome Completo</label>
                  <div class="col-md-12">
                    <?php echo form_input($form_inp_nome, $form_val_inp_nome); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-12"><i class="fa fa-envelope-open m-r-5"></i> E-mail</label>
                  <div class="col-md-12">
                    <?php echo form_input($form_inp_email, $form_val_inp_email); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-12"><i class="fa fa-key m-r-5"></i> Nova Senha</label>
                  <div class="col-md-12">
                    <?php echo form_password($form_inp_senha1, $form_val_inp_senha1); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-12"><i class="fa fa-key m-r-5"></i> Confirme Sua Nova Senha</label>
                  <div class="col-md-12">
                    <?php echo form_password($form_inp_senha2, $form_val_inp_senha2); ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 m-t-20 text-right">
                    <button type="submit" name="bt-submit" class="btn btn-primary"><i class="far fa-save m-r-5"></i> Atualizar</button>
                  </div>
                </div>
              <?php
                echo form_close();
              ?>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
