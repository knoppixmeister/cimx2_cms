<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$hook['pre_system'][] = array(
								'function' => 'load_exceptions', 
								'filename' => 'uhoh.php', 
								'filepath' => 'hooks/system', 
							);

	$hook['pre_controller'][] = array(
									'class'		=> 'Language_hook', 
									'function' 	=> 'get_lang', 
									'filename'	=> 'language.php', 
									'filepath'	=> 'hooks/system', 
								);

	if(file_exists(EXTPATH."config/user_hooks.php")) require EXTPATH."config/user_hooks.php";
	else require 'user_hooks.php';
