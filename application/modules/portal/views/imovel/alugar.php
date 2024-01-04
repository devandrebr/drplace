<div class="properties-list-fullwidth content-area-2">
  <div class="container">
    <div class="main-title">
      <h1>Imóveis Disponíveis Para Locação</h1>
    </div>
    <div class="option-bar">
      <div class="row clearfix">
        <div class="col-md-12">
          <h4>
            <span class="heading-icon">
              <i class="fa fa-caret-right icon-design"></i>
              <i class="fa fa-th-large"></i>
            </span>
            <span class="heading">Lista de Imóveis Para Alugar</span>
          </h4>
        </div>
      </div>
    </div>
    <div class="subtitle">
      <b><?php echo $qtd_total ?></b> imóveis encontrados
    </div>
    <?php
      if( $qtd == 0 )
      {
        $msg = array();
        $msg['status'] = 'info';
        $msg['msg'] = 'Nenhum imóvel localizado para alugar.';
        echo monta_box_mensagem_status($msg);
      }
      else
      {
        echo '<div class="row">';
          for($i=0; $i<$qtd; $i++):
            $id = $res[$i]['imo_id'];
            $usu_id = $res[$i]['usu_id'];
            $usu_nome = $res[$i]['usu_nome'];
            $usu_foto = $res[$i]['usu_foto'];
            $titulo = $res[$i]['imo_titulo'];
            $endereco = $res[$i]['imo_logradouro'];
            $numero = $res[$i]['imo_numero'];
            $bairro = $res[$i]['imo_bairro'];
            $complemento = $res[$i]['imo_complemento'];
            $cid_nome = $res[$i]['cid_nome'];
            $cid_sigla = $res[$i]['cid_sigla'];
            $data_cad = converte_data($res[$i]['imo_dataCadastro']);
            $valor = ($res[$i]['imo_valor'] != '') ? 'R$ '.converte_moeda($res[$i]['imo_valor'],'BRL') : 'Não Informado';
            $valorVenda = ($res[$i]['imo_valorVenda'] != '') ? ' / '.converte_moeda($res[$i]['imo_valorVenda'],'BRL').' (Venda)' : '';
            $tipo = mb_strtoupper($res[$i]['imtip_titulo']);
            $car_garagem = $res[$i]['imcar_garagem'];
            $car_dormitorio = $res[$i]['imcar_dormitorio'];
            $car_banheiro = $res[$i]['imcar_banheiro'];
            $car_area = $res[$i]['imcar_area'];
            $img = $res[$i]['imo_img'];
            $slug = url_slug($titulo);
            list($data,$hora) = explode(' ',$data_cad);
            $data_cad = $data;

            $localizacao = $endereco;
            $localizacao .= ($numero != '') ? ', '.$numero.' ' : '';
            $localizacao .= ($cid_nome != '') ? $cid_nome.'/'.$cid_sigla : '';

            $link_det = base_url(MODULO_PORTAL.'imovel/detalhe-anuncio/'.$id.'/'.$slug);

            $path_img = PATH_UPLOAD.$usu_id.'/'.$img;
            $link_img = (!is_dir($path_img) && is_file($path_img)) ? base_url(ASSETS_UPLOADS.$usu_id.'/'.$img) : base_url(ASSETS_UPLOADS.'imovel_sem_foto.jpg');

            $link_avatar = ($usu_foto != '') ? base_url(ASSETS_AVATAR.$usu_id.'/'.$usu_foto) : base_url(ASSETS_AVATAR.'avatar-default.jpg');
    ?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="property-box box-imovel">
              <div class="property-thumbnail">
                <a href="<?php echo $link_det ?>" class="property-img">
                  <div class="tag button alt featured"><?php echo $tipo ?></div>
                  <div class="price-ratings-box">
                    <p class="price"><?php echo $valor.$valorVenda ?></p>
                    <div class="ratings">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                  </div>
                  <img src="<?php echo $link_img ?>" alt="<?php echo $titulo ?>" class="img-fluid">
                </a>
              </div>
              <div class="detail">
                <h1 class="title">
                  <a href="<?php echo $link_det ?>"><?php echo $titulo ?></a>
                </h1>
                <div class="location">
                  <a href="<?php echo $link_det ?>">
                    <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>
                    <?php echo $localizacao ?>
                  </a>
                </div>
                <ul class="facilities-list clearfix">
                  <li><i class="flaticon-bed"></i> <?php echo $car_dormitorio ?> Quarto(s)</li>
                  <li><i class="flaticon-bath"></i> <?php echo $car_banheiro ?> Banheiro(s)</li>
                  <li><i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <?php echo $car_area ?>m<sup>2</sup></li>
                  <li><i class="fa fa-car"></i> <?php echo $car_garagem ?> Vaga(s)</li>
                </ul>
              </div>
              <div class="footer">
                <a href="#" class="imo-avatar"><img src="<?php echo $link_avatar ?>" alt="<?php echo $usu_nome ?>" /> <?php echo $usu_nome ?></a>
                <span class="imo-data"><i class="fa fa-calendar-o"></i> <?php echo $data_cad ?></span>
              </div>
            </div>
          </div>
    <?php
        endfor;

      echo '</div>'; #row

      echo $paginacao;
    }
    ?>
  </div>
</div>
