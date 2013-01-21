<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	if(!function_exists("js")) {
		function js($file, $full_path=TRUE, $theme=null) {
			return '<script type="text/javascript" src="'.$file.'"></script>';
		}
	}
