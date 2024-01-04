<?php
  require_once( PATH_LIBRARIES . 'Dados_ip.php' );

  class Dados_email extends Dados_ip
  {
    protected $saudacao_email;
    protected $data_rodape;
    protected $data_atual;
    protected $modulo;
    protected $titulo_topo;

    protected $usuario_token;
    protected $usuario_nome;
    protected $usuario_email;

    public function __construct(){
      $this->data_atual = date("d/m/Y H:i:s") . ' (BRASIL/SP)';
    }

    public function clear() {
      $this->saudacao_email = '';
      $this->data_rodape = '';
      $this->data_atual = '';
      $this->modulo = '';

      $this->usuario_token = '';
      $this->usuario_nome = '';
      $this->usuario_email = '';
      $this->endereco_ip = '';
      $this->ip_cidade = '';
      $this->ip_estado = '';
      $this->ip_pais = '';
      $this->ip_provedor = '';
      $this->user_agent = '';
      $this->browser = '';
      $this->os = '';
    }

    public function setModulo( $modulo ) {
      if( $modulo != '' )
        $this->modulo = $modulo;
    }

    public function setTituloTopo( $titulo ) {
      $this->titulo_topo = $titulo;
    }

    public function setDataRodape( $data ) {
      if( $data != '' )
        $this->data_rodape = $data;
    }

    public function setSaudacaoEmail( $saudacao ) {
      if( $saudacao != '' )
        $this->saudacao_email = $saudacao;
    }

    public function setUsuarioToken( $token ) {
      if( $token != '' )
        $this->usuario_token = $token;
    }

    public function setUsuarioNome( $nome ) {
      if( $nome != '' )
        $this->usuario_nome = $nome;
    }

    public function setUsuarioEmail( $email ) {
      if( $email != '' )
        $this->usuario_email = $email;
    }

    public function setDadosIp()
    {
      $this->consultaByLocalizaIp();
    }

  }
