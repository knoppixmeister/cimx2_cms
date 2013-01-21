<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function generate_activate_code($user_id, $write_in_db=TRUE) {

		return md5(time());
	}
