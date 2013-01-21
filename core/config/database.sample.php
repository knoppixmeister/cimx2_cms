<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$active_group	=	'default';
	$active_record	=	TRUE;

	$db['default']	= array(
						'hostname' => 'localhost', 
						'username' => '', 
						'password' => '',
						'database' => '', 
						'dbdriver' => 'mysql', 
						'dbprefix' => '',
						'pconnect' => FALSE, 
						'db_debug' => ((defined('ENVIRONMENT') && ENVIRONMENT == "development") ? TRUE : FALSE), 
						'cache_on' => FALSE,
						'cachedir' => '',
						'char_set' => 'utf8',
						'dbcollat' => 'utf8_general_ci',
						'swap_pre' => '',
						'autoinit' => TRUE, 
						'stricton' => FALSE, 
					);

	//--- SET FEW CONSTANTS FOR DIFFERENT DB TYPES

	if($db[$active_group]['dbdriver'] == "mysql") {
		define('DB_TRUE',	1);
		define('DB_FALSE',	0);
	}
	elseif($db[$active_group]['dbdriver'] == "postgre") {
		define('DB_TRUE',	't');
		define('DB_FALSE',	'f');
	}
