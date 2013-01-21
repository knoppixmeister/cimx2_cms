<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Lang extends MX_Lang {
		function __construct() {
			parent::__construct();
		}

		function load($langfile, $lang = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '', $_module = '') {
			if(is_array($langfile)) {
				foreach($langfile as $_lang) $this->load($_lang);

				return $this->language;
			}

			$deft_lang = config_item('default_language');
			$idiom = 	empty($lang) ? 
						CURRENT_LANGUAGE_FOLDER : 
						element('folder', element($lang, config_item('supported_languages')));

			$segments 	= explode('/', $langfile);

			$file 		= array_pop($segments);
			$path 		= ltrim(implode('/', $segments).'/', '/');

			if(in_array($langfile.'_lang'.EXT, $this->is_loaded, TRUE)) return $this->language;

			if(file_exists(EXTPATH.'/language/'.$path."/".$idiom."/".$file."_lang".EXT)) {
				parent::load($file, $path."/".$idiom, $return, $add_suffix, EXTPATH, uniqid());//DON'T REMOVE uniqid()
			}

			$_module || $_module = CI::$APP->router->fetch_module();

			list($path, $_langfile) = Modules::find($langfile.'_lang', $_module, 'language/'.$idiom.'/');

			if($path === FALSE) {
				if($lang = parent::load($langfile, $lang, $return, $add_suffix, $alt_path)) return $lang;
			}
			else {
				if($lang = Modules::load_file($_langfile, $path, 'lang')) {
					if($return) return $lang;

					$this->language = array_merge($this->language, $lang);
					$this->is_loaded[] = $langfile.'_lang'.EXT;

					unset($lang);
				}
			}

			return $this->language;
		}

		function line($line = '') {
			if(empty($line)) {
				log_message('error', __CLASS__.":".__FUNCTION__.'. Could not find the language line "'.$line.'"');

				show_404();
			}

			$line = ($line == '' OR ! isset($this->language[$line])) ? FALSE : $this->language[$line];

			return $line;
		}
	}
