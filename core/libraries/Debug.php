<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Debug {
		public static function dump() {
			for($i=0; $i<func_num_args(); $i++) {
				echo '<pre>';
				var_dump(func_get_arg($i));
				echo '</pre>
					----------------------------------------------------------<br/>';
			}
		}
	}
