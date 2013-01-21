<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Pager_Tag extends Tag {
		function show() {
			$type = $this->get_attribute('type', 'table');

			$data['lang']			= $this->get_attribute('lang', CURRENT_LANGUAGE);
			$data['page'] 			= $this->get_attribute('page', 1);
			$data['items_count'] 	= $this->get_attribute('items_count', 0);
			$data['per_page'] 		= $this->get_attribute('per_page', 30);
			$data['base_url'] 		= $this->get_attribute('base_url', '');
			$data['path'] 			= $this->get_attribute('path', '');
			$data['params']			= $this->get_attribute('params', '');

			$this->load->language('pager/pager', $data['lang']);

			return $this->load->view('pager/'.$type."_pager", $data, TRUE);
		}
	}
