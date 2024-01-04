    <div class="user-page content-area-14">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-12 d-xs-none">
            <div class="user-profile-box mrb">
              <div class="header clearfix">
                <h2><?php echo $_usu_nome; ?></h2>
                <!-- <h4><?php echo $_usu_perfil; ?></h4> -->
                <img src="<?php echo $_usu_avatar; ?>" alt="Avatar" class="img-fluid profile-img">
              </div>
              <div class="detail clearfix">
                <ul>
                  <li><a href="<?php echo base_url('novo-anuncio') ?>" <?php echo verifica_menu_painel($_menu_painel, 'novo_anuncio') ?>><i class="fa fa-plus-circle"></i>Adicionar Novo Imóvel</a></li>
                  <li><a href="<?php echo base_url(MODULO_PAINEL.'meus-imoveis') ?>" <?php echo verifica_menu_painel($_menu_painel, 'meus_imoveis') ?>><i class="flaticon-house"></i>Meus Imóveis</a></li>
                  <li><a href="<?php echo base_url(MODULO_PAINEL.'chat') ?>" <?php echo verifica_menu_painel($_menu_painel, 'chat') ?>><i class="fa fa-comments"></i>Chat</a></li>
                  <li><a href="<?php echo base_url(MODULO_PAINEL.'imoveis-favoritos') ?>" <?php echo verifica_menu_painel($_menu_painel, 'imoveis_favoritos') ?>><i class="flaticon-heart-shape-outline"></i>Imóveis Favoritos</a></li>
                  <li><a href="<?php echo base_url(MODULO_PAINEL.'perfil/meu-perfil') ?>" <?php echo verifica_menu_painel($_menu_painel, 'meu_perfil') ?>><i class="flaticon-user"></i>Meu Perfil / Mudar Senha</a></li>
                  <li><a href="<?php echo base_url(MODULO_PAINEL.'imovel/lista-interessados') ?>" <?php echo verifica_menu_painel($_menu_painel, 'lista_interesse') ?>><i class="fa fa-home"></i>Lista de Interessados</a></li>
                  <li><a href="<?php echo base_url(MODULO_PAINEL.'imovel/novo-interesse') ?>" <?php echo verifica_menu_painel($_menu_painel, 'novo_interesse') ?>><i class="fa fa-plus-circle"></i>Cadastrar Novo Interesse</a></li>
                  <li><a href="<?php echo base_url('compartilhe-indique-para-um-amigo') ?>" <?php echo verifica_menu_painel($_menu_painel, 'compartilhe') ?>><i class="fas fa-share-square"></i>Compartilhe Com Um Amigo</a></li>
                  <li id="bt-logout"><a href="<?php echo base_url(MODULO_PAINEL.'autenticacao/logout') ?>"><i class="flaticon-logout"></i>Sair do Painel</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
