<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_settings_model extends MX2_Model {
		protected $_settings = array();

		function __construct() {
			parent::__construct();

			$this->initialize();
		}

		function initialize() {
			foreach($this->get_all() as $s) {
				$this->_settings[$s['name']] = $s['value'];
			}
		}

		function get_setting($name) {
			if(isset($this->_settings[$name])) return $this->_settings[$name];
			else return NULL;
		}

		function save_setting($name, $value) {
			if($this->count_by(array('name' => $name))) {
				$this->update_by(
							array('name'	=>	$name, ), 
							array('value'	=>	$value, )
						);
			}
			else $this->insert(
							array(
								'name'	=>	$name, 
								'value' =>	$value, 
							), 
							TRUE 
						);

			$this->_settings[$name] = $value;
		}
	}
