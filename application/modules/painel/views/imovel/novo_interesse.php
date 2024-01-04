<div class="user-page">
  <div class="container">
    <h3 class="heading">Adicionar Novo Interesse/Procura por imóvel</h3>

    <?php
      if( validation_errors() != '' )
        echo '<div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div>';

      if( $_msg_status )
        echo monta_box_mensagem_status( $_msg_status );
    ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="search-area contact-2">
            <div class="search-area-inner">
              <div class="search-contents">
                <?php
                  $form_act = base_url(MODULO_PAINEL.'imovel/registro-interesse/1');
                  $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form',
                                      'class' => 'form-bv', 'autocomplete' => 'off', 'role' => 'form' );

                  $form_label = array('class' => 'control-label');

                  $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'class' => 'form-control afocus', 'placeholder' => 'Seu Nome', 'maxlength' => '120', 'data-bv-notempty' => 'true' );
                  $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'class' => 'form-control', 'placeholder' => 'email@provedor.com' );
                  $form_tex_msg = array('name' => 'tex_msg', 'id' => 'tex_msg', 'class' => 'form-control', 'placeholder' => 'Cadastre seu interesse, como comprador ou locador, valor, localização e demais informações...' );

                  $form_val_inp_nome = set_value( 'inp_nome', $_usu_nome );
                  $form_val_inp_email = set_value( 'inp_email', $_usu_email );
                  $form_val_tex_msg = set_value( 'tex_msg' );


                  echo form_open( $form_act, $form_atr );
                ?>
                    <div class="row mb-20">
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <?php
                            echo form_label('<b>*</b> Seu Nome', 'inp_nome', $form_label);
                            echo form_input($form_inp_nome, $form_val_inp_nome);
                          ?>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <?php
                            echo form_label('<b>*</b> E-mail', 'inp_email', $form_label);
                            echo form_input($form_inp_email, $form_val_inp_email);
                          ?>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group message">
                          <?php
                            echo form_label('<b>*</b> Cadastro de Interesse', 'tex_msg', $form_label);
                            echo form_textarea($form_tex_msg, $form_val_tex_msg);
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 text-right">
                      <br><hr><br>
                      <button type="submit" name="bt-submit" class="btn btn-md btn-color">
                        Cadastrar
                      </button>
                    </div>

                  </div>
                <?php
                  echo form_close();
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
