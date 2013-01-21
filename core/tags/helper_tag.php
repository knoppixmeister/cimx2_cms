<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Helper_Tag extends Tag {
		function date() {
			$format = $this->get_attribute('format', 'd-m-Y');

			return date($format);
		}

		function gravatar() {
			$email 	= $this->get_attribute('email');
			$size 	= $this->get_attribute('size', 60);
			$alt	= $this->get_attribute('alt', "");

			$default = "http://www.gravatar.com/avatar/07690bc69efe6999c72be717f7082875?s=".$size;

			$url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".urlencode($default)."&s=".$size;

			return '<img alt="'.$alt.'" src="'.$url.'">';
		}
	}
