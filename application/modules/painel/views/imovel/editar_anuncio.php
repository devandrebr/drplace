<?php
  $cid_id = $res['fk_id_cidade'];
  $cid_sigla = $res['cid_sigla'];
  $cid_nome = $res['cid_nome'];
  $imo_id = $res['imo_id'];
  $imo_codigo = $res['imo_codigo'];
  $imo_titulo = $res['imo_titulo'];
  $imo_descricao = $res['imo_descricao'];
  $imo_logradouro = $res['imo_logradouro'];
  $imo_numero = $res['imo_numero'];
  $imo_bairro = $res['imo_bairro'];
  $imo_complemento = $res['imo_complemento'];
  $imo_cep = $res['imo_cep'];
  $imo_valor = converte_moeda($res['imo_valor'],'BRL');
  $imo_valorVenda = converte_moeda($res['imo_valorVenda'],'BRL');
  $imo_dataEdicao = converte_data($res['imo_dataEdicao']);
  $imo_ultimaReforma = converte_data($res['imo_ultimaReforma']);
  $imo_construcao = converte_data($res['imo_construcao']);
  $imo_situacao = $res['imo_situacao'];
  $imo_valorIptu = $res['imo_valorIptu'];
  $imo_valorCondominio = $res['imo_valorCondominio'];
  $imtip_id = $res['fk_id_tipo'];
  $imtip_titulo = $res['imtip_titulo'];
  $usu_id = $res['usu_id'];
  $usu_nome = $res['usu_nome'];

  $ci_viaAcesso = $res_car['imcar_proxViaAcesso'];
  $ci_shopping = $res_car['imcar_proxShopping'];
  $ci_sacada = $res_car['imcar_sacada'];
  $ci_quintal = $res_car['imcar_quintal'];
  $ci_espGourmet = $res_car['imcar_espacoGourmet'];
  $ci_quadraPolies = $res_car['imcar_quadraPoliesportiva'];
  $ci_piscina = $res_car['imcar_piscina'];
  $ci_churrasqueira = $res_car['imcar_churrasqueira'];
  $ci_jardim = $res_car['imcar_jardim'];
  $ci_circSeg = $res_car['imcar_proxViaAcesso'];
  $ci_condFechado = $res_car['imcar_circuitoSeguranca'];
  $ci_condAberto = $res_car['imcar_condominioAberto'];
  $ci_areaServico = $res_car['imcar_areaServico'];
  $ci_segFullTime = $res_car['imcar_segurancaFullTime'];
  $ci_hospital = $res_car['imcar_proxHospital'];
  $ci_parque = $res_car['imcar_parque'];
  $ci_transPub = $res_car['imcar_proxTransPub'];
  $ci_escola = $res_car['imcar_proxEscola'];
  $ci_internet = $res_car['imcar_internet'];
  $ci_interfone = $res_car['imcar_interfone'];
  $ci_arCondicionado = $res_car['imcar_arCondicionado'];
  $ci_garagem = $res_car['imcar_garagem'];
  $ci_cozinha = $res_car['imcar_cozinha'];
  $ci_dormitorio = $res_car['imcar_dormitorio'];
  $ci_banheiro = $res_car['imcar_banheiro'];
  $ci_area = $res_car['imcar_area'];
  $ci_suite = $res_car['imcar_suite'];
