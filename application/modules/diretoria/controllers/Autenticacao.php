<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://www.andrewd.com.br/
 *
 * @date    2018-08-31
 * @version 2018-08-31
 */
class Autenticacao extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo      = MODULO_ADMIN;
    $this->_controller  = strtolower( __CLASS__ );

    $this->url_logado = base_url( $this->_modulo . 'home/dashboard' );
  }

  function index()
  {
    $this->login();
  }

  function login()
  {
    if( $this->_usu_admin_logado )
      redirect( $this->url_logado );

    $dados['_titulo'] = 'Gestão do Portal Doutor.Place - Login';
    $dados['_view'] = __METHOD__;
    $dados['_tipo'] = 2;

    $this->_template_admin( $dados );
  }

  function logar()
  {
    if( $this->_usu_admin_logado )
      redirect( $this->url_logado );

    $this->load->library('form_validation');

    $config = array(
                     array('field'=>'inp_email', 'label'=>'E-mail', 'rules'=>'required'),
                     array('field'=>'inp_senha', 'label'=>'Senha', 'rules'=>'required')
                );

    // $this->form_validation->set_message( 'required', 'O campo <b>%s</b> é obrigatório.' );
    $this->form_validation->set_rules($config);

    if ( ! $this->form_validation->run($this) )
     $this->login();
    else
    {
      $url_ok = $this->url_logado;
      $url_er = base_url( $this->_modulo . $this->_controller . '/login' );

      $email = $this->input->post( 'inp_email' );
      $senha = crypt_senha( $this->input->post( 'inp_senha' ) );

      $this->load->model( $this->_modulo . 'Autenticacao_model', 'mauth' );

      $res = $this->mauth->login( $email, $senha );
      $qtd = is_array($res) ? count($res) : 0;
      if( $qtd > 0 )
      {
        $usu_id = $res['usu_id'];
        $usu_token = $res['usu_token'];
        $usu_nome = $res['usu_nome'];
        $usu_telefone = $res['usu_telefone1'];
        $usu_dataCadastro = converte_data( $res['usu_dataCadastro'] );

        $cid_id = $res['cid_id'];
        $cid_nome = $res['cid_nome'];
        $cid_sigla = $res['cid_sigla'];

        // Verificações
        $usu_status = $res['usu_status'];
        if( !$usu_status )
            $this->_mensagem_status( 'erro', 'Usuário desativado, entre em contato conosco ou com o responsável.', $url_er );

        $session = array(
                      'adm_usu_id' => $usu_id,
                      'adm_usu_token' => $usu_token,
                      'adm_usu_nome' => $usu_nome,
                      'adm_usu_telefone' => $usu_telefone,
                      'adm_usu_dataCadastro' => $usu_dataCadastro,
                      'adm_usu_email' => $email,
                      'adm_usu_senha' => $senha,
                      'adm_cid_id' => $cid_id,
                      'adm_cid_nome' => $cid_nome,
                      'adm_cid_sigla' => $cid_sigla,
                      'adm_usu_logado' => TRUE
                  );

        $this->session->set_userdata( $session );

        $ip = (!EXEC_CLI) ? $_SERVER['REMOTE_ADDR'] : '';
        $ua = (!EXEC_CLI) ? $_SERVER['HTTP_USER_AGENT'] : '';

        $datains = array();
        $datains['fk_id_usuario'] = $usu_id;
        $datains['logace_data'] = date('Y-m-d H:i:s');
        $datains['logace_enderecoIp'] = ($ip != '') ? $ip : '#$ EXEC_CLI';
        $datains['logace_navegador'] = ($ua != '') ? $ua : 'Browser EXEC_CLI';

        $this->mauth->set_table('log_acesso');
        $this->mauth->insert($datains);

        redirect( $url_ok );
      }
      else
        $this->_mensagem_status( 'erro', 'Dados de acesso inválidos, verifique os dados digitados e tente novamente.', $url_er );
    }
  }

  function logout()
  {
    $this->session->sess_destroy();
    $url = base_url( $this->_modulo );
    redirect( $url );
  }

}
