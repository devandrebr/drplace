<div class="blog-section content-area-2">
    <div class="container">
      <div class="main-title">
        <h1>Todos os artigos do site</h1>
      </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12">
              <?php
                if( $qtd > 0 ) {

                  for($i=0; $i<$qtd; $i++):

                    $id = $res[$i]['art_id'];
                    $slug = $res[$i]['art_slug'];
                    $usu_nome = $res[$i]['usu_nome'];
                    $titulo = $res[$i]['art_titulo'];
                    $conteudo = cortar_string(strip_tags($res[$i]['art_conteudo']), 200);
                    $img = $res[$i]['art_imgPrincipal'];
                    $data_cadastro = converte_data($res[$i]['art_dataCadastro']);
                    $data_artigo = get_data_artigo($data_cadastro);

                    $link_detalhe = base_url('artigo/'.$slug);
                    $link_img = base_url(ASSETS_ARTIGOS.$img);
              ?>
                    <div class="blog-grid-box">
                      <img class="blog-theme img-fluid" src="<?php echo $link_img; ?>" alt="blog-3">
                      <div class="detail">
                        <div class="date-box">
                          <h5><?php echo $data_artigo['dia'] ?></h5>
                          <h5><?php echo $data_artigo['mes'] ?></h5>
                        </div>
                        <h2>
                          <a href="<?php echo $link_detalhe ?>"><?php echo $titulo ?></a>
                        </h2>
                        <div class="post-meta">
                          <span><a><i class="fa fa-user"></i><?php echo $usu_nome ?></a></span>
                          <span><a><i class="fa fa-clock"></i><?php echo get_string_data($data_cadastro) ?></a></span>
                        </div>
                        <p><?php echo $conteudo ?></p>
                        <a href="<?php echo $link_detalhe ?>" class="btn-read-more">Veja Mais</a>
                      </div>
                    </div>
              <?php
                  endfor;

                  echo $paginacao;
                }
              ?>
            </div>
        </div>
    </div>
</div>
