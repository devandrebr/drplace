<?php
    require_once( PATH_VENDOR . 'autoload.php' );
    require_once( PATH_LIBRARIES . 'notificacao/Envio_email.php' );

    Use PHPMailer\PHPMailer\PHPMailer;
    
    class Envio_email_phpmailer extends Envio_email
    {
        public function __construct(){}

        public function enviar()
        {
            $send = FALSE;

            $phpmailer = new PHPMailer;

            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'utf-8';
            #$phpmailer->Debugoutput = 0;

            if( EMAIL_USAR_SMTP_1 )
            {
                $phpmailer->IsSMTP();
                $phpmailer->SMTPAuth    = true;
                $phpmailer->SMTPDebug   = false;
                $phpmailer->Host        = EMAIL_HOST_SMTP_1;
                $phpmailer->Port        = EMAIL_PORT_SMTP_1;
                $phpmailer->Username    = EMAIL_USER_SMTP_1;
                $phpmailer->Password    = EMAIL_PASS_SMTP_1;
                $phpmailer->SMTPOptions = array(
                                              'ssl' => array(
                                                  'verify_peer' => false,
                                                  'verify_peer_name' => false,
                                                  'allow_self_signed' => true
                                                )
                                            );
            }

            $phpmailer->SetFrom( $this->email_from, $this->nome_from );
            $phpmailer->HeaderLine( "Return-Path", $this->email_return_path."\n" );

            $phpmailer->Subject = "=?UTF-8?B?".base64_encode($this->assunto)."?=";
            $phpmailer->MsgHTML( $this->html );

            $qtd_copia = isset($this->emails_enviar_copia['email']) ? count($this->emails_enviar_copia['email']) : 0;
            $qtd = count($this->emails_enviar['email']);
            for( $i=0; $i<$qtd; $i++ ):
                $email  = trim($this->emails_enviar['email'][$i]);
                $nome   = isset($this->emails_enviar['nome'][$i]) ? trim( $this->emails_enviar['nome'][$i] ) : '';

                if( $this->_valida_email($email) ) {
                    $phpmailer->AddAddress( $email, $nome );

                    $send = $phpmailer->Send();

                    $phpmailer->ClearAllRecipients();
                }
            endfor;

            if( $qtd_copia > 0 )
            {
                for( $i=0; $i<$qtd_copia; $i++ ):
                    $email  = trim($this->emails_enviar_copia['email'][$i]);
                    $nome   = isset($this->emails_enviar_copia['nome'][$i]) ? trim( $this->emails_enviar_copia['nome'][$i] ) : '';

                    if( $this->_valida_email($email) ) {
                        $phpmailer->AddAddress( $email, $nome );
                    }
                endfor;

                $phpmailer->Send();
                $phpmailer->ClearAllRecipients();
            }

            $codigo     = ($send) ? 200 : 500;
            $codigoMsg  = ($send) ? ''  : 'Erro ao enviar a mensagem';

            $return = array(
                                'codigo' => $codigo,
                                'codigoMsg' => $codigoMsg
                            );

            return $return;
        }
    }
