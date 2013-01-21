<?php
	ini_set('error_log', 'setup_error_log.txt');

	require_once dirname(__FILE__).'/../core/config/environment.php';

	define('ENVIRONMENT', 'production');

	/*
	 * ini_set('display_errors', 'on');
	error_reporting(E_ALL);
	 */

	error_reporting(0);

	//TRYING TO DEFINE CI system folder automatically,
	//TODO: need review & revision

	if(realpath($config['ci_system_path']) == $config['ci_system_path']) $system_path = $config['ci_system_path'];
	else $system_path = '../'.$config['ci_system_path'];

	$application_folder = 'application';

	$view_folder = '';

	// Set the current directory correctly for CLI requests
	if(defined('STDIN')) chdir(dirname(__FILE__));

	if(realpath($system_path) !== FALSE) $system_path = realpath($system_path).'/';

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';

	// Is the system path correct?
	if(!is_dir($system_path)) {
		exit('	Your CI system folder path does not appear to be set correctly. 
				Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME));
	}

	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// The PHP file extension
	// this global constant is deprecated.
	define('EXT', '.php');

	// Path to the system folder
	define('BASEPATH', str_replace('\\', '/', $system_path));

	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));

	// Name of the "system folder"
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

	// The path to the "application" folder
	if(is_dir($application_folder)) define('APPPATH', $application_folder.'/');
	else {
		if(!is_dir(BASEPATH.$application_folder.'/')) {
			header('HTTP/1.1 503 Service Unavailable.', TRUE, '503');
			exit('	Your application folder path does not appear to be set correctly. 
					Please open the following file and correct this: '.SELF);
		}

		define('APPPATH', BASEPATH.$application_folder.'/');
	}

	require_once BASEPATH.'core/CodeIgniter.php';
