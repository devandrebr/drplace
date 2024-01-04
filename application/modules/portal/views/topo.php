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

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CMontserrat:400,400i,700,700i%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/bootstrapValidator.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/select2.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/magnific-popup.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'fine-uploader/fine-uploader-new.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/rangeslider.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/animate.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/leaflet.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/jquery.mCustomScrollbar.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'fonts/font-awesome/css/fontawesome-all.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'fonts/flaticon/font/flaticon.css'); ?>">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/style.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/skins/dr-2018.css'); ?>" id="css_tema">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/'.$_css_topo.'?v='.VERSAO_PORTAL); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/painel.css?v='.VERSAO_PORTAL); ?>">

    <link type="image/x-icon" rel="shortcut icon" href="<?php echo base_url("favicon.ico"); ?>">

    <script type="text/javascript">
      _base_url = "<?php echo base_url(MODULO_PORTAL); ?>";
      _assets_portal = "<?php echo base_url(ASSETS_PORTAL); ?>";
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body id="top">
    <div class="page_loader"></div>
