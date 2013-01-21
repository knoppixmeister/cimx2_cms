<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function login_site_url($url="") {
		$CI = &get_instance();

		$u = $CI->session->userdata('user');
		if(empty($u) || !is_numeric($u)) return site_url('login'.(!empty($url) ? '?next='.urlencode($url) : ""));
		else return $url;
	}

	if(!function_exists("base_url_path")) {
		function base_url_path() {
			$CI = & get_instance();

			$proto = (($CI->input->server("SERVER_PORT")=="443") ? "https" : "http");

			$http_host_url = $proto."://".$CI->input->server("HTTP_HOST");
			$conf_base_url = config_item('base_url');

			$res = (stripos($conf_base_url, $http_host_url) !== FALSE) ? $conf_base_url : $http_host_url.$conf_base_url;

			return ((str_ends_with($res, "/")) ? $res : $res."/");
		}
	}

	if(!function_exists("get_url_lang")) {
		function get_url_lang() {
			$CI = &get_instance();

			$_lang = $CI->uri->segment(1, config_item('default_language'));
			if(in_array($_lang,	array_keys(config_item('supported_languages')))) return $_lang;
			else return config_item('default_language');
		}
	}

	if(!function_exists("get_url_without_lang")) {
		function get_url_without_lang() {
			$segments = get_instance()->uri->segment_array();

			if(config_item('lang_switch_method') == "url") $start_idx = 2;
			else $start_idx = 1;

			$s = "";
			for($i=$start_idx; $i<=count($segments); $i++) {
				$s .= $segments[$i]."/";
			}

			$s = trim($s, '/');

			$get = $_GET;//DON't modify original GET array;

			if(config_item('lang_switch_method') != "url") unset($get['lang']);

			if(count($get) > 0) {
				$s .= "?";
				foreach($get as $key => $value) {
					if(!empty($get[$key])) $s .= $key."=".$value."&";
				}
				$s = substr($s, 0, strlen($s)-1);//deletes last trailing '&'
			}

			return $s;
		}
	}

	if(!function_exists("switch_url_lang")) {
		function switch_url_lang($lang) {
			if(config_item("lang_switch_method") == "url") {
				$ip = config_item('index_page');

				return 	base_url(TRUE)
						.$ip
						.(!empty($ip) ? "/" : "")
						.$lang."/".get_url_without_lang();
			}
			else {
				$get = $_GET;

				unset($get['lang']);

				return site_url(get_url_without_lang()).(count($get) > 0 ? "&" : "?")."lang=".$lang;
			}
		}
	}

	function admin_base_url($full_path=FALSE) {
		$ip = config_item('index_page');

		return 	base_url($full_path).
				$ip.
				(empty($ip) ? "" : "/").
				"admin/";
	}

	function admin_url($url="", $full_path=TRUE) {
		return admin_base_url($full_path).$url;
	}

	function _admin_url($url="", $full_path=TRUE) {
		e(admin_url($url, $full_path));
	}

	function base_url($full_path=TRUE) {
		return (!$full_path) ? (get_instance()->config->slash_item('base_url')) : base_url_path();
	}

	if(!function_exists("base_url_lang")) {
		function base_url_lang($full_path=FALSE) {
			$ip = config_item('index_page');

			return 	base_url($full_path)
					.$ip
					.(!empty($ip) ? "/" : "")
					.(config_item('lang_switch_method') == "url" ? CURRENT_LANGUAGE : "")
					."/";
		}
	}

	function site_url($uri="", $full_path=FALSE, $show_get_lang=FALSE, $lang=CURRENT_LANGUAGE) {
		return get_instance()->config->site_url($uri);

		/*
		$url_lang = "";
		$get_param_lang = "";
		if(config_item('lang_switch_method') == 'url') $url_lang = CURRENT_LANGUAGE."/";
		elseif($show_get_lang) $get_param_lang = "?lang=".CURRENT_LANGUAGE;

		return base_url($full_path).$url_lang.$url.$get_param_lang;
		*/
	}

	function _site_url($uri="", $full_path=FALSE, $show_get_lang=FALSE, $lang=CURRENT_LANGUAGE) {
		e(site_url($uri, $full_path, $show_get_lang, $lang));
	}

	if(!function_exists('url_title')) {
		function url_title($str, $separator = 'dash', $lowercase = FALSE) {
			$foreign_characters = array(
	            '/ä|æ|ǽ/' => 'ae',
	            '/ö|œ/' => 'oe',
	            '/ü/' => 'ue',
	            '/Ä/' => 'Ae',
	            '/Ü/' => 'Ue',
	            '/Ö/' => 'Oe',
	            '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|А/' => 'A',
	            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|а/' => 'a',
	            '/Б/' => 'B',
	            '/б/' => 'b',
	            '/Ç|Ć|Ĉ|Ċ|Č|Ц/' => 'C',
	            '/ç|ć|ĉ|ċ|č|ц/' => 'c',
	            '/Ð|Ď|Đ|Д/' => 'D',
	            '/ð|ď|đ|д/' => 'd',
	            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Е|Ё|Э/' => 'E',
	            '/è|é|ê|ë|ē|ĕ|ė|ę|ě|е|ё|э/' => 'e',
	            '/Ф/' => 'F',
	            '/ф/' => 'f',
	            '/Ĝ|Ğ|Ġ|Ģ|Г/' => 'G',
	            '/ĝ|ğ|ġ|ģ|г/' => 'g',
	            '/Ĥ|Ħ|Х/' => 'H',
	            '/ĥ|ħ|х/' => 'h',
	            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|И/' => 'I',
	            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|и/' => 'i',
	            '/Ĵ|Й/' => 'J',
	            '/ĵ|й/' => 'j',
	            '/Ķ|К/' => 'K',
	            '/ķ|к/' => 'k',
	            '/Ĺ|Ļ|Ľ|Ŀ|Ł|Л/' => 'L',
	            '/ĺ|ļ|ľ|ŀ|ł|л/' => 'l',
	            '/М/' => 'M',
	            '/м/' => 'm',
	            '/Ñ|Ń|Ņ|Ň|Н/' => 'N',
	            '/ñ|ń|ņ|ň|ŉ|н/' => 'n',
	            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|О/' => 'O',
	            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|о/' => 'o',
	            '/П/' => 'P',
	            '/п/' => 'p',
	            '/Ŕ|Ŗ|Ř|Р/' => 'R',
	            '/ŕ|ŗ|ř|р/' => 'r',
	            '/Ś|Ŝ|Ş|Š|С/' => 'S',
	            '/ś|ŝ|ş|š|ſ|с/' => 's',
	            '/Ţ|Ť|Ŧ|Т/' => 'T',
	            '/ţ|ť|ŧ|т/' => 't',
	            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|У/' => 'U',
	            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|у/' => 'u',
	            '/В/' => 'V',
	            '/в/' => 'v',
	            '/Ý|Ÿ|Ŷ|Ы/' => 'Y',
	            '/ý|ÿ|ŷ|ы/' => 'y',
	            '/Ŵ/' => 'W',
	            '/ŵ/' => 'w',
	            '/Ź|Ż|Ž|З/' => 'Z',
	            '/ź|ż|ž|з/' => 'z',
	            '/Æ|Ǽ/' => 'AE',
	            '/ß/'=> 'ss',
	            '/Ĳ/' => 'IJ',
	            '/ĳ/' => 'ij',
	            '/Œ/' => 'OE',
	            '/ƒ/' => 'f',
	            '/Ч/' => 'Ch',
	            '/ч/' => 'ch',
	            '/Ю/' => 'Ju',
	            '/ю/' => 'ju',
	            '/Я/' => 'Ja',
	            '/я/' => 'ja',
	            '/Ш/' => 'Sh',
	            '/ш/' => 'sh',
	            '/Щ/' => 'Shch',
	            '/щ/' => 'shch',
	            '/Ж/' => 'Zh',
	            '/ж/' => 'zh', 
	        );

	        $str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);

	        $replace = ($separator == 'dash') ? '-' : '_';

	        $trans = array(
						'&\#\d+?;'			=>	'',
	            		'&\S+?;'			=>	'',
	        			'\s+'				=>	$replace,
	            		'[^a-z0-9\-\._]'	=>	'',
	            		$replace.'+'		=>	$replace,
	            		$replace.'$'		=>	$replace,
	            		'^'.$replace		=>	$replace,
	            		'\.+$'				=>	'', 
	        		);

	        $str = strip_tags($str);

			foreach($trans as $key => $val) {
	            $str = preg_replace("#".$key."#i", $val, $str);
	        }

			if($lowercase === TRUE) {
				if(function_exists('mb_convert_case')) $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
				else $str = strtolower($str);
	        }

        	$str = preg_replace('#[^'.config_item('permitted_uri_chars').']#i', '', $str);

        	return trim(stripslashes($str));
    	}
	}
