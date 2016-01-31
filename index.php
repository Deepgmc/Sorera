<?php
if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/' && $_SERVER['REQUEST_URI'] != '') {
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	if(count($uri) > 1) {
		$file = str_replace('/', '', str_replace('.php', '', $uri[0]));
		$params = explode('&', $uri[1]);
		foreach ($params as $k => $v) {
			$tmp = explode('=', $v);
			$arr[$tmp[0]] = $tmp[1];
		}
		if(!isset($arr['query']) && !isset($arr['footerCId'])) {
			$cId = 0;$cName = '';$to=0;
			if (count($arr) > 0) {
				switch ($file) {
					case 'review':
						switch ($arr['sg']) {
							case 'company':
								$cId = $arr['wts'];
								$cName = $arr['company'];
								$to = 'review';
								break;
							case 'salary':
								$cId = $arr['wts'];
								$cName = $arr['company'];
								$to = 'salary';
								break;
						}
						break;
					case 'viewersviewACR':
						$cId = $arr['cId'];
						$cName = $arr['CN'];
						$to = 'review';
						break;
					case 'viewerssingleCR':
						$cId = $arr['cId'];
						$cName = $arr['name'];
						$to = 'review';
						break;
					default:
						break;
				}
				if (is_numeric($cId) && count($cName) > 0 && count($to) > 0 && $cId != 0) {
					$cName = str_replace('+', ' ', $cName);
					header('HTTP/1.1 301 Moved Permanently');
					header('Location: http://sorera.ru/' . $to . '/' . $cId . '/' . $cName);
					exit();
				} else {
					//header('HTTP/1.0 404 Not Found');
					//header('Location: http://sorera.ru/');
					//exit();
				}
			}
		}
	}
}
/*
dev
test
prod
If you change these, also change the error_reporting() code below
 */
define('ENV', 'prod');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if (defined('ENV'))
{
	switch (ENV)
	{
		case 'dev':
			error_reporting(E_ALL);break;
		case 'test':
			error_reporting(E_ALL);break;
		case 'prod':
			error_reporting(0);break;
		default:
			exit('The application environment is not set correctly.');
	}
}

/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 */
$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder then the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server.  If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 *
 */
$application_folder = 'application';

/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here.  For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT:  If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller.  Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 *
 */
// The directory name, relative to the "controllers" folder.  Leave blank
// if your controller is not in a sub-folder within the "controllers" folder
// $routing['directory'] = '';

// The controller class file name.  Example:  Mycontroller
// $routing['controller'] = '';

// The controller function you wish to be called.
// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 *
 */
// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

// Set the current directory correctly for CLI requests
if (defined('STDIN'))
{
	chdir(dirname(__FILE__));
}

if (realpath($system_path) !== FALSE)
{
	$system_path = realpath($system_path).'/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/').'/';

// Is the system path correct?
if ( ! is_dir($system_path))
{
	exit("Bad path. It was at: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// The PHP file extension
// this global constant is deprecated.
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


// The path to the "application" folder
if (is_dir($application_folder))
{
	define('APPPATH', $application_folder.'/');
}
else
{
	if ( ! is_dir(BASEPATH.$application_folder.'/'))
	{
		exit("Application folder was set wrong. Correct this one: ".SELF);
	}
	define('APPPATH', BASEPATH.$application_folder.'/');
}
require_once BASEPATH.'core/CodeIgniter.php';