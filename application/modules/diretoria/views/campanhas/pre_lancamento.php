<div class="row page-titles">
  <div class="col-md-12 align-self-center">
    <h3 class="text-themecolor"><?php echo $_titulo_page ?></h3>
    <?php echo $_breadcrumb ?>
  </div>
</div>
<?php
  if( $qtd == 0 )
  {
    $status = 'warning';
    $msg = 'Ninguém realizou o cadastro, até o momento.';
    echo monta_box_mensagem_aviso_admin( $msg, $status );
  }
  else
  {
?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Usuários cadastrados no pré-lançamento da plataforma</h4>
        <div class="table-responsive">
          <table id="tb-lista-campanha1" class="table table-bordered table-striped">
            <thead class="bg-info">
              <tr>
                <th class="text-center">Nome</th>
                <th class="text-center">E-mail</th>
                <th class="text-center" width="160">Data Cadastro</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $html = '';
                $cidades = array();
                for( $i=0; $i<$qtd; $i++ ):
                  $id = $res[$i]['c1prelanc_id'];
                  $nome = $res[$i]['c1prelanc_nome'];
                  $email = $res[$i]['c1prelanc_email'];
                  $data_cad = converte_data($res[$i]['c1prelanc_dataCadastro']);

                  $html .= '<tr>';
                    $html .= '<td>'.$nome.'</td>';
                    $html .= '<td>'.$email.'</td>';
                    $html .= '<td class="text-center">'.$data_cad.'</td>';
                  $html .= '</tr>'.PHP_EOL;
                endfor;

                echo $html;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
