<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Ckeditor_tag extends Tag {
		function ckeditor() {
			$this->load->helper('ckeditor/ckeditor');

			$name = $this->get_attribute('name', uniqid());
			$src = $this->get_attribute('src', 'external');

			return ckeditor($name, $item, array(), $src);
		}
	}
