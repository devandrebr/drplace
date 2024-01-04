        </div>

        <footer class="footer">
          <i class="mdi mdi-copyright"></i> <?php echo date('Y') ?> Dr.Place - Todos os direitos reservados.
        </footer>

      </div>

      <div id="idle-timeout-dialog" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Seu acesso vai ser bloqueado por inatividade</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <p>
                <i class="fa fa-warning font-red"></i> A sua sessão vai ser bloqueada por inatividade em
                <span id="idle-timeout-counter"></span> segundos.
              </p>
              <p>Você quer continuar logado ?</p>
            </div>
            <div class="modal-footer text-center">
              <button id="idle-timeout-dialog-keepalive" type="button" class="btn btn-success" data-dismiss="modal">
                Sim, continuar trabalhando!
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap-validator/js/bootstrapValidator.min.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap-validator/js/language/pt_BR.js'); ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/bootstrap-select/bootstrap-select.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/ps/perfect-scrollbar.jquery.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/font-awesome/js/fontawesome-all.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/jquery-mask/jquery.mask.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'js/waves.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'js/sidebarmenu.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/sticky-kit-master/dist/sticky-kit.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/sparkline/jquery.sparkline.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/session-timeout/idle/jquery.idletimeout.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/session-timeout/idle/jquery.idletimer.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') ?>"></script>
    <!-- <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/session-timeout/idle/session-init.js') ?>"></script> -->
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/icheck/icheck.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/summernote/dist/summernote.min.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/summernote/lang/summernote-pt-BR.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'js/app.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'js/custom.js') ?>"></script>
    <script src="<?php echo base_url(ASSETS_ADMIN.'js/datatable.js') ?>"></script>

    <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/styleswitcher/jQuery.style.switcher.js') ?>"></script>

    <?php if( $_enable_gmaps ) { ?>
      <script src="https://maps.google.com/maps/api/js?key=<?php echo API_KEY_GOOGLE_MAPS ?>"></script>
      <script src="<?php echo base_url(ASSETS_ADMIN.'node_modules/gmaps/gmaps.min.js') ?>"></script>
      <script src="<?php echo base_url(ASSETS_ADMIN.'js/gmaps.js') ?>"></script>
    <?php } ?>

    <script type="text/javascript">
      $(document).ready(function(){
        // Mensagens de retorno (oks, alertas, erros)
        <?php
          if( $_msg_status ):
            $status_msg = $_msg_status['msg'];
            switch( $_msg_status['status'] ):
              case 'erro':
              case 'danger':
                $status = 'error';
                $status_titulo = 'Aviso!';
              break;
              case 'ok':
              case 'success':
                $status = 'success';
                $status_titulo = 'Sucesso!';
              break;
              case 'aviso':
              case 'warning':
                $status = 'warning';
                $status_titulo = 'Aviso!';
              break;
              case 'info':
                $status = 'info';
                $titulo = 'Informação!';
              break;
              default:
                $status = 'info';
                $status_titulo = 'Aviso!';
              break;
            endswitch;
          ?>
              swal({
                title:"<?php echo $status_titulo; ?>",
                text:"<?php echo $status_msg; ?>",
                type:"<?php echo $status; ?>"
              });
          <?php
            endif;
          ?>
      });
    </script>

  </body>

</html>
