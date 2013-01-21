<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Bootstrap_Tag extends Tag {
		function all_css() {
			$no_responsivity = $this->get_attribute('no_resp', FALSE);

			$res = '<link rel="stylesheet" href="'.base_url(TRUE).'public/modules/bootstrap/css/bootstrap.min.css">';

			if(!$no_responsivity) {
				$res .=	'<link rel="stylesheet" href="'.base_url(TRUE).'public/modules/bootstrap/css/bootstrap-responsive.min.css">';
			}

			return $res;
		}

		function responsive_css() {
			return '<link rel="stylesheet" href="'.base_url(TRUE).'public/modules/bootstrap/css/bootstrap-responsive.min.css">';
		}

		function all_js() {
			$src = $this->get_attribute('src', 'local');//ext

			if($src == 'local') {
				return '<script type="text/javascript" src="'.base_url(TRUE).'public/modules/bootstrap/js/bootstrap.min.js"></script>';
			}
			elseif($src == "ext") {
				return '<script type="text/javascript" src="https://raw.github.com/twitter/bootstrap/master/docs/assets/js/bootstrap.min.js"></script>';
			}
		}
	}
