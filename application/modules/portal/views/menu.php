    <?php if( $_usu_logado ) { ?>
      <!-- <header class="top-header top-header-bg d-block" id="top-header-2">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <span id="msg-boas-vindas"><?php echo ucfirst(get_saudacao()).', '.$_usu_logado_nome.'! Bem vindo' ?></span>
              <ul class="top-menu-logado pull-right">
                <li id="lk-anunciar"><a href="<?php echo base_url('novo-anuncio'); ?>" <?php echo verifica_menu_painel($_menu_painel, 'novo_anuncio') ?>><i class="fas fa-plus-circle"></i> <span>Anunciar Imóvel</span></a></li>
                <li <?php echo verifica_menu_painel($_menu_painel, 'meus_imoveis') ?>><a href="<?php echo base_url(MODULO_PAINEL.'meus-imoveis') ?>"><i class="fas fa-home"></i> <span>Meus Imóveis</span></a></li>
                <li <?php echo verifica_menu_painel($_menu_painel, 'chat') ?>><a href="<?php echo base_url(MODULO_PAINEL.'chat') ?>"><i class="fas fa-comments"></i> <span>Chat</span></a></li>
                <li <?php echo verifica_menu_painel($_menu_painel, 'imo_favoritos') ?>><a href="#"><i class="fas fa-hand-holding-heart"></i> <span>Favoritos</span></a></li>
                <li <?php echo verifica_menu_painel($_menu_painel, 'novo_interesse') ?>><a href="<?php echo base_url(MODULO_PAINEL.'imovel/novo-interesse') ?>"><i class="fas fa-plus-circle"></i> <span>Novo Interesse</span></a></li>
                <li <?php echo verifica_menu_painel($_menu_painel, 'meu_perfil') ?>><a href="<?php echo base_url(MODULO_PAINEL.'perfil/meu-perfil') ?>"><i class="fas fa-user-cog"></i> <span>Meu Perfil</span></a></li>
                <li id="lk-logout"><a href="<?php echo base_url(MODULO_PAINEL.'autenticacao/logout') ?>"><i class="fa fa-sign-out-alt"></i> <span>Sair</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </header> -->
    <?php } ?>
    <!-- <header class="main-header sticky-header" id="main-header-2"> -->
    <header class="main-header sticky-header" id="main-header-2">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <nav class="navbar navbar-expand-lg navbar-light rounded hide-carat">
              <!-- <a class="navbar-brand logo navbar-brand d-flex w-100 mr-auto" href="<?php echo base_url(MODULO_PORTAL); ?>">
                <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/logo-drplace-dark.png'); ?>" alt="Dr.Place - Direto com o proprietário" />
              </a> -->
              <a class="navbar-brand logo navbar-brand mr-auto" href="<?php echo base_url(MODULO_PORTAL); ?>">
                <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/logo-drplace-dark.png'); ?>" alt="Dr.Place - Direto com o proprietário" />
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
              </button>
              <div class="collapse navbar-collapse <?php echo $_nav_bar_topo ?>" id="navbar">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item<?php echo verifica_menu_site( $_menu_ativo, 'comprar') ?>">
                    <a class="nav-link" href="<?php echo base_url('imoveis-para-comprar'); ?>" role="button" aria-haspopup="false" aria-expanded="false">
                      Comprar
                    </a>
                  </li>
                  <li class="nav-item<?php echo verifica_menu_site( $_menu_ativo, 'alugar') ?>">
                    <a class="nav-link" href="<?php echo base_url('imoveis-para-alugar'); ?>" role="button" aria-haspopup="false" aria-expanded="false">
                      Alugar
                    </a>
                  </li>
                  <li class="nav-item dropdown<?php echo verifica_menu_site( $_menu_ativo, 'parceiros') ?>">
                    <a class="nav-link dropdown-toggle" href="<?php echo base_url('parceiros'); ?>" id="navbarDropdownMenuServico" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Parceiros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuServico">
                      <li><a class="dropdown-item" href="<?php echo base_url('servico/contate-um-advogado'); ?>">Contate um Advogado</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown<?php echo verifica_menu_site( $_menu_ativo, 'ajuda') ?>">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdownMenuAjuda" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Ajuda
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuAjuda">
                      <li><a class="dropdown-item" href="<?php echo base_url('faq/ajuda/como-comprar'); ?>">Como Comprar ?</a></li>
                      <li><a class="dropdown-item" href="<?php echo base_url('faq/ajuda/como-vender'); ?>">Como Vender ?</a></li>
                      <!-- <li><a class="dropdown-item" href="<?php echo base_url('faq/ajuda/lista-de-documentos'); ?>">Lista de Documentos</a></li> -->
                    </ul>
                  </li>
                  <li class="nav-item<?php echo verifica_menu_site( $_menu_ativo, 'artigo') ?>">
                    <a class="nav-link" href="<?php echo base_url('artigos'); ?>" role="button" aria-haspopup="false" aria-expanded="false">
                      Artigos
                    </a>
                  </li>
                  <li class="nav-item<?php echo verifica_menu_site( $_menu_ativo, 'contato') ?>">
                    <a class="nav-link" href="<?php echo base_url('contato'); ?>" role="button" aria-haspopup="false" aria-expanded="false">
                      Contato
                    </a>
                  </li>
                </ul>
                <!-- <ul class="nav navbar-nav nav-menu-2 ml-auto w-100 justify-content-end">
                  <li class="nav-item">
                    <a class="open-offcanvas" href="#">
                      <span class="fa fa-bars"></span>
                    </a>
                  </li>
                </ul> -->
                <?php if( !$_usu_logado ) { ?>
                <ul class="nav nav-btn navbar-nav">
                  <li class="nav-item">
                    <a class="btn btn-info open-form-topo" href="<?php echo base_url(MODULO_PAINEL.'autenticacao'); ?>">
                      <i class="fa fa-sign-in-alt pr-1"></i>
                      Entrar
                    </a>
                  </li>
                </ul>
                <div class="nav-btn-text-ou">ou</div>
                <ul class="nav nav-btn navbar-nav">
                  <li class="nav-item">
                    <a class="btn btn-info open-form-topo" href="<?php echo base_url('criar-conta'); ?>">
                      <i class="fas fa-plus-square pr-1"></i>
                      Criar Minha Conta
                    </a>
                  </li>
                </ul>
              <?php } else { ?>
                <ul class="nav navbar-nav nav-menu-2">
                  <li class="nav-item">
                    <a class="<?php echo $_class_link_painel ?>" href="<?php echo base_url(MODULO_PAINEL.'home/minha-conta'); ?>">
                      <i class="fas fa-user-cog"></i>
                    </a>
                  </li>
                </ul>
              <?php } ?>
              </div>
              <?php if( $_topo != 1 ) { ?>
                <!-- <form class="form-inline my-2 my-lg-0">
                  <a href="#full-page-search" class="bt-page-search my-2 my-sm-0">
                    <i class="fa fa-search"></i>
                  </a>
                </form> -->
              <?php } ?>
            </nav>
          </div>
        </div>
      </div>
    </header>

    <?php if( $_topo == 1 ) { ?>
      <div class="banner">
        <div class="container text-center">
          <div class="row">
            <div class="col-md-12">
              <div class="box-bt-anuncie-topo">
                <a href="<?php echo base_url(MODULO_CAMPANHA_2.'meu-imovel') ?>" class="btn">
                  <i class="fa fa-plus-circle"></i>
                  Anuncie Seu Imóvel
                </a>
              </div>
            </div>
          </div>

          <h1>Seu imóvel direto com o proprietário está aqui</h1>

          <div class="form-pesquisa">
            <?php
              $form_act = base_url(MODULO_PORTAL.'home/pesquisa');
              $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form',
                                  'class' => 'form form-bv', 'autocomplete' => 'off', 'role' => 'form' );

              echo form_open($form_act,$form_atr);
            ?>
              <div class="input-group">
                <div class="form-select-procura sel-situacao">
                  <select id="sel_pesq_situacao" class="form-control" name="sel_pesq_situacao">
                    <option value="V">Quero Comprar</option>
                    <option value="A">Quero Alugar</option>
                  </select>
                </div>
                <!-- <div class="form-select-procura sel-tipo">
                  <select id="sel_pesq_tipo" class="form-control" name="sel_pesq_tipo">
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
               </div> -->
               <div class="clear-mob"></div>
               <input type="text" class="form-control" name="inp_pesq_string" id="inp_pesq_string" placeholder="Digite a cidade ou estado" />
               <span class="input-group-btn">
                 <button type="submit" class="btn btn-color" type="button">Buscar</button>
               </span>
            </div>
          <?php echo form_close(); ?>
        </div>

      </div>
    </div>
  <?php } else if( $_topo == 2 ) { ?>
    <!-- <div class="sub-banner overview-bgi">
      <div class="container">
        <div class="breadcrumb-area">
          <h1><?php echo $_titulo_page ?></h1>
          <?php echo $_breadcrumb ?>
        </div>
      </div>
    </div> -->
  <?php } ?>
