<div class="user-page">
  <div class="container">
    <h3 class="heading">Chat com as mensagens do portal</h3>
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
              $msg = 'Nenhuma mensagem enviada ou recebida até o momento.';
              echo monta_box_mensagem_status( array('status'=>$status,'msg'=>$msg) );
            } else {
          ?>
            <table class="table tb-lista-msg">
              <thead>
                <tr>
                  <th>Imóvel</th>
                  <th>Nome</th>
                  <th>Telefone</th>
                  <th>Data</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $html = '';
                  // dump($res);dump($_usu_id);die;
                  for( $i=0; $i<$qtd; $i++ ):
                    $usu_envio = (int)$res[$i]['fk_id_usuarioEnvio'];
                    $qtd_conversa = (int)$res[$i]['qtd_conversa'];
                    $id = $res[$i]['imomsg_id'];
                    $m_nome = $res[$i]['imomsg_nome'];
                    $m_telefone = $res[$i]['imomsg_telefone'];
                    $data_cad = converte_data($res[$i]['imomsg_dataCadastro']);
                    $imo_id = $res[$i]['imo_id'];
                    $titulo = $res[$i]['imo_titulo'];
                    $img = $res[$i]['imo_img'];
                    $slug = url_slug($titulo);
                    $msg_visualizada = $res[$i]['imomsg_visualizada'];
                    $nmsg = ($msg_visualizada) ? '' : ' <span class="badge badge-danger">nova</span>';

                    $qtd_conv = $res[$i]['qtd_conversa'];
                    $conv_visualizada = $res[$i]['convmsg_visualizada'];
                    $conv_usuario = $res[$i]['convmsg_usuario'];
                    if($msg_visualizada && ($nmsg == '') && !$conv_visualizada && ($conv_usuario != $_usu_id))
                      $nmsg = ' <span class="badge badge-warning">resposta</span>';

                    $link_imo = base_url(MODULO_PORTAL.'imovel/detalhe-anuncio/'.$imo_id.'/'.$slug);
                    $link = base_url(MODULO_PAINEL.'chat/conversa/'.$id);
                    $link_del = base_url(MODULO_PAINEL.'chat/remover-mensagem/'.$id);

                    $html .= '<tr>';
                      $html .= '<td class="text-center"><a href="'.$link_imo.'">'.$titulo.'</a></td>';
                      $html .= '<td><a href="'.$link.'">'.$m_nome.'</a></td>';
                      $html .= '<td><a href="'.$link.'">'.$m_telefone.'</a></td>';
                      $html .= '<td><a href="'.$link.'">'.$data_cad.'</a></td>';
                      $html .= '<td class="actions">';
                        $html .= '<a href="'.$link.'" class="edit"><i class="fa fa-comments"></i>'.$nmsg.'</a>';
                        $html .= '<a href="javascript:void(0);" class="confirm-remover-msg" data-url="'.$link_del.'"><i class="delete fas fa-trash-alt"></i></a>';
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
