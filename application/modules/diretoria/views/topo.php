<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="André Severino - https://andrewd.com.br">

    <title><?php echo $_titulo ?></title>

    <link href="<?php echo $_favicon; ?>" rel="shortcut icon">

    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/bootstrap/css/bootstrap.min.css' ); ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/bootstrap-select/bootstrap-select.min.css' ); ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/font-awesome/css/fontawesome-all.min.css' ); ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/icheck/skins/square/blue.css' ); ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/bootstrap-validator/css/bootstrapValidator.css' ) ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/Magnific-Popup-master/dist/magnific-popup.css' ) ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/datatables/jquery.dataTables.min.css' ) ?>" rel="stylesheet">
    <!-- <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/datatables-responsive/css/responsive.bootstrap.scss' ) ?>" rel="stylesheet"> -->
    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/sweetalert/sweetalert.css' ) ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'node_modules/summernote/dist/summernote.css' ) ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'css/style.css' ); ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'css/temas/laranja-preto.css' ); ?>" id="theme" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'css/tab.css' ); ?>" rel="stylesheet">
    <link href="<?php echo base_url( ASSETS_ADMIN . 'css/ribbon.css' ); ?>" rel="stylesheet">

    <link href="<?php echo base_url( ASSETS_ADMIN . 'css/custom.css' ); ?>" rel="stylesheet">

    <script type="text/javascript">
      _base_url = "<?php echo base_url() ?>";
      _base_url_assets = "<?php echo base_url(ASSETS_ADMIN) ?>";
      _url_ajax_app = "<?php echo base_url(MODULO_ADMIN.'ajax/') ?>";
      _session_url_lockedScreen = "<?php echo base_url(MODULO_ADMIN.'autenticacao/sessao-travada') ?>";
      _session_url_logout = "<?php echo base_url(MODULO_ADMIN.'autenticacao/logout') ?>";
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="fix-sidebar fix-header card-no-border <?php echo $_css_gmaps ?>">

    <div class="preloader">
      <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Doutor.Place</p>
      </div>
    </div>

    <div id="main-wrapper">

      <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
          <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(MODULO_ADMIN.'home/dashboard'); ?>">
              <b class="">
                <img src="<?php echo $_logo_icone_dark ?>" alt="iEasy" class="dark-logo" width="39" />
                <img src="<?php echo $_logo_icone_light ?>" alt="iEasy" class="light-logo" width="39" />
              </b>
              <span>
                <img src="<?php echo $_logo_dark ?>" alt="iEasy" class="dark-logo" height="68" />
                <img src="<?php echo $_logo_light ?>" alt="iEasy" class="light-logo" height="68" />
              </span>
            </a>
          </div>

          <div class="navbar-collapse">

            <ul class="navbar-nav mr-auto">

              <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
              <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>

              <li class="nav-item">
                <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:history.back(-1);" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                  <i class="fa fa-arrow-circle-left"></i>
                </a>
              </li>

              <li class="nav-item hidden-xs-down search-box">
                <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Pesquisar">
                  <i class="icon-Magnifi-Glass2"></i>
                </a>
                <form class="app-search">
                  <input type="text" class="form-control" placeholder="Digite e pressione enter para pesquisar..." />
                  <a class="srh-btn"><i class="ti-close"></i></a>
                </form>
              </li>
            </ul>

            <ul class="navbar-nav my-lg-0">
              <li class="nav-item dropdown u-pro">
                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-account"></i>
                  <span class="hidden-md-down">
                    <?php echo $_usu_nome_topo ?> &nbsp;<i class="fa fa-angle-down"></i>
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                  <ul class="dropdown-user">
                    <li>
                      <div class="dw-user-box">
                        <div class="u-img text-center">
                          <i class="mdi mdi-face" style="font-size:40px;"></i>
                        </div>
                        <div class="u-text">
                          <h4><?php echo $_usu_nome; ?></h4>
                          <p class="text-muted"><?php echo $_usu_email ?></p>
                          <p class="text-muted"><?php echo $_usu_dataCadastro ?></p>
                        </div>
                      </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo base_url(MODULO_ADMIN.'perfil/meu-perfil') ?>"><i class="mdi mdi-account-card-details"></i> Meu Perfil</a></li>
                    <li><a href="javascript:void(0);"><i class="mdi mdi-account-settings-variant"></i> Configurações/Parâmetros</a></li>
                    <li><a href="<?php echo base_url(MODULO_ADMIN.'autenticacao/logout') ?>" class="text-danger"><i class="mdi mdi-power"></i> Sair do Sistema</a></li>
                  </ul>
                </div>
              </li>

            </ul>
          </div>
        </nav>
      </header>
