<?php
    require_once( PATH_LIBRARIES . 'notificacao/Template.php' );

    class N_Campanha1 extends Template
    {
      private $primeiro_nome;
      private $nome;
      private $email;

      public function __construct(){
        parent::__construct();

        $this->titulo_topo = 'Novo Cadastro na Plataforma';
      }

      public function setFormNome( $nome = NULL ) {
        $this->nome = $nome;

        $ex = explode(' ',$nome);
        $this->primeiro_nome = isset($ex[0]) ? trim($ex[0]) : trim($nome);
      }

      public function setFormEmail( $email = NULL ) {
        $this->email = $email;
      }

      public function pre_lancamento_cadastro() {
        $this->set_template();

        $conteudo = $this->_topo_tpl;
        $conteudo .= '<table cellspacing="0" cellpadding="0" border="0" width="540" bgcolor="#FFFFFF" align="center">
                        <tr>
                          <td width="10">&nbsp;</td>
                          <td colspan="2">
                            <font size="2" face="Helvetica, Arial, sans-serif" color="#555555">
                            <span class="f-content-1">Olá, '.$this->saudacao_email.'! O(a) visitante <b>'.ucfirst($this->nome).'</b> acabou de se cadastrar na plataforma. Abaixo você tem mais detalhes sobre o cadastro na Dr.Place!
                            </span></font>
                          </td>
                          <td width="10">&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Informações sobre o cadastro</strong>
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
                        <tr><td colspan="4">&nbsp;</td></tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2">
                            <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                              <strong class="f-title-1">Informações complementares sobre o cadastro</strong>
                            </font>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td width="160" align="right">
                            <font size="2" face="Helvetica, Arial, sans-serif">
                              <strong class="f-title-1">Data do cadastro:</strong>
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

      public function pre_lancamento_usuario_copia() {
        $this->set_template(2);

        $conteudo = $this->_topo_tpl;

        $conteudo .= '<div class="box-conteudo">
                        <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="titulo">
                          E aí, '.ucfirst($this->primeiro_nome).'!<br>
                        </div></font>
                        <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="msg-usuario">
                          Seu cadastro foi<br>realizado com <span class="cor">sucesso</span>.<br><br><br>
                        </div></font>
                        <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="msg-welcome">Seja Bem Vindo!</div></font>
                      </div>';

        $conteudo .= $this->_rodape_tpl;
        // $this->set_template();
        //
        // $conteudo = $this->_topo_tpl;
        // $conteudo .= '<table cellspacing="0" cellpadding="0" border="0" width="540" bgcolor="#FFFFFF" align="center">
        //                 <tr>
        //                   <td width="10">&nbsp;</td>
        //                   <td colspan="2">
        //                     <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">Olá, '.$this->saudacao_email.'
        //                      <b>'.ucfirst($this->nome).'</b> você acabou de se cadastrar na plataforma da Dr.Place.<br>
        //                       Se você não se cadastrou ou desconhece o conteúdo deste e-mail entre em contato conosco!
        //                     </span></font>
        //                   </td>
        //                   <td width="10">&nbsp;</td>
        //                 </tr>
        //                 <tr><td colspan="4">&nbsp;</td></tr>
        //                 <tr>
        //                   <td>&nbsp;</td>
        //                   <td colspan="2">
        //                     <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
        //                       <strong class="f-title-1">Mais detalhes sobre o cadastro</strong>
        //                     </font>
        //                   </td>
        //                   <td>&nbsp;</td>
        //                 </tr>
        //                 <tr>
        //                   <td>&nbsp;</td>
        //                   <td width="160" align="right">
        //                     <font size="2" face="Helvetica, Arial, sans-serif">
        //                       <strong class="f-title-1">Data do contato:</strong>
        //                     </font>
        //                   </td>
        //                   <td align="left">
        //                     &nbsp;
        //                     <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->data_atual.'</span></font>
        //                   </td>
        //                   <td>&nbsp;</td>
        //                 </tr>
        //                 <tr>
        //                   <td>&nbsp;</td>
        //                   <td width="160" align="right">
        //                     <font size="2" face="Helvetica, Arial, sans-serif">
        //                       <strong class="f-title-1">E-mail:</strong>
        //                     </font>
        //                   </td>
        //                   <td align="left">
        //                     &nbsp;
        //                     <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-1">'.$this->email.'</span></font>
        //                   </td>
        //                   <td>&nbsp;</td>
        //                 </tr>
        //                 <tr><td colspan="4">&nbsp;</td></tr>
        //               </table>';
        //
        // $conteudo .= $this->_rodape_tpl;

        return trim($conteudo);
      }

    }
