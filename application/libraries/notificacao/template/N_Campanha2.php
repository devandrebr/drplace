<?php
    require_once( PATH_LIBRARIES . 'notificacao/Template.php' );

    class N_Campanha2 extends Template
    {
      private $primeiro_nome;
      private $nome;
      private $email;
      private $senha;

      public function __construct(){
        parent::__construct();

        $this->titulo_topo = 'Novo Cadastro na Plataforma';
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

      public function confirmacao_cadastro() {
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
