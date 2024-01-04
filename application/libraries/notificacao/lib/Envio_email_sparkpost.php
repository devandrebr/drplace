<?php

  require_once( PATH_VENDOR . 'autoload.php' );
  require_once( PATH_LIBRARIES . 'notificacao/Envio_email.php' );

  use SparkPost\SparkPost;
  use GuzzleHttp\Client;
  use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

  class Envio_email_sparkpost extends Envio_email
  {
      public function __construct(){}

      public function enviar( $email_from_sparkpost )
      {
          $qtd = count($this->emails_enviar['email']);
          $cont = 0;
          $recipients = array();
          for( $i=0; $i<$qtd; $i++ ):

              $email  = trim( $this->emails_enviar['email'][$i] );
              $nome   = isset($this->emails_enviar['nome'][$i]) ? trim( $this->emails_enviar['nome'][$i] ) : '';

              // if( getMxEmail($email) ) {
              if(_valida_email($email)){

                  $recipients[$cont]['address']['name']  = $nome;
                  $recipients[$cont]['address']['email'] = $email;

                  $cont++;
              }

          endfor;

          dump($recipients);
          die;
          # REALIZAR O ENVIO

          $httpAdapter = new GuzzleAdapter( new Client() );
          $sparky = new SparkPost( $httpAdapter, [ 'key' => KEY_API_ADMIN_SPARKPOST ] );

          $options = array();
          $options['start_time'] = 'now';
          $options['inline_css'] = TRUE;

          $promise = $sparky->transmissions->post([
                  'content' => [
                          'from' => [
                                      'name' => $this->nome_from,
                                      'email' => $email_from_sparkpost
                                  ],
                      'reply_to' => $this->email_return_path,
                      'subject' => $this->assunto,
                      'html' => $this->html,
                      'attachments' => $this->attachments
                  ],
                  'recipients' => $recipients,
                  // 'campaign_id' => TOKEN_ENVIO_CAMPANHA_SPARKPOST,
                  'options' => $options
              ]);

          try {

              $response = $promise->wait();

              $spark_codigo = $response->getStatusCode();
              $spark_codigoMsg = NULL;

              $results = $response->getBody();

              $id_transmissao = NULL;
              $qtd_rejeitado = NULL;
              $qtd_aceitado = NULL;

              // Salvar alguns dados do retorno
              if( $spark_codigo == 200 ) {
                  $id_transmissao = $results['results']['id'];
                  $qtd_rejeitado = $results['results']['total_rejected_recipients'];
                  $qtd_aceitado = $results['results']['total_accepted_recipients'];
              }

          } catch (\Exception $e) {
              $spark_codigo = $e->getCode();
              $msg_json = json_decode($e->getMessage(), true);

              $er_msg     = $msg_json['errors'][0]['message'];
              $er_desc    = $msg_json['errors'][0]['description'];
              $er_code    = $msg_json['errors'][0]['code'];

              $spark_codigoMsg = trim( 'Cod: ' . $er_code . ' - Mensagem: ' . $er_msg . ' - Desc.: ' . $er_desc );
          }

          return array('spark_codigo' => $spark_codigo, 'spark_codigoMsg' => $spark_codigoMsg);
      }
  }
