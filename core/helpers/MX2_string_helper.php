<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	if(!function_exists("nvl")) {
		function nvl() {
			foreach(func_get_args() as $a) {
				if(!empty($a)) return $a;
			}

			return NULL;
		}
	}
