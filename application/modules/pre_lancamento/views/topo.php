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
    <meta property="og:image" content="<?php echo $_og_image; ?>">
    <meta property="og:image:alt" content="Dr.Place">

    <title><?php echo $_titulo ?></title>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i%7CLato:400,400i,700,700i">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_PORTAL.'css/plugins/bootstrapValidator.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_CAMPANHA_2.'css/style.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_CAMPANHA_2.'css/skins/preview/skin-orange.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_CAMPANHA_2.'css/custom.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(ASSETS_CAMPANHA_2.'css/captacao.css?v='.VERSAO_PORTAL); ?>">

    <link type="image/x-icon" rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" href="<?php echo base_url(ASSETS_CAMPANHA_2.'images/general-elements/favicon/apple-touch-icon.png'); ?>">
  	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(ASSETS_CAMPANHA_2.'images/general-elements/favicon/apple-touch-icon-72x72.png'); ?>">
  	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(ASSETS_CAMPANHA_2.'images/general-elements/favicon/apple-touch-icon-114x114.png'); ?>">

    <script type="text/javascript">
      _base_url = "<?php echo base_url() ?>";
      _modulo = "<?php echo MODULO_CAMPANHA_2; ?>";
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

	<div id="scroll-progress"><div class="scroll-progress"><span class="scroll-percent"></span></div></div>

  	<!-- Loading Progress
  	============================================= -->
    <div id="loading-progress">
  		<a class="logo" href="#">
  			<img src="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/logo-drplace.png'); ?>" data-logo-alt="<?php echo base_url(ASSETS_CAMPANHA_2.'images/files/logo-drplace-alt.png'); ?>" alt="Logo Dr.Place">
  			<h3><span class="colored">Dr.</span></h3>
  			<span>Place</span>
  		</a>
    	<div class="lp-content">
        <div class="lp-counter">
        	Carregando
        	<div id="lp-counter">0%</div>
        </div><!-- .lp-counter end -->
        <div class="lp-bar">
	        <div id="lp-bar"></div>
        </div><!-- .lp-bar end -->
    	</div><!-- .lp-content end -->
    </div><!-- #loading-progress end -->

  	<!-- Document Full Container
  	============================================= -->
  	<div id="full-container">
