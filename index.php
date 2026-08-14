<?php
require __DIR__ . '/application/bootstrap_env.php';

/*
|--------------------------------------------------------------------------
| APPLICATION ENVIRONMENT
|--------------------------------------------------------------------------
| Defaults to production. Set CI_ENV=development in the local .env file
| when detailed errors are needed during development.
|--------------------------------------------------------------------------
*/

define('ENVIRONMENT', getenv('CI_ENV') ?: 'production');

switch (ENVIRONMENT) {
	case 'development':
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);

		/*
		 * PHP 8.2 compatible error reporting for old CodeIgniter 3.
		 * This hides deprecated warnings but shows real fatal errors.
		 */
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1);
}

/*
|--------------------------------------------------------------------------
| SYSTEM DIRECTORY NAME
|--------------------------------------------------------------------------
*/
$system_path = 'system';

/*
|--------------------------------------------------------------------------
| APPLICATION DIRECTORY NAME
|--------------------------------------------------------------------------
*/
$application_folder = 'application';

/*
|--------------------------------------------------------------------------
| VIEW DIRECTORY NAME
|--------------------------------------------------------------------------
*/
$view_folder = '';

/*
|--------------------------------------------------------------------------
| Resolve the system path for increased reliability
|--------------------------------------------------------------------------
*/

if (defined('STDIN')) {
	chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== FALSE) {
	$system_path = $_temp . DIRECTORY_SEPARATOR;
} else {
	$system_path = rtrim($system_path, '/\\') . DIRECTORY_SEPARATOR;
}

if (! is_dir($system_path)) {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: ' . pathinfo(__FILE__, PATHINFO_BASENAME);
	exit(3);
}

/*
|--------------------------------------------------------------------------
| Define core constants
|--------------------------------------------------------------------------
*/

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', str_replace('\\', '/', $system_path));
define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('SYSDIR', basename(rtrim(BASEPATH, '/\\')));

/*
|--------------------------------------------------------------------------
| Resolve the application path
|--------------------------------------------------------------------------
*/

if (is_dir($application_folder)) {
	if (($_temp = realpath($application_folder)) !== FALSE) {
		$application_folder = $_temp;
	}

	define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);
} else {
	if (! is_dir(BASEPATH . $application_folder . DIRECTORY_SEPARATOR)) {
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
		exit(3);
	}

	define('APPPATH', BASEPATH . $application_folder . DIRECTORY_SEPARATOR);
}

/*
|--------------------------------------------------------------------------
| Resolve the view path
|--------------------------------------------------------------------------
*/

if (! is_dir($view_folder)) {
	if (! empty($view_folder) && is_dir(APPPATH . $view_folder . DIRECTORY_SEPARATOR)) {
		$view_folder = APPPATH . $view_folder;
	} elseif (! is_dir(APPPATH . 'views' . DIRECTORY_SEPARATOR)) {
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
		exit(3);
	} else {
		$view_folder = APPPATH . 'views';
	}
}

if (($_temp = realpath($view_folder)) !== FALSE) {
	$view_folder = $_temp . DIRECTORY_SEPARATOR;
} else {
	$view_folder = rtrim($view_folder, '/\\') . DIRECTORY_SEPARATOR;
}

define('VIEWPATH', $view_folder);

/*
|--------------------------------------------------------------------------
| Load CodeIgniter
|--------------------------------------------------------------------------
*/

require_once BASEPATH . 'core/CodeIgniter.php';
