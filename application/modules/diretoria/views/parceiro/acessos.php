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
        <h4 class="card-title">Acessos</h4>
        <div class="table-responsive">
          <table id="tb-lista-acesso" class="table table-bordered table-striped">
            <thead class="bg-info">
              <tr>
                <th class="text-center">Data</th>
                <th class="text-center">I.P.</th>
                <th class="text-center">S.O.</th>
                <th class="text-center">Navegador</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $html = '';
                for( $i=0; $i<$qtd; $i++ ):
                  $id = $res[$i]['parace_id'];
                  $data = converte_data($res[$i]['parace_data']);
                  $endereco_ip = $res[$i]['parace_enderecoIp'];
                  $user_agent = $res[$i]['parace_navegador'];
                  $os = get_OS( $user_agent );
                  $browser = get_browser_modificado( $user_agent );

                  $html .= '<tr>';
                    $html .= '<td>'.$data.'</td>';
                    $html .= '<td>'.$endereco_ip.'</td>';
                    $html .= '<td>'.$os.'</td>';
                    $html .= '<td>'.$browser.'</td>';
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
