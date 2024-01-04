<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dr.Place - Negocie Direto com Proprietário">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $_titulo ?>">
    <meta property="og:description" content="<?php echo $_description ?>">
    <meta property="og:url" content="<?php echo base_url(); ?>">
    <meta property="og:image" content="<?php echo base_url(ASSETS_PORTAL.'img/og-drplace.jpg'); ?>">
    <meta property="og:image:alt" content="Dr.Place">

    <title><?php echo $_titulo ?></title>

    <link href="<?php echo base_url(ASSETS_QUEMSOMOS.'css/bootstrap.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url(ASSETS_QUEMSOMOS.'css/animations.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_QUEMSOMOS.'css/ionicons.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_QUEMSOMOS.'css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_QUEMSOMOS.'css/responsive.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_QUEMSOMOS.'css/carouseldesign.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSETS_QUEMSOMOS.'css/carousel.min.css'); ?>" rel="stylesheet">

    <link type="image/x-icon" rel="shortcut icon" href="<?php echo base_url("favicon.ico"); ?>">

    <link rel="canonical" href="<?php echo base_url(MODULO_PORTAL); ?>" />

    <link href="<?php echo base_url(ASSETS_QUEMSOMOS.'css/custom.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url(ASSETS_QUEMSOMOS.'js/ie10-viewport-bug-workaround.js'); ?>"></script>

    <meta name="theme-color" content="#FF7700"/>
  </head>

  <body>
    <div class="row" id="top">
      <div class="logo brand">
        <a href="<?php echo base_url(MODULO_PORTAL); ?>">
          <img src="<?php echo base_url(ASSETS_QUEMSOMOS.'img/logo.png'); ?>" class="center-block img-responsive" alt="Dr.Place">
        </a>
      </div>
      <div class="headbutt">
        <a href="<?php echo base_url('criar-conta'); ?>" class="headbutton btn btn-default">
          Criar Sua Conta
          <span class="ion-chevron-right"></span>
        </a>
      </div>
    </div>

    <div class="row supportrow"></div>
    <div class="col-md-12 hero">
      <h2 class="herohead">
        O método mais rápido e econômico pra quem procura,
        <br /> vende ou aluga imóveis. Experimente!
      </h2>
    </div>
    <!-- Hero end -->

    <div class="row">
      <div class="container-fluid col-md-6 head2" id="head2">
        <h3 class="another-head">Porque existimos ? Afinal quem somos</h3>
        <p>
          Nascemos para resolver um problema real no setor imobiliário.
          Ao longo de alguns meses, escutamos com atenção as queixas das pessoas que usavam o modelo tradicional de vendas e
          locação de imóveis. As barreiras eram fáceis de serem percebidas.
        </p>
        <p>
          Por exemplo: A lentidão dos processos internos, altas taxas de corretagem, exigência de fiador,
          valores cauções elevados e seguro de locação, além de comprovação de renda e demais fatores.
        </p>
        <p>
          Todos esses detalhes dificultam muito a vida dos proprietários de imóveis que acabam
          ficando com os imóveis parados por meses e até anos.
          E também de potenciais inquilinos que acabam se frustrando por não conseguirem o novo imóvel desejado.
        </p>
        <hr>
        <a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" title="Anunciar Meu Imóvel na Dr.Place" class="headbutton btn btn-default">
          Anuncie Seu Imóvel
        </a>
      </div>
      <div class="container-fluid col-md-6 mobilevec mobilevecone head2" id="head3">
        <img class="right-mobile img-responsive" src="<?php echo base_url(ASSETS_QUEMSOMOS.'img/print-celular.png'); ?>" alt="">
      </div>
    </div>
    <!-- Section 1 end -->

    <hr class="divider" />

    <div class="row">
      <div class="container-fluid col-md-6 mobilevec mobilevectwo head2">
        <img class="right-mobile2" src="<?php echo base_url(ASSETS_QUEMSOMOS.'img/print-portal-1.png'); ?>" alt="">
      </div>
      <div class="container-fluid col-md-6 head2" id="head4">
        <h3 class="another-head">A solução: Dr.Place</h3>
        <p>Em seguida, quebramos a cabeça para conseguir solucionar essas questões.</p>
        <p>Os fundadores então desenvolveram uma solução sustentável e com melhor custo/benefício para todos os envolvidos:
          A Dr.Place - uma plataforma online onde os potenciais inquilinos negociam diretamente com os proprietários.
          E também aumenta significativamente a visibilidade dos imóveis e a facilidade de vender/alugar os mesmos,
          além de eliminar a taxa de 6% cobrada no processo.
        </p>
        <p>
          Dessa forma os proprietários se tornarão mais autônomos e empoderados e os potenciais inquilinos com maior
          poder de negociação, deixando as coisas mais justas e recompensadoras para ambos.
        </p>
        <p>É fácil de perceber as vantagens da Dr.Place não é mesmo ?</p>
        <hr>
        <a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" title="Anunciar Seu Imóvel na Dr.Place" class="headbutton btn btn-default">
          Anuncie Seu Imóvel
        </a>
      </div>
    </div>
    <!-- Section 2 end -->

    <hr class="divider" />

    <div class="row">
      <div class="container-fluid col-md-6 head2" id="head5">
        <h3 class="another-head">
          Nossa Missão e Visão
        </h3>
        <p>
          <b>Visão:</b><br>
          Se tornar uma plataforma que atende milhares de pessoas e melhore significativamente a forma de como o setor imobiliário funciona.
        </p>
        <p>
          <b>Missão:</b><br>
          Gerar mais conexões e empoderar nossos clientes por meio da plataforma e transformar o mercado imobiliário em um ambiente mais aberto.
        </p>
      </div>
      <div class="container-fluid col-md-6 mobilevec mobilevecthree head2" id="head6">
        <img class="right-mobile3" src="<?php echo base_url(ASSETS_QUEMSOMOS.'img/print-portal-2.png'); ?>" alt="">
      </div>
    </div>
    <!-- Section 3 end -->

    <div class="row col-md-12 CTA">
      <h3 class="cta">Anuncie Seu Imóvel na Dr.Place</h3>
      <p class="cta">Aumente a visibilidade do seus potenciais compradores/inquilinos com a Dr.Place, anuncie seu imóvel na internet hoje mesmo.</p>
      <hr>
      <a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" class="ctabutton btn btn-default">ANUNCIE AGORA MESMO</a>
    </div>
    <!-- Section 5 end -->

    <div class="row col-md-12 footer text-center">
      <div class="container-fluid">
        <h3 class="social">Compartilhe Nas Redes Sociais</h3>
        <h4 class="social">Compartilhe com seus amigos a Dr.Place</h4>
        <div class="col-md-12">
          <div class="container footerbox">
            <a href="https://www.facebook.com/share.php?u=<?php echo base_url() ?>">
              <div class="container-fluid">
                <i class="ion-social-facebook"></i>
                <p class="paravatar auth1">
                  <strong>Facebook</strong>
                  <br />
                  Compartilhe no Facebook
                </p>
              </div>
            </a>
          </div>
          <div class="container footerbox">
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url() ?>&title=<?php echo $_titulo ?>&source=">
              <div class="container-fluid">
                <i class="ion-social-linkedin"></i>
                <p class="paravatar auth1">
                  <strong>LinkedIn</strong>
                  <br />
                  Compartilhe no LinkedIn
                </p>
              </div>
            </a>
          </div>
          <div class="container footerbox">
            <a href="https://api.whatsapp.com/send?text=<?php echo 'Estou compartilhando o site '.base_url().' com vc!'; ?>">
              <div class="container-fluid">
                <i class="ion-social-whatsapp"></i>
                <p class="paravatar auth1">
                  <strong>WhatsApp</strong>
                  <br />
                  Compartilhe no WhatsApp
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Section 6 end -->

    <div class="col-md-12 postfooter">
      &copy; <?php echo date('Y'); ?> - Desenvolvido com <i class="ion-heart"></i> para vocês
    </div>
    <!-- End post footer -->

    <script src="<?php echo base_url(ASSETS_QUEMSOMOS.'js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_QUEMSOMOS.'js/animations.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_QUEMSOMOS.'js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_QUEMSOMOS.'js/carousel.min.js'); ?>"></script>

  </body>
</html>
