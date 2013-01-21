<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	require APPPATH."third_party/MX/Config.php";

	class MX2_Config extends MX_Config {
		function __construct() {
			parent::__construct();

			$this->_config_paths = 	array_merge(
										array(EXTPATH), 
										$this->_config_paths 
									);
		}
		/*
		function load($file = 'config', $use_sections = FALSE, $fail_gracefully = FALSE, $_module = '') {
			return parent::load($file, $use_sections, $fail_gracefully, $_module);
		}
		*/
		function site_url($uri = '') {
			if(!$this->item('enable_query_strings')) {
				$suffix = !$this->item('url_suffix') ? '' : $this->item('url_suffix');
		
				return 	$this->slash_item('base_url').
						$this->slash_item('index_page').$this->_uri_string($uri).$suffix;
			}
			else {
				$ip = $this->item('index_page');

				return 	$this->slash_item('base_url').
						$ip.
						(!empty($ip) && $this->item('lang_switch_method') == "get_param" ? "/" : "").
						$this->_uri_string($uri);
			}
		}

		protected function _uri_string($uri) {
			if(!$this->item('enable_query_strings')) {
				if(is_array($uri)) $uri = implode('/', $uri);
				$uri = trim($uri, '/');
			}
			else {
				if(is_array($uri)) {
					$i = 0;
					$str = '';

					foreach($uri as $key => $val) {
						$prefix = ($i == 0) ? '' : '&';
						$str .= $prefix.$key.'='.$val;
						$i++;
					}

					$uri = $str;
				}
				else {
					$url_lang = "";

					$ip = $this->item('index_page');

					$uris = explode("/", uri_string());
					if($this->item('lang_switch_method') == 'url') {
						$url_lang = (empty($ip) ? "" : "/");

						if(!in_array($uris[0], $this->item('ignore_lang_paths'))) {
							$url_lang .= CURRENT_LANGUAGE."/";
						}
					}
					elseif($show_get_lang) $get_param_lang = "?lang=".CURRENT_LANGUAGE;
				}
			}

			return $url_lang.$uri;
		}
	}
