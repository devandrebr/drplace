<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'portal/home/index';
// $route['default_controller'] = 'pre_lancamento/outubro';
$route['404_override'] = 'erro/pagina/nao_encontrada';
$route['translate_uri_dashes'] = FALSE;

$route['pre-lancamento'] = 'pre_lancamento/outubro';

# Portal
$route['portal'] = 'portal/home';
$route['servico'] = 'portal/servico';
$route['servico/contate-um-advogado'] = 'portal/parceiros/contate_advogado';
$route['contato'] = 'portal/contato';
$route['anuncie-seu-imovel'] = 'portal/anuncie';
$route['quem-somos'] = 'portal/quem_somos';
$route['vantagens'] = 'portal/vantagens';
$route['ajuda'] = 'portal/ajuda';

$route['imoveis-para-comprar'] = 'portal/imovel/comprar';
$route['imoveis-para-alugar'] = 'portal/imovel/alugar';

$route['politica-de-privacidade'] = 'portal/ajuda/politica_privacidade';
$route['termos-de-uso'] = 'portal/ajuda/termos_de_uso';

$route['faq/ajuda/como-comprar'] = 'portal/ajuda/faq_como_comprar';
$route['faq/ajuda/como-vender'] = 'portal/ajuda/faq_como_vender';

$route['artigo'] = 'portal/artigo/lista';
$route['artigos'] = 'portal/artigo/lista';
$route['portal/artigo'] = 'portal/artigo/lista';
$route['portal/artigos'] = 'portal/artigo/lista';

$route['portal/artigo/lista'] = 'portal/artigo/lista';

$route['artigo/(:any)'] = 'portal/artigo/detalhe/$1';
$route['artigos/(:any)'] = 'portal/artigo/detalhe/$1';
$route['portal/artigo/(:any)'] = 'portal/artigo/detalhe/$1';
$route['portal/artigos/(:any)'] = 'portal/artigo/detalhe/$1';

# Painel
$route['painel'] = 'painel/autenticacao';
$route['criar-conta'] = 'painel/usuario/criar_conta';
$route['painel/novo-anuncio'] = 'painel/imovel/novo_anuncio';
$route['novo-anuncio'] = 'painel/imovel/novo_anuncio';
$route['painel/meus-imoveis'] = 'painel/imovel/meus_imoveis';
$route['meus-imoveis'] = 'painel/imovel/meus_imoveis';

$route['confirmar/(:any)'] = 'painel/autenticacao/confirmar/$1';
$route['painel/confirmar/(:any)'] = 'painel/autenticacao/confirmar/$1';
$route['confirmar-conta/(:any)'] = 'painel/autenticacao/confirmar/$1';

$route['painel/imoveis-favoritos'] = 'painel/imovel/favoritos';
$route['imoveis-favoritos'] = 'painel/imovel/favoritos';

$route['compartilhe'] = 'painel/home/compartilhe';
$route['painel/compartilhe-indique-para-um-amigo'] = 'painel/home/compartilhe';
$route['portal/compartilhe-indique-para-um-amigo'] = 'painel/home/compartilhe';
$route['compartilhe-indique-para-um-amigo'] = 'painel/home/compartilhe';

# Diretoria
$route['diretoria'] = 'diretoria/autenticacao';
$route['portal/diretoria'] = 'diretoria/autenticacao';
$route['admin'] = 'diretoria/autenticacao';
$route['portal/admin'] = 'diretoria/autenticacao';

$route['p/(:any)'] = 'diretoria/parceiro/set_info/$1';
$route['parceiro/(:any)'] = 'diretoria/parceiro/set_info/$1';
$route['parceiros/(:any)'] = 'diretoria/parceiro/set_info/$1';
