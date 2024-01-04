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
    $msg = 'Nenhum registro encontrado até o momento, tente novamente.';
    echo monta_box_mensagem_aviso_admin( $msg, $status );
  }
  else
  {
?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Controle dos links dos parceiros e campanhas</h4>
        <div class="table-responsive">
          <table id="tb-lista-parceiro" class="table table-bordered table-striped">
            <thead class="bg-info">
              <tr>
                <th class="text-center">Nome</th>
                <th class="text-center">Link</th>
                <th class="text-center">Acessos</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $html = '';
                for( $i=0; $i<$qtd; $i++ ):
                  $id = $res[$i]['parc_id'];
                  $nome = $res[$i]['parc_nome'];
                  $slug = $res[$i]['parc_slug'];
                  $link = base_url('p/'.$slug);
                  $qtd_acesso = str_pad($res[$i]['qtd_acesso'], 4, "0", STR_PAD_LEFT);;

                  $link_acesso  = base_url( $_modulo . $_controller . '/acessos/' . $id . '/' . url_slug($nome) );

                  $html .= '<tr>';
                    $html .= '<td>'.$nome.'</td>';
                    $html .= '<td>'.$link.'</td>';
                    $html .= '<td class="tdacao td-edt">';
                      $html .= '<a href="'.$link_acesso.'" data-toggle="tooltip" data-placement="left" title="Acessos">';
                        $html .= '<i class="fa fa-chart-line"></i> ';
                        $html .= $qtd_acesso;
                      $html .= '</a>';
                    $html .= '</td>';
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
