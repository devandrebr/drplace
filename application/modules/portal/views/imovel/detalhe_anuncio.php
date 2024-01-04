<?php
  $cid_sigla = $res['cid_sigla'];
  $cid_nome = $res['cid_nome'];
  $usu_id = $res['usu_id'];
  $imo_id = $res['imo_id'];
  $imo_codigo = $res['imo_codigo'];
  $imo_titulo = $res['imo_titulo'];
  $imo_descricao = $res['imo_descricao'];
  $imo_logradouro = $res['imo_logradouro'];
  $imo_numero = $res['imo_numero'];
  $imo_bairro = $res['imo_bairro'];
  $imo_complemento = $res['imo_complemento'];
  $imo_cep = $res['imo_cep'];
  $imo_valor = ($res['imo_valor'] != '') ? converte_moeda($res['imo_valor'],'BRL') : 'Não Informado';
  $imo_dataCadastro = converte_data($res['imo_dataCadastro']);
  $imo_dataEdicao = converte_data($res['imo_dataEdicao']);
  $imo_ultimaReforma = converte_data($res['imo_ultimaReforma']);
  $imo_construcao = converte_data($res['imo_construcao']);
  $imo_situacao = $res['imo_situacao'];
  $imo_valorIptu = $res['imo_valorIptu'];
  $imo_valorCondominio = $res['imo_valorCondominio'];
  $imo_valorVenda = ($res['imo_valorVenda'] != '') ? ' / '.converte_moeda($res['imo_valorVenda'],'BRL').' (Venda)' : '';
  $imtip_titulo = $res['imtip_titulo'];
  $usu_id = $res['usu_id'];
  $usu_nome = $res['usu_nome'];
  $usu_foto = $res['usu_foto'];
  $usu_cidade = ($res['usu_cid_nome'] != '') ? $res['usu_cid_nome'].'/'.$res['usu_cid_sigla'] : '';
  $usu_dataCad = converte_data($res['usu_dataCadastro']);
  list($data,$hora) = explode(' ',$usu_dataCad);
  $usu_dataCad = $data;

  $id_chat = (int)$res['imomsg_id'];

  $imo_id_favorito = (int)$res['imfav_id'];
  $icone_imo_favorito = ($imo_id_favorito == 0 || $usu_id == $_usu_id) ? 'far fa-heart' : 'fas fa-heart';
  $btn_imo_favorito = ($imo_id_favorito == 0 || $usu_id == $_usu_id) ? 'btn-warning' : 'btn-success';

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

  $endereco = ($imo_logradouro != '') ? $imo_logradouro : '';
  $endereco .= ($imo_numero != '') ? ', n '.$imo_numero : '';
  $endereco .= ($imo_bairro != '') ? ', '.$imo_bairro : '';
  $endereco .= ($imo_complemento != '') ? ' - '.$imo_complemento : '';
  $endereco .= ($cid_nome != '') ? ' '.$cid_nome.'/'.$cid_sigla : '';

  $link_avatar = ($usu_foto != '') ? base_url(ASSETS_AVATAR.$usu_id.'/'.$usu_foto) : base_url(ASSETS_AVATAR.'avatar-default.jpg');

  $_msg = 'Olá '.$usu_nome.', estou interessado no seu imóvel '.$imo_titulo.' e gostaria de mais informações sobre o mesmo.'.PHP_EOL.'Poderia entrar em contato comigo ?';
