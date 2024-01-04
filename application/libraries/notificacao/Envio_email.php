<?php

  class Envio_email
  {
    protected $html;

    protected $emails_enviar;
    protected $emails_enviar_copia;

    protected $assunto;

    protected $nome_from;
    protected $email_from;

    protected $email_return_path;

    protected $attachments;

    public function __construct(){}

    protected function _valida_email( $email ) {
      return filter_var( $email, FILTER_VALIDATE_EMAIL );
    }

    public function setHtml( $html ) {
      $this->html = $html;
    }

    public function setEmailsEnviar( $emails ) {
      $this->emails_enviar = $emails;
    }

    public function setEmailsEnviarCopiaOculta( $emails ) {
      $this->emails_enviar_copia = $emails;
    }

    public function setAssunto( $assunto ) {
      $this->assunto = $assunto;
    }

    public function setNomeFrom( $nome ) {
      $this->nome_from = $nome;
    }

    public function setEmailFrom( $email ) {
      $this->email_from = $email;
    }

    public function setEmailReturnPath( $email ) {
      $this->email_return_path = $email;
    }

    public function setAttachments( $attachments ) {
      $this->attachments = $attachments;
    }

  }
