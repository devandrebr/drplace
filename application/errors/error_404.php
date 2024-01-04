<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dr.Place - Direto com Proprietário">

    <title>Erro 404 - Página não encontrada</title>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'fonts/font-awesome/css/fontawesome-all.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'fonts/flaticon/font/flaticon.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/magnific-popup.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/jquery.selectBox.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/dropzone.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/rangeslider.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/animate.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/leaflet.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/jquery.mCustomScrollbar.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/style.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/skins/dr-2018.css'); ?>" id="style_sheet">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/custom.css?v='.VERSAO_PORTAL); ?>">

    <link href="<?php echo base_url('favicon.ico'); ?>" rel="shortcut icon">
  </head>

  <body id="top">
    <div class="page_loader"></div>

    <div class="pages-404 content-area-7">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="pages-404-inner">
              <h1>404</h1>
              <div class="e404">
                <h5>Página Não Encontrada</h5>
                <a class="btn btn-border btn-sm" href="<?php echo base_url() ?>" role="button"><i class="fa fa-home"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url(ASSETS_PORTAL.'js/plugins/jquery-2.2.0.min.js'); ?>"></script>
    <script type="text/javascript">
      $(function () {
        "use strict";
        $(window).on('load', function () {
          setTimeout(function () {
            $(".page_loader").fadeOut("fast");
            $('link[id="style_sheet"]').attr('href', '<?php echo base_url(ASSETS_PORTAL.'css/skins/dr-2018.css'); ?>');
          }, 1000);
        });
      });
    </script>

  </body>

</html>
