<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once( PATH_VENDOR . 'autoload.php' );

/**
 * NOTE: Requires PHP version 5 or later
 *
 * @author  André da Silva Severino <andre@andrewd.com.br>
 * @url     https://www.andrewd.com.br/
 *
 * @date    2018-05-10
 * @version 2018-09-29
 */
class Autenticacao extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->_modulo = MODULO_PAINEL;
    $this->_controller = strtolower( __CLASS__ );
  }

  function index() { $this->login(); }

  function login()
  {
    if( $this->_usu_painel_logado )
      redirect( $this->url_logado );

    $url_er = base_url( $this->_modulo . $this->_controller . '/login' );

    $dados['_titulo'] = 'Login';
    $dados['_view'] = __METHOD__;
    $dados['_tipo'] = 2;

    $fb = new \Facebook\Facebook([
      'app_id' => FACEBOOK_APP_ID,
      'app_secret' => FACEBOOK_APP_SECRET,
      'default_graph_version' => 'v3.1',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $url_login = base_url($this->_modulo.$this->_controller.'/facebook-callback');

    $dados['fb_loginUrl'] = $helper->getLoginUrl($url_login, ['email']);

    $this->_template_painel( $dados );
  }

  function login_2()
  {
    if( $this->_usu_painel_logado )
      redirect( $this->url_logado );

    $dados['_titulo'] = 'Login';
    $dados['_view'] = __METHOD__;
    $dados['_tipo'] = 2;

    $fb = new \Facebook\Facebook([
      'app_id' => FACEBOOK_APP_ID,
      'app_secret' => FACEBOOK_APP_SECRET,
      'default_graph_version' => 'v3.1',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $url_login = base_url($this->_modulo.$this->_controller.'/facebook-callback');

    $dados['fb_loginUrl'] = $helper->getLoginUrl($url_login, ['email']);

    $this->_template_painel( $dados );
  }

  function facebook_callback()
  {
    if( $this->_usu_painel_logado )
      redirect( $this->url_logado );

    $url_ok = $this->url_logado;
    $url_er = base_url( $this->_modulo . $this->_controller . '/login' );
    $url_er2 = base_url( $this->_modulo . $this->_controller . '/enviar-nova-confirmacao' );

    $fb = new \Facebook\Facebook([
      'app_id' => FACEBOOK_APP_ID,
      'app_secret' => FACEBOOK_APP_SECRET,
      'default_graph_version' => 'v3.1',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    try {
    		$accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) { // When Graph returns an error
    	$this->_mensagem_status( 'erro', 'Graph returned an error: ' . $e->getMessage(), $url_er);
    	exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) { // When validation fails or other local issues
    	$this->_mensagem_status( 'erro', 'Facebook SDK returned an error: ' . $e->getMessage(), $url_er);
    	exit;
    }

    if($accessToken != ''){
  		$fb->setDefaultAccessToken($accessToken);
  	}//Usuário não está autenticado
  	else{
  		$oAuth2Client = $fb->getOAuth2Client();
  		$accessToken = (string)$oAuth2Client->getLongLivedAccessToken($accessToken);
  		$fb->setDefaultAccessToken($accessToken);

      $session = array('face_access_token' => $accessToken);
      $this->session->set_userdata($session);
  	}

    try {
  		// Returns a `Facebook\FacebookResponse` object
  		$response = $fb->get('/me?fields=name, picture.width(160).height(160), email');
  		$user = $response->getGraphUser();

      $face_id = $user['id'];
      $face_foto = $user['picture']['url'];
      $email = $user['email'];
      $nome = $user['name'];

      $perf_id = 2;

      $this->load->model( $this->_modulo . 'Autenticacao_model', 'mauth' );

      $this->mauth->set_table('usuario_perfil');
      $this->mauth->set_return('row');

      $field = array('uperf_nome');
      $where = array('uperf_id'=>$perf_id);
      $res = $this->mauth->get($field,$where);

      $perf_nome = $res['uperf_nome'];

      $res = $this->mauth->loginFacebook( $email, $face_id );
      $qtd = is_array($res) ? count($res) : 0;
      if( $qtd > 0 )
      {
        # Realiza o login
        $usu_id = $res['usu_id'];
        $token = $res['usu_token'];
        $nome = $res['usu_nome'];
        $email = $res['usu_email1'];
        $senha = $res['usu_senha'];
        $dataCadastro = converte_data( $res['usu_dataCadastro'] );
        $admin = $res['usu_admin'];
        $perf_nome = $res['uperf_nome'];
        $perf_id = $res['fk_id_perfil'];
        $foto = $res['usu_foto'];
        $telefone = $res['usu_telefone1'];
        $celular = $res['usu_celular1'];

        // Verificações
        $usu_confirmado = $res['usu_confirmado'];
        $usu_status = $res['usu_status'];

        if( !$usu_confirmado )
          $this->_mensagem_status( 'erro', 'Verifique seu e-mail <b>'.$usu_email.'</b> e confirme seu cadastro.', $url_er2 );

        if( !$usu_status )
          $this->_mensagem_status( 'erro', 'Acesso desativado, entre em <a href="'.base_url('contato').'">contato conosco</a> para maiores informações.', $url_er );
      }
      else
      {
        # Cadastra o usuário
        $nome = mb_convert_case( $nome, MB_CASE_TITLE, "UTF-8" );
        $senha = senha_aleatoria();
        $token = gerar_token();
        $dataCadastro = date('Y-m-d H:i:s');
        $admin = FALSE;
        $celular = '';
        $telefone = '';
        $foto = '';

        $datains1 = array();
        $datains1['fk_id_perfil'] = $perf_id;
        $datains1['usu_nome'] = $nome;
        $datains1['usu_email1'] = $email;
        $datains1['usu_token'] = $token;
        $datains1['usu_dataCadastro'] = $dataCadastro;
        $datains1['usu_senha'] = crypt_senha($senha);
        $datains1['usu_confirmado'] = TRUE;
        $datains1['usu_admin'] = $admin;
        $datains1['usu_facebookId'] = $face_id;
        $datains1['usu_facebookToken'] = $accessToken;

        $this->mauth->set_table('usuario');

        $usu_id = $this->mauth->insert( $datains1, TRUE );
        if( $usu_id > 0 ) {

          $this->_email_usuario_boas_vindas($nome,$email,$senha);

          $senha = $datains1['usu_senha'];

          $dir = PATH_AVATAR.$usu_id.'/';
          verifica_diretorio($dir);

          $img_ext = '.jpg';
          $img_name = url_slug($nome);
          $foto = $img_name.$img_ext;
          file_put_contents($dir.$foto, file_get_contents($face_foto));

          $dataupd1 = array('usu_foto'=>$foto);
          $this->mauth->update($dataupd1,array('usu_id'=>$usu_id));
        }
        else
          $this->_mensagem_status( 'info', 'Falha ao tentar acessar com o Facebook, entre em <a href="'.base_url('contato').'">contato conosco</a> para maiores informações.', $url_er );
      }

      $session = array(
                    'drplace_usu_id' => $usu_id,
                    'drplace_usu_token' => $token,
                    'drplace_usu_nome' => $nome,
                    'drplace_usu_email' => $email,
                    'drplace_usu_senha' => $senha,
                    'drplace_usu_telefone' => ($celular != '') ? $celular : $telefone,
                    'drplace_usu_dataCadastro' => $dataCadastro,
                    'drplace_usu_perf_id' => $perf_id,
                    'drplace_usu_perf_nome' => $perf_nome,
                    'drplace_usu_admin' => $admin,
                    'drplace_usu_foto' => $foto,
                    'drplace_usu_logado' => TRUE
                );

      $this->session->set_userdata( $session );
      if( !EXEC_CLI )
      {
        $datains = array();
        $datains['fk_id_usuario'] = $usu_id;
        $datains['logace_data'] = date('Y-m-d H:i:s');
        $datains['logace_enderecoIp'] = $_SERVER['REMOTE_ADDR'];
        $datains['logace_navegador'] = $_SERVER['HTTP_USER_AGENT'];

        $this->mauth->set_table('log_acesso');
        $this->mauth->insert($datains);
      }

      redirect( $url_ok );

  	} catch(Facebook\Exceptions\FacebookResponseException $e) {
  		$this->_mensagem_status( 'erro', 'Graph returned an error: ' . $e->getMessage(), $url_er);
  		exit;
  	} catch(Facebook\Exceptions\FacebookSDKException $e) {
  		$this->_mensagem_status( 'erro', 'Facebook SDK returned an error: ' . $e->getMessage(), $url_er);
  	exit;
  	}
  }

  function confirmar( $token = NULL )
  {
    if( $this->_usu_painel_logado )
      redirect( $this->url_logado );

    $dados['_titulo'] = 'Confirmação do seu cadastro';
    $dados['_view'] = __METHOD__;
    $dados['_tipo'] = 2;

    $this->_template_painel( $dados );
  }

  function logar( $token = NULL, $landpage = 1 )
  {
    if( $this->_usu_painel_logado )
      redirect( $this->url_logado );

    $this->load->library('form_validation');

    $config = array(
                     array('field'=>'inp_email', 'label'=>'E-mail', 'rules'=>'required'),
                     array('field'=>'inp_senha', 'label'=>'Senha', 'rules'=>'required')
                );

    $this->form_validation->set_rules( $config );

    if ( ! $this->form_validation->run($this) )
     $this->login();
    else
    {
      $url_ok = $this->url_logado;
      $url_er = base_url( $this->_modulo . $this->_controller . '/login' );
      $url_er2 = base_url( $this->_modulo . $this->_controller . '/enviar-nova-confirmacao' );

      $email  = $this->input->post( 'inp_email' );
      $senha  = crypt_senha( $this->input->post( 'inp_senha' ) );
      $token  = valida_token($token);

      $this->load->model( $this->_modulo . 'Autenticacao_model', 'mauth' );

      $res = $this->mauth->login( $email, $senha, $token );
      $qtd = is_array($res) ? count($res) : 0;
      if( $qtd > 0 )
      {
        if( !isset($res['usu_id']) )
          $this->_mensagem_status( 'erro', 'Não foi possível localizar os dados para acessar o portal, entre em <a href="'.base_url('contato').'">contato conosco</a> para maiores informações ou tente novamente.', $url_er );

        $usu_id = $res['usu_id'];
        $usu_token = $res['usu_token'];
        $usu_nome = $res['usu_nome'];
        $usu_email = $res['usu_email1'];
        $usu_senha = $res['usu_senha'];
        $usu_dataCadastro = converte_data( $res['usu_dataCadastro'] );
        $usu_admin = $res['usu_admin'];
        $perf_nome = $res['uperf_nome'];
        $perf_id = $res['fk_id_perfil'];
        $usu_foto = $res['usu_foto'];
        $usu_telefone = $res['usu_telefone1'];
        $usu_celular = $res['usu_celular1'];

        // Verificações
        $usu_confirmado = $res['usu_confirmado'];
        $usu_status = $res['usu_status'];

        if( !$usu_confirmado )
          $this->_mensagem_status( 'erro', 'Verifique seu e-mail <b>'.$usu_email.'</b> e confirme seu cadastro.', $url_er2 );

        if( !$usu_status )
          $this->_mensagem_status( 'erro', 'Acesso desativado, entre em <a href="'.base_url('contato').'">contato conosco</a> para maiores informações.', $url_er );

        // if( (int)$landpage > 1 || ($perf_id == 1) ) {
        //   $url_ok = base_url(MODULO_PORTAL.$this->_controller.'/seja-bem-vindo');
        // }

        $session = array(
                      'drplace_usu_id' => $usu_id,
                      'drplace_usu_token' => $usu_token,
                      'drplace_usu_nome' => $usu_nome,
                      'drplace_usu_email' => $usu_email,
                      'drplace_usu_senha' => $usu_senha,
                      'drplace_usu_telefone' => ($usu_celular != '') ? $usu_celular : $usu_telefone,
                      'drplace_usu_dataCadastro' => $usu_dataCadastro,
                      'drplace_usu_perf_id' => $perf_id,
                      'drplace_usu_perf_nome' => $perf_nome,
                      'drplace_usu_admin' => $usu_admin,
                      'drplace_usu_foto' => $usu_foto,
                      'drplace_usu_logado' => TRUE
                  );

        $this->session->set_userdata( $session );
        if( !EXEC_CLI )
        {
          $datains = array();
          $datains['fk_id_usuario'] = $usu_id;
          $datains['logace_data'] = date('Y-m-d H:i:s');
          $datains['logace_enderecoIp'] = $_SERVER['REMOTE_ADDR'];
          $datains['logace_navegador'] = $_SERVER['HTTP_USER_AGENT'];

          $this->mauth->set_table('log_acesso');
          $this->mauth->insert($datains);
        }

        redirect( $url_ok );
      }
      else
        $this->_mensagem_status( 'erro', 'Dados de acesso inválidos, verifique os dados digitados e tente novamente.', $url_er );
    }

  }

  function logout()
  {
    $session = array(
                'drplace_usu_id' => 0,
                'drplace_usu_logado' => FALSE
            );

    $this->session->set_userdata( $session );
    $url = base_url();
    redirect( $url );
  }

}
