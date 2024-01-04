  <aside class="left-sidebar">
    <div class="scroll-sidebar">
      <nav class="sidebar-nav">

        <ul id="sidebarnav">
          <li>
            <a class="waves-effect waves-dark <?php echo verifica_menu_ativo_admin('dashboard', $_menu_left); ?>" href="<?php echo base_url(MODULO_ADMIN.'home/dashboard') ?>" aria-expanded="false">
              <i class="mdi mdi-view-dashboard"></i>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
          <li>
            <a class="waves-effect waves-dark <?php echo verifica_menu_ativo_admin('artigos', $_menu_left); ?>" href="<?php echo base_url(MODULO_ADMIN.'artigos') ?>" aria-expanded="false">
              <i class="mdi mdi-account-edit"></i>
              <span class="hide-menu">Artigo(s)</span>
            </a>
          </li>
          <li>
            <a class="waves-effect waves-dark <?php echo verifica_menu_ativo_admin('usuarios', $_menu_left); ?>" href="javascript:void(0);" aria-expanded="false">
              <i class="mdi mdi-account-multiple"></i>
              <span class="hide-menu">Usuários/Membros</span>
            </a>
          </li>
          <li>
            <a class="waves-effect waves-dark <?php echo verifica_menu_ativo_admin('parceiro', $_menu_left); ?>" href="<?php echo base_url(MODULO_ADMIN.'parceiro') ?>" aria-expanded="false">
              <i class="mdi mdi-account-search"></i>
              <span class="hide-menu">Controle Parceiro</span>
            </a>
          </li>
          <li>
            <a class="has-arrow waves-effect <?php echo verifica_menu_ativo_admin('campanhas', $_menu_left); ?>" href="javascript:void(0);" aria-expanded="false">
              <i class="mdi mdi-file-multiple"></i>
              <span class="hide-menu">Campanhas</span>
            </a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="<?php echo base_url(MODULO_ADMIN.'campanhas/pre-lancamento') ?>">Pré Lançamento</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow waves-effect" href="javascript:void(0);" aria-expanded="false">
              <i class="mdi mdi-settings"></i>
              <span class="hide-menu">Configurações</span>
            </a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="javascript:void(0);">Link 1</a></li>
              <li><a href="javascript:void(0);">Link 2</a></li>
              <li><a href="javascript:void(0);">Link 3</a></li>
            </ul>
          </li>
        </ul>

      </nav>
    </div>
  </aside>

  <div class="page-wrapper">
    <div class="container-fluid">
