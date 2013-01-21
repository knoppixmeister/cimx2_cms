<?php
	

	class ORM {
		protected $CI;

		protected $_primary_key = "id";
		protected $_primary_key_value;
		protected $_table = NULL;

		protected $_fields = array();
		protected $_loaded = FALSE;

		function __construct() {
			if(get_class($this) == __CLASS__) return;//DON'T REMOVE THIS.

			$this->CI = &get_instance();

			if($this->_table == NULL) {
				$class = preg_replace('/(_m|_(m|M)odel)?$/', '', get_class($this));

				$this->_table = strtolower($class);
			}
		}

		static function factory($model, $primary_id=NULL) {
			return $this;
		}

		function create() {
			$this->CI->db->insert($this->_table, $this->_fields);

			return $this;
		}

		function update() {
			$this->CI->db->update($id, $this->_table, $this->_fields);

			return $this;
		}

		function save() {
			$this->_loaded ? $this->update() : $this->create(); 
		}

		function __set($name, $value) {
			$this->_fields[$name] = $value;
		}

		function __get($name) {
			return isset($this->_fields[$name]) ? $this->_fields[$name] : NULL;
		}

		function __call($name, $params=NULL) {
			//Debug::dump( func_get_args() );

			if(method_exists($this->CI->db, $name)) {
				call_user_func_array(array($this->CI->db, $name), $params);

				return $this;
			}
			else show_error('Wrong method');
		}

		function loaded() {
			return $this->_loaded;
		}

		function delete() {
			if(!$this->_loaded) return NULL;

			//$id = $this->pk();

			// Delete the object
			//DB::delete($this->_table_name)
			//			->where($this->_primary_key, '=', $id)
			//			->execute($this->_db);

			return TRUE;
		}

		function count_all() {
			return $this->CI->db->count_all($this->_table);
		}

		function find() {
			if($this->_loaded) return NULL;

			$res = $this->CI->db->limit(1)->get($this->_table)->row();

			if(!empty($res)) {
				$this->_loaded = TRUE;
			}
			else $this->_loaded = FALSE;

			return $res;
		}

		function find_all() {
			if($this->_loaded) return NULL;

			return $this->CI->db->get($this->_table)->result();
		}

		function get_all() {
			return $this->find_all();
		}

		function clear() {
			return $this;
		}

		function reload() {
			$primary_key = $this->pk();

			// Replace the object and reset the object status
			$this->_object = $this->_changed = $this->_related = array();

			if($this->_loaded) {
				return $this->clear()
							->where($this->_table.'.'.$this->_primary_key, '=', $primary_key)
							->find();
			}
			else return $this->clear();
		}

		function last_query() {
			return $this->CI->db->last_query();
		}
	}
