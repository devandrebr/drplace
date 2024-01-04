<!-- Header
    ============================================= -->
    <header id="header" class="" data-scroll-index="0">

      <div id="header-wrap">

        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <a class="logo logo-header" href="#">
                <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/logo-drplace.png'); ?>" data-logo-alt="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/logo-drplace-alt.png'); ?>" alt="Logo Dr.Place">
                <h3><span class="colored">Dr</span></h3>
                <span>Place</span>
              </a><!-- .logo end -->
              <div class="header-menu-and-meta">
                <div class="header-meta">
                  <div class="info-call"><i class="fa fa-envelope"></i>Suporte: contato@drplace.com.br</div>
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
    <!-- <section id="banner" class="fullscreen" data-scroll-index="0">

      <div class="banner-parallax">
        <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/parallax-bg/img-5.jpg'); ?>" alt="">
        <div class="overlay-colored" data-bg-color="#000" data-bg-color-opacity="0.65"></div>
        <div class="slide-content">

          <div class="container">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">

                <div class="banner-center-box text-white text-center">
                  <h1>Anúncie Seu Imóvel</h1>
                  <div class="description">
                    Anúncie seu imóvel e faça você mesmo o contato com seu
                    <br>
                    possível comprador ou inquilino. Anúncie agora mesmo!
                  </div>
                  <a class="scroll-to btn xx-large colorful hover-dark mt-30" href="#criar-conta">Crie sua conta</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </section> -->
    <!-- #banner end -->

    <section id="banner" class="fullscreen" data-scroll-index="0">

			<div class="banner-parallax">
				<img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/parallax-bg/img-5.jpg'); ?>" alt="">
				<div class="overlay-colored" data-bg-color="#000" data-bg-color-opacity="0.5"></div><!-- .overlay-colored end -->
				<div class="video-background" data-property="{videoURL:'s4vehakfYGs'}"></div><!-- end .video-background end -->
				<div class="slide-content">

					<div class="container">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">

								<div class="banner-center-box text-white text-center">
                  <h1>Anúncie Seu Imóvel</h1>
                  <div class="description">
                    Anúncie seu imóvel e faça você mesmo o contato com seu
                    <br>
                    possível comprador ou inquilino. Anúncie agora mesmo!
                  </div>
									<a class="scroll-to btn xx-large colorful hover-dark mt-30" href="#criar-conta">Crie sua conta</a>
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
        <div id="criar-conta" class="flat-section center-vertical" data-scroll-index="1">
          <div class="section-content">
            <div class="container">
              <div class="row">

                <div class="col-md-6">

                  <div class="box-center">
                    <div class="section-title pb-20 pb-md-0">
                      <h2>Conheça melhor a pessoa interessada e negocie direto o seu imóvel</h2>
                    </div>
                    <div class="box-info mb-60">
                      <div class="box-icon icon x3 colorful-icon mr-20">
                        <i class="fa fa-safari"></i>
                      </div>
                      <div class="box-content">
                        <h4>Explore New Areas</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. text ever since the 1500s.</p>
                      </div>
                    </div>
                    <div class="box-info mb-md-80">
                      <div class="box-icon icon x3 colorful-icon mr-20">
                        <i class="fa fa-eercast"></i>
                      </div>
                      <div class="box-content">
                        <h4>Get a Fresh Perspective</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. text ever since the 1500s.</p>
                      </div>
                    </div>
                  </div>

                </div><!-- .col-md-6 end -->
                <div class="col-md-5 col-md-offset-1">

                  <div class="box-center">
                    <div class="register-house box-form text-center">
                      <div class="box-title">
                        <i class="rh-arrow fa fa-angle-down"></i>
                        <h4>Cadastre-se e Crie sua Conta</h4>
                      </div>
                      <div class="box-content">
                        <?php
                          if( validation_errors() != '' )
                            echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div></div></div>';

                          if( $_msg_status )
                            echo monta_box_mensagem_status( $_msg_status );

                          $form_act = base_url(MODULO_CAMPANHA_2.'meu-imovel/cadastro');
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
                            <input type="submit" class="form-control" id="btn" value="Criar Conta">
                          </div>
                          <hr>
                          <p id="termos-de-uso">Ao criar a conta você concorda com os <a href="<?php echo base_url('politica-de-privacidade') ?>" target="_blank">termos de uso</a>.</p>
                        <?php echo form_close(); ?><!-- #form-register-house end -->
                      </div>
                    </div>
                  </div>

                </div><!-- .col-md-5 end -->

              </div><!-- .row end -->
            </div><!-- .container end -->
          </div><!-- .section-content end -->
        </div><!-- .flat-section end -->


        <!-- === Featured Houses =========== -->
        <div id="featured-houses" class="flat-section" data-scroll-index="2">
          <div class="section-content">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">

                  <div class="section-title text-center">
                    <h2>Últimos Anúncios</h2>
                    <p>
                      Confira abaixo os últimos anúncios cadastrados na Dr.Place.
                      <br>cadastre o seu imóvel também, não fique de fora desta nova forma de vender imóveis.
                    </p>
                  </div><!-- .section-title end -->

                </div><!-- .col-md-8 end -->
                <div class="col-md-12">
                  <?php
                    if( $qtd <= 0 ) {
                      echo '<p>Nenhum imóvel cadastrado até o momento, tente novamente.</p>';
                    } else {
                  ?>
                     <div class="slider-project-house">
                      <ul class="owl-carousel">
                        <?php
                          for($i=0;$i<$qtd;$i++):
                            $id = $res[$i]['imo_id'];
                            $usu_id = $res[$i]['usu_id'];
                            $titulo = $res[$i]['imo_titulo'];
                            $data_cad = get_string_data(converte_data($res[$i]['imo_dataCadastro']));
                            $valor = converte_moeda($res[$i]['imo_valor'],'BRL');
                            $tipo = mb_strtoupper($res[$i]['imtip_titulo']);
                            $img = $res[$i]['imo_img'];
                            $slug = url_slug($titulo);

                            $link_det = base_url(MODULO_PORTAL.'imovel/detalhe-anuncio/'.$id.'/'.$slug);

                            $path_img = PATH_UPLOAD.$usu_id.'/'.$img;
                            $link_img = (!is_dir($path_img) && is_file($path_img)) ? base_url(ASSETS_UPLOADS.$usu_id.'/'.$img) : base_url(ASSETS_UPLOADS.'imovel_sem_foto.jpg');
                        ?>
                          <li>
                            <div class="slide">
                              <div class="box-preview box-project-house">
                                <div class="box-img img-bg">
                                  <a href="<?php echo $link_det ?>">
                                    <img src="<?php echo $link_img; ?>" alt="">
                                  </a>
                                </div>
                                <div class="box-content">
                                  <h4><a href="<?php echo $link_det ?>"><?php echo $tipo ?></a></h4>
                                  <span class="price">R$ <?php echo $valor ?></span>
                                </div>
                              </div>
                            </div>
                          </li>
                      <?php endfor; ?>
                      </ul>
                   </div>
                 <?php } ?>
                </div>
              </div>
            </div>
          </div>

        </div><!-- .flat-section end -->

        <!-- === Users Interessados =========== -->
        <div id="clients-testimonials" class="flat-section" data-scroll-index="2">

          <div class="section-content">

            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">

                  <div class="section-title text-center">
                    <h2>Interessados e procurando por imóveis</h2>

                    <p>
                      Lorem Ipsum is simply dummy text of the printing and typesetting
                      <br>
                      industry. text ever since the 1500s
                    </p>
                  </div><!-- .section-title end -->

                </div><!-- .col-md-8 end -->
                <div class="col-md-12">

                  <div class="slider-testimonials">
                    <ul class="owl-carousel">
                      <li>
                        <div class="slide">
                          <div class="testimonial-single-1">
                            <div class="ts-content">
                              <span class="quote-sign">“</span>
                              “Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been standard dummy text ever since the 1500s.”
                            </div><!-- .ts-content end -->
                            <div class="ts-person">
                              <div class="ts-img">
                                <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/sliders/clients-testimonials/img-1.jpg'); ?>"alt="">
                              </div><!-- .ts-img end -->
                              <h5>Mark Smith</h5>
                              <span>Procurando</span>
                            </div><!-- .ts-person end -->
                          </div><!-- .testimonial-single-1 -->
                        </div><!-- .slide end -->
                      </li>
                      <li>
                        <div class="slide">
                          <div class="testimonial-single-1">
                            <div class="ts-content">
                              <span class="quote-sign">“</span>
                              “Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been standard dummy text ever since the 1500s.”
                            </div><!-- .ts-content end -->
                            <div class="ts-person">
                              <div class="ts-img">
                                <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/sliders/clients-testimonials/img-2.jpg'); ?>"alt="">
                              </div><!-- .ts-img end -->
                              <h5>Jolya Smith</h5>
                              <span>Procurando</span>
                            </div><!-- .ts-person end -->
                          </div><!-- .testimonial-single-1 -->
                        </div><!-- .slide end -->
                      </li>
                      <li>
                        <div class="slide">
                          <div class="testimonial-single-1">
                            <div class="ts-content">
                              <span class="quote-sign">“</span>
                              “Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been standard dummy text ever since the 1500s.”
                            </div><!-- .ts-content end -->
                            <div class="ts-person">
                              <div class="ts-img">
                                <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/sliders/clients-testimonials/img-1.jpg'); ?>"alt="">
                              </div><!-- .ts-img end -->
                              <h5>Mark Smith</h5>
                              <span>Envato Inc</span>
                            </div><!-- .ts-person end -->
                          </div><!-- .testimonial-single-1 -->
                        </div><!-- .slide end -->
                      </li>
                      <li>
                        <div class="slide">
                          <div class="testimonial-single-1">
                            <div class="ts-content">
                              <span class="quote-sign">“</span>
                              “Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been standard dummy text ever since the 1500s.”
                            </div><!-- .ts-content end -->
                            <div class="ts-person">
                              <div class="ts-img">
                                <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/sliders/clients-testimonials/img-2.jpg'); ?>"alt="">
                              </div><!-- .ts-img end -->
                              <h5>Jolya Smith</h5>
                              <span>PayPal Inc</span>
                            </div><!-- .ts-person end -->
                          </div><!-- .testimonial-single-1 -->
                        </div><!-- .slide end -->
                      </li>
                    </ul>
                  </div><!-- .slider-testimonials end -->

                </div><!-- .col-md-12 end -->
              </div><!-- .row end -->
            </div><!-- .container end -->

          </div><!-- .section-content end -->

        </div><!-- .flat-section end -->

          <!-- === CTA Title 1 =========== -->
          <div id="cta-title-1" class="parallax-section text-white" data-parallax-bg-img="img-3.jpg" data-stellar-background-ratio="0.2">

            <div class="overlay-colored" data-bg-color="#000" data-bg-color-opacity="0.7"></div><!-- .overlay-colored end -->
            <div class="section-content">

              <div class="container">
                <div class="row">
                  <div class="col-md-12 text-center">

                    <img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/cta-1-logo.png'); ?>"alt="">
                    <h1>Cadastre-se na Dr.Place e Procure ou Venda seu imóvel!</h1>
                    <p>
                      Estamos desenvolvendo essa plataforma inovadora justamente pra te ajudar resolver esse problema que enche o saco e atrasa a vida.
                      Não perca tempo porque já estamos quase atingindo nosso limite
                    </p>
                    <a class="scroll-to btn xx-large colorful hover-dark mt-20" href="#criar-conta">Anuncie Seu Imóvel</a>

                  </div><!-- .col-md-12 end -->
                </div><!-- .row end -->
              </div><!-- .container end -->

            </div><!-- .section-content end -->

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
