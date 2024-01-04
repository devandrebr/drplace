<div class="row page-titles">
  <div class="col-md-12 align-self-center">
    <h3 class="text-themecolor"><?php echo $_titulo_page ?></h3>
    <?php echo $_breadcrumb ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Usuários cadastrados no pré-lançamento da plataforma</h4>
        <?php
            $form_act = base_url( $_modulo . 'artigos/registro' );
            $form_atr = array( 'method' => 'POST', 'id' => 'form', 'name' => 'form',
                                'class' => 'form-horizontal form-bv', 'role' => 'form', 'autocomplete' => 'off' );

            $form_label_param = array( 'class' => 'control-label' );

            $form_inp_assunto = array( 'name' => 'inp_assunto', 'id' => 'inp_assunto', 'class' => 'form-control', 'data-bv-notempty' => 'true' );
            $form_tex_mensagem = array( 'name' => 'tex_mensagem', 'id' => 'tex_mensagem', 'class' => 'summernote-artigo-1', 'data-bv-notempty' => 'true' );

            $form_val_inp_assunto   = set_value( 'inp_assunto' );
            $form_val_tex_mensagem  = '';

            echo form_open_multipart( $form_act, $form_atr );
        ?>
          <div class="form-group row m-t-20">
            <div class="col-md-8">
              <?php
                echo form_label('<i class="text-danger">*</i> Assunto', 'inp_assunto',$form_label_param);
                echo form_input($form_inp_assunto, $form_val_inp_assunto);
              ?>
            </div>
            <div class="col-md-4">
              <?php
                echo form_label('<i class="text-danger">*</i> Imagem Principal', 'inp_imgPrincipal',$form_label_param);
                echo '<input type="file" name="inp_imgPrincipal" id="inp_imgPrincipal" class="form-control" />';
              ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <?php
                echo form_label('<i class="text-danger">*</i> Artigo', 'tex_mensagem',$form_label_param);
                echo form_textarea($form_tex_mensagem, $form_val_tex_mensagem);
              ?>
            </div>
          </div>
          <hr>
          <div class="form-actions">
            <div class="row">
              <div class="col-md-12 text-right">
                <a href="<?php echo base_url($_modulo.$_controller) ?>" class="btn btn-danger">Cancelar</a>
                &nbsp; &nbsp; &nbsp;
                <button type="submit" class="btn btn-success">Cadastrar</button>
              </div>
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
