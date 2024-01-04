<!-- Header
    ============================================= -->
    <header id="header" class="" data-scroll-index="0">

      <div id="header-wrap">

        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <a class="logo logo-header" href="javascript:void(0);">
                <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/logo-drplace.png'); ?>" data-logo-alt="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/logo-drplace-alt.png'); ?>" alt="Logo Dr.Place">
                <h3><span class="colored">Dr</span></h3>
                <span>Place</span>
              </a><!-- .logo end -->
              <div class="header-menu-and-meta">
                <div class="header-meta">
                  <div class="info-call"><i class="fa fa-envelope"></i>Dúvidas: contato@drplace.com.br</div>
                </div><!-- .header-meta end -->
                <!-- <div class="clearfix"></div> -->
              </div><!-- .header-menu-and-meta end -->

            </div><!-- .col-md-12 end -->
          </div><!-- .row end -->
        </div><!-- .container end -->

      </div><!-- #header-wrap end -->

    </header><!-- #header end -->

    <!-- Banner
    ============================================= -->
    <section id="banner" class="fullscreen" data-scroll-index="0">

      <div class="banner-parallax">
        <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/parallax-bg/img-5.jpg'); ?>" alt="">
        <div class="overlay-colored" data-bg-color="#000" data-bg-color-opacity="0.65"></div><!-- .overlay-colored end -->
        <div class="slide-content">

          <div class="container">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <div class="banner-center-box text-white text-center">
                  <!-- <div class="box-contador"></div> -->
                  <div class="description">
                    <div class="box-contador"></div>
                    <!-- <p class="first-p">Você está tentando vender ou alugar seu imóvel há bastante tempo?</p>
                    <p>Já conseguiu alguns contatos mas, ainda não fechou nenhum negócio?</p>
                    <p>Isso é muito frustrante né? Nós te entendemos, já passamos por isso também.</p> -->
                  </div>
                  <!-- <a class="scroll-to btn xx-large colorful hover-dark mt-30" href="#inscreva-se">Inscreva-se</a> -->
                </div><!-- .banner-center-box end -->
              </div><!-- .col-md-10 end -->
            </div><!-- .row end -->
          </div><!-- .container end -->

        </div><!-- .slide-content end -->
      </div><!-- .banner-parallax end -->

    </section><!-- #banner end -->

    <!-- Content
    ============================================= -->
    <section id="content">

      <div id="content-wrap">

        <!-- === Our Services =========== -->
        <div id="our-services" class="flat-section center-vertical" data-scroll-index="1">
          <div class="section-content">
            <div class="container">
              <div class="row">

                <div class="col-md-6">

                  <div class="box-center">
                    <div class="section-title pb-20 pb-md-0">
                      <h2>Promoção de Pré-Lançamento! Cadastre-se GRÁTIS, até conseguir vender o seu IMÓVEL.</h2>
                    </div>
                    <div class="box-info mb-60">
                      <!-- <div class="box-icon icon x3 colorful-icon mr-20">
                        <i class="fa fa-safari"></i>
                      </div> -->
                      <div class="box-content">
                        <!-- <h4>Explore New Areas</h4> -->
                        <p>Estamos desenvolvendo essa plataforma inovadora justamente pra te ajudar resolver esse problema que enche o saco e atrasa a vida.</p>
                      </div>
                    </div>
                    <div class="box-info mb-60">
                      <!-- <div class="box-icon icon x3 colorful-icon mr-20">
                        <i class="fa fa-eercast"></i>
                      </div> -->
                      <div class="box-content">
                        <!-- <h4>Explore New Areas</h4> -->
                        <p>Os 100 primeiros que mandarem e-mails terão o benefício de usar os serviços de nossa plataforma 100% grátis.</p>
                      </div>
                    </div>
                    <div class="box-info mb-md-80">
                      <!-- <div class="box-icon icon x3 colorful-icon mr-20">
                        <i class="fa fa-calendar"></i>
                      </div> -->
                      <div class="box-content">
                        <!-- <h4>Get a Fresh Perspective</h4> -->
                        <p>Não perca tempo porque já estamos quase atingindo nosso limite.</p>
                      </div>
                    </div>
                  </div>

                </div><!-- .col-md-6 end -->
                <div class="col-md-5 col-md-offset-1">

                  <div class="box-center">
                    <div id="inscreva-se" class="register-house box-form text-center">
                      <div class="box-title">
                        <i class="rh-arrow fa fa-angle-down"></i>
                        <h4>Inscreva-se</h4>
                      </div>
                      <div class="box-content">
                        <p>Deixe seu melhor e-mail e tenha todas as vantagens de fazer parte da nossa primeira base de clientes.</p>
                        <hr>
                        <?php
                          if( validation_errors() != '' )
                            echo '<div class="col-md-12"><div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div></div>';

                          if( $_msg_status )
                            echo monta_box_mensagem_status_camp1( $_msg_status );

                          $form_act = base_url(MODULO_CAMPANHA_1.'outubro/cadastro-antecipado');
                          $form_atr = array('method' => 'post', 'id' => 'form-imovel-cad', 'name' => 'form',
                                              'class' => 'form form-bv', 'autocomplete' => 'off', 'role' => 'form' );

                          $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'class' => 'form-control', 'placeholder' => 'Nome', 'maxlength' => '120', 'data-bv-notempty' => 'true' );
                          $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'E-mail', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );

                          $form_val_inp_nome = set_value( 'inp_nome' );
                          $form_val_inp_email = set_value( 'inp_email' );

                          echo form_open( $form_act, $form_atr );
                        ?>
                        <!-- <form id="form-register-house"> -->
                          <div class="rh-notifications">
                            <div class="rh-notifications-content"></div>
                          </div>
                          <div class="form-group">
                            <?php
                              echo form_label('Seu Nome','inp_nome');
                              echo form_input($form_inp_nome, $form_val_inp_nome);
                            ?>
                          </div>
                          <div class="form-group">
                            <?php
                              echo form_label('E-mail','inp_email');
                              echo form_email($form_inp_email, $form_val_inp_email);
                            ?>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="form-control" id="btn" value="Inscrever-me">
                          </div>
                        <?php echo form_close(); ?><!-- #form-register-house end -->
                      </div>
                    </div>
                  </div>

                </div><!-- .col-md-5 end -->

              </div><!-- .row end -->
            </div><!-- .container end -->
          </div><!-- .section-content end -->
        </div><!-- .flat-section end -->

            <!-- Footer Mini
            ============================================= -->
            <footer id="footer-mini">

              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="copyrights-message text-white"><?php echo date('Y') ?> © <strong>Dr.Place</strong>. Todos os direitos reservados.</div>
                  </div>
                </div>
              </div>

            </footer><!-- #footer-mini end -->

          </div><!-- .parallax-section end -->

      </div><!-- #content-wrap -->

    </section><!-- #content end -->

  </div><!-- #full-container end -->

  <a class="scroll-top-icon scroll-top" href="#"><i class="fa fa-angle-up"></i></a>