?>
<div class="user-page">
  <div class="container">
    <h3 class="heading">Atualizar o Imóvel<br><?php echo $imo_titulo ?></h3>

    <?php
      if( validation_errors() != '' )
        echo '<div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div>';

      if( $_msg_status )
        echo monta_box_mensagem_status( $_msg_status );
    ?>
      <div class="row">
        <div class="col-lg-12 mb-60">
            <div class="search-area contact-2">
              <div class="search-area-inner">
                <div class="search-contents">
                  <?php
                    $form_act = base_url(MODULO_PAINEL.'imovel/atualizar');
                    $form_atr = array('method' => 'post', 'id' => 'form_imo_edt', 'name' => 'form',
                                        'class' => 'form-bv', 'autocomplete' => 'off', 'role' => 'form' );

                    $form_label = array('class' => 'control-label');

                    $form_inp_titulo = array('name' => 'inp_titulo', 'id' => 'inp_titulo', 'class' => 'form-control', 'placeholder' => 'Título do seu imóvel. Ex: Vendo imóvel reformado', 'maxlength' => '120', 'data-bv-notempty' => 'true' );
                    $form_inp_valor = array('name' => 'inp_valor', 'id' => 'inp_valor', 'class' => 'form-control m_money', 'placeholder' => 'R$' );
                    $form_inp_valorVenda = array('name' => 'inp_valorVenda', 'id' => 'inp_valorVenda', 'class' => 'form-control m_money', 'placeholder' => 'R$' );
                    $form_inp_dormitorio = array('name' => 'inp_dormitorio', 'id' => 'inp_dormitorio', 'class' => 'form-control', 'placeholder' => 'Qtd de Dormitórios' );
                    $form_inp_banheiro = array('name' => 'inp_banheiro', 'id' => 'inp_banheiro', 'class' => 'form-control', 'placeholder' => 'Qtd de Banheiros' );
                    $form_inp_suite = array('name' => 'inp_suite', 'id' => 'inp_suite', 'class' => 'form-control', 'placeholder' => 'Qtd de Suítes' );
                    $form_inp_area = array('name' => 'inp_area', 'id' => 'inp_area', 'class' => 'form-control', 'placeholder' => 'Área (m²)' );
                    $form_inp_garagem = array('name' => 'inp_garagem', 'id' => 'inp_garagem', 'class' => 'form-control', 'placeholder' => 'Vagas na Garagem' );
                    $form_inp_cozinha = array('name' => 'inp_cozinha', 'id' => 'inp_cozinha', 'class' => 'form-control', 'placeholder' => 'Qtd de Cozinhas' );
                    $form_inp_endereco = array('name' => 'inp_endereco', 'id' => 'inp_endereco', 'class' => 'form-control', 'placeholder' => 'Endereço' );
                    $form_inp_numero = array('name' => 'inp_numero', 'id' => 'inp_numero', 'class' => 'form-control', 'placeholder' => 'Número' );
                    $form_inp_cep = array('name' => 'inp_cep', 'id' => 'inp_cep', 'class' => 'form-control m_cep', 'placeholder' => 'CEP' );
                    $form_inp_bairro = array('name' => 'inp_bairro', 'id' => 'inp_bairro', 'class' => 'form-control', 'placeholder' => 'Bairro' );
                    $form_inp_complemento = array('name' => 'inp_complemento', 'id' => 'inp_complemento', 'class' => 'form-control', 'placeholder' => 'Complemento' );
                    $form_inp_construcao = array('name' => 'inp_construcao', 'id' => 'inp_construcao', 'class' => 'form-control m_data', 'placeholder' => 'Data da Construção' );
                    $form_inp_reforma = array('name' => 'inp_reforma', 'id' => 'inp_reforma', 'class' => 'form-control m_data', 'placeholder' => 'Data da Reforma' );
                    $form_tex_obs = array('name' => 'tex_obs', 'id' => 'tex_obs', 'class' => 'form-control', 'placeholder' => 'Observações Adicionais Sobre o Imóvel' );

                    $form_val_inp_titulo = set_value( 'inp_titulo', $imo_titulo );
                    $form_val_inp_dormitorio = set_value( 'inp_dormitorio', $ci_dormitorio );
                    $form_val_inp_banheiro = set_value( 'inp_banheiro', $ci_banheiro );
                    $form_val_inp_suite = set_value( 'inp_suite', $ci_suite );
                    $form_val_inp_garagem = set_value( 'inp_garagem', $ci_garagem );
                    $form_val_inp_cozinha = set_value( 'inp_cozinha', $ci_cozinha );
                    $form_val_inp_area = set_value( 'inp_area', $ci_area );
                    $form_val_inp_valor = set_value( 'inp_valor', $imo_valor );
                    $form_val_inp_valorVenda = set_value( 'inp_valorVenda', $imo_valorVenda );
                    $form_val_inp_endereco = set_value( 'inp_endereco', $imo_logradouro );
                    $form_val_inp_numero = set_value( 'inp_numero', $imo_numero );
                    $form_val_inp_cep = set_value( 'inp_cep', $imo_cep );
                    $form_val_inp_complemento = set_value( 'inp_complemento', $imo_complemento );
                    $form_val_inp_bairro = set_value( 'inp_bairro', $imo_bairro );
                    $form_val_inp_construcao = set_value( 'inp_construcao', $imo_construcao );
                    $form_val_inp_reforma = set_value( 'inp_reforma', $imo_ultimaReforma );
                    $form_val_tex_obs = set_value( 'tex_obs', $imo_descricao );
                    $form_val_opt_cidade = set_value( 'opt_cidade', $cid_id );
                    $form_val_opt_estado = set_value( 'opt_estado', $cid_sigla );
                    $form_val_opt_situacao = set_value( 'opt_situacao', $imo_situacao );

                    $form_opt_cidade = array( '' => 'Selecione uma Cidade' );
                    $form_opt_estado = array( '' => '' );
                    $form_opt_situacao = array( '' => 'Vender ou Alugar ?' );

                    for($i=0; $i<$qtd_situacao; $i++):
                      $valor = $combo_situacao[$i]['valor'];
                      $nome = $combo_situacao[$i]['nome'];
                      $form_opt_situacao[$valor] = $nome;
                    endfor;

                    for($i=0; $i<$qtd_uf; $i++):
                      $valor = $combo_uf[$i]['valor'];
                      $nome = $combo_uf[$i]['nome'];
                      $form_opt_estado[$valor] = $nome;
                    endfor;

                    for($i=0; $i<$qtd_cid; $i++):
                      $id = $res_cid[$i]['cid_id'];
                      $nome = $res_cid[$i]['cid_nome'];
                      $form_opt_cidade[$id] = $nome;
                    endfor;

                    $form_hidden = array('id'=>$imo_id);
                    echo form_open_multipart( $form_act, $form_atr, $form_hidden );
                  ?>
                      <div class="row mb-20">
                        <div class="col-md-12">
                          <div class="form-group">
                            <?php
                              echo form_label('<b>*</b> Título do Imóvel', 'inp_titulo', $form_label);
                              echo form_input($form_inp_titulo, $form_val_inp_titulo);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <?php
                              echo form_label('<b>*</b> Situação', 'opt_situacao', $form_label);
                              echo form_dropdown('opt_situacao',$form_opt_situacao,$form_val_opt_situacao,'id="opt_situacao" class="form-control select-text-1" data-bv-notempty="true"');
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <?php
                              echo form_label('Valor', 'inp_valor', $form_label);
                              echo form_input($form_inp_valor, $form_val_inp_valor);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <?php
                              echo form_label('Valor Venda', 'inp_valorVenda', $form_label);
                              echo form_input($form_inp_valorVenda, $form_val_inp_valorVenda);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="form-group">
                            <?php echo form_label('<b>*</b> Tipo do Imóvel', 'opt_tipo', $form_label); ?>
                            <select class="form-control select-text-1" name="opt_tipo" data-bv-notempty="true">
                              <option></option>
                              <?php
                                if( $qtd_imtipo > 0 )
                                {
                                  $html = '';
                                  $opt_grupo = array();
                                  for($i=0;$i<$qtd_imtipo;$i++):
                                    $im_id = $res_imtipo[$i]['imtip_id'];
                                    $im_titulo = $res_imtipo[$i]['imtip_titulo'];
                                    $im_tipo = $res_imtipo[$i]['imtip_tipo'];
                                    $selected = $res_imtipo[$i]['imtip_id'] == $imtip_id ? 'selected="selected"' : '';

                                    if( !in_array($im_tipo, $opt_grupo) ) {
                                      if( $i>0 )
                                        $html .= '</optgroup>';
                                      $html .= '<optgroup label="'.combo_categoriaImovel($im_tipo).'">';

                                      $opt_grupo[] = $im_tipo;
                                    }
                                    $html .= '<option value="'.$im_id.'" '.$selected.'>'.$im_titulo.'</option>';
                                  endfor;
                                  $html .= '</optgroup>';

                                  echo $html;
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                          <div class="form-group">
                            <?php
                              echo form_label('Qtd de Dormitórios', 'inp_dormitorio', $form_label);
                              echo form_number($form_inp_dormitorio, $form_val_inp_dormitorio);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                          <div class="form-group">
                            <?php
                              echo form_label('Qtd de Cozinhas', 'inp_cozinha', $form_label);
                              echo form_number($form_inp_cozinha, $form_val_inp_cozinha);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                          <div class="form-group">
                            <?php
                              echo form_label('Qtd de Banheiros', 'inp_banheiro', $form_label);
                              echo form_number($form_inp_banheiro, $form_val_inp_banheiro);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <?php
                              echo form_label('Qtd de Suítes', 'inp_suite', $form_label);
                              echo form_number($form_inp_suite, $form_val_inp_suite);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <?php
                              echo form_label('Vagas na Garagem', 'inp_garagem', $form_label);
                              echo form_number($form_inp_garagem, $form_val_inp_garagem);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <?php
                              echo form_label('Área (m²)', 'inp_area', $form_label);
                              echo form_number($form_inp_area, $form_val_inp_area);
                            ?>
                          </div>
                        </div>
                      </div>

                      <h3 class="heading">Localização</h3>
                      <div class="row mb-20">
                        <div class="col-lg-6 col-md-6">
                          <div class="form-group">
                            <?php
                              echo form_label('<b>*</b> Estado', 'opt_estado', $form_label);
                              echo form_dropdown('opt_estado',$form_opt_estado,$form_val_opt_estado,'id="opt_estado" class="form-control select-text-1" data-bv-notempty="true"');
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="form-group">
                            <?php
                              echo form_label('<b>*</b> Cidade <span id="box-loading-1"><img src="'.base_url(ASSETS_PORTAL.'img/carregando-1.gif').'" alt="Loading" /> carregando...</span>', 'opt_cidade', $form_label);
                              echo form_dropdown('opt_cidade',$form_opt_cidade,$form_val_opt_cidade,'id="opt_cidade" class="form-control select-text-1" data-bv-notempty="true"');
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-10 col-md-10">
                          <div class="form-group">
                            <?php
                              echo form_label('Endereço', 'inp_endereco', $form_label);
                              echo form_input($form_inp_endereco, $form_val_inp_endereco);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                          <div class="form-group">
                            <?php
                              echo form_label('Número', 'inp_numero', $form_label);
                              echo form_input($form_inp_numero, $form_val_inp_numero);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                          <div class="form-group">
                            <?php
                              echo form_label('Bairro', 'inp_bairro', $form_label);
                              echo form_input($form_inp_bairro, $form_val_inp_bairro);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                          <div class="form-group">
                            <?php
                              echo form_label('CEP', 'inp_cep', $form_label);
                              echo form_input($form_inp_cep, $form_val_inp_cep);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <?php
                              echo form_label('Complemento', 'inp_complemento', $form_label);
                              echo form_input($form_inp_complemento, $form_val_inp_complemento);
                            ?>
                          </div>
                        </div>
                      </div>

                      <h3 class="heading">Caracteristicas Opcionais</h3>
                      <div class="row mb-20">
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_viaAcesso" id="ck_viaAcesso" <?php if($ci_viaAcesso){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_viaAcesso">
                                Próximo a Via de Acesso
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_escola" id="ck_escola" <?php if($ci_escola){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_escola">
                                Próximo a Escola
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_transPub" id="ck_transPub" <?php if($ci_transPub){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_transPub">
                                Próximo a Transporte Público
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_shopping" id="ck_shopping" <?php if($ci_shopping){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_shopping">
                                Próximo a Shopping
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_hospital" id="ck_hospital" <?php if($ci_hospital){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_hospital">
                                Próximo a Hospital
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_arCondicionado" id="ck_arCondicionado" <?php if($ci_arCondicionado){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_arCondicionado">
                                Ar Condicionado
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_segFullTime" id="ck_segFullTime" <?php if($ci_segFullTime){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_segFullTime">
                                Segurança 24hrs
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_quintal" id="ck_quintal" <?php if($ci_quintal){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_quintal">
                                Quintal
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_sacada" id="ck_sacada" <?php if($ci_sacada){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_sacada">
                                Sacada
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_areaServico" id="ck_areaServico" <?php if($ci_areaServico){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_areaServico">
                                Área de Serviço
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_condAberto" id="ck_condAberto" <?php if($ci_condAberto){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_condAberto">
                                Condomínio Aberto
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_condFechado" id="ck_condFechado" <?php if($ci_condFechado){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_condFechado">
                                Condomínio Fechado
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_circSeg" id="ck_circSeg" <?php if($ci_circSeg){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_circSeg">
                                Circuito de Segurança
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_interfone" id="ck_interfone" <?php if($ci_interfone){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_interfone">
                                Interfone
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_churrasqueira" id="ck_churrasqueira" <?php if($ci_churrasqueira){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_churrasqueira">
                                Churrasqueira
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_piscina" id="ck_piscina" <?php if($ci_piscina){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_piscina">
                                Piscina
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_jardim" id="ck_jardim" <?php if($ci_jardim){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_jardim">
                                Jardim
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_parque" id="ck_parque" <?php if($ci_parque){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_parque">
                                Parque
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_quadraPolies" id="ck_quadraPolies" <?php if($ci_quadraPolies){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_quadraPolies">
                                Quadra Poliesportiva
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_espGourmet" id="ck_espGourmet" <?php if($ci_espGourmet){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_espGourmet">
                                Espaço Gourmet
                              </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check checkbox-theme">
                              <input class="form-check-input" type="checkbox" value="1" name="ck_internet" id="ck_internet" <?php if($ci_internet){echo 'checked="checked"';} ?>>
                              <label class="form-check-label" for="ck_internet">
                                Internet
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <h3 class="heading">Fotos do Imóvel</h3>
                      <div class="row mb-20">
                        <div class="col-lg-12">
                          <div id="image-preview">
                            <label for="img-upload-imovel" id="image-label">Enviar Novas Fotos</label>
                            <input type="file" name="inp_imagem" id="img-upload-imovel" multiple="multiple" />
                          </div>
                        </div>
                      </div>
                      <div id="boximg" class="row mb-40">
                        <?php
                          $html = '';
                          if($qtd_imoft > 0) {
                            $colunas = 'col-sm-2 col-xs-4';
                            $colunas = ($qtd_imoft==2) ? 'col-sm-6 col-xs-6' : $colunas;
                            $colunas = ($qtd_imoft==3) ? 'col-sm-4 col-xs-4' : $colunas;
                            $colunas = ($qtd_imoft==4) ? 'col-sm-3 col-xs-6' : $colunas;

                            for($i=0; $i<$qtd_imoft; $i++):
                              $link_foto = base_url(ASSETS_UPLOADS.$_usu_id.'/'.$res_imoft[$i]['imoft_arquivo']);
                              $html .= '<div class="'.$colunas.' text-center">';
                                $html .= '<img src="'.$link_foto.'" alt="Foto '.$i.'" class="img-fluid" style="max-height:90px;" />';
                                $html .= '<hr>';
                                $html .= '<a href="javascript:void(0);" class="confirm-remover-foto" data-url="'.base_url(MODULO_PAINEL.'imovel/remover-foto/'.$imo_id.'/'.$res_imoft[$i]['imoft_id']).'"><i class="fa fa-ban"></i> Remover</a>';
                              $html .= '</div>';
                            endfor;
                          } else {
                            $html .= '<div class="col-lg-12">';
                              $html .= '<p>Nenhuma foto localizada para este imóvel, envie algumas fotos usando o campo acima.</p>';
                            $html .= '</div>';
                          }

                          echo $html;
                        ?>
                      </div>

                      <h3 class="heading">Informações/Detalhes Adicionais</h3>
                      <div class="row mb-40">
                        <div class="col-lg-6 col-md-6">
                          <div class="form-group">
                            <?php
                              echo form_label('Data da Construção', 'inp_construcao', $form_label);
                              echo form_input($form_inp_construcao, $form_val_inp_construcao);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="form-group">
                            <?php
                              echo form_label('Data da Última Reforma', 'inp_reforma', $form_label);
                              echo form_input($form_inp_reforma, $form_val_inp_reforma);
                            ?>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group message">
                            <?php
                              echo form_label('Observações Adicionais', 'tex_obs', $form_label);
                              echo form_textarea($form_tex_obs, $form_val_tex_obs);
                            ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12 text-right">
                        <br><hr><br>
                        <button type="submit" name="bt-submit" class="btn btn-md btn-color">
                          Atualizar
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
