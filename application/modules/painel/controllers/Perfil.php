<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-05-21
 * @version 2018-05-22
 */
class Perfil extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PAINEL;
    $this->_controller = strtolower( __CLASS__ );

    $this->_valida_usuario_logado_painel();
  }

  function index(){ $this->meu_perfil(); }

  function meu_perfil()
  {
    $this->load->model( $this->_modulo . 'Usuario_model', 'musu' );
    $res_usu = $this->musu->editar($this->_usu_painel_id);
    $qtd_usu = is_array($res_usu) ? count($res_usu) : 0;

    $id_cid = isset($res_usu['fk_id_cidade']) ? $res_usu['fk_id_cidade'] : 0;

    $uf = '';
    $res_cid = array();
    if( (int)$id_cid > 0 ) {
      $uf = $res_usu['cid_sigla'];

      $this->musu->set_table('cidade');
      $field = array('cid_id','cid_sigla','cid_nome');
      $where = array('cid_sigla' => $uf, 'cid_status'=>TRUE,'cid_statusAtivo'=>TRUE);
      $order = 'cid_nome ASC';
      $res_cid = $this->musu->get($field, $where, $order);
    }

    $qtd_cid = is_array($res_cid) ? count($res_cid) : 0;

    $dados['res_cid'] = $res_cid;
    $dados['qtd_cid'] = $qtd_cid;

    $dados['combo_uf'] = combo_uf();
    $dados['qtd_uf'] = count($dados['combo_uf']);

    $dados['res_usu'] = $res_usu;

    $dados['_uf'] = $uf;

    $this->load->library('Make_bread_painel', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Minha Conta');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Atualizar Meu Perfil';
    $dados['_titulo_page'] = 'Editar '.$this->_usu_painel_nome;

    $dados['_menu_painel'] = 'meu_perfil';

    $dados['_view'] = __METHOD__;
    $this->_template_painel( $dados );
  }

  function atualizar()
  {
    $this->load->library('form_validation');

    $config = array(
                    array( 'field' => 'inp_nome', 'label' => 'Nome', 'rules' => 'required' ),
                    array( 'field' => 'inp_email', 'label' => 'E-mail', 'rules' => 'required' )
                );
    $this->form_validation->set_rules( $config );

    $url_ok = base_url( $this->_modulo . $this->_controller . '/meu-perfil' );
    $url_erro = $url_ok;

    if( $this->form_validation->run() == FALSE )
     $this->meu_perfil();
    else
    {
      $nome = mb_convert_case( $this->input->post('inp_nome'), MB_CASE_TITLE, "UTF-8" );
      $email = mb_strtolower($this->input->post('inp_email'));
      $senha1 = $this->input->post('inp_senha1');
      $senha2 = $this->input->post('inp_senha2');
      $telefone1 = $this->input->post('inp_telefone1');
      $celular1 = $this->input->post('inp_celular1');
      $whatsapp1 = $this->input->post('inp_whatsapp1');
      $radio1 = $this->input->post('inp_radio1');
      $site = $this->input->post('inp_site');
      $facebook = $this->input->post('inp_facebook');
      $twitter = $this->input->post('inp_twitter');
      $instagram = $this->input->post('inp_instagram');
      $inp_avatar = $_FILES['inp_avatar'];
      $nome_avatar = isset($_FILES['inp_avatar']['name']) ? $_FILES['inp_avatar']['name'] : '';
      $avatar = $this->session->userdata('drplace_usu_foto');

      if( ($senha1 != $senha2) && ($senha1 != '') )
        $this->_mensagem_status( 'erro', 'As senhas não conferem, tente novamente.', $url_erro );

      if( $nome_avatar != '' )
      {
        $this->load->library('upload/Imagem',NULL,'upimg');

        $diretorio = PATH_AVATAR.$this->_usu_painel_id.'/';
        verifica_diretorio($diretorio);

        $arq_nome = get_nome_arquivo($inp_avatar['name'], 70);

        list( $width, $height ) = getimagesize($inp_avatar['tmp_name']);

        $size = $this->upimg->getTamanhoRedimensionado($width,$height,UP_FOTO_AVATAR_MAX_LARG,UP_FOTO_AVATAR_MAX_ALT);

        $this->upimg->setRedimensionar();
        $this->upimg->setArquivo($inp_avatar);
        $this->upimg->setNomeArquivoImg($arq_nome);
        $this->upimg->setDiretorio($diretorio);
        $this->upimg->setAltura($size['h']);
        $this->upimg->setLargura($size['w']);
        $this->upimg->upload();

        $st = $this->upimg->getStatusError();
        if( $st->cod == 1 )
          $avatar = $st->nome_arquivo;
      }

      $this->load->model($this->_modulo.'Usuario_model','musu');

      $this->musu->set_table('usuario');

      $dataupd1['usu_nome'] = $nome;
      $dataupd1['usu_telefone1'] = $telefone1;
      $dataupd1['usu_celular1'] = $celular1;
      $dataupd1['usu_whatsapp1'] = $whatsapp1;
      $dataupd1['usu_radio1'] = $radio1;
      $dataupd1['usu_site'] = $site;
      $dataupd1['usu_facebook'] = $facebook;
      $dataupd1['usu_twitter'] = $twitter;
      $dataupd1['usu_instagram'] = $instagram;
      $dataupd1['usu_foto'] = $avatar;

      if( $this->_usu_painel_email != $email ) {
        $where = array('usu_email1' => $email, 'usu_statusAtivo' => TRUE);
        $qtd = $this->musu->count_results($where);
        if( $qtd > 0 )
          $this->_mensagem_status('erro', 'Já existe um usuário com o e-mail <b>'.$email.'</b>, se você esqueceu a senha <a href="'.$url_rsenha.'">clique aqui</a>.', $url_erro);

        $dataupd1['usu_email1'] = $email;
      }

      if( ($senha1 != '') && ($senha1 == $senha2) )
        $dataupd1['usu_senha'] = crypt_senha($senha1);

      $where = array('usu_id' => $this->_usu_painel_id);
      $st = $this->musu->update($dataupd1,$where);
      if( $st ) {
        $session = array('drplace_usu_nome'=>$nome,'drplace_usu_email'=>$email);
        if( $avatar != '' )
          $session['drplace_usu_foto'] = $avatar;

        $this->session->set_userdata($session);

        $this->_mensagem_status('ok','Conta atualizada com sucesso.', $url_ok);
      } else
        $this->_mensagem_status('erro','Ops! Ocorreu um erro interno no servidor, pedimos desculpa pelo incoveniente e tente novamente assim que possível.', $url_erro);
    }
  }
}
