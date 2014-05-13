<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


define('BASE_URL', 'http://localhost/onlinesurvey/olsv-bpotech/');

define('DEFAULT_PAGE_TITLE', 'Online Survey');

define('USER_SESSION_KEY', 'uid');

define('POST_DATA', 'post_data');

define('SUCCESS_CLASS',		'success');

define('INFO_CLASS',		'info');

define('ERROR_CLASS',		'error');

define('WARNING_CLASS',		'warning');

define('ADMIN_MAIL','localhost_wampserver@yahoo.com');

define('USERNAME','localhost_wampserver@yahoo.com');

define('PASSWORD','Abc123...');

define('HOST_MAIL','smtp.mail.yahoo.com');

define('ALT_BODY_FORGOT_ID', 'This email is feedback requirements reminiscent username');

define('ALT_BODY_FORGOT_PASSWORD', 'This email is feedback requirements reminiscent password');

define('ALT_BODY_ACTIVE_ACCOUNT', 'This email contains information to activate your account');

define('PORT',587);

define('SMTPSECURE','tls'); // or 'ssl'

define('IN_ADMIN', 1);

define('IN_CONSULTANT', 1);

define('IN_USER', 1);

define('ADMIN_ROLE', 'IN_ADMIN');

define('CONSULTANT_ROLE', 'IN_CONSULTANT');

define('USER_ROLE', 'IN_USER');

/**
 * Define information config to create PDF
 */

define('LOGO_HEADER_WIDTH', 188);

define('TCPDF_MARGIN_HEADER', 7);

define('TCPDF_MARGIN_FOOTER', 10);

define ('TCPDF_MARGIN_TOP', 32);

define ('TCPDF_MARGIN_BOTTOM', 20);

define ('TCPDF_MARGIN_LEFT', 10);

define ('TCPDF_MARGIN_RIGHT', 20);

define ('TCPDF_FONT_NAME_MAIN', 'centurygothic');

define ('TCPDF_FONT_SIZE_MAIN', 10);

define('PDF_UNIT_PX', 'mm' );

define ('TCPDF_FONT_NAME_DATA', 'centurygothic');

define ('TCPDF_FONT_SIZE_DATA', 8);

define ('TCPDF_FONT_MONOSPACED', 'centurygothic');

define ('TCPDF_IMAGE_SCALE_RATIO', 1.25);

define('TCHEAD_MAGNIFICATION', 1.1);

define('TCK_CELL_HEIGHT_RATIO', 1.25);

define('TCK_TITLE_MAGNIFICATION', 1.3);

define('TCK_SMALL_RATIO', 2/3);


/**
 * End of Define information config to create PDF
 */



define('SUB_PAGE', 'ONLINE SURVEY');

define('PREFIX_SUB_PAGE', ' | ');


/* End of file constants.php */
/* Location: ./application/config/constants.php */