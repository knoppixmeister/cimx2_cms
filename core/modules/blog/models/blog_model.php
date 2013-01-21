<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_model extends MX2_Multilang_model {
		function __construct() {
			parent::__construct();

			$this->_lang_fields = array('title', 'preview', 'text', );
		}

		function get($id) {
			$this->db->select("	tbl.*, 
								u.username AS created_by_username, 
								bc.slug AS blog_category_slug, 
								(
									SELECT t1.text 
									FROM _texts t1 
									WHERE t1.module='blog_categories' 
										AND t1.module_record_id=bc.id 
										AND t1.language='".CURRENT_LANGUAGE."' 
										AND t1.field='title' 
								) AS blog_category_title")
					->join('users u', 'u.id=tbl.created_by', 'LEFT')
					->join('blog_categories bc', 'bc.id=tbl.category_id', 'LEFT');

			$this->_set_select_lang_fields();

			return $this->db->where("tbl.".$this->primary_key, $id)
							->get($this->_table." tbl")
							->row_array();
		}

		function get_by() {
			$where =& func_get_args();
			$this->_set_where($where);

			$this->db->select("	tbl.*, 
								u.username AS created_by_username, 
								bc.slug AS blog_category_slug, 
								(
									SELECT t1.text 
									FROM _texts t1 
									WHERE t1.module='blog_categories' 
										AND t1.module_record_id=bc.id 
										AND t1.language='".CURRENT_LANGUAGE."' 
										AND t1.field='title' 
								) AS blog_category_title")
					->join('users u', 'u.id=tbl.created_by', 'LEFT')
					->join('blog_categories bc', 'bc.id=tbl.category_id', 'LEFT');

			$this->_set_select_lang_fields();

			return $this->db->get($this->_table." tbl")
							->row_array();
		}

		function get_all() {
			$this->db->select("	tbl.*, 
								u.username AS created_by_username, 
								bc.slug AS blog_category_slug, 
								(
									SELECT t1.text 
									FROM _texts t1 
									WHERE t1.module='blog_categories' 
										AND t1.module_record_id=bc.id 
										AND t1.language='".CURRENT_LANGUAGE."' 
										AND t1.field='title' 
								) AS blog_category_title")
					->join('users u', 'u.id=tbl.created_by', 'LEFT')
					->join('blog_categories bc', 'bc.id=tbl.category_id', 'LEFT');

			$this->_set_select_lang_fields();

			return $this->db->get($this->_table." tbl")
							->result_array();
		}

		function get_archive_months() {
			$res = array();

			$_res = $this->db->select("created_time")
							->distinct()
							->order_by('created_time', 'DESC')
							->get_where($this->_table, array('status' => 'live', ))
							->result_array();

			foreach($_res as $r) {
				$res[] = date('01-m-Y', $r['created_time']);
			}

			$res = array_unique($res);

			$res1 = array();
			foreach($res as $r) {
				$cnt = $this->db->where(
										array(
											'status' 			=>	'live', 
											'created_time >= '	=>	strtotime($r), 
											'created_time <= '	=>	mktime(0, 0, 0, date("m", strtotime($r)), date("d", strtotime($r))+30, date("Y", strtotime($r))), 
										)
									)
									->count_all_results($this->_table);

				$res1[] = 	array(
								'date' 			=>	$r, 
								'records_count' =>	$cnt, 
							);
			}

			return $res1;
		}
	}
