<div id="box-sobre-o-portal">
  <div class="container">
    <div class="sobre-home content-area">
      <?php
        if( validation_errors() != '' )
          echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div></div></div>';

        if( $_msg_status )
          echo monta_box_mensagem_status( $_msg_status );
      ?>
      <h2 class="text-center">O método mais rápido e econômico pra quem procura, vende ou aluga imóveis. Experimente!</h2>
      <br>
      <ul class="nav nav-pills">
  			<li>
          <a data-toggle="tab" href="#box-quem-anuncia" id="lk-anuncia" class="active">Quero anunciar meu imóvel</a>
  			</li>
  			<li>
          <a data-toggle="tab" href="#box-quem-procura" id="lk-procura">Procuro por um imóvel</a>
  			</li>
  		</ul>
			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="box-quem-anuncia">
          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="box-ico ico-anuncia-1">
                <div class="ico-img"><img src="<?php echo base_url(ASSETS_PORTAL.'img/ico-proprietario-direto.png'); ?>" alt="Maior autonomia e sem burocracia"></div>
                <div class="ico-desc">
                  <!-- <h5>Maior autonomia e sem burocracia</h5> -->
                  <!-- <h5>+ autonomia e - burocracia</h5> -->
                  <h5>Mais autonomia e menos burocracia</h5>
                  <p>Não dependa de ninguém! Aqui você pode negociar com os interessados, dentro dos seus próprios termos e critérios.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="box-ico ico-anuncia-2">
                <div class="ico-img"><img src="<?php echo base_url(ASSETS_PORTAL.'img/ico-pesquisa.png'); ?>" alt="Mais visibilidade e velocidade"></div>
                <div class="ico-desc">
                  <h5>Maior visibilidade e velocidade</h5>
                  <!-- <p>Milhares de pessoas estão procurando imóveis, usando, as plataformas onlines como primeira opção de pesquisa.</p> -->
                  <p>Milhares de pessoas estão procurando imóveis, usando, as plataformas online como primeira opção de pesquisa. Pois a pesquisa dessa forma economiza tempo e dinheiro.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="box-ico ico-anuncia-3">
                <div class="ico-img"><img src="<?php echo base_url(ASSETS_PORTAL.'img/ico-economia.png'); ?>" alt="Economia que faz a diferença"></div>
                <div class="ico-desc">
                  <h5>Economia que faz diferença</h5>
                  <p>Economize 6% do valor total do seu imóvel referentes às taxas de corretagem. Por exemplo: Se você tem um imóvel de 300 mil reais, sua economia será de 18 mil reais.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 text-center">
              <hr><br>
              <a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" class="btn btn-lg btn-color">Quero Anunciar Meu Imóvel</a>
            </div>
          </div>
				</div>
				<div class="tab-pane" id="box-quem-procura">
          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="box-ico ico-procura-1">
                <div class="ico-img"><img src="<?php echo base_url(ASSETS_PORTAL.'img/ico-autonomia.png'); ?>" alt="Negociação diretamento com o proprietário"></div>
                <div class="ico-desc">
                  <h5>Negociação aberta</h5>
                  <p>Negociando diretamente com o proprietário, você pode fazer propostas e tornar viável pra você e seu bolso, a conquista de seu novo lar.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="box-ico ico-procura-2">
                <div class="ico-img"><img src="<?php echo base_url(ASSETS_PORTAL.'img/ico-doutor-place.png'); ?>" alt="Imóvel ideal"></div>
                <div class="ico-desc">
                  <h5>Imóvel ideal</h5>
                  <p>Usando a plataforma e seus filtros de busca específicos, você encontrará o imóvel ideal com grande facilidade e menor esforço.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="box-ico ico-procura-3">
                <div class="ico-img"><img src="<?php echo base_url(ASSETS_PORTAL.'img/ico-ia.png'); ?>" alt="Inteligência Artificial"></div>
                <div class="ico-desc">
                  <h5>Inteligência Artificial (I.A)</h5>
                  <p>Algoritmos desenvolvidos para alinhar os interesses dos potenciais inquilinos aos anúncios dos proprietários de forma rápida.</p>
                  <!-- <p>Nossos algoritmos vão cruzar as informações e te apresentar os imóveis certos para você de acordo com sua descrição.</p> -->
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 text-center">
              <hr><br>
              <a href="<?php echo base_url(MODULO_PORTAL.'imovel/novo-interesse') ?>" class="btn btn-lg btn-color">Publique seu interesse</a>
            </div>
          </div>
				</div>
			</div>
    </div>
  </div>
