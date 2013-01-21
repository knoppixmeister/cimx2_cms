<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Pages_Tag extends Tag {
		function content() {
			$slug = $this->get_attribute('slug');
			$lang = $this->get_attribute('lang');

			$p = $this->pages_model->get_by('slug', $slug);

			if(empty($p)) return "";
			else return $p['text_'.$lang];
		}

		function title() {
			$slug = $this->get_attribute('slug');
			$lang = $this->get_attribute('lang');

			$p = $this->pages_model->get_by('slug', $slug);

			if(empty($p)) return "";
			else return $p['title_'.$lang];
		}
	}
