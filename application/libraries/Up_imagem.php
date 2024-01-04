<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    require_once(PATH_LIBRARIES . 'Up_default.php');

    /**
     * NOTE: Requires PHP version 5 or later
     *
     * @package ./application/libraries
     *
     * @author  André da Silva Severino
     *
     * @version 2017-05-05 16:30
     */
    class Up_Imagem extends Up_Default
    {
        private $largura        = 800;
        private $altura         = 600;
        private $thumb          = FALSE;
        private $thumb_altura   = 250;
        private $thumb_largura  = 250;
        private $transparencia  = 100;
        private $qualidade_img  = 90;
        private $diretorio_thumb;
        private $redimensionar;

        public function __construct()
        {
            parent::__construct();

            $this->extensao = array('jpg', 'png', 'gif', 'jpeg');
        }

        public function setExtensao( $ext )
        {
            $this->extensao = $ext;
        }

        public function setTransparencia( $num )
        {
            if( (int)$num > 0 )
                $this->transparencia = (int)$num;
        }

        public function setNomeArquivoImg( $nome )
        {
          $this->nome_arquivo = $nome;
        }

        protected function uploadImagem()
        {
            switch( $this->arquivo['type'] )
            {
                case 'image/gif':
                    $img = imagecreatefromgif( $this->arquivo['tmp_name'] );
                break;

                case 'image/png':
                case 'image/x-png':
                    $img = imagecreatefrompng( $this->arquivo['tmp_name'] );
                break;

                default:
                    $img = imagecreatefromjpeg( $this->arquivo['tmp_name'] );
            }

            $x = imagesx( $img );
            $y = imagesy( $img );

            if( $this->redimensionar ){
                if($x >= $y)
                    $this->altura = ( $this->largura * $y) / $x;
                else{
                        $this->setAltura($this->largura / 1.333333333);
                        $this->largura = ( $this->altura * $x) / $y;
                }
            }

            $local = $this->diretorio . $this->nome_arquivo;
            $nova  = imagecreatetruecolor( $this->largura, $this->altura );

            if( $this->arquivo['type'] == 'image/png' || $this->arquivo['type'] == 'image/x-png' )
            {
                imagealphablending($img, false);
                imagesavealpha($img, true);
                imagealphablending($nova, false);
                imagesavealpha($nova, true);
            }

            imagecopyresampled( $nova, $img, 0, 0, 0, 0, $this->largura, $this->altura, $x, $y );

            switch( $this->arquivo['type'] )
            {
                case 'image/gif':
                    $st = imagegif( $nova, $local );
                break;

                case 'image/png':
                case 'image/x-png':
                    $st = imagepng( $nova, $local );
                break;

                default:
                    $st = imagejpeg( $nova, $local, $this->qualidade_img );
            }

            imagedestroy( $img );
            imagedestroy( $nova );

            if( $this->thumb )
                self::uploadImagemThumb();

            if( $st )
                parent::setStatusError( 1, 'Imagem enviada com sucesso', $this->nome_arquivo );
            else
                parent::setStatusError( 0, 'Diretório das mininaturas inacessível' );

        }

        protected function uploadImagemThumb()
        {
            if( parent::checkDiretorio( $this->diretorio_thumb ) )
            {
                switch( $this->arquivo['type'] )
                {
                    case 'image/gif':
                        $img = imagecreatefromgif( $this->arquivo['tmp_name'] );
                    break;

                    case 'image/png':
                    case 'image/x-png':
                        $img = imagecreatefrompng( $this->arquivo['tmp_name'] );
                    break;

                    default:
                        $img = imagecreatefromjpeg( $this->arquivo['tmp_name'] );
                }

                $x = imagesx( $img );
                $y = imagesy( $img );

                if( $this->redimensionar )
                    $this->thumb_altura = ( $this->thumb_largura * $y) / $x;

                $local = $this->diretorio_thumb . $this->nome_arquivo;
                $nova  = imagecreatetruecolor( $this->thumb_largura, $this->thumb_altura );

                if( $this->arquivo['type'] == 'image/png' || $this->arquivo['type'] == 'image/x-png' )
                {
                    imagealphablending($img, false);
                    imagesavealpha($img, true);
                    imagealphablending($nova, false);
                    imagesavealpha($nova, true);
                }

                imagecopyresampled( $nova, $img, 0, 0, 0, 0, $this->thumb_largura, $this->thumb_altura, $x, $y );

                switch( $this->arquivo['type'] )
                {
                    case 'image/gif':
                        $st = imagegif( $nova, $local );
                    break;

                    case 'image/png':
                    case 'image/x-png':
                        $st = imagepng( $nova, $local );
                    break;

                    default:
                        $st = imagejpeg( $nova, $local, $this->qualidade_img );
                }

                imagedestroy( $img );
                imagedestroy( $nova );

                if( $st )
                    parent::setStatusError( 1, 'Imagem enviada com sucesso', $this->nome_arquivo );
                else
                    parent::setStatusError( 0, 'Diretório das mininaturas inacessível' );
            }
            else
                parent::setStatusError( 0, 'Diretório das mininaturas inacessível' );
        }

        public function setDiretorioThumb( $diretorio )
        {
            if( !empty( $diretorio ) )
                $this->diretorio_thumb = $diretorio;
        }

        public function setThumb( $altura = 0, $largura = 0 )
        {
            if( ((int)$altura > 0) || ((int)$altura > 0) )
            {
                $this->thumb = TRUE;

                $this->thumb_altura  = ((int)$altura > 0) ? $altura : $this->thumb_altura;
                $this->thumb_largura = ((int)$largura > 0) ? $largura : $this->thumb_largura;
            }
        }

        public function setLargura( $largura )
        {
            $this->largura = $largura;
        }

        public function setAltura( $altura )
        {
            $this->altura = $altura;
        }

        public function setRedimensionar( $red = FALSE )
        {
            if( is_bool($red) )
                $this->redimensionar = $red;
        }

        public function getTamanhoRedimensionado($imgWidth, $imgHeight, $maxWidth, $maxHeight)
        {

            if($imgWidth > $maxWidth || $imgHeight > $maxHeight){

                $new_width  = $maxWidth;
                $new_height = $maxHeight;

                $scale      = min( $maxWidth / $imgWidth, $maxHeight / $imgHeight );

                $new_width  = ceil( $scale * $imgWidth );
                $new_height = ceil( $scale * $imgHeight );

            }
            else{
                $new_width  = $imgWidth;
                $new_height = $imgHeight;
            }

            return array('w' => $new_width, 'h' => $new_height);
        }

    }
