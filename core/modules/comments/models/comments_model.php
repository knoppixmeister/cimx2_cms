<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Comments_model extends MX2_Model {
		function __construct() {
			parent::__construct();
		}

		function get_all() {
			return $this->db->select('c.*, u.username')
							->join('users u', 'u.id=c.created_by', 'LEFT')
							->get($this->_table." c")
							->result_array();
		}
	}
