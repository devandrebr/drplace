<?php
  $id = $res['art_id'];
  $slug = $res['art_slug'];
  $usu_nome = $res['usu_nome'];
  $titulo = $res['art_titulo'];
  $conteudo = $res['art_conteudo'];
  $img = $res['art_imgPrincipal'];
  $data_cadastro = converte_data($res['art_dataCadastro']);
  $data_artigo = get_data_artigo($data_cadastro);

  $link_img = base_url(ASSETS_ARTIGOS.$img);

  $link_artigo = base_url('artigo/'.$slug);
?>
<div class="blog-section content-area-7">
  <div class="container">
    <div class="main-title">
      <h1>Artigo Completo</h1>
    </div>
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="blog-grid-box">
          <img class="blog-theme img-fluid" src="<?php echo $link_img ?>" alt="<?php echo $titulo ?>">
          <div class="detail">
            <div class="date-box">
              <h5><?php echo $data_artigo['dia'] ?></h5>
              <h5><?php echo $data_artigo['mes'] ?></h5>
            </div>
            <h2><?php echo $titulo ?></h2>
            <div class="post-meta">
              <span><a><i class="fa fa-user"></i><?php echo $usu_nome ?></a></span>
              <span><a><i class="fa fa-clock"></i><?php echo get_string_data($data_cadastro) ?></a></span>
            </div>
            <?php echo $conteudo ?>
            <br>
            <br>
            <hr>
            <div class="row clearfix tags-socal-box">
              <div class="col-lg-10 col-md-10 col-sm-10 offset-lg-1 offset-md-1 offset-sm-1">
                <div class="social-list">
                  <h2>Compartilhe</h2>
                  <ul>
                    <li><a href="https://www.facebook.com/share.php?u=<?php echo $link_artigo ?>" class="facebook"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://api.whatsapp.com/send?text=<?php echo 'Estou compartilhando o artigo '.$link_artigo.' da Dr.Place com vc!'; ?>" class="whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link_artigo ?>&title=<?php echo $_titulo ?>&source=" class="linkedin"><i class="fab fa-linkedin"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
