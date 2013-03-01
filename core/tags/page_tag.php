<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Page_Tag extends Tag {
		function content() {
			$slug	=	$this->get_attribute('slug');
			$lang	=	$this->get_attribute('lang', CURRENT_LANGUAGE);

			$p = $this->pages_model->get_by('slug', $slug);

			if(empty($p)) return "";
			else return $p['text_'.$lang];
		}

		function title() {
			$slug	=	$this->get_attribute('slug');
			$lang	=	$this->get_attribute('lang', CURRENT_LANGUAGE);

			$p = $this->pages_model->get_by('slug', $slug);

			if(empty($p)) return "";
			else return $p['title_'.$lang];
		}

		function meta_title() {
			$slug	=	$this->get_attribute('slug');
			$lang	=	$this->get_attribute('lang', CURRENT_LANGUAGE);

			$p = $this->pages_model->get_by('slug', $slug);

			if(empty($p)) return "";
			else return $p['meta_title_'.$lang];
		}

		function meta_keywords() {
			$slug	=	$this->get_attribute('slug');
			$lang	=	$this->get_attribute('lang', CURRENT_LANGUAGE);

			$p = $this->pages_model->get_by('slug', $slug);

			if(empty($p)) return "";
			else return $p['meta_keywords_'.$lang];
		}

		function meta_description() {
			$slug	=	$this->get_attribute('slug');
			$lang	=	$this->get_attribute('lang', CURRENT_LANGUAGE);

			$p = $this->pages_model->get_by('slug', $slug);

			if(empty($p)) return "";
			else return $p['meta_description_'.$lang];
		}
	}
