<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Template_Tag extends Tag {
		function partial() {
			$name 	= $this->get_attribute("name");
			$theme 	= $this->get_attribute("theme",	CURRENT_THEME);
			$path	= $this->get_attribute("path",	$this->template->find_theme(CURRENT_THEME));

			return $this->parser->parse_string(
									file_get_contents(
										$path.$theme."/partials/".$name 
									), 
									array(), 
									TRUE 
								);
		}
	}
