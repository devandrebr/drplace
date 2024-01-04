<div class="banner banner-interesse">
  <div class="container text-center">
    <h1>Cadastrar Seu Interesse</h1>
    <div class="form-interesse">
      <?php
        if( validation_errors() != '' )
          echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div></div></div>';

        if( $_msg_status )
          echo monta_box_mensagem_status( $_msg_status );

        $form_act = base_url(MODULO_PORTAL.'imovel/cadastrar-interesse');
        $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form',
                            'class' => 'form form-bv', 'autocomplete' => 'off', 'role' => 'form' );

        $form_label = array('class' => 'control-label');

        $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'class' => 'form-control afocus', 'placeholder' => 'Nome', 'maxlength' => '120', 'data-bv-notempty' => 'true' );
        $form_inp_cidade = array('name' => 'inp_cidade', 'id' => 'inp_cidade', 'class' => 'form-control', 'placeholder' => 'Cidade, UF', 'maxlength' => '80', 'data-bv-notempty' => 'true' );
        $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'E-mail', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );
        $form_tex_msg = array('name' => 'tex_msg', 'id' => 'tex_msg', 'class' => 'form-control', 'rows' => 3, 'placeholder' => 'Diga-nos o que você procura. Ex: Procuro casa na zona norte de SP, com dois quartos e garagem para um carro...', 'data-bv-notempty' => 'true' );

        $form_val_inp_nome = set_value( 'inp_nome' );
        $form_val_inp_cidade = set_value( 'inp_cidade', 'São Paulo, SP' );
        $form_val_inp_email = set_value( 'inp_email' );
        $form_val_tex_msg = set_value( 'tex_msg' );

        echo form_open($form_act,$form_atr);
      ?>
        <div class="row">
          <div class="col-md-7 col-sm-12">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group name">
                <?php echo form_input($form_inp_nome,$form_val_inp_nome) ?>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group email">
                <?php echo form_email($form_inp_email,$form_val_inp_email) ?>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group message">
                <?php echo form_textarea($form_tex_msg,$form_val_tex_msg) ?>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-sm-12">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group city">
              <?php echo form_input($form_inp_cidade,$form_val_inp_cidade) ?>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group select">
              <select id="opt_situacao" class="form-control" name="opt_situacao">
                <option value="V">Quero Comprar</option>
                <option value="A">Quero Alugar</option>
              </select>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="box-recaptcha text-left">
                <script src='https://www.google.com/recaptcha/api.js'></script>
                <div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_SITE_RECAPTCHA ?>"></div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="send-btn text-left">
                <br>
                <button type="submit" class="btn btn-theme btn-lg">Publicar Interesse</button>
              </div>
            </div>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<?php
  if( $_msg_status )
    echo '<div class="row"><div class="col-md-12">'.monta_box_mensagem_status( $_msg_status ).'</div></div>';
?>

<?php if( $qtd > 0 ) { ?>
  <div class="testimonial overview-bgi wow fadeInUp delay-04s" style="background-color: #F3F3F3 !important;">
    <!-- <div class="testimonial wow fadeInUp" style="background: #F3F3F3 !important;"> -->
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 wow fadeInLeft delay-04s">
          <div class="testimonial-inner">
            <header class="testimonia-header">
              <h1>Interesses Publicados</h1>
            </header>
            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                  $html = '';
                  for($i=0; $i<$qtd; $i++):
                    $active =($i==0) ? ' class="active"' : '';
                    $html .= '<li data-target="#carouselExampleIndicators2" data-slide-to="'.$i.'"'.$active.'></li>';
                  endfor;
                  echo $html;
                ?>
              </ol>
              <div class="carousel-inner">
                <?php
                    for($i=0; $i<$qtd; $i++):
                      $active =($i==0) ? ' active"' : '';

                      $id = $res[$i]['imint_id'];
                      $usu_id = $res[$i]['usu_id'];
                      $nome = mb_strtoupper($res[$i]['imint_nome']);
                      $msg = mb_strtoupper($res[$i]['imint_msg']);
                      $data_cad = get_string_data(converte_data($res[$i]['imint_dataCadastro']));
                      $img = $res[$i]['usu_foto'];

                      $path_img = PATH_AVATAR.$usu_id.'/'.$img;
                      $link_img = (!is_dir($path_img) && is_file($path_img)) ? base_url(ASSETS_AVATAR.$usu_id.'/'.$img) : base_url(ASSETS_AVATAR.'avatar-default.jpg');
                ?>
                  <div class="carousel-item<?php echo $active ?>">
                    <div class="avatar"><img src="<?php echo $link_img ?>" alt="avatar" class="img-fluid rounded-circle" style="max-height:70px;"></div>
                    <p class="lead"><?php echo $msg ?> por <?php echo $nome ?></p>
                    <div class="author-name"><?php echo $data_cad ?></div>
                  </div>
                <?php endfor; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  }
  // }
  // else
  // {
  //   $status_interessados = array();
  //   $status_interessados['status'] = 'default'; #aviso
  //   $status_interessados['msg'] = 'Nenhum interesse localizado até o momento.';
  //   echo monta_box_mensagem_status( $status_interessados );
  // }
?>
