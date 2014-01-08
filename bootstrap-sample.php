<?php

/*
|--------------------------------------------------------------------------
| Require the autoload
|--------------------------------------------------------------------------
|
| The first thing to do is require the autoload.
|
*/
require_once __DIR__.'/vendor/autoload.php';	

/*
|--------------------------------------------------------------------------
| Application Env
|--------------------------------------------------------------------------
|
| Find wich env we are working.
|
*/
defined('APPLICATON_ENV') || define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');

/*
|--------------------------------------------------------------------------
| URL Constant
|--------------------------------------------------------------------------
|
| Find wich env we are working.
|
*/
defined('URL') || define('URL', 'http://' . $_SERVER['HTTP_HOST']);

/*
|--------------------------------------------------------------------------
| ROOT Constant
|--------------------------------------------------------------------------
|
| The ROOT path.
|
*/
defined('ROOT') || define('ROOT', __DIR__);

/*
|--------------------------------------------------------------------------
| Mail Configs
|--------------------------------------------------------------------------
|
| The mail user configs.
|
*/
defined('MAIL_HOST') || define('MAIL_HOST', 'x');
defined('MAIL_PORT') || define('MAIL_PORT', 'x');
defined('MAIL_USER') || define('MAIL_USER', 'x');
defined('MAIL_PASS') || define('MAIL_PASS', 'x');

/*
|--------------------------------------------------------------------------
| PHP Settings
|--------------------------------------------------------------------------
|
| The php enviroment settings
|
*/
switch (APPLICATION_ENV) {
    case 'production':
        ini_set('log_errors', 'On');
        ini_set('display_errors', 'Off');
		break;
	default:
        error_reporting(E_ALL);
 		ini_set('display_errors', 1);
        break;
}




