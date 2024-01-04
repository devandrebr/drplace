<div class="user-page">
  <div class="container">
    <h3 class="heading">Lista de Interesses Cadastrados no Portal</h3>
    <?php
      if( $_msg_status )
        echo monta_box_mensagem_status( $_msg_status );
    ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="my-properties">
          <?php
            if( $qtd == 0 ) {
              $status = 'info';
              $msg = 'Nenhum interesse cadastrado até o momento, <a href="'.base_url('novo-anuncio').'">crie seu primeiro anúncio agora mesmo aqui.</a>';
              echo monta_box_mensagem_status( array('status'=>$status,'msg'=>$msg) );
            } else {
          ?>
            <table class="table">
              <thead>
                <tr>
                  <th width="70">Nome</th>
                  <th>E-mail</th>
                  <th>Mensagem</th>
                  <th class="text-center">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $html = '';
                  for( $i=0; $i<$qtd; $i++ ):
                    $id = $res[$i]['imint_id'];
                    $nome = $res[$i]['imint_nome'];
                    $ex = explode(' ',$nome);
                    $primeiro_nome = $ex[0];

                    $email = $res[$i]['imint_email'];
                    $msg = cortar_string($res[$i]['imint_msg'],30);
                    $data_cad = converte_data($res[$i]['imint_dataCadastro']);

                    $link_det = base_url(MODULO_PAINEL.'imovel/detalhe-interesse/'.$id.'/'.url_slug($msg));

                    $html .= '<tr>';
                      $html .= '<td class="text-center">'.$primeiro_nome.'</td>';
                      $html .= '<td>'.$email.'</td>';
                      $html .= '<td>'.$msg.'</td>';
                      $html .= '<td class="text-center">';
                        $html .= '<a href="'.$link_det.'" class="edit"><i class="fas fa-edit"></i></a>';
                      $html .= '</td>';
                    $html .= '</tr>';
                  endfor;

                  echo $html;
                ?>
              </tbody>
            </table>
          <?php
              echo $paginacao;
            }
          ?>
        </div>
      </div>
    </div>
    <?php
      if( $qtd2 > 0 ) {
    ?>
    <br><hr><br>
    <h3 class="heading">Meu(s) Interesse(s) Cadastrado(s)</h3>
    <div class="row">
      <div class="col-lg-12">
        <div class="my-properties">
          <table class="table">
            <thead>
              <tr>
                <th width="70">Nome</th>
                <th>Mensagem</th>
                <th class="text-center">Deletar</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $html = '';
                for( $i=0; $i<$qtd2; $i++ ):
                  $id = $res2[$i]['imint_id'];
                  $nome = $res2[$i]['imint_nome'];
                  $ex = explode(' ',$nome);
                  $primeiro_nome = $ex[0];

                  $email = $res2[$i]['imint_email'];
                  $msg = cortar_string($res2[$i]['imint_msg'],60);
                  $data_cad = converte_data($res2[$i]['imint_dataCadastro']);

                  $link_del = base_url(MODULO_PAINEL.'imovel/remover-interesse/'.$id);

                  $html .= '<tr>';
                    $html .= '<td class="text-center">'.$primeiro_nome.'</td>';
                    $html .= '<td>'.$msg.'</td>';
                    $html .= '<td class="text-center">';
                      $html .= '<a href="javascript:void(0);" class="confirm-remover-interesse" data-url="'.$link_del.'"><i class="delete fas fa-trash-alt"></i></a>';
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
    <?php
      }
    ?>
  </div>
</div>
