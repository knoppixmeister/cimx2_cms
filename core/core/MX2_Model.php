<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Model extends CI_Model {
		protected $_table;
		protected $primary_key 		= 'id';
		protected $before_create 	= array();
		protected $after_create 	= array();
		protected $validate 		= array();
		protected $skip_validation 	= TRUE;

		function __construct() {
			parent::__construct();

			$this->load->helper('inflector');
			$this->_fetch_table();
		}

		function __call($method, $arguments) {
			$result = call_user_func_array(array($this->db, $method), $arguments);

			if(is_object($result) && $result === $this->db) return $this;

			return $result;
		}

		function get($primary_value) {
			return $this->db->where($this->primary_key, $primary_value)
							->get($this->_table)
							->row_array();
		}

		function get_by() {
			$where =& func_get_args();
			$this->_set_where($where);

			return $this->db->get($this->_table)
							->row_array();
		}

		function get_many($primary_value) {
			$this->db->where($this->primary_key, $primary_value);

			return $this->get_all();
		}

		function get_many_by() {
			$where = &func_get_args();
			$this->_set_where($where);

			return $this->get_all();
		}

		function get_all() {
			return $this->db->get($this->_table)->result_array();
		}

		function count_by() {
			$where =& func_get_args();
			if(!empty($where)) $this->_set_where($where);

			return $this->db->count_all_results($this->_table);
		}

		function count_all() {
			return $this->db->count_all($this->_table);
		}

		function insert($data, $skip_validation=FALSE) {
			$valid = TRUE;
			if($skip_validation === FALSE) $valid = $this->_run_validation($data);

			if($valid) {
				$data = $this->_run_before_create($data);
				$this->db->insert($this->_table, $data);
				$this->_run_after_create($data, $this->db->insert_id());

				$this->skip_validation = FALSE;

				return $this->db->insert_id();
			}
			else return FALSE;
		}

		function insert_many($data, $skip_validation = FALSE) {
			$ids = array();

			foreach($data as $row) {
				$valid = TRUE;
				if($skip_validation === FALSE) $valid = $this->_run_validation($data);

				if($valid) {
					$data = $this->_run_before_create($row);
					$this->db->insert($this->_table, $row);
					$this->_run_after_create($row, $this->db->insert_id());

					$ids[] = $this->db->insert_id();
				}
				else $ids[] = FALSE;
			}

			$this->skip_validation = FALSE;

			return $ids;
		}

		function update($primary_value, $data, $skip_validation = FALSE) {
			$valid = TRUE;
			if($skip_validation === FALSE) $valid = $this->_run_validation($data);

			if($valid) {
				$this->skip_validation = FALSE;
				return $this->db->where($this->primary_key, $primary_value)
								->set($data)
								->update($this->_table);
			}
			else return FALSE;
		}

		function update_by() {
			$args =& func_get_args();
			$data = array_pop($args);
			$this->_set_where($args);

			if($this->_run_validation($data)) {
				$this->skip_validation = FALSE;

				return $this->db->set($data)
								->update($this->_table);
			}
			else return FALSE;
		}

		function update_many($primary_values, $data, $skip_validation) {
			$valid = TRUE;
			if($skip_validation === FALSE) $valid = $this->_run_validation($data);

			if($valid) {
				$this->skip_validation = FALSE;

				return $this->db->where_in($this->primary_key, $primary_values)
								->set($data)
								->update($this->_table);	
			}
			else return FALSE;
		}

		function update_all($data) {
			return $this->db->set($data)
							->update($this->_table);
		}

		function delete($id) {
			return $this->db->where($this->primary_key, $id)
							->delete($this->_table);
		}

		function delete_by() {
			$where =& func_get_args();
			$this->_set_where($where);

			return $this->db->delete($this->_table);
		}

		function delete_many($primary_values) {
			return $this->db->where_in($this->primary_key, $primary_values)
							->delete($this->_table);
		}

		function dropdown() {
			$args =& func_get_args();

			if(count($args) == 2) {
				list($key, $value) = $args;
			}
			else {
				$key = $this->primary_key;
				$value = $args[0];
			}

			$query = $this->db->select(array($key, $value))->get($this->_table);

			$options = array();
			foreach($query->result() as $row) {
				$options[$row->{$key}] = $row->{$value};
			}

			return $options;
		}

		function order_by($criteria, $order = 'ASC') {
			$this->db->order_by($criteria, $order);

			return $this;
		}

		function limit($limit, $offset = 0) {
			$limit =& func_get_args();
			$this->_set_limit($limit);

			return $this;
		}

		function distinct() {
			$this->db->distinct();

			return $this;
		}

		private function _run_before_create($data) {
			foreach($this->before_create as $method) {
				$data = call_user_func_array(array($this, $method), array($data));
			}

			return $data;
		}

		private function _run_after_create($data, $id) {
			foreach ($this->after_create as $method) {
				call_user_func_array(array($this, $method), array($data, $id));
			}
		}

		private function _run_validation($data) {
			if($this->skip_validation) return TRUE;

			if(!empty($this->validate)) {
				foreach($data as $key => $val) {
					$_POST[$key] = $val;
				}

				$this->load->library('form_validation');
				if(is_array($this->validate)) {
					$this->form_validation->set_rules($this->validate);

					return $this->form_validation->run();
				}
				else $this->form_validation->run($this->validate);
			}
			else return TRUE;
		}

		private function _fetch_table() {
			if($this->_table == NULL) {
				$class = preg_replace('/(_m|_(m|M)odel)?$/', '', get_class($this));

				$this->_table = strtolower($class);
			}
		}

		function _set_where($params) {
			if(count($params) == 1) $this->db->where($params[0]);
			else $this->db->where($params[0], $params[1]);
		}

		private function _set_limit($params) {
			if(count($params) == 1) {
				if(is_array($params[0])) $this->db->limit($params[0][0], $params[0][1]);
				else $this->db->limit($params[0]);
			}
			else $this->db->limit( (int) $params[0], (int) $params[1]);
		}
	}