<?php
    require_once( PATH_LIBRARIES . 'notificacao/Template.php' );

    class N_Contato extends Template
    {
      private $nome;
      private $email;
      private $telefone;
      private $msg;
      private $anuncio_titulo;
      private $anuncio_imagem;
      private $anuncio_link;

      public function __construct(){
        parent::__construct();

        $this->titulo_topo = 'Novo Contato Através do Site';
      }

      public function setAnuncioTitulo( $titulo = NULL ) {
        $this->anuncio_titulo = $titulo;
      }

      public function setAnuncioImagem( $img = NULL ) {
        $this->anuncio_imagem = $img;
      }

      public function setAnuncioLink( $link = NULL ) {
        $this->anuncio_link = $link;
      }

      public function setFormNome( $nome = NULL ) {
        $this->nome = $nome;
      }

      public function setFormEmail( $email = NULL ) {
        $this->email = $email;
      }

      public function setFormTelefone( $telefone = NULL ) {
        $this->telefone = $telefone;
      }

      public function setFormMensagem( $msg = NULL ) {
        $this->msg = $msg;
      }

      public function fale_conosco() {
        $this->set_template();

        $conteudo = $this->_topo_tpl;
        $conteudo .= '<table cellspacing="0" cellpadding="0" border="0" width="540" bgcolor="#FFFFFF" align="center">
                        <tr>
                          <td width="10">&nbsp;</td>
                          <td colspan="2">
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">
                              Olá, '.$this->saudacao_email.'! O(a) visitante <b>'.ucfirst($this->nome).'</b> acabou de enviar uma mensagem através do formulário de contato localizado
                              na página Fale Conosco, no portal da Dr.Place.
                            </span></font>
                          </td>
                          <td width="10">&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Informações sobre o contato</strong>
                            </font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Nome:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->nome.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">E-mail:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->email.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Telefone:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->telefone.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Mensagem:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            &nbsp;
                          </td>
                          <td align="left" style="padding-left:10px;">
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.nl2br($this->msg).'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Informações complementares sobre o envio</strong>
                            </font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td width="160" align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Data do contato:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->data_atual.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Navegador:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->browser.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Sistema Operacional:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->os.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Endereço IP:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->endereco_ip.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>';

              if( ($this->ip_cidade != '') && ($this->ip_estado != '') )
              {
                $conteudo .= '<tr>
                              <td>&nbsp;</td>
                              <td align="right">
                                <font size="2" face="Helvetica, Arial, sans-serif"><strong class="f-title-1">Localização</strong></font>
                                <font size="1" face="Tahoma, Verdana, sans-serif"><i>(aproximada)</i></font><font size="2" face="Helvetica, Arial, sans-serif"><strong class="f-title-1">:</strong></font>
                              </td>
                              <td align="left">
                                &nbsp;
                                <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->ip_cidade.'/'.$this->ip_estado.', '.$this->ip_pais.'</span></font>
                              </td>
                              <td>&nbsp;</td>
                            </tr>';
                $conteudo .= '<tr>
                              <td>&nbsp;</td>
                              <td align="right">
                                <font size="2" face="Helvetica, Arial, sans-serif">
                                  <strong class="f-title-1">Provedor:</strong>
                                </font>
                              </td>
                              <td align="left">
                                &nbsp;
                                <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->ip_provedor.'</span></font>
                              </td>
                              <td>&nbsp;</td>
                            </tr>';
              }

          $conteudo .= '<tr><td colspan="4">&nbsp;</td></tr>
                      </table>';

        $conteudo .= $this->_rodape_tpl;

        return trim($conteudo);
      }

      public function anuncio_proprietario() {
        $this->set_template();

        $conteudo = $this->_topo_tpl;
        $conteudo .= '<table cellspacing="0" cellpadding="0" border="0" width="540" bgcolor="#FFFFFF" align="center">
                        <tr>
                          <td width="10">&nbsp;</td>
                          <td colspan="2">
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">
                              Olá, '.$this->saudacao_email.'! O(a) visitante <b>'.ucfirst($this->nome).'</b> acabou de enviar uma mensagem através do formulário no detalhe do seu anúncio.<br>
                              Abaixo você tem mais detalhes da mensagem e do imóvel no portal da Dr.Place!
                            </span></font>
                          </td>
                          <td width="10">&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Imóvel de referência para a mensagem</strong>
                            </font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td width="160" align="center">
                            <a href="'.$this->anuncio_link.'"><img src="'.$this->anuncio_imagem.'" border="0" alt="Foto do Imóvel" height="80" /></a>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1"><a href="'.$this->anuncio_link.'">'.$this->anuncio_titulo.'</a></span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Informações sobre o contato</strong>
                            </font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Nome:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->nome.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">E-mail:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->email.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Telefone:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->telefone.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Mensagem:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            &nbsp;
                          </td>
                          <td align="left" style="padding-left:10px;">
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.trim(nl2br($this->msg)).'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Informações complementares sobre o envio</strong>
                            </font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td width="160" align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Data do contato:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->data_atual.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Navegador:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->browser.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Sistema Operacional:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->os.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Endereço IP:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->endereco_ip.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>';

              if( ($this->ip_cidade != '') && ($this->ip_estado != '') )
              {
                $conteudo .= '<tr>
                              <td>&nbsp;</td>
                              <td align="right">
                                <font size="2" face="Helvetica, Arial, sans-serif"><strong class="f-title-1">Localização</strong></font>
                                <font size="1" face="Tahoma, Verdana, sans-serif"><i>(aproximada)</i></font><font size="2" face="Helvetica, Arial, sans-serif"><strong class="f-title-1">:</strong></font>
                              </td>
                              <td align="left">
                                &nbsp;
                                <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->ip_cidade.'/'.$this->ip_estado.', '.$this->ip_pais.'</span></font>
                              </td>
                              <td>&nbsp;</td>
                            </tr>';
                $conteudo .= '<tr>
                              <td>&nbsp;</td>
                              <td align="right">
                                <font size="2" face="Helvetica, Arial, sans-serif">
                                  <strong class="f-title-1">Provedor:</strong>
                                </font>
                              </td>
                              <td align="left">
                                &nbsp;
                                <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->ip_provedor.'</span></font>
                              </td>
                              <td>&nbsp;</td>
                            </tr>';
              }

          $conteudo .= '<tr><td colspan="4">&nbsp;</td></tr>
                      </table>';

        $conteudo .= $this->_rodape_tpl;

        return trim($conteudo);
      }

      public function anuncio_proprietario_resposta() {
        $this->set_template();

        $conteudo = $this->_topo_tpl;
        $conteudo .= '<table cellspacing="0" cellpadding="0" border="0" width="540" bgcolor="#FFFFFF" align="center">
                        <tr>
                          <td width="10">&nbsp;</td>
                          <td colspan="2">
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">
                              Olá, '.$this->saudacao_email.'! O(a) <b>'.ucfirst($this->nome).'</b> acabou de enviar uma resposta através do chat da Dr.Place!<br>
                              Abaixo você tem mais detalhes da mensagem que foi enviada agora, em uma conversa já iniciada, responda-a o mais rápido possível!
                            </span></font>
                          </td>
                          <td width="10">&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Imóvel de referência da conversa</strong>
                            </font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td width="160" align="center">
                            <a href="'.$this->anuncio_link.'"><img src="'.$this->anuncio_imagem.'" border="0" alt="Foto do Imóvel" height="80" /></a>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1"><a href="'.$this->anuncio_link.'">'.$this->anuncio_titulo.'</a></span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Mensagem (atual):</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td align="right">
                            &nbsp;
                          </td>
                          <td align="left" style="padding-left:10px;">
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.trim(nl2br($this->msg)).'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Informações complementares sobre o envio</strong>
                            </font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td width="160" align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Data do contato:</strong>
                            </font>
                          </td>
                          <td align="left">
                            &nbsp;
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->data_atual.'</span></font>
                          </td>
                          <td>&nbsp;</td>
                        <tr><td colspan="4">&nbsp;</td></tr>
                      </table>';

        $conteudo .= $this->_rodape_tpl;

        return trim($conteudo);
      }

    }