</div>

<div class="simple-content overview-bgi" style="background-image: url(<?php echo base_url(ASSETS_PORTAL.'img/simple-content.jpg'); ?>)" id="box-calculadora">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-6 align-self-center">
        <h1>Economize de verdade com a Dr.Place! <span id="valor-economia">R$ 18.000,00</span></h1>
        <p>Anunciando na Dr.Place este valor é seu e não mais de um corretor de imóveis ou imobiliária. <br>Utilize o campo abaixo com o valor da venda!</p>
        <p class="text-center" id="p-money">R$ <input type="text" name="inp_calc_venda" id="inp_calc_venda" class="inp_calculo" placeholder="300.000,00" /></p>
        <!-- <a href="<?php echo base_url('imoveis-para-comprar'); ?>" class="btn btn-sm btn-border">Imóveis para Venda</a>
        <a href="<?php echo base_url('imoveis-para-alugar'); ?>" class="btn btn-sm btn-color">Imóveis para Locação</a> -->
        <br>
        <p class="text-center"><a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" class="btn btn-md btn-color">Anunciar Meu Imóvel</a></p>
      </div>
      <div class="col-lg-4 offset-lg-1 col-md-6">
        <img src="<?php echo base_url(ASSETS_PORTAL.'img/avatar/avatar-14.png'); ?>" alt="Dr Place" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<div class="recent-properties content-area">
  <div class="container">
    <div class="main-title">
      <h1>Propriedades Mais Recentes</h1>
    </div>
    <?php
      if( $qtd2 > 0 )
      {
        echo '<div class="row">';
        for($i=0; $i<$qtd2; $i++):
          $id = $res2[$i]['imo_id'];
          $usu_id = $res2[$i]['usu_id'];
          $titulo = $res2[$i]['imo_titulo'];
          $data_cad = get_string_data(converte_data($res2[$i]['imo_dataCadastro']));
          $tipo = mb_strtoupper($res2[$i]['imtip_titulo']);
          $img = $res2[$i]['imo_img'];
          $slug = url_slug($titulo);

          $link_det = base_url(MODULO_PORTAL.'imovel/detalhe-anuncio/'.$id.'/'.$slug);

          $path_img = PATH_UPLOAD.$usu_id.'/'.$img;
          $link_img = (!is_dir($path_img) && is_file($path_img)) ? base_url(ASSETS_UPLOADS.$usu_id.'/'.$img) : base_url(ASSETS_UPLOADS.'imovel_sem_foto.jpg');
    ?>
      <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft delay-04s">
        <div class="card property-box-2">
          <div class="property-thumbnail">
            <a href="<?php echo $link_det ?>" class="property-img">
              <img src="<?php echo $link_img; ?>" alt="<?php echo $titulo ?>" class="img-fluid">
            </a>
          </div>
          <div class="detail">
            <h5 class="title"><a href="<?php echo $link_det ?>"><?php echo $titulo ?></a></h5>
            <h4><?php echo $tipo ?></h4>
          </div>
        </div>
      </div>
    <?php
        endfor;
        echo '</div>'; #row
      }
      else
      {
        $status_mais_recente = array();
        $status_mais_recente['status'] = 'default'; #aviso
        $status_mais_recente['msg'] = 'Nenhum imóvel localizado até o momento.';
        echo monta_box_mensagem_status( $status_mais_recente );
      }
    ?>
  </div>
</div>
<!-- </div> -->

