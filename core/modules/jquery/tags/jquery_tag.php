<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Jquery_Tag extends Tag {
		function jquery() {
			$src = $this->get_attribute('src', 'ext');

			if($src == "ext") {
				return '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>';
			}
			elseif($src == "local") {
				return '<script type="text/javascript" src="'.base_url(TRUE).'public/modules/jquery/js/jquery.js"></script>';
			}
		}

		function js() {//alias for jquery() method
			return $this->jquery();
		}
	}
