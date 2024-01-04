<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * NOTE: Requires PHP version 5 or later
     *
     * @package ./application/libraries
     *
     * @author  André da Silva Severino
     *
     * @version 2017-05-05 16:30
     */
    class Up_Default
    {
        protected $arquivo = array();
        protected $nome_arquivo;
        protected $length_nome = 60;
        protected $diretorio;
        protected $extensao;

        private $tipo_upload;
        private $renomear = TRUE;
        private $max_size;
        private $error;

        function __construct()
        {
            if( empty($this->error) )
                    $this->error = new stdClass();

            if( empty($this->max_size) )
                $this->max_size = 1024 * 1024 * 20; // 20MB

            $this->extensao = array( 'doc', 'docx', 'xls', 'xlsx', 'csv', 'txt', 'pdf', 'odt', 'jpg', 'gif', 'jpeg', 'xml' );
        }

        public function upload()
        {
            if( $this->arquivo['error'] == 0 )
            {

                if( self::checkExtensao() )
                {

                    if( self::checkDiretorio( $this->diretorio ) )
                    {

                        if( self::checkTamanho( $this->arquivo['size'] ) )
                        {
                            if( $this->nome_arquivo == '' )
                              self::setNomeArquivo();

                            if( $this->tipo_upload == 'A' )
                                self::uploadArquivo();
                            else
                                $this->uploadImagem();

                        }
                        else
                            self::setStatusError( 0, 'Arquivo muito grande' );

                    }
                    else
                        self::setStatusError( 0, 'Diretório não localizado' );

                }
                else
                {
                    $ex  = explode('.', $this->arquivo['name']);
                    $ext = end($ex);
                    self::setStatusError( 0, 'Arquivo com extensão (<b>.' . strtolower( $ext ) . '</b>) não permitido' );
                }

            }
            else
                self::setStatusError( 0, 'Erro interno do servidor ao fazer o upload, tente novamente mais tarde ou entre em contato com nosso suporte técnico' );
        }

        private function uploadArquivo()
        {
            if ( move_uploaded_file( $this->arquivo['tmp_name'], $this->diretorio . $this->nome_arquivo ) )
                $st = TRUE;
            else
                $st = FALSE;

            if( $st )
                self::setStatusError( 1, 'Arquivo enviado com sucesso', $this->nome_arquivo );
            else
                self::setStatusError( 0, 'Não foi possível fazer o upload do arquivo, tente novamente mais tarde' );

        }

        private function checkExtensao()
        {
            $ex = explode('.', $this->arquivo['name']);
            $extensao = strtolower( end( $ex ) );

            if( in_array( "{$extensao}", $this->extensao ) === FALSE )
                return FALSE;

            return TRUE;
        }

        private function checkTamanho( $tamanho )
        {
            return $tamanho < $this->max_size ? TRUE : FALSE;
        }

        protected function checkDiretorio( $diretorio )
        {
            $return = TRUE;
            if( ! is_dir( $diretorio ) )
                $return = @mkdir($diretorio, 0777, TRUE);

            return $return;
        }


        /*
         * SETTERS
         */
        private function setNomeArquivo()
        {
            $nome = $this->arquivo['name'];

            $ex = explode( '.', $this->arquivo['name'] );
            $extensao = strtolower( end($ex) );
            $this->nome_arquivo = string_remove_acento( str_replace(".$extensao", '', substr($nome,0, $this->length_nome)) ) . ".$extensao";
            if( $this->renomear ) {
                $param = time().uniqid().string_remove_acento($nome);
                $this->nome_arquivo = crypt_senha($param) . ".$extensao";
            }
        }

        protected function setStatusError( $codigo, $msg )
        {
            $this->error->cod           = $codigo;
            $this->error->msg           = $msg;
            $this->error->nome_arquivo  = $this->nome_arquivo;
        }

        public function setArquivo( $file )
        {
            if( is_array( $file ) )
                $this->arquivo = $file;
        }

        public function setMaxSize( $size )
        {
            if( $size != '' && is_numeric($size) )
                $this->max_size = 1024 * 1024 * (int)$size;
        }

        public function setTipoUpload( $type )
        {
            if( $type != '' && strlen( $type ) == 1 && is_string( $type ) )
                $this->tipo_upload = $type;
        }

        public function setRenomear( $renomeia = FALSE )
        {
            if( is_bool( $renomeia ) )
                $this->renomear = $renomeia;
        }

        public function setDiretorio( $diretorio )
        {
            if( !empty( $diretorio ) )
                $this->diretorio = $diretorio;
        }

        public function setExtensao( $extensao )
        {
            $this->extensao = $extensao;
        }

        public function getStatusError()
        {
            return $this->error;
        }

    }

    /* End of file up_default.php */
    /* Location: ./app/modules/libraries/up_default.php */
