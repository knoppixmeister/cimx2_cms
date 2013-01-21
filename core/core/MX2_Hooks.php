<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Hooks extends CI_Hooks {
		function __construct() {
			parent::__construct();

			log_message('debug', 'MX2_Hooks Class Initialized');
		}

		function _initialize() {
			$CFG = &load_class('Config', 'core');

			if($CFG->item('enable_hooks') == FALSE) return;

			if(defined('ENVIRONMENT') AND is_file(EXTPATH.'config/'.ENVIRONMENT.'/hooks.php')) {
				require EXTPATH.'config/'.ENVIRONMENT.'/hooks.php';
			}
			elseif(is_file(EXTPATH.'config/hooks.php')) require EXTPATH.'config/hooks.php';
			elseif(defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/hooks.php')) {
				require APPPATH.'config/'.ENVIRONMENT.'/hooks.php';
			}
			elseif(is_file(APPPATH.'config/hooks.php')) require APPPATH.'config/hooks.php';

			if(!isset($hook) || ! is_array($hook)) {
				log_message('error', 'No hooks config data');

				return;
			}

			$this->hooks = &$hook;
			$this->enabled = TRUE;
		}
	}
