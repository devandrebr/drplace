        </div>
      </div>
    </div>
  </div>

  <div class="off-canvas-sidebar">
    <div class="off-canvas-sidebar-wrapper">
      <div class="off-canvas-header">
        <a class="close-offcanvas" href="javascript:void(0);" title="Fechar"><span class="fa fa-times"></span></a>
      </div>
      <div class="off-canvas-content">
        <aside class="canvas-widget">
          <div class="text-center">
            <img src="<?php echo base_url(ASSETS_PORTAL.'img/logos/logo-drplace.png'); ?>" height="80" alt="Logo Dr.Place - Direto com o proprietário">
          </div>
        </aside>
        <aside class="canvas-widget">
          <ul class="menu"><!-- <li class="menu-item menu-item-has-children"> -->
            <li class="menu-item"><a href="<?php echo base_url(MODULO_PAINEL.'perfil/meu-perfil') ?>"><i class="fas fa-user-cog"></i> Meu Perfil</a></li>
            <li class="menu-item"><a href="<?php echo base_url(); ?>">Página Principal</a></li>
            <li class="menu-item"><a href="<?php echo base_url('novo-anuncio'); ?>" <?php echo verifica_menu_painel($_menu_painel, 'novo_anuncio') ?>><i class="fas fa-plus-circle"></i> Novo Anúncio</li>
            <li class="menu-item"><a href="<?php echo base_url(MODULO_PAINEL.'meus-imoveis') ?>"><i class="fas fa-home"></i> Meus Imóveis</a></li>
            <li class="menu-item"><a href="<?php echo base_url(MODULO_PAINEL.'chat') ?>"><i class="fas fa-comments"></i> Chat/Mensagens</a></li>
            <li class="menu-item"><a href="<?php echo base_url(MODULO_PAINEL.'imoveis-favoritos') ?>"><i class="fas fa-hand-holding-heart"></i> Favoritos</a></li>
            <li class="menu-item"><a href="<?php echo base_url(MODULO_PAINEL.'imovel/novo-interesse') ?>"><i class="fas fa-plus-circle"></i> Novo Interesse</a></li>
            <li class="menu-item"><a href="<?php echo base_url('contato'); ?>"><i class="fa fa-envelope"></i> Fale Conosco</a></li>
            <li class="menu-item bt-logout"><a href="<?php echo base_url(MODULO_PAINEL.'autenticacao/logout') ?>"><i class="flaticon-logout"></i> Sair do Painel</a></li>
          </ul>
        </aside>
        <aside class="canvas-widget">
          <ul class="social-icons">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </aside>
      </div>
    </div>
  </div>