?>
<div class="pag-det-imovel properties-details-page content-area-15">
  <div class="container">
    <?php
      if( validation_errors() != '' )
        echo '<div class="row"><div class="col-md-12"><div class="alert alert-danger fade show" role="alert">'.validation_errors('<p>', '</p>').'</div></div></div>';

      if( $_msg_status )
        echo monta_box_mensagem_status( $_msg_status );
    ?>
    <div class="row">
      <div class="col-lg-12">
        <div id="propertiesDetailsSlider" class="carousel properties-details-sliders slide mb-60">
          <div class="heading-properties">
            <div class="row">
              <div class="col-md-11 col-sm-9 col-xs-8">
                <div class="pull-left">
                  <h3><?php echo $imo_titulo ?></h3>
                  <p><i class="fa fa-map-marker"></i> <?php echo $endereco ?></p>
                </div>
                <div class="p-r">
                  <h3>R$ <?php echo $imo_valor.$imo_valorVenda ?></h3>
                </div>
              </div>
              <div class="col-md-1 col-sm-3 col-xs-4 text-center">
                <button type="button" name="btn-favorito" class="btn-favorito btn btn-block <?php echo $btn_imo_favorito ?>" id="btn-favorito" data-idimovel="<?php echo $imo_id ?>" data-id="<?php echo $imo_id_favorito ?>"><i class="<?php echo $icone_imo_favorito ?>"></i></button>
              </div>
            </div>
          </div>
          <?php
            if( $qtd_ft > 0 )
            {
              $c=0;
              $html2 = '<ul class="carousel-indicators smail-properties list-inline nav nav-justified">'; #indicadores(slide)
              $html1 = '<div class="carousel-inner">'; #slide
                for($i=0; $i<$qtd_ft; $i++):
                  $active = ($c==0) ? 'active ' : '';
                  $selected = ($c==0) ? 'class="selected" ' : '';

                  $path_foto = PATH_UPLOAD.$usu_id.'/'.$res_ft[$i]['imoft_arquivo'];
                  $imo_foto = base_url(ASSETS_UPLOADS.$usu_id.'/'.$res_ft[$i]['imoft_arquivo']);
                  if( is_file($path_foto) && !is_dir($path_foto) ) {
                    $html1 .= '<div class="'.$active.'item carousel-item" data-slide-number="'.$c.'">';
                      $html1 .= '<img src="'.$imo_foto.'" class="img-fluid" alt="Foto Imóvel '.$c.'">';
                    $html1 .= '</div>';

                    $html2 .= '<li class="'.$active.'list-inline-item" data-slide-number="'.$c.'">';
                      $html2 .= '<a id="carousel-selector-'.$c.'" '.$selected.'data-slide-to="'.$c.'" data-target="#propertiesDetailsSlider">';
                        $html2 .= '<img src="'.$imo_foto.'" class="img-fluid" alt="Foto Imóvel '.$c.'">';
                      $html2 .= '</a>';
                    $html2 .= '</li>';

                    $c++;
                  }
                endfor;
                $html1 .= '<a class="carousel-control left" href="#propertiesDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
                $html1 .= '<a class="carousel-control right" href="#propertiesDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>';
              $html1 .= '</div>';

              $html2 .= '</ul>';

              echo $html1;
              echo $html2;
            }
            else
            {
              $c=0;
              $active = 'active ';
              $selected = 'class="selected" ';
              $imo_foto = base_url(ASSETS_UPLOADS.'imovel_sem_foto.jpg');

              $html2 = '<ul class="carousel-indicators smail-properties list-inline nav nav-justified">'; #indicadores(slide)
              $html1 = '<div class="carousel-inner">'; #slide
                $html1 .= '<div class="'.$active.'item carousel-item" data-slide-number="'.$c.'">';
                  $html1 .= '<img src="'.$imo_foto.'" class="img-fluid" alt="Foto Imóvel '.$c.'">';
                $html1 .= '</div>';

                $html2 .= '<li class="'.$active.'list-inline-item" data-slide-number="'.$c.'">';
                  $html2 .= '<a id="carousel-selector-'.$c.'" '.$selected.'data-slide-to="'.$c.'" data-target="#propertiesDetailsSlider">';
                    $html2 .= '<img src="'.$imo_foto.'" class="img-fluid" alt="Foto Imóvel '.$c.'">';
                  $html2 .= '</a>';
                $html2 .= '</li>';
                $html1 .= '<a class="carousel-control left" href="#propertiesDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
                $html1 .= '<a class="carousel-control right" href="#propertiesDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>';
              $html1 .= '</div>';

              $html2 .= '</ul>';

              echo $html1;
              echo $html2;
            }
          ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-12 slider">

        <div class="tabbing tabbing-box mb-60">
          <ul class="nav nav-tabs" id="carTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active show" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="one" aria-selected="false">Descrição</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="true">Características</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="three" aria-selected="true">Localização</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="four" aria-selected="true">Imóveis Semelhantes</a>
            </li>
          </ul>
          <div class="tab-content" id="carTabContent">

            <div class="tab-pane fade active show" id="one" role="tabpanel" aria-labelledby="one-tab">
              <h3 class="heading">Descrição do Imóvel</h3>
              <div class="col-md-12">
                <?php echo $imo_descricao ?>
              </div>
              <div class="floor-plans mt-20 mb-20">
                <table>
                  <tbody>
                    <tr>
                      <td><strong>Área</strong></td>
                      <td><strong>Dormitórios</strong></td>
                      <td><strong>Banheiros</strong></td>
                      <td><strong>Vagas Garagem</strong></td>
                    </tr>
                    <tr>
                      <td><?php echo $ci_area ?> m²</td>
                      <td><?php echo $ci_dormitorio ?></td>
                      <td><?php echo $ci_banheiro ?></td>
                      <td><?php echo $ci_garagem ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="property-details">
                <div class="row">
                  <div class="col-md-5 col-sm-6">
                    <ul>
                      <li><strong>Preço:</strong>R$<?php echo $imo_valor.$imo_valorVenda ?></li>
                      <li><strong>Tipo:</strong> <?php echo $imtip_titulo ?></li>
                      <li><strong>Proprietário:</strong> <?php echo $usu_nome ?></li>
                    </ul>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <ul>
                      <li><strong>Área do Imóvel:</strong> <?php echo $ci_area ?> m²</li>
                      <li><strong>Garagem:</strong> <?php echo $ci_garagem ?> vaga(s)</li>
                      <li><strong>Banheiro(s):</strong> <?php echo $ci_banheiro ?></li>
                    </ul>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <ul>
                      <li><strong>Quarto(s):</strong> <?php echo $ci_dormitorio ?></li>
                      <li><strong>Cidade/UF:</strong> <?php echo $cid_nome.'/'.$cid_sigla ?></li>
                      <li><strong>CEP:</strong> <?php echo $imo_cep ?></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
              <div class="amenities-box">
                <h3 class="heading">Carateristícas Do Imóvel</h3>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li><span><i class="flaticon-bed"></i> <?php echo $ci_dormitorio ?> Dormitório(s)</span></li>
                      <li><span><i class="flaticon-bath"></i> <?php echo $ci_banheiro ?> Banheiro(s)</span></li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li><span><i class="flaticon-car-repair"></i> <?php echo $ci_garagem ?> Vagas na Garagem</span></li>
                      <li><span><i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <?php echo $ci_area ?> m²</span></li>
                    </ul>
                  </div>
                </div>
                <hr>
                <br>
                <div class="row">
                  <div class="col-md-4 col-sm-6">
                    <?php
                      $lista1 = '<ul>';
                        if( $ci_arCondicionado )
                          $lista1 .= '<li><i class="fas fa-check-circle"></i> Ar Condicionado</li>';
                        if( $ci_viaAcesso )
                          $lista1 .= '<li><i class="fas fa-check-circle"></i> Próximo a Via de Acesso</li>';
                        if( $ci_shopping )
                          $lista1 .= '<li><i class="fas fa-check-circle"></i> Próximo a Shopping</li>';
                        if( $ci_hospital )
                          $lista1 .= '<li><i class="fas fa-check-circle"></i> Próximo a Hospital</li>';
                        if( $ci_escola )
                          $lista1 .= '<li><i class="fas fa-check-circle"></i> Próximo a Escola</li>';
                        if( $ci_transPub )
                          $lista1 .= '<li><i class="fas fa-check-circle"></i> Próximo a Transporte Público</li>';
                        if( $ci_internet )
                          $lista1 .= '<li><i class="fas fa-check-circle"></i> Internet</li>';
                      $lista1 .= '</ul>';
                      echo $lista1;
                    ?>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <?php
                      $lista2 = '<ul>';
                        if( $ci_quintal )
                          $lista2 .= '<li><i class="fas fa-check-circle"></i> Quintal</li>';
                        if( $ci_espGourmet )
                          $lista2 .= '<li><i class="fas fa-check-circle"></i> Espaço Gourmet</li>';
                        if( $ci_quadraPolies )
                          $lista2 .= '<li><i class="fas fa-check-circle"></i> Quadra Poliesportiva</li>';
                        if( $ci_piscina )
                          $lista2 .= '<li><i class="fas fa-check-circle"></i> Piscina</li>';
                        if( $ci_churrasqueira )
                          $lista2 .= '<li><i class="fas fa-check-circle"></i> Churrasqueira</li>';
                        if( $ci_jardim )
                          $lista2 .= '<li><i class="fas fa-check-circle"></i> Jardim</li>';
                        if( $ci_interfone )
                          $lista1 .= '<li><i class="fas fa-check-circle"></i> Interfone</li>';
                      $lista2 .= '</ul>';
                      echo $lista2;
                    ?>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <?php
                      $lista3 = '<ul>';
                        if( $ci_circSeg )
                          $lista3 .= '<li><i class="fas fa-check-circle"></i> Circuito de Segurança Fechado</li>';
                        if( $ci_condFechado )
                          $lista3 .= '<li><i class="fas fa-check-circle"></i> Condomínio Fechado</li>';
                        if( $ci_condAberto )
                          $lista3 .= '<li><i class="fas fa-check-circle"></i> Condomínio Aberto</li>';
                        if( $ci_areaServico )
                          $lista3 .= '<li><i class="fas fa-check-circle"></i> Área de Serviço</li>';
                        if( $ci_segFullTime )
                          $lista3 .= '<li><i class="fas fa-check-circle"></i> Segurança 24 horas</li>';
                        if( $ci_parque )
                          $lista3 .= '<li><i class="fas fa-check-circle"></i> Parque</li>';
                        if( $ci_sacada )
                          $lista3 .= '<li><i class="fas fa-check-circle"></i> Sacada</li>';
                      $lista3 .= '</ul>';
                      echo $lista3;
                    ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="three" role="tabpanel" aria-labelledby="three-tab">
              <div class="section location">
                <h3 class="heading">Localização</h3>
                <p><i class="fa fa-map-marker"></i> <?php echo $endereco ?></p>
                <hr>
                <div class="map">
                  <div id="map-localizacao-imovel" class="contact-map"></div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="four" role="tabpanel" aria-labelledby="four-tab">
              <div class="section location">
                <h3 class="heading">Imóveis Sugeridos</h3>
                <p>Em desenvolvimento...</p>
              </div>
            </div>

          </div>
        </div>
        <div class="row info-politica">
          <div class="col-md-12">
            <h4>Termos de uso</h4>
            <hr>
            <p>
              O parceiro que anuncia nesta página é o único responsável pelas transações comerciais que realizar com usuários do web site da Dr.Place.
              A comercialização e/ou locação do imóvel anunciado, bem como a garantia de sua legítima procedência, é de inteira responsabilidade do anunciante,
              não sendo a Dr.Place responsável por quaisquer danos diretos e/ou indiretos causados a terceiros,
              advindos da exibição dos anúncios em desacordo com o Código de Defesa do Consumidor e outras legislações aplicáveis
              ao comércio e/ou prestação de serviços por parte do anunciante. Para oferecer uma melhor experiência de navegação,
              a Dr.Place utiliza cookies. Ao navegar pelo site você concorda com o uso dos mesmos.
              <a href="<?php echo base_url('politica-de-privacidade') ?>">Entenda mais, continue lendo.</a>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-12">
        <div class="sidebar mbl">
          <!-- <div class="widget categories">
            <h5 class="sidebar-title">Categorias</h5>
            <ul>
              <li><a href="#">Apartamentos<span>(12)</span></a></li>
              <li><a href="#">Casas<span>(8)</span></a></li>
              <li><a href="#">Casas Comerciais<span>(23)</span></a></li>
              <li><a href="#">Escritórios<span>(5)</span></a></li>
              <li><a href="#">Terrenos<span>(63)</span></a></li>
              <li><a href="#">Outros<span>(7)</span></a></li>
            </ul>
          </div> -->
          <div class="widget info-proprietario">
            <h5 class="sidebar-title">Sobre o Proprietário</h5>
            <div class="row">
            <div class="col-sm-5 col-xs-12 text-center">
              <img src="<?php echo $link_avatar ?>" alt="<?php echo $usu_nome ?>" class="img-fluid img-avatar" />
            </div>
            <div class="col-sm-7 col-xs-12">
              <ul class="text-right">
                <li><b>Nome</b><br><?php echo $usu_nome ?></li>
                <li><b>Membro Desde</b><br><?php echo $usu_dataCad ?></li>
                <?php if( $usu_cidade != '' ) { ?>
                  <li><b>Cidade</b><br><?php echo $usu_cidade ?></li>
                <?php } ?>
              </ul>
            </div>
            </div>
          </div>
          <hr>
          <div class="widget contato-proprietario">
            <h5 class="sidebar-title">Enviar Mensagem</h5>
            <?php
              $form_act = base_url(MODULO_PORTAL.'contato/enviar-contato-proprietario');
              $form_atr = array('method' => 'post', 'id' => 'form', 'name' => 'form',
                                  'class' => 'form form-bv', 'autocomplete' => 'off', 'role' => 'form' );

              $form_label = array('class' => 'control-label');

              $form_inp_nome = array('name' => 'inp_nome', 'id' => 'inp_nome', 'class' => 'form-control', 'placeholder' => 'Nome', 'maxlength' => '120', 'data-bv-notempty' => 'true' );
              $form_inp_telefone = array('name' => 'inp_telefone', 'id' => 'inp_telefone', 'class' => 'form-control m_telefone', 'placeholder' => 'Telefone', 'data-bv-notempty' => 'true' );
              $form_inp_email = array('name' => 'inp_email', 'id' => 'inp_email', 'placeholder' => 'E-mail', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'data-bv-emailaddress' => 'true' );
              $form_tex_msg = array('name' => 'tex_msg', 'id' => 'tex_msg', 'class' => 'form-control', 'placeholder' => 'Escreva sua mensagem...', 'data-bv-notempty' => 'true' );

              $form_val_inp_nome = set_value( 'inp_nome', $_usu_logado_nome );
              $form_val_inp_telefone = set_value( 'inp_telefone', $_usu_telefone );
              $form_val_inp_email = set_value( 'inp_email', $_usu_email );
              $form_val_tex_msg = set_value( 'tex_msg', $_msg );

              $form_hidden = array( 'imo_id' => $imo_id, 'imsg_id' => $id_chat );
              echo form_open( $form_act, $form_atr, $form_hidden );
            ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">* Mensagem</label>
                    <?php echo form_textarea($form_tex_msg,$form_val_tex_msg); ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">* Nome</label>
                    <?php echo form_input($form_inp_nome,$form_val_inp_nome); ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">* Telefone</label>
                    <?php echo form_input($form_inp_telefone,$form_val_inp_telefone); ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <?php echo form_email($form_inp_email,$form_val_inp_email); ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group box-recaptcha">
                    <script src='https://www.google.com/recaptcha/api.js'></script>
                    <div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_SITE_RECAPTCHA ?>"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mt-10">
                    <button type="submit" class="btn btn-color btn-md btn-message btn-block">Enviar</button>
                  </div>
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
