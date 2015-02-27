<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Pages_model extends MX2_Multilang_model {
		function __construct() {
			parent::__construct();

			$this->_lang_fields = array('title', 'text', 'meta_title', 'meta_keywords', 'meta_description');
		}

		function get_pages_tree($parent_id=0) {
			$res = $this->order_by('id', 'DESC')
						->where_in('status', array('draft', 'live', ))
						->get_many_by('parent_id', $parent_id);
			for($i=0; $i<count($res); $i++) {
				$res[$i]['child_pages'] = $this->get_pages_tree($res[$i]['id']);
			}

			return $res;
		}

		function delete($id) {
			$child_pages = $this->pages_model->get_many_by(array('parent_id' => $id, ));
			foreach($child_pages as $cp) {
				$this->delete($cp['id']);
			}

			return parent::delete($id);
		}
	}
