<?php
    require_once( PATH_LIBRARIES . 'notificacao/Template.php' );

    class N_Usuario extends Template
    {
        private $usu_status;
        private $primeiro_nome;
        private $nome;
        private $email;
        private $senha;

        public function __construct(){
          parent::__construct();

          $this->titulo_topo = 'Bem vindo a Dr.Place';
        }

        public function setNome( $nome = NULL ) {
          $this->nome = trim($nome);

          $ex = explode(' ',$nome);
          $this->primeiro_nome = isset($ex[0]) ? trim($ex[0]) : trim($nome);
        }

        public function setEmail( $email = NULL ) {
          $this->email = $email;
        }

        public function setSenha( $senha = NULL ) {
          $this->senha = $senha;
        }

        public function setCadastroStatus( $status )
        {
            $this->usu_status = $status;
        }

        public function confirmacao_cadastro_interesse()
        {
          $this->set_template(2);

          $conteudo = $this->_topo_tpl;

          $conteudo .= '<div class="box-conteudo">
                          <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="titulo">
                            E aí, '.ucfirst($this->primeiro_nome).'!
                          </div></font>
                          <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="msg-usuario">
                            Seu interesse foi cadastrado<br>na plataforma <span class="cor">Dr.Place</span>.<br><br>
                            A sua <span class="cor">senha</span> é: '.$this->senha.'!
                          </div></font>
                          <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="msg-welcome">Seja Bem Vindo!</div></font>
                        </div>';

          $conteudo .= $this->_rodape_tpl;

          return trim($conteudo);
        }

        public function confirmacao_cadastro()
        {
          $this->set_template();

          $link = BASE_URL_EMAIL.'confirmar/'.$this->usuario_token;
          $link_bt_img = BASE_URL_EMAIL.ASSETS_PORTAL.'img/email/bt-confirmar.png';

          $conteudo = $this->_topo_tpl;
          $conteudo .= '<table cellspacing="0" cellpadding="0" border="0" width="540" bgcolor="#FFFFFF" align="center">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td colspan="2">
                              <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-msg">
                                '.$this->saudacao_email.' '.$this->usuario_nome.', bem vindo a Dr.Place.<br>
                                Acabamos de receber seu cadastro e ficamos contente em ter você conosco,
                                para obter acesso a todos os recursos da sua conta, verifique seu endereço de e-mail <a href="'.$link.'">clicando no botão abaixo ou aqui</a>
                              </span></font>
                            </td>
                            <td width="10">&nbsp;</td>
                          </tr>
                          <tr><td colspan="4">&nbsp;</td></tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td colspan="2" align="center">
                              <a href="'.$link.'">
                                <img src="'.$link_bt_img.'" alt="Confirmar Cadastro" border="0" />
                              </a>
                            </td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr><td colspan="4">&nbsp;</td></tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td colspan="2">
                              <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00">
                                <strong class="f-title-1">Dados do Solicitação</strong>
                              </font>
                            </td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                              <td>&nbsp;</td>
                              <td width="160" align="right">
                                  <font size="2" face="Helvetica, Arial, sans-serif">
                                  <strong class="f-title-1">Data:</strong>
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
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="2">
                                <font size="2" face="Helvetica, Arial, sans-serif" color="#555555"><span class="f-content-msg">
                                    Se você desconhece essas informações ou não fez nenhum cadastro em nosso sistema, por favor entre em <a href="'.$this->link_contato.'">contato</a> agora mesmo com nossa equipe.
                                </span></font>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr><td colspan="4">&nbsp;</td></tr>
                    </table>';

          $conteudo .= $this->_rodape_tpl;

          return remove_espaco_html($conteudo);
        }



        public function boas_vindas() {
          $this->set_template(2);

          $conteudo = $this->_topo_tpl;

          $conteudo .= '<div class="box-conteudo">
                          <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="titulo">
                            E aí, '.ucfirst($this->primeiro_nome).'!
                          </div></font>
                          <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="msg-usuario">
                            Seu cadastro foi<br>realizado com <span class="cor">sucesso</span>.<br><br>
                            A sua <span class="cor">senha</span> é: '.$this->senha.'!
                          </div></font>
                          <font size="4" face="Helvetica, Arial, sans-serif" color="#FF7D00"><div class="msg-welcome">Seja Bem Vindo!</div></font>
                        </div>';

          $conteudo .= $this->_rodape_tpl;

          return trim($conteudo);
        }
    }
