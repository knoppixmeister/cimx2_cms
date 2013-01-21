<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function lang($line = '', $lang = CURRENT_LANGUAGE) {
		$line = get_instance()->lang->line($line, $lang);

		return $line;
	}
