<div class="user-page">
  <div class="container">
    <h3 class="heading">Imóveis Favoritados no Portal</h3>
    <?php
      if( $_msg_status )
        echo monta_box_mensagem_status( $_msg_status );
    ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="my-properties box-imo-favoritos">
          <?php
            if( $qtd == 0 ) {
              $status = 'aviso';
              $msg = 'Você não favoritou nenhum imóvel, navegue pelo <a href="'.base_url(MODULO_PORTAL).'">portal.</a> e salve os seus favoritos';
              echo monta_box_mensagem_status( array('status'=>$status,'msg'=>$msg) );
            } else {
          ?>
            <table class="table">
              <thead>
                <tr>
                  <th>Imóvel</th>
                  <th>Localização</th>
                  <th>Favoritado em</th>
                  <th>Remover</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $html = '';
                  for( $i=0; $i<$qtd; $i++ ):
                    $id = $res[$i]['imo_id'];
                    $titulo = $res[$i]['imo_titulo'];
                    $cid_nome = $res[$i]['cid_nome'];
                    $cid_sigla = $res[$i]['cid_sigla'];
                    $data_cad = converte_data($res[$i]['imfav_dataCadastro']);
                    $valor = converte_moeda($res[$i]['imo_valor'],'BRL');
                    $img = $res[$i]['imo_img'];
                    $slug = url_slug($titulo);

                    $localizacao = $cid_nome.'/'.$cid_sigla;

                    $imo_id_favorito = (int)$res[$i]['imfav_id'];

                    $link = base_url(MODULO_PORTAL.'imovel/detalhe-anuncio/'.$id.'/'.$slug);
                    $link_del = base_url(MODULO_PAINEL.'imovel/remover-favorito/'.$imo_id_favorito.'/'.$slug);
                    $path_img = PATH_UPLOAD.$_usu_id.'/'.$img;
                    $link_img = (!is_dir($path_img) && is_file($path_img)) ? base_url(ASSETS_UPLOADS.$_usu_id.'/'.$img) : '';

                    $html .= '<tr>';
                      $html .= '<td class="image text-center">';
                        $html .= '<a href="'.$link.'">';
                          if( $link_img != '' )
                            $html .= '<img alt="'.$titulo.'" src="'.$link_img.'" class="img-fluid">';
                          else
                            $html .= 'Sem Foto';
                        $html .= '</a>';
                      $html .= '</td>';
                      $html .= '<td>';
                        $html .= '<div class="inner">';
                          $html .= '<a href="'.$link.'"><h2>'.$titulo.'</h2></a>';
                          $html .= '<span><i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i> '.$localizacao.'</span>';
                          if($valor != '')
                            $html .= '<div class="tag price">R$ '.$valor.'</div>';
                        $html .= '</div>';
                      $html .= '</td>';
                      $html .= '<td>'.$data_cad.'</td>';
                      $html .= '<td class="text-center">';
                        $html .= '<a href="javascript:void(0);" class="confirm-remover-imovel-favorito btn btn-theme" data-url="'.$link_del.'">';
                          $html .= '<i class="delete fas fa-heart"></i>';
                        $html .= '</a>';
                      $html .= '</td>';
                    $html .= '</tr>';
                  endfor;

                  echo $html;
                ?>
              </tbody>
            </table>
          </div>
        <?php
            echo $paginacao;
          }
        ?>
      </div>
    </div>
  </div>
</div>
