<?php
  require_once( PATH_LIBRARIES . 'notificacao/Dados_email.php' );

  class Template extends Dados_email
  {
    protected $_topo_tpl;
    protected $_rodape_tpl;

    protected $url_img_logo_topo;
    protected $url_img_logo_rodape;
    protected $link_logo;
    protected $link_contato;

    public function __construct(){
      parent::__construct();

      $this->link_logo    = BASE_URL_EMAIL;
      $this->link_contato = BASE_URL_EMAIL.'contato';

      $this->url_img_logo_topo = BASE_URL_EMAIL.ASSETS_PORTAL.'img/logos/auth-logo-drplace-dark.png';
      $this->url_img_logo_rodape = BASE_URL_EMAIL.ASSETS_PORTAL.'img/logos/logo-drplace-dark.png';
    }

    protected function set_template( $tpl=1 )
    {
        $this->_set_topo($tpl);
        $this->_set_rodape($tpl);
    }

    protected function _set_topo( $tpl )
    {
      $this->_topo_tpl = $this->_topo_1();
      if((int)$tpl==2)
        $this->_topo_tpl = $this->_topo_2();
    }

    protected function _set_rodape( $tpl )
    {
      $this->_rodape_tpl = $this->_rodape_1();
      if((int)$tpl==2)
        $this->_rodape_tpl = $this->_rodape_2();
    }

    /*
     * ### LAYOUT - 1 ###
     */
    private function _topo_1()
    {
      $topo = '<html>
                  <head>
                    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                    <style>
                      @import url(\'https://fonts.googleapis.com/css?family=Open+Sans|Oswald\');
                      body{padding:0px;margin:0px;}
                      .f-title-1{font-family:"Oswald", sans-serif;}
                      .f-content-1, .f-content-msg, .f-footer-1{font-family:"Open Sans", sans-serif;}
                      .f-content-1{padding-left:5px;}
                    </style>
                  </head>
                  <body>

                  <table cellspacing="0" cellpadding="0" border="0" width="540" align="center" bgcolor="#FFFFFF">
                    <tr>
                      <td>
                        <table cellspacing="5" cellpadding="5" width="100%" border="0" align="center">
                          <tr valign="middle">
                            <td valign="middle" align="center">
                              <br>
                              <a href="'.$this->link_logo.'" style="text-decoration:none;"><img src="'.$this->url_img_logo_topo.'" alt="Dr.Place Logo" height="60" border="0" /></a>
                              <br><br>
                            </td>
                          </tr>
                          <tr valign="middle">
                            <td valign="middle" align="center">
                              <br>
                              <font size="6" face="Helvetica, Arial, Verdana, sans-serif" color="#555555">
                                <strong class="f-title-1">'.$this->titulo_topo.'</strong>
                              </font>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>

                  <table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#FFFFFF">
                  <tr><td>&nbsp;</td></tr><tr><td>';

      return $topo;
    }

    private function _rodape_1()
    {
      $rodape = '</td></tr></table>

                  <table cellspacing="0" cellpadding="0" border="0" align="center" width="540" bgcolor="#F7F7F7">
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                      <td>
                        <table cellspacing="5" cellpadding="5" border="0" width="100%">
                          <tr>
                            <td width="100" align="center">
                              <a href="'.$this->link_logo.'">
                                <img src="'.$this->url_img_logo_rodape.'" height="24" border="0" />
                              </a>
                            </td>
                            <td align="left">
                              <font size="1" face="Tahoma, Verdana, Arial, sans-serif" color="#BBBBBB">
                                <span class="f-footer-1">
                                  Esta mensagem foi enviada em '.$this->data_rodape.'.<br>
                                  Em caso de dúvidas, reclamações ou sugestões <a href="'.$this->link_contato.'" color="#BBBBBB" style="color:#BBB; text-decoration:none;"><b>fale conosco</b></a>.
                                </span>
                              </font>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                  </table>
                </body>
              </html>';

      return $rodape;
    }

    /*
     * ### LAYOUT - 2 ###
     */
    private function _topo_2()
    {
      $topo = '<html>
                  <head>
                    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                    <style type="text/css">
                      @import url("https://fonts.googleapis.com/css?family=Open+Sans|Montserrat:300,400,400i,700,700i");
                      body{padding:0px;margin:0px;}
                      .titulo{font-family:"Montserrat", Helvetica, Arial, sans-serif !important; font-weight:700; color:#FFF;}
                      .msg-usuario{font-family:"Montserrat", Helvetica, Arial, sans-serif !important; font-weight:400; color:#FFF;}
                      .msg-welcome{font-family:"Montserrat", Helvetica, Arial, sans-serif !important; font-weight:400; color:#FFF;}
                      .bgimg{width:900px; height:408px; position:absolute; top:0px; z-index:1; background:url(\''.BASE_URL_EMAIL.ASSETS_PORTAL.'img/email/bg-cadastro-anuncio.jpg\') left center no-repeat;}
                      .bgimg tr,
                      .bgimg tr td{padding:0px;}
                      .wrap{width:900px; height:408px; margin:0px auto;}
                      .wrap .box-conteudo{position:absolute; top:0px; padding-left:60px; z-index:2;}
                      .wrap .box-conteudo .titulo{font-size:2em; padding-top:60px;}
                      .wrap .box-conteudo .msg-usuario{font-size:1.6em; padding-top:0px;}
                      .wrap .box-conteudo .msg-usuario .cor{color:#FF9A67;}
                      .wrap .box-conteudo .msg-welcome{font-size:0.8em; padding-top:30px;}
                    </style>
                  </head>
                  <body>
                    <div class="wrap">
                      <table class="bgimg" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                          <td>';

      return $topo;
    }

    private function _rodape_2()
    {
          $rodape = '</td>
                    </tr>
                  </table>
                </div><!-- .wrap -->
              </body>
            </html>';

      return $rodape;
    }
  }
