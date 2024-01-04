<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 7.2 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 *
 * @date    2018-08-31
 * @version 2018-08-31
 */
class Artigos extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_ADMIN;
    $this->_controller = strtolower( __CLASS__ );

    $this->_valida_usuario_logado_admin();

    $this->load->library('form_validation');
  }

  function index()
  {
    $this->load->model( $this->_modulo . 'Artigo_model', 'mart' );

    $res = $this->mart->lista();
    $qtd = is_array($res) ? count($res) : 0;

    $dados['res'] = $res;
    $dados['qtd'] = $qtd;

    // Valores obrigatórios e defaults para a view
    $this->load->library('Make_bread_admin', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Artigos');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Artigos';
    $dados['_titulo_page'] = 'Lista dos Artigos';

    $dados['_menu_left'] = 'artigos';

    $dados['_view'] = __METHOD__;
    $this->_template_admin( $dados );
  }

  function novo()
  {
    // Valores obrigatórios e defaults para a view
    $this->load->library('Make_bread_admin', $this->_modulo, 'breadcrumb');

    $this->breadcrumb->add('Artigos');
    $this->breadcrumb->add('Cadastrar Novo');

    $dados['_breadcrumb'] = $this->breadcrumb->output();

    $dados['_titulo'] = 'Artigos';
    $dados['_titulo_page'] = 'Adicionar Novo Artigo';

    $dados['_menu_left'] = 'artigos';

    $dados['_view'] = __METHOD__;
    $this->_template_admin( $dados );
  }

  function registro()
  {
    $config = array(
                  array( 'field' => 'inp_assunto', 'label' => 'Assunto', 'rules' => 'required' ),
                  array( 'field' => 'tex_mensagem', 'label' => 'Conteúdo do Artigo', 'rules' => 'required' )
                );
    $this->form_validation->set_rules( $config );

    $url_ok   = base_url( $this->_modulo . $this->_controller );
    $url_erro = base_url( $this->_modulo . $this->_controller . '/novo' );

    if( $this->form_validation->run() == FALSE )
     $this->novo();
    else
    {
      $this->load->model( $this->_modulo . 'Artigo_model', 'mart' );
      $this->load->library('upload');

      $this->mart->set_table( 'artigo' );

      $titulo = $this->input->post('inp_assunto');
      $slug = url_slug($titulo);
      $mensagem = $this->input->post('tex_mensagem');
      $data_cad = date('Y-m-d H:i:s');

      $where = array( 'art_slug' => $slug, 'art_statusAtivo' => TRUE );
      $qtd = $this->mart->count_results( $where );
      if( $qtd > 0 )
        $this->_mensagem_status( 'erro', 'Já existe um artigo com o assunto/titulo: '.$titulo.' - '.$slug, $url_erro );

      $inp_img = $_FILES['inp_imgPrincipal'];
      $img_nome = isset($inp_img['name']) ? get_nome_arquivo($inp_img['name']) : '';
      if( $img_nome == '' )
        $this->_mensagem_status( 'erro', 'A imagem é obrigatória.', $url_erro );
      else {
        $config = array();
        $config['upload_path'] = PATH_UPLOAD_ARTIGOS;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = $img_nome;
        $config['overwrite'] = TRUE;
        $config['max_size'] = 0;

        $this->upload->initialize( $config );
        $up = $this->upload->do_upload('inp_imgPrincipal');

        if( !$up ) {
          $msg_erro = $this->upload->display_errors();
          $this->_mensagem_status( 'aviso', 'Ocorreu o seguinte erro durante o envio da imagem: '.strip_tags($msg_erro), $url_erro );
        }
      }

      $datains1 = array();
      $datains1['fk_id_usuario'] = $this->_usu_admin_id;
      $datains1['art_slug'] = $slug;
      $datains1['art_titulo'] = $titulo;
      $datains1['art_conteudo'] = $mensagem;
      $datains1['art_dataCadastro'] = $data_cad;
      $datains1['art_imgPrincipal'] = $img_nome;
      $datains1['art_publico'] = TRUE;

      $id_art = $this->mart->insert( $datains1, TRUE );

      if( $id_art > 0 ) {
        $this->_mensagem_status( 'ok', 'Artigo cadastrado com sucesso.', $url_ok );
      }
      else
        $this->_mensagem_status( 'erro', 'Falha de comunicação com o servidor durante a tentativa de cadastro, tente novamente.', $url_erro );
    }
  }
}
