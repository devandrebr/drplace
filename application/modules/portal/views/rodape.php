    <footer class="footer">
      <div class="container footer-inner">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="footer-item">
              <h4>Canais de Atendimento</h4>
              <ul class="contact-info">
                <li><i class="fa fa-envelope pr-4"></i> <a href="mailto:<?php echo CONTATO_EMAIL ?>" title="E-mail"><?php echo CONTATO_EMAIL ?></a></li>
                <li><i class="fa fa-phone pr-4"></i> <a href="tel:55<?php echo somente_numero(CONTATO_TELEFONE) ?>" title="Telefone"><?php echo CONTATO_TELEFONE ?></a></li>
                <li><i class="fa fa-globe pr-4"></i> <a href="<?php echo base_url(MODULO_PORTAL.'contato'); ?>" title="Site">Formulário Para Contato</a></li>
              </ul>
              <ul class="social-list clearfix">
                <li><a href="<?php echo LINK_RS_FACEBOOK ?>" class="facebook"><i class="fab fa-facebook"></i></a></li>
                <li><a href="<?php echo LINK_RS_INSTAGRAM ?>" class="instagram"><i class="fab fa-instagram"></i></a></li>
                <li><a href="<?php echo LINK_RS_LINKEDIN ?>" class="linkedin"><i class="fab fa-linkedin"></i></a></li>
              </ul>
              <!-- <h4 class="subtitulo">Institucional</h4>
              <ul class="links">
                <li><a href="<?php echo base_url('quem-somos'); ?>"><i class="fa fa-angle-right"></i>Quem Somos</a></li>
                <li><a href="<?php echo base_url('vantagens'); ?>"><i class="fa fa-angle-right"></i>Vantagens</a></li>
              </ul> -->
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
            <div class="footer-item">
              <h4>Acesso Rápido</h4>
              <ul class="links">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-angle-right"></i>Página Inicial</a></li>
                <li><a href="<?php echo base_url('quem-somos'); ?>"><i class="fa fa-angle-right"></i>Quem Somos</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Comprar</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Alugar</a></li>
                <li><a href="<?php echo base_url('servico'); ?>"><i class="fa fa-angle-right"></i>Serviços</a></li>
                <li><a href="<?php echo base_url('ajuda'); ?>"><i class="fa fa-angle-right"></i>Ajuda</a></li>
                <!-- <li><a href="#"><i class="fa fa-angle-right"></i>Artigos</a></li> -->
                <li><a href="<?php echo base_url('contato'); ?>"><i class="fa fa-angle-right"></i>Fale Conosco</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="recent-posts footer-item">
              <h4>Últimos Imóveis Cadastrados</h4>
              <?php
                if( $qtd_ult_imo > 0 ) {
                  $html = '';
                  for($i=0; $i<$qtd_ult_imo; $i++):
                    $id = $res_ult_imo[$i]['imo_id'];
                    $usu_id = $res_ult_imo[$i]['usu_id'];
                    $titulo = $res_ult_imo[$i]['imo_titulo'];
                    $data_cad = get_string_data(converte_data($res_ult_imo[$i]['imo_dataCadastro']));
                    $tipo = mb_strtoupper($res_ult_imo[$i]['imtip_titulo']);
                    $img = $res_ult_imo[$i]['imo_img'];
                    $slug = url_slug($titulo);

                    $link_det = base_url(MODULO_PORTAL.'imovel/detalhe-anuncio/'.$id.'/'.$slug);

                    $path_img = PATH_UPLOAD.$usu_id.'/'.$img;
                    $link_img = (!is_dir($path_img) && is_file($path_img)) ? base_url(ASSETS_UPLOADS.$usu_id.'/'.$img) : base_url(ASSETS_UPLOADS.'imovel_sem_foto.jpg');

                    $html .= '<div class="media mb-4">';
                      if($link_img != '') {
                        $html .= '<a class="pr-4" href="'.$link_det.'">';
                          $html .= '<img src="'.$link_img.'" alt="'.$titulo.'">';
                        $html .= '</a>';
                      }
                      $html .= '<div class="media-body align-self-center">';
                        $html .= '<h5><a href="'.$link_det.'">'.$titulo.'</a></h5>';
                        $html .= '<p>'.$tipo.'</p>';
                        $html .= '<p>'.$data_cad.'</p>';
                      $html .= '</div>';
                    $html .= '</div>';
                  endfor;

                  echo $html;
                } else {
                  echo '<p>Nenhum imóvel até o momento.</p>';
                }
              ?>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="lista-artigos footer-item">
              <h4>Artigos Recentes</h4>
              <?php
                if( $qtd_ult_art > 0 ) {
                  $html = '';
                  for($i=0; $i<$qtd_ult_art; $i++):
                    $id = $res_ult_art[$i]['art_id'];
                    $usu_id = $res_ult_art[$i]['usu_id'];
                    $usu_nome = $res_ult_art[$i]['usu_nome'];
                    $titulo = mb_ucfirst($res_ult_art[$i]['art_titulo']);
                    $data_cad = get_string_data(converte_data($res_ult_art[$i]['art_dataCadastro']));
                    $slug = $res_ult_art[$i]['art_slug'];

                    $nomes = explode(' ',$usu_nome);
                    $primeiro_nome = trim($nomes[0]);

                    $link_det = base_url('artigo/'.$slug);
                    $link_det = 'javascript:void(0);';

                    $html .= '<div class="media mb-4">';
                      $html .= '<div class="media-body align-self-center">';
                        $html .= '<h5><a href="'.$link_det.'">'.$titulo.'</a></h5>';
                        $html .= '<p>'.$data_cad.'</p>';
                        $html .= '<p>por <b>'.$primeiro_nome.'</b></p>';
                      $html .= '</div>';
                    $html .= '</div>';
                  endfor;

                  echo $html;
                } else {
                  echo '<p>Nenhum artigo até o momento.</p>';
                }
              ?>
            </div>
          </div>
          <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <div class="footer-item clearfix">
              <h4>Newsletter</h4>
              <div class="Subscribe-box">
                <p>Fique por dentro das novidades aqui na Dr.Place em primeira mão. Inscreva-se em nossa newsletter abaixo:</p>
                <?php
                  $form_act = base_url(MODULO_PORTAL.'home/sub-newsletter');
                  $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form', 'class' => 'form form-bv', 'autocomplete' => 'off', 'role' => 'form' );

                  $form_inp_news_email = array('name' => 'inp_news_email', 'id' => 'inp_news_email', 'class' => 'form-contact', 'placeholder' => 'Seu e-mail@provedor.com', 'maxlength' => '80', 'data-bv-notempty' => 'true' );
                  $form_val_inp_news_email = set_value( 'inp_news_email' );

                  echo form_open( $form_act, $form_atr );
                ?>
                  <p>
                    <?php echo form_email($form_inp_news_email,$form_val_inp_news_email); ?>
                  </p>
                  <p>
                    <button type="submit" name="submitNewsletter" class="btn btn-block btn-color">
                      Inscreva-se
                    </button>
                  </p>
                <?php echo form_close() ?>
              </div>
            </div>
          </div> -->
        </div>
        <div class="row info-politica">
          <div class="col-xs-12">
            <p>
              O parceiro que anuncia nesta página é o único responsável pelas transações comerciais que realizar com usuários do web site da Dr.Place.
              A comercialização e/ou locação do imóvel anunciado, bem como a garantia de sua legítima procedência, é de inteira responsabilidade do anunciante,
              não sendo a Dr.Place responsável por quaisquer danos diretos e/ou indiretos causados a terceiros,
              advindos da exibição dos anúncios em desacordo com o Código de Defesa do Consumidor e outras legislações aplicáveis
              ao comércio e/ou prestação de serviços por parte do anunciante. Para oferecer uma melhor experiência de navegação,
              a Dr.Place utiliza cookies. Ao navegar pelo site você concorda com o uso dos mesmos.
              <a href="<?php echo base_url('politica-de-privacidade') ?>">Entenda mais em nosso termo de uso e política, continue lendo.</a>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12">
            <p class="copy">&copy; <?php echo date('Y'); ?> - Todos os direitos reservados.</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Full Page Search -->
    <div id="full-page-search">
      <button type="button" class="close"><i class="fa fa-times"></i></button>
      <form autocomplete="off" method="get" name="form_pesq_rodape" id="form_pesq_rodape" action="#">
        <div class="input-group">
          <div class="form-select-procura sel-situacao">
            <select id="sel_pesq_tipo" name="sel_pesq_tipo">
              <option value="V">Comprar</option>
              <option value="A">Alugar</option>
            </select>
          </div>
          <div class="form-select-procura sel-tipo">
            <select id="sel_pesq_procura" name="sel_pesq_procura">
              <option value="">Mostrar Todos</option>
              <?php
                if( $p_qtd_tipo > 0 )
                {
                  $html = '';
                  $opt_grupo = array();
                  for($i=0;$i<$p_qtd_tipo;$i++):
                    $im_id = $p_res_tipo[$i]['imtip_id'];
                    $im_titulo = $p_res_tipo[$i]['imtip_titulo'];
                    $im_tipo = $p_res_tipo[$i]['imtip_tipo'];
                    if( !in_array($im_tipo, $opt_grupo) ) {
                      if( $i>0 )
                        $html .= '</optgroup>';
                      $html .= '<optgroup label="'.combo_categoriaImovel($im_tipo).'">';

                      $opt_grupo[] = $im_tipo;
                    }
                    $html .= '<option value="'.$im_id.'">'.$im_titulo.'</option>';
                  endfor;
                  $html .= '</optgroup>';

                  echo $html;
                }
              ?>
           </select>
         </div>
         <input type="text" class="form-control" name="inp_pesq_string" id="inp_pesq_string" placeholder="Digite a cidade ou estado" />
         <span class="input-group-btn">
           <button class="btn btn-color" type="button">Buscar</button>
         </span>
       </div>
    </form>
    </div>

    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/jquery-2.2.0.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/select2.full.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/langs2/pt-BR.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/bootstrapValidator.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/langbv/pt_BR.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/rangeslider.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/jquery.filterizr.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/wow.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/backstretch.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/jquery.scrollUp.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/ie-emulation-modes-warning.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/jquery.mask.min.js'); ?>"></script>
    <!-- <script src="<?php echo base_url(ASSETS_PORTAL.'fine-uploader/fine-uploader.min.js'); ?>"></script> -->

    <script src="<?php echo base_url(ASSETS_PORTAL.'js/app.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/painel.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_PORTAL.'js/portal.js'); ?>"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118840525-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-118840525-1');
    </script>

    <?php if($_enable_map_imovel && (($map_lat != '') && ($map_lng != '')) ) { ?>
      <script src="https://maps.google.com/maps/api/js?key=<?php echo API_KEY_GOOGLE_MAPS ?>"></script>
      <script type="text/javascript">
        function LoadMap(propertes) {
          var defaultLat = <?php echo $map_lat ?>;
          var defaultLng = <?php echo $map_lng ?>;
          var mapOptions = {
              center: new google.maps.LatLng(defaultLat, defaultLng),
              zoom: 15,
              scrollwheel: false,
              styles: [
                  {
                      featureType: "administrative",
                      elementType: "labels",
                      stylers: [
                          {visibility: "off"}
                      ]
                  },
                  {
                      featureType: "water",
                      elementType: "labels",
                      stylers: [
                          {visibility: "off"}
                      ]
                  },
                  {
                      featureType: 'poi.business',
                      stylers: [{visibility: 'off'}]
                  },
                  {
                      featureType: 'transit',
                      elementType: 'labels.icon',
                      stylers: [{visibility: 'off'}]
                  },
              ]
          };
          var map = new google.maps.Map(document.getElementById("map-localizacao-imovel"), mapOptions);
          var infoWindow = new google.maps.InfoWindow();
          var myLatlng = new google.maps.LatLng(<?php echo $map_lat ?>, <?php echo $map_lng ?>);

          var marker = new google.maps.Marker({
              position: myLatlng,
              map: map
          });
          (function (marker) {
              google.maps.event.addListener(marker, "click", function (e) {
                  infoWindow.setContent("" +
                      "<div class='map-properties contact-map-content'>" +
                        "<div class='map-content'>" +
                          "<p class='address'><?php echo $map_address ?></p>" +
                          "<ul class='map-properties-list'> " +
                            "<li><i class='fas fa-user'></i> <?php echo $map_user ?></li> " +
                            "<li><i class='fa fa-globe'></i> www.drplace.com.br</li>" +
                          "</ul>" +
                        "</div>" +
                      "</div>");
                  infoWindow.open(map, marker);
              });
          })(marker);
        }

        if($('#map-localizacao-imovel').length){
          LoadMap();
        }
      </script>
    <?php } ?>
  </body>
</html>
