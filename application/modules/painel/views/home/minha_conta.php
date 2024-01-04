  <div class="user-page">
    <div class="container">
      <h3 class="heading"><?php echo $_titulo_page ?></h3>
      <?php
        if( validation_errors() != '' )
          echo '<div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div>';

        if( $_msg_status )
          echo monta_box_mensagem_status( $_msg_status );
      ?>
      <div class="row">
        <div class="col-lg-12">
          <p>Minha conta.</p>
        </div>
      </div>
    </div>
  </div>
