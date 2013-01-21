<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Theme_Tag extends Tag {
		function css() {
			$file = $this->get_attribute("file");
			$theme = $this->get_attribute("theme", CURRENT_THEME);

			return '<link rel="stylesheet" href="'.base_url().'public/themes/'.$theme.'/css/'.$file.'">';
		}

		function css_link_path() {
			$file 	=	$this->get_attribute("file");
			$theme 	=	$this->get_attribute("theme", CURRENT_THEME);

			return '<link rel="stylesheet" href="'.FCPATH.'public/themes/'.$theme.'/css/'.$file.'">';
		}

		function image() {
			$file 	= $this->get_attribute('file');
			$theme 	= $this->get_attribute("theme", CURRENT_THEME);

			$width 	= $this->get_attribute("width", '');
			$height = $this->get_attribute("height", '');

			$border	= $this->get_attribute('border', 0);

			//die("File: ".$file." : ".$width);

			if(!empty($width)) 	$width 	= ' width="'.$width.'" ';
			if(!empty($height)) $height = ' height="'.$height.'" ';

			return '<img src="'.base_url().'public/themes/'.$theme.'/images/'.$file.'"'.$width.$height.' border="'.$border.'"/>';
		}

		function image_url() {
			$file 	= $this->get_attribute("file");
			$theme 	= $this->get_attribute("theme", CURRENT_THEME);

			return base_url().'public/themes/'.$theme.'/images/'.$file;
		}

		function js() {
			$file = $this->get_attribute("file");
			$theme = $this->get_attribute("theme", CURRENT_THEME);

			return '<script type="text/javascript" src="'.base_url().'public/themes/'.$theme.'/js/'.$file.'"></script>';
		}
	}
