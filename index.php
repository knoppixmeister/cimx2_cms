<?php
	ini_set('display_errors', 'on');//enable error reporting to see possible init errors;

	function callback($buffer) {
		$buffer = str_replace("\r\n", "\n", trim($buffer));

		$buffer = preg_replace('/^\\s+|\\s+$/m', '', $buffer);

		$buffer = preg_replace('/\\s+(<\\/?(?:area|base(?:font)?|blockquote|body'
				.'|caption|center|cite|col(?:group)?|dd|dir|div|dl|dt|fieldset|form'
				.'|frame(?:set)?|h[1-6]|head|hr|html|legend|li|link|map|menu|meta|img|a|span|input|'
				.'|ol|opt(?:group|ion)|p|param|t(?:able|body|head|d|h||r|foot|itle)'
				.'|ul)\\b[^>]*>)/i', '$1', $buffer);

		return $buffer;
	}

	//ob_start("callback");
	ob_start();

	date_default_timezone_set('Europe/Riga');

	$application_folder = 'core';

	require dirname(__FILE__).'/'.$application_folder.'/config/environment.php';

	define('ENVIRONMENT', $config['environment']);

	if(defined('ENVIRONMENT')) {
		switch (ENVIRONMENT) {
			case 'development':	ini_set('display_errors', 'on');
								if(version_compare(PHP_VERSION, '5.4.0') >= 0) error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);
								else error_reporting(E_ALL ^ E_NOTICE);
								break;

			case 'testing':
			case 'production':	ini_set('display_errors',	'off');
								ini_set("error_log", 		"mx2_log.txt");
								error_reporting(0);
								break;

			default:			exit('The application environment is not set correctly.');
		}
	}

	$system_path = $config['ci_system_path'];

	$extensions_folder = 'extensions';

	$view_folder = '';

	// Set the current directory correctly for CLI requests
	if(defined('STDIN')) chdir(dirname(__FILE__));

	if(realpath($system_path) !== FALSE) $system_path = realpath($system_path).'/';

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';

	// Is the system path correct?
	if(!is_dir($system_path)) {
		exit('	Your CI system folder path does not appear to be set correctly. 
				Please open the following file and correct this: '.dirname(__FILE__).'/'.$application_folder.'/config/environment.php');
	}

	if(!file_exists($application_folder.'/config/database.php')) {
		die('CIMX2 instance deployed to file system. Run setup now.');
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

	define('EXTPATH', $extensions_folder.'/');

	if(file_exists(EXTPATH."core/CodeIgniter.php")) require_once EXTPATH."core/CodeIgniter.php";
	else require_once BASEPATH.'core/CodeIgniter.php';
