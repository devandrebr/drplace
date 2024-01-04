<?php

  class Imoveis_olx
  {
    private $user_agent;
    private $cookies;
    private $imoveis;

    public function __construct(){}

    public function setUserAgent($ua){
      $this->user_agent = $ua;
    }

    public function getImoveis(){
      return $this->imoveis;
    }

    public function getCookies(){
      return $this->cookies;
    }

    public function consulta($qtd=10){
      $this->_set_cookie();
      $this->_set_pesquisa($qtd);
    }

    public function consultaGeral($qtd=100){
      $this->_set_cookie();
      $this->_set_pesquisa($qtd);
    }

    private function _set_cookie(){
      #$url = 'https://sp.olx.com.br/sao-paulo-e-regiao/zona-norte/imoveis/venda';
      $url = 'https://sp.olx.com.br/sao-paulo-e-regiao/zona-norte/imoveis/';

      $ch = curl_init();

      $options = array(
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_AUTOREFERER => true,
          CURLOPT_COOKIESESSION => true,
          CURLOPT_HEADER => true,
          CURLOPT_SSL_VERIFYHOST => false,
          // CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_USERAGENT => $this->user_agent,
          CURLOPT_URL => $url
      );

      curl_setopt_array( $ch, $options );
      $resp = curl_exec($ch);
      curl_close($ch);

      $pattern = '/Set-Cookie: (.*?);/';
      preg_match_all($pattern,$resp,$cookies);
      $qtd = isset($cookies[1][0]) ? count($cookies[1]) : 0;
      if( $qtd > 0 ) {
        $this->cookies = '';
        for($i=0; $i<$qtd; $i++):
          $this->cookies .= $cookies[1][$i].'; ';
        endfor;
      }
    }

    private function _set_pesquisa($qtd=10){
      $this->imoveis = array();
      $c=0;
      for($i=1;$i<=$qtd;$i++):
        #$url = 'https://sp.olx.com.br/sao-paulo-e-regiao/zona-norte/imoveis/venda?o='.$i;
        $url = 'https://sp.olx.com.br/sao-paulo-e-regiao/zona-norte/imoveis?o='.$i;

        $ch = curl_init();

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_COOKIESESSION => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_USERAGENT => $this->user_agent,
            CURLOPT_COOKIE => $this->cookies,
            CURLOPT_URL => $url
        );

        curl_setopt_array( $ch, $options );
        $resp = curl_exec($ch);
        curl_close($ch);
        $resp = utf8_encode($resp);
        $html = remove_espaco_html($resp);

        $pattern1 = '~<li class="item"\s[^>]*>(.*?)</li>~';
        preg_match_all($pattern1,$html,$dados1);
        $qtd1 = isset($dados1[1]) ? (is_array($dados1[1]) ? count($dados1[1]) : 0 ) : 0;
        if( $qtd1 > 0 ) {
          for($v=0; $v<$qtd1; $v++):
            $ret = array();
            $pattern2 = '@<a\s[^>]* name=".*?" id=".*?" href="(.*?)" title=".*?"><div class="col-1"><div class="OLXad-list-image"><div class="OLXad-list-image-box"><div class="OLXad-list-image-counter"><svg\s[^>]*><title>.*?</title><desc>.*?</desc><defs></defs><g\s[^>]*> <g\s[^>]*> <path\s[^>]*></path> <path\s[^>]*></path> </g></g></svg>(.*?)</div><img class="image" src="(.*?)" alt=".*?"><div class="tag">.*?</div></div></div></div><div class="col-2"><div\s[^>]*><h2\s[^>]*>(.*?)</h2><p class="text detail-specific">(.*?)</p></div><div class="OLXad-list-line-2"><p class="text detail-region">(.*?)</p><p class="text detail-category">(.*?)</p></div></div><div class="col-3"><p class="OLXad-list-price">(.*?)</p></div><div class="col-4"><p\s[^>]*>(.*?)</p><p\s[^>]*>(.*?)</p></div></a>@';
            preg_match($pattern2, $dados1[1][$v], $dados2);
            $add = isset($dados2[1]) ? (is_array($dados2) ? TRUE : FALSE ) : FALSE;
            if(!$add){
              $pattern3 = '@<a\s[^>]* name=".*?" id=".*?" href="(.*?)" title=".*?"><div class="col-1"><div class="OLXad-list-image"><div class="OLXad-list-image-box"><div class="OLXad-list-image-counter"><svg\s[^>]*><title>.*?</title><desc>.*?</desc><defs></defs><g\s[^>]*> <g\s[^>]*> <path\s[^>]*></path> <path\s[^>]*></path> </g></g></svg>(.*?)</div><img class=".*?" src=".*?" data-original="(.*?)" alt=".*?"><div class="tag">.*?</div></div></div></div><div class="col-2"><div\s[^>]*><h2\s[^>]*>(.*?)</h2><p class="text detail-specific">(.*?)</p></div><div class="OLXad-list-line-2"><p class="text detail-region">(.*?)</p><p class="text detail-category">(.*?)</p></div></div><div class="col-3"><p class="OLXad-list-price">(.*?)</p></div><div class="col-4"><p\s[^>]*>(.*?)</p><p\s[^>]*>(.*?)</p></div></a>@';
              preg_match($pattern3, $dados1[1][$v], $dados2);
              $add = isset($dados2[1]) ? (is_array($dados2) ? TRUE : FALSE ) : FALSE;
            }

            if(isset($dados2[1])){
              $ret['link'] = $dados2[1];
              $ret['qtd_thumb'] = $dados2[2];
              $ret['thumb'] = $dados2[3];
              $ret['titulo'] = trim($dados2[4]);
              $ret['desc'] = trim($dados2[5]);
              $ret['local'] = trim($dados2[6]);
              $ret['categoria'] = trim(strip_tags(str_replace('Profissional','',$dados2[7])));
              $ret['valor'] = trim($dados2[8]);
              $ret['data'] = trim($dados2[9]);
              $ret['hora'] = trim($dados2[10]);

              $this->imoveis[$c] = $ret;

              $c++;
            }
          endfor;
        }
      endfor;
    }

    private function _set_pesquisa_geral(){
      $this->imoveis = array();
      $c=0;
      for($i=1;$i<=5000;$i++):
        $url = 'https://sp.olx.com.br/sao-paulo-e-regiao/zona-norte/imoveis/venda?o='.$i;

        $ch = curl_init();

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_COOKIESESSION => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_USERAGENT => $this->user_agent,
            CURLOPT_COOKIE => $this->cookies,
            CURLOPT_URL => $url
        );

        curl_setopt_array( $ch, $options );
        $resp = curl_exec($ch);
        curl_close($ch);
        $resp = utf8_encode($resp);
        $html = remove_espaco_html($resp);

        $pattern1 = '~<li class="item"\s[^>]*>(.*?)</li>~';
        preg_match_all($pattern1,$html,$dados1);
        $qtd1 = isset($dados1[1]) ? (is_array($dados1[1]) ? count($dados1[1]) : 0 ) : 0;
        if( $qtd1 > 0 ) {
          for($v=0; $v<$qtd1; $v++):
            $ret = array();
            $pattern2 = '@<a\s[^>]* name=".*?" id=".*?" href="(.*?)" title=".*?"><div class="col-1"><div class="OLXad-list-image"><div class="OLXad-list-image-box"><div class="OLXad-list-image-counter"><svg\s[^>]*><title>.*?</title><desc>.*?</desc><defs></defs><g\s[^>]*> <g\s[^>]*> <path\s[^>]*></path> <path\s[^>]*></path> </g></g></svg>(.*?)</div><img class="image" src="(.*?)" alt=".*?"><div class="tag">.*?</div></div></div></div><div class="col-2"><div\s[^>]*><h2\s[^>]*>(.*?)</h2><p class="text detail-specific">(.*?)</p></div><div class="OLXad-list-line-2"><p class="text detail-region">(.*?)</p><p class="text detail-category">(.*?)</p></div></div><div class="col-3"><p class="OLXad-list-price">(.*?)</p></div><div class="col-4"><p\s[^>]*>(.*?)</p><p\s[^>]*>(.*?)</p></div></a>@';
            preg_match($pattern2, $dados1[1][$v], $dados2);
            $add = isset($dados2[1]) ? (is_array($dados2) ? TRUE : FALSE ) : FALSE;
            if(!$add){
              $pattern3 = '@<a\s[^>]* name=".*?" id=".*?" href="(.*?)" title=".*?"><div class="col-1"><div class="OLXad-list-image"><div class="OLXad-list-image-box"><div class="OLXad-list-image-counter"><svg\s[^>]*><title>.*?</title><desc>.*?</desc><defs></defs><g\s[^>]*> <g\s[^>]*> <path\s[^>]*></path> <path\s[^>]*></path> </g></g></svg>(.*?)</div><img class=".*?" src=".*?" data-original="(.*?)" alt=".*?"><div class="tag">.*?</div></div></div></div><div class="col-2"><div\s[^>]*><h2\s[^>]*>(.*?)</h2><p class="text detail-specific">(.*?)</p></div><div class="OLXad-list-line-2"><p class="text detail-region">(.*?)</p><p class="text detail-category">(.*?)</p></div></div><div class="col-3"><p class="OLXad-list-price">(.*?)</p></div><div class="col-4"><p\s[^>]*>(.*?)</p><p\s[^>]*>(.*?)</p></div></a>@';
              preg_match($pattern3, $dados1[1][$v], $dados2);
              $add = isset($dados2[1]) ? (is_array($dados2) ? TRUE : FALSE ) : FALSE;
            }

            if(isset($dados2[1])){
              $ret['link'] = $dados2[1];
              $ret['qtd_thumb'] = $dados2[2];
              $ret['thumb'] = $dados2[3];
              $ret['titulo'] = trim($dados2[4]);
              $ret['desc'] = trim($dados2[5]);
              $ret['local'] = trim($dados2[6]);
              $ret['categoria'] = trim(str_replace('Profissional','',$dados2[7]));
              $ret['valor'] = trim($dados2[8]);
              $ret['data'] = trim($dados2[9]);
              $ret['hora'] = trim($dados2[10]);

              $this->imoveis[$c] = $ret;

              $c++;
            }
          endfor;
        }
      endfor;
    }

  }
