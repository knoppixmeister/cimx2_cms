<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Jqueryui_Tag extends Tag {
		function jqueryui_all() {
			$src = $this->get_attribute('src', 'ext');

			if($src == "ext") {
				return '<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
						<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" type="text/css"/>';
			}
			elseif($src == "local") {
				return '<script src="'.base_url(TRUE).'public/modules/jqueryui/js/jquery-ui.min.js" type="text/javascript"></script>
						<link rel="stylesheet" href="'.base_url(TRUE).'public/modules/jqueryui/css/jquery-ui.css" type="text/css"/>';
			}
		}
	}
