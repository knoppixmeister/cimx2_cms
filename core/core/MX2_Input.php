<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Input Extends CI_Input {
		function __construct() {
			if(PHP_EOL == "\r\n") {
				$this->_standardize_newlines = FALSE;

				log_message('debug', 'Windows server: standardize newlines disabled.');
			}

			parent::__construct();
		}
		/*
		protected function _sanitize_globals() {
			// It would be "wrong" to unset any of these GLOBALS.
			$protected = array('_SERVER', '_GET', '_POST', '_FILES', '_REQUEST',
							'_SESSION', '_ENV', 'GLOBALS', 'HTTP_RAW_POST_DATA',
							'system_folder', 'application_folder', 'BM', 'EXT',
							'CFG', 'URI', 'RTR', 'OUT', 'IN'
			);

			// Unset globals for securiy.
			// This is effectively the same as register_globals = off
			foreach (array($_GET, $_POST, $_COOKIE) as $global)
			{
				if ( ! is_array($global))
				{
					if ( ! in_array($global, $protected))
					{
						global $$global;
						$$global = NULL;
					}
				}
				else
				{
					foreach ($global as $key => $val)
					{
						if ( ! in_array($key, $protected))
						{
							global $$key;
							$$key = NULL;
						}
					}
				}
			}
		
			// Is $_GET data allowed? If not we'll set the $_GET to an empty array
			if ($this->_allow_get_array == FALSE)
			{
				$_GET = array();
			}
			elseif (is_array($_GET) && count($_GET) > 0)
			{
				foreach ($_GET as $key => $val)
				{
					$_GET[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
				}
			}
		
			// Clean $_POST Data
			if (is_array($_POST) && count($_POST) > 0)
			{
				foreach ($_POST as $key => $val)
				{
					$_POST[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
				}
			}
		
			// Clean $_COOKIE Data
			if (is_array($_COOKIE) && count($_COOKIE) > 0)
			{
				// Also get rid of specially treated cookies that might be set by a server
				// or silly application, that are of no use to a CI application anyway
				// but that when present will trip our 'Disallowed Key Characters' alarm
				// http://www.ietf.org/rfc/rfc2109.txt
				// note that the key names below are single quoted strings, and are not PHP variables
				unset($_COOKIE['$Version']);
				unset($_COOKIE['$Path']);
				unset($_COOKIE['$Domain']);
		
				foreach ($_COOKIE as $key => $val)
				{
					$_COOKIE[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
				}
			}

			// Sanitize PHP_SELF
			$_SERVER['PHP_SELF'] = strip_tags($_SERVER['PHP_SELF']);

			// CSRF Protection check

			$is_ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
						strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

			if($this->_enable_csrf == TRUE && !$is_ajax) {
				$this->security->csrf_verify();
			}

			log_message('debug', 'Global POST and COOKIE data sanitized');
		}
		*/
	}