<div class="intro-section box-anuncie-home">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-2 col-sm-12 text-center wow fadeInLeft delay-04s">
        <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/logo-drplace.png'); ?>" alt="Dr.Place - Direto com o proprietário" class="img-responsive">
      </div>
      <div class="col-lg-7 col-md-7 col-sm-12 wow fadeInLeft delay-04s">
        <div class="intro-text">
          <h3>Está querendo alugar ou vender seu imóvel ?</h3>
        </div>
      </div>
      <div class="col-lg-2 col-md-3 col-sm-12 wow fadeInLeft delay-04s">
        <a href="<?php echo base_url('anuncie-seu-imovel') ?>" class="btn btn-md">
          <i class="fa fa-plus-circle"></i>
          Anuncie
        </a>
      </div>
    </div>
  </div>
</div>

<!-- <div class="pricing-tables content-area-2">
  <div class="container">
    <div class="main-title">
      <h1>Planos</h1>
    </div>
    <div class="row">
      <div class="col-lg-4 wow fadeInLeft delay-04s">
        <div class="pricing">
          <div class="price-header">
            <h1 class="title">Plano Básico</h1>
            <div class="price">R$ 239,00</div>
          </div>
          <div class="content">
            <ul>
              <li>30 dias de exibição</li>
              <li>Menos que 1 café por dia</li>
              <li>Sem Anúncios em Mídias Sociais</li>
              <li>Sem Anúncios em Mídias Sociais</li>
            </ul>
            <div class="button"><a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" class="btn btn-border btn-sm">Anuncie Agora</a></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 wow fadeInDown delay-04s">
        <div class="pricing featured">
          <div class="listing-badges">
            <span class="featured">Recomendado</span>
          </div>
          <div class="price-header">
            <h1 class="title">Plano Padrão</h1>
            <div class="price">R$ 389,00</div>
          </div>
          <div class="content">
            <ul>
              <li>60 dias de exibição</li>
              <li>Menos que 1 café por dia</li>
              <li>Anúncio no Facebook*</li>
              <li>Anúncio no Instagram*</li>
            </ul>
            <div class="button"><a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" class="btn btn-border btn-sm">Começe Agora</a></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 wow fadeInRight delay-04s">
        <div class="pricing">
          <div class="price-header">
            <h1 class="title">Plano Premium</h1>
            <div class="price">R$ 569,00</div>
          </div>
          <div class="content">
            <ul>
              <li>90 dias de exibição</li>
              <li>Menos que 1 café por dia</li>
              <li>Anúncio no Facebook*</li>
              <li>Anúncio no Instagram*</li>
            </ul>
            <div class="button"><a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" class="btn btn-border btn-sm">Começe Agora</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<?php if( $qtd3 > 0 ) { ?>
  <div class="testimonial overview-bgi wow fadeInUp delay-04s" style="background-color: #F3F3F3 !important;">
    <!-- <div class="testimonial wow fadeInUp" style="background: #F3F3F3 !important;"> -->
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 wow fadeInLeft delay-04s">
          <div class="testimonial-inner">
            <header class="testimonia-header">
              <h1>Interessados</h1>
            </header>
            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                  $html = '';
                  for($i=0; $i<$qtd3; $i++):
                    $active =($i==0) ? ' class="active"' : '';
                    $html .= '<li data-target="#carouselExampleIndicators2" data-slide-to="'.$i.'"'.$active.'></li>';
                  endfor;
                  echo $html;
                ?>
              </ol>
              <div class="carousel-inner">
                <?php
                    for($i=0; $i<$qtd3; $i++):
                      $active =($i==0) ? ' active"' : '';

                      $id = $res3[$i]['imint_id'];
                      $usu_id = $res3[$i]['usu_id'];
                      $nome = mb_strtoupper($res3[$i]['imint_nome']);
                      $msg = mb_strtoupper($res3[$i]['imint_msg']);
                      $data_cad = get_string_data(converte_data($res3[$i]['imint_dataCadastro']));
                      $img = $res3[$i]['usu_foto'];

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
