<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_categories_model extends MX2_Multilang_model {	
		function __construct() {
			parent::__construct();

			$this->_lang_fields = array('title', );
		}

		function get_categories_tree($parent_id=0) {
			$res = $this->order_by('id', 'DESC')
						->get_many_by('parent_id', $parent_id);
			for($i=0; $i<count($res); $i++) {
				$res[$i]['child_categories'] = $this->get_categories_tree($res[$i]['id']);
			}

			return $res;
		}

		function get_categories_options_tree($parent_id=0) {
			//TODO: 
		}
	}
