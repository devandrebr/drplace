<?php

  class Dados_ip
  {
    protected $endereco_ip;
    protected $user_agent;
    protected $browser;
    protected $os;
    protected $ip_cidade;
    protected $ip_estado;
    protected $ip_pais;
    protected $ip_provedor;

    public function __construct(){

    }

    public function setEnderecoIp( $ip ) {
      if( ! filter_var( $ip, FILTER_VALIDATE_IP ) === false )
        $this->endereco_ip = $ip;
    }

    public function setUserAgent( $useragent ) {
      if( $useragent != '' )
        $this->user_agent = $useragent;
    }

    public function setNavegador( $browser ) {
      if( $browser != '' )
        $this->browser = $browser;
    }

    public function setSistemaOperacional( $os ) {
      if( $os != '' )
        $this->os = $os;
    }

    public function getDadosIp()
    {
      $dados = array();
      $dados['ip_cidade'] = $this->ip_cidade;
      $dados['ip_estado'] = $this->ip_estado;
      $dados['ip_pais'] = $this->ip_pais;
      $dados['ip_provedor'] = $this->ip_provedor;

      return $dados;
    }

    public function consultaByLocalizaIp()
    {
      $url = 'http://www.localizaip.com.br/localizar-ip.php?ip=' . $this->endereco_ip;

      $ch = curl_init();

      $options = array(
                      CURLOPT_URL => $url,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_AUTOREFERER => true,
                      CURLOPT_USERAGENT => $this->user_agent,
                      CURLOPT_COOKIESESSION => true
                  );

      curl_setopt_array( $ch, $options );

      $resp = curl_exec($ch);

      curl_close($ch);

      $html = remove_espaco_html($resp);

      $pattern = '/Pa&iacute;s:<b>(.*?)<\/b><br>\s*Estado:<b>(.*?)<\/b><br>\s*Cidade:<b>(.*?)<\/b><br><br>\s*Provedor:<b>(.*?)<\/b><br><!--stdClass::__set_state.*?-->IP-Reverso:<b>(.*?)<\/b>/';
      preg_match( $pattern, $html, $dados_ip );

      $this->ip_pais      = isset($dados_ip[1]) ? trim($dados_ip[1]) : '';
      $this->ip_estado    = isset($dados_ip[2]) ? trim($dados_ip[2]) : '';
      $this->ip_cidade    = isset($dados_ip[3]) ? trim($dados_ip[3]) : '';
      $this->ip_provedor  = isset($dados_ip[4]) ? trim($dados_ip[4]) : '';
    }

  }
