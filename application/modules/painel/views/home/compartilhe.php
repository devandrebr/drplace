<div class="user-page">
  <div class="container">
    <h3 class="heading"><?php echo $_titulo_page ?></h3>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <a href="https://www.facebook.com/share.php?u=<?php echo base_url() ?>">
          Facebook
        </a>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url() ?>&title=<?php echo $_titulo ?>&source=">
          LinkedIn
        </a>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <a href="https://api.whatsapp.com/send?text=<?php echo 'Estou compartilhando o site'.base_url().' com vc!'; ?>">
          WhatsApp
        </a>
      </div>
    </div>
  </div>
</div>
