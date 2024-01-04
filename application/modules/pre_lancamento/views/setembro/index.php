    <div class="coming-soon">
      <div class="container-fluid coming-soon-bg">
        <div class="row">
          <div class="col-lg-12">
            <div class="coming-soon-inner">
              <h1><span>Dr.Place</span> Está Vindo Em Breve</h1>
              <h2>Você está tentando vender ou alugar seu imóvel há bastante tempo? Já conseguiu alguns contatos mas, ainda não fechou nenhum negócio? Isso é muito frustrante né? Nós te entendemos, já passamos por isso também.</h2>
              <br>
              <div class="countdown styled coming-soon-counter"></div>
              <div class="clearfix"></div>

              <ul class="social-list clearfix">
                <li><a href="#" class="facebook"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#" class="instagram"><i class="fab fa-instagram"></i></a></li>
              </ul>

              <?php
                if( validation_errors() != '' )
                  echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div></div></div>';

                if( $_msg_status )
                  echo monta_box_mensagem_status( $_msg_status );
              ?>

              <div class="box-web">
                <!-- <p class="lead" style="text-align:left;">Você está tentando vender ou alugar seu imóvel há bastante tempo? Já conseguiu alguns contatos mas, ainda não fechou nenhum negócio? Isso é muito frustrante né? Nós te entendemos, já passamos por isso também.</p> -->
                <p class="lead" style="text-align:left;">Estamos desenvolvendo essa plataforma inovadora justamente pra te ajudar resolver esse problema que enche o saco e atrasa a vida.</p>
                <p class="lead" style="text-align:left;">Os 100 primeiros que mandarem e-mails terão o benefício de usar os serviços de nossa plataforma 100% grátis.</p>
                <p class="lead" style="text-align:left;">Não perca tempo porque já estamos quase atingindo nosso limite.</p>
                <!-- <div class="coming-soon-inner"> -->
                <!-- <div class="clearfix"> -->
                <div class="row">
                  <div class="col-md-12">

                    <?php
                      $form_act = base_url(MODULO_CAMPANHA_1.'setembro/cadastro-antecipado');
                      $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form', 'style' => 'margin:0px auto; text-align:center;',
                                          'class' => 'form-horizontal form-bv', 'autocomplete' => 'off', 'role' => 'form' );

                      $form_label = array('class' => 'control-label');

                      $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'class' => 'form-control afocus', 'placeholder' => 'Seu Nome', 'maxlength' => '100', 'data-bv-notempty' => 'true' );
                      $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'seu.email@provedor.com.br', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );

                      $form_val_inp_nome = set_value( 'inp_nome' );
                      $form_val_inp_email = set_value( 'inp_email' );

                      echo form_open( $form_act, $form_atr );
                    ?>
                      <label class="control-label">Deixe seu melhor e-mail e tenha todas as vantagens de fazer parte da nossa primeira base de clientes.</label><br>
                      <div class="row">
                        <div class="col-md-5 col-sm-4 col-xs-12">
                          <div class="form-group text-center">
                            <?php echo form_input($form_inp_nome, $form_val_inp_nome); ?>
                          </div>
                        </div>
                        <div class="col-md-5 col-sm-4 col-xs-12">
                          <div class="form-group text-center">
                            <?php echo form_email($form_inp_email, $form_val_inp_email); ?>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                          <div class="form-group text-center">
                            <button type="submit" class="btn btn-color">Inscrever</button>
                          </div>
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
        <div class="coming-soon-text box-mob">
          <div class="row">
            <div class="col-lg-12">
              <!-- <p class="texto-mob">Você está tentando vender ou alugar seu imóvel há bastante tempo? Já conseguiu alguns contatos mas, ainda não fechou nenhum negócio? Isso é muito frustrante né? Nós te entendemos, já passamos por isso também.</p> -->
              <p class="texto-mob">Estamos desenvolvendo essa plataforma inovadora justamente pra te ajudar resolver esse problema que enche o saco e atrasa a vida.</p>
              <p class="texto-mob">Os 100 primeiros que mandarem e-mails terão o benefício de usar os serviços de nossa plataforma 100% grátis.</p>
              <p class="texto-mob">Não perca tempo porque já estamos quase atingindo nosso limite.</p>
              <div class="coming-soon-inner">
                <div class="coming-form clearfix">
                  <?php
                    $form_act = base_url(MODULO_CAMPANHA_1.'setembro/cadastro-antecipado');
                    $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form',
                                        'class' => 'form-horizontal form-bv', 'autocomplete' => 'off', 'role' => 'form' );

                    $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome_mob', 'class' => 'form-control afocus', 'placeholder' => 'Seu Nome', 'maxlength' => '100', 'data-bv-notempty' => 'true' );
                    $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email_mob', 'class' => 'form-control mt-2 mb-2', 'placeholder' => 'seu.email@provedor.com.br', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );

                    $form_val_inp_nome = set_value( 'inp_nome' );
                    $form_val_inp_email = set_value( 'inp_email' );

                    echo form_open( $form_act, $form_atr );
                  ?>
                    <label class="control-label" for="inp_email">Deixe seu melhor e-mail e tenha todas as vantagens de fazer parte da nossa primeira base de clientes.</label><br>
                    <?php
                      echo form_input($form_inp_nome,$form_val_inp_nome);
                      echo br(1);
                      echo form_email($form_inp_email,$form_val_inp_email);
                    ?>
                    <button type="submit" class="btn btn-color">Inscrever</button>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
