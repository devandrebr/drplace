<?php

define('VERSAO_PORTAL','24.09.2');
define('VERSAO_PAINEL','24.09.1');
define('VERSAO_ADMIN','24.09.1');

define('SOURCE_DEV', TRUE);

define('EMAIL_USAR_SMTP_1', TRUE);
define('EMAIL_HOST_SMTP_1', (ENVIRONMENT !== 'production') ? 'mail.drplace.com.br' : 'localhost');
define('EMAIL_PORT_SMTP_1', '587' );
define('EMAIL_USER_SMTP_1', 'notificacao@drplace.com.br');
define('EMAIL_PASS_SMTP_1', '^)@2%3;;2V4x');

$cli = defined('STDIN') ? TRUE : FALSE;
define('EXEC_CLI', $cli);

define('BASE_URL_EMAIL', 'http://beta.drplace.com.br/');
define('BASE_URL_FALE_CONOSCO', 'https://beta.drplace.com.br/contato/');

define('MODULO_CAMPANHA_1', 'pre_lancamento/');
define('MODULO_CAMPANHA_2', 'anuncio/');
define('MODULO_PORTAL', 'portal/');
define('MODULO_PAINEL', 'painel/');
define('MODULO_ADMIN', 'diretoria/');
define('MODULO_ERRO', 'errors/');

define('ASSETS_PORTAL', 'public/portal/');
define('ASSETS_CAMPANHA_2', 'public/anuncio/');
define('ASSETS_ADMIN', 'public/admin/');
define('ASSETS_UPLOADS', 'public/uploads/');
define('ASSETS_AVATAR', ASSETS_UPLOADS.'avatar/');
define('ASSETS_ARTIGOS', ASSETS_UPLOADS.'artigos/');
define('ASSETS_QUEMSOMOS', 'public/quem-somos/');

define('UP_FOTO_IMOVEL_MAX_LARG',1920);
define('UP_FOTO_IMOVEL_MAX_ALT',1080);
define('UP_FOTO_AVATAR_MAX_LARG',200);
define('UP_FOTO_AVATAR_MAX_ALT',200);

$path = rtrim(str_replace(array('\\'), array('/'),getcwd()),'/') . '/';

define('PATH_SISTEMA', $path);
define('PATH_UPLOAD', PATH_SISTEMA.ASSETS_UPLOADS);
define('PATH_UPLOAD_ARTIGOS', PATH_SISTEMA.ASSETS_ARTIGOS);
define('PATH_AVATAR', PATH_SISTEMA.ASSETS_AVATAR);
define('PATH_VENDOR', PATH_SISTEMA.'vendor/');
define('PATH_TMP', PATH_SISTEMA.'tmp/');
define('PATH_LOGS', PATH_SISTEMA.'application/logs/');
define('PATH_LIBRARIES', PATH_SISTEMA.'application/libraries/');

define('SALT_SENHA_USUARIO', 'SejauMvenc3d0rN4v1d4Ag0r@');

# PROD - GoogleMaps - AIzaSyAyuPT4tAaU9wgD1pb1gAuXHuVO1MdJeiY
# PROD - KeyPrivate - Recaptcha - 6Lc7WF8UAAAAANTMGwsemV1z-iuMAOMZig9jUy-X
# PROD - SiteKey - Recaptcha - 6Lc7WF8UAAAAAE-CzuG4Kzka36755MARMAeHokFO
define('API_KEY_GOOGLE_MAPS', 'AIzaSyCUPAO3bqG_KW7RhyihPXL_FsVyAHX3CCU');
define('GOOGLE_KEY_RECAPTCHA', '6LfwWSYTAAAAAD6nKMIIOH57ZZ13q3BMN9SocQRc');
define('GOOGLE_SITE_RECAPTCHA', '6LfwWSYTAAAAAPBoT1fF6o6cVnhpBJx9ExC7JGX-');

define('FACEBOOK_APP_ID', '379021685845642');
define('FACEBOOK_APP_SECRET', 'bed02b1c279cc1b3d276dd7ec8485128');

define('KEY_API_ADMIN_SPARKPOST', 'be5214582c35f12cf6b691a6af5fb799a2f67fdd');

define('LINK_RS_FACEBOOK', 'https://www.facebook.com/drplace');
define('LINK_RS_INSTAGRAM', 'https://www.instagram.com/drplace');
define('LINK_RS_LINKEDIN', 'https://www.linkedin.com/in/drplace');

define('CONTATO_SKYPE', 'skype.drplace');
define('CONTATO_TELEFONE', '(19) 98888-7777');
define('CONTATO_EMAIL', 'contato@drplace.com.br');

define('CAMPANHA_01_CODIGO','CAMP001_PRELANCAMENTO');
define('CAMPANHA_02_CODIGO','CAMP002_ANUNCIOIMOVEL');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
