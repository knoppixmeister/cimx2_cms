<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Language_hook {
		function get_lang() {
			$CI = & get_instance();

			if(!str_starts_with($CI->uri->uri_string(), 'admin')) {	
				if(config_item('lang_switch_method') == 'url') {
					$uri = $CI->uri->uri_string();

					$uri_parts = explode('/', $uri);
					for($i=0; $i<count($uri_parts); $i++) {
						if(empty($uri_parts[$i])) unset($uri_parts[$i]);
					}

					if(	!empty($uri_parts[0]) && 
						!in_array($uri_parts[0], config_item('ignore_lang_paths'))) 
					{
						$lang = $this->_validate_raw_lang($uri_parts[0]);
					}
					elseif(isset($_COOKIE['lang'])) {
						 $lang = $this->_validate_raw_lang($_COOKIE['lang']);
					}
					else $lang = config_item('default_language');

					define("CURRENT_LANGUAGE", $lang);
				}
				else {
					if(isset($_GET['lang'])) {
						$lang = $this->_validate_raw_lang($_GET['lang']);

						set_cookie('lang', $lang, 86000);
					}
					elseif(isset($_COOKIE['lang'])) $lang = $this->_validate_raw_lang($_COOKIE['lang']);
					else $lang = config_item('default_language');

					define("CURRENT_LANGUAGE", strtolower($lang));
				}

				if(!defined('CURRENT_LANGUAGE')) define("CURRENT_LANGUAGE", config_item('default_language'));

				set_cookie('lang', CURRENT_LANGUAGE, 86000);

				$langs = config_item('supported_languages');

				define("CURRENT_LANGUAGE_FOLDER", $langs[CURRENT_LANGUAGE]['folder']);
			}
			else {
				define("CURRENT_LANGUAGE", 'en');
				define("CURRENT_LANGUAGE_FOLDER", 'en');
			}
		}

		function _validate_raw_lang($raw_lang="") {
			$CI = & get_instance();

			$lang = strtolower($raw_lang);

			$is_correct = FALSE;
			foreach(config_item('supported_languages') as $k => $v) {
				if($lang == $k) $is_correct = TRUE;
			}

			if(!$is_correct) {
				if(config_item('wrong_language') == "error") show_404();
				elseif(config_item('wrong_language') == "correct") {
					return config_item('default_language');
				}
				elseif(config_item('wrong_language') == "redirect") {
					header("Location: ".base_url().config_item('default_language'));
					exit;
				}
			}
			else return $lang;
		}
	}
