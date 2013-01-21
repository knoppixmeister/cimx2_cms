<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Multilang_model extends MX2_Model {
		public $_lang_fields = array();

		function __construct() {
			parent::__construct();

			$this->load->model('multilang/multilang_model');
		}

		function get($id) {
			$this->db->select('tbl.*');

			$this->_set_select_lang_fields();

			return $this->db->where("tbl.".$this->primary_key, $id)
							->get($this->_table." tbl")
							->row_array();
		}

		function get_by() {
			$where =& func_get_args();
			$this->_set_where($where);

			$this->db->select('tbl.*');

			$this->_set_select_lang_fields();

			return $this->db->get($this->_table." tbl")
							->row_array();
		}

		function get_all() {
			$this->db->select('tbl.*');

			$this->_set_select_lang_fields();

			return $this->db->get($this->_table." tbl")
							->result_array();
		}

		function insert($regular_fields=array(), $lang_fields=array()) {
			$id = parent::insert($regular_fields, TRUE);

			if(empty($id)) return FALSE;

			foreach($lang_fields as $f) {
				$this->multilang_model->insert(
											array(
												'module'			=>	$this->_table, 
												'module_record_id'	=>	$id, 
												'field'				=>	$f['field'], 
												'language'			=>	$f['language'], 
												'text'				=>	$f['text'], 
											), 
											TRUE 
										);
			}

			return $id;
		}

		function update($id, $regular_fields=array(), $lang_fields=array()) {
			parent::update($id, $regular_fields, TRUE);

			foreach($lang_fields as $f) {
				if($this->db->where(
								array(
									'module'			=>	$this->_table, 
									'module_record_id'	=>	$id, 
									'field'				=>	$f['field'], 
									'language'			=>	$f['language'], 
								)
							)->count_all_results('_texts') == 0)
				{
					$this->multilang_model->insert(
												array(
													'module'			=>	$this->_table, 
													'module_record_id'	=>	$id, 
													'field'				=>	$f['field'], 
													'language'			=>	$f['language'], 
													'text'				=>	$f['text'], 
												), 
												TRUE 
											);
				}
				else {
					$this->multilang_model->update_by(
												array(
													'module'			=>	$this->_table, 
													'module_record_id'	=>	$id, 
													'field'				=>	$f['field'], 
													'language'			=>	$f['language'], 
												), 
												array('text' => $f['text'], )
											);
				}
			}

			return TRUE;
		}

		function delete($id) {
			$this->multilang_model->delete_by(
										array(
											'module'			=>	$this->_table, 
											'module_record_id'	=>	$id, 
										)
									);

			return parent::delete($id);
		}

		protected function _set_select_lang_fields() {
			$idx = 1;
			foreach(config_item('supported_languages') as $k => $v) {
				foreach($this->_lang_fields as $field) {
					$this->db->select("(SELECT t".$idx.".text 
											FROM _texts t".$idx." 
											WHERE t".$idx.".module='".$this->_table."' 
											AND t".$idx.".module_record_id=tbl.id 
											AND t".$idx.".language='".$k."' 
											AND t".$idx.".field='".$field."') AS ".$field."_".$k.", 
										( 
											SELECT t".$idx.".text 
											FROM _texts t".$idx." 
											WHERE t".$idx.".module='".$this->_table."' 
											AND t".$idx.".module_record_id=tbl.id 
											AND t".$idx.".language='".$k."' 
											AND t".$idx.".field='".$field."' 
										) AS ".$field);
					++$idx;
				}
			}
		}
	}
