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



define('TBL_LOGIN', 'tbl_users');
define('TBL_TABLES','tbl_tables');
define('TBL_MENUS', 'tbl_menu');
define('TBL_BILLS', 'tbl_bills');
define('TBL_ORDERS', 'tbl_order');


define('TABLE_STATUS_UNAVAILABLE', 0);
define('TABLE_STATUS_FREE', 1);
define('TABLE_STATUS_OCCUPIED', 2);
define('TABLE_STATUS_RESERVED', 3);

define('STATUS_ACTIVE', 1);
define('STATUS_INACTIVE', 0);

define('BILL_TYPE_NEW',1);
define('BILL_TYPE_EXISTING',2);



/* End of file constants.php */
/* Location: ./application/config/constants.php */