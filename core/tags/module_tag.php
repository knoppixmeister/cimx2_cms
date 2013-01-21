<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Module_tag extends Tag {
		function image() {
			$file 	= $this->get_attribute('file', '');
			$module	= $this->get_attribute('module', get_instance()->router->fetch_module());

			$width 	= $this->get_attribute("width", '');
			$height = $this->get_attribute("height", '');

			$border	= $this->get_attribute('border', 0);

			if(!empty($width)) 	$width 	= ' width="'.$width.'" ';
			if(!empty($height)) $height = ' height="'.$height.'" ';

			return '<img src="'.base_url().'public/modules/'.$module.'/images/'.$file.'"'.$width.$height.' border="'.$border.'"/>';
		}

		function image_url() {
			$file 	= $this->get_attribute("file");
			$module	= $this->get_attribute('module', get_instance()->router->fetch_module());

			return base_url().'public/modules/'.$module.'/images/'.$file;
		}
	}
