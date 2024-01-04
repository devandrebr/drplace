<div class="row page-titles">
  <div class="col-md-9 col-sm-8 col-xs-12 align-self-center">
    <h3 class="text-themecolor"><?php echo $_titulo_page ?></h3>
    <?php echo $_breadcrumb ?>
  </div>
  <div class="col-md-3 col-sm-4 col-xs-12 align-self-center text-right d-none d-md-block">
    <a href="<?php echo base_url($_modulo.$_controller.'/novo') ?>" class="btn btn-success">
      <i class="mdi mdi-file-document m-r-5"></i> Novo Artigo
    </a>
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
        <h4 class="card-title">Lista de artigos cadastrados na plataforma</h4>
        <div class="table-responsive">
          <table id="tb-lista-artigo" class="table table-hover table-striped table-bordered">
            <thead class="bg-info">
              <tr>
                <th class="text-center">Artigo</th>
                <th class="text-center" width="160">Data Cadastro</th>
                <th class="text-center" colspan="3">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $html = '';
                for( $i=0; $i<$qtd; $i++ ):
                  $id = $res[$i]['art_id'];
                  $slug = $res[$i]['art_slug'];
                  $titulo = $res[$i]['art_titulo'];
                  $data_cad = converte_data($res[$i]['art_dataCadastro']);

                  $url_view  = base_url('artigo/'.$slug );
                  $url_editar  = base_url( $_modulo . $_controller . '/editar/' . $id . '/' . $slug );
                  $url_deletar = base_url( $_modulo . $_controller . '/remover/' . $id . '/' . $slug );

                  $html .= '<tr>';
                    $html .= '<td>'.$titulo.'</td>';
                    $html .= '<td>'.$data_cad.'</td>';
                    $html .= '<td class="tdacao td-edt">';
                      $html .= '<a href="'.$url_view.'" data-toggle="tooltip" data-placement="left" title="Visualizar">';
                        $html .= '<i class="fa fa-eye"></i>';
                      $html .= '</a>';
                    $html .= '</td>';
                    $html .= '<td class="tdacao td-edt">';
                      $html .= '<a href="'.$url_editar.'" data-toggle="tooltip" data-placement="left" title="Editar">';
                        $html .= '<i class="fa fa-edit"></i>';
                      $html .= '</a>';
                    $html .= '</td>';
                    $html .= '<td class="tdacao td-del">';
                      $html .= '<a href="javascript:void(0);" class="confirm-remover-artigo" data-url="'.$url_deletar.'" data-toggle="tooltip" data-placement="left" title="Remover">';
                        $html .= '<i class="fa fa-ban"></i>';
                      $html .= '</a>';
                    $html .= '</td>';
                  $html .= '</tr>';
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
