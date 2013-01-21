<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Users_model extends MX2_Model {
		function __construct() {
			parent::__construct();

			$this->load->model('users/user_info_model');
		}

		function get_all() {
			return $this->db->select('u.*, r.description AS role_name')
							->join('roles r', 'r.id=u.role_id', 'LEFT')
							->get($this->_table." u")
							->result_array();
		}

		function get($id) {
			return $this->db->select('u.*, r.description AS role_name')
							->join('roles r', 'r.id=u.role_id', 'LEFT')
							->where("u.id", $id)
							->get($this->_table." u")
							->row_array();
		}
		/*
		function get_by() {
			return $this->db->select('u.*, r.description AS role_name')
							->join('user_roles r', 'r.id=u.role_id', 'LEFT')
							->where("u.id", $id)
							->get($this->_table." u")
							->row_array();
		}
		*/
		function set_reset_token($id) {
			$token = md5(microtime().$id.uniqid());

			$this->update(
						$id, 
						array(
							'reset_code' => $token, 
						), 
						TRUE
					);

			return $token;
		}

		function set_last_login($id) {
			$this->update($id, array('last_login_time' => time(), 'modified_time' => time(), ), TRUE);
		}

		function set_last_action_time($id) {
			$time = time();

			$this->update($id, array('last_action_time' => $time, 'modified_time' => $time, ), TRUE);

			return $time;
		}

		function insert($data) {
			$uid = parent::insert($data, TRUE);

			$this->user_info_model->insert(
										array(
											'user_id'	=>	$uid, 
										)
									);

			return $uid;
		}

		function delete($id) {
			Events::trigger('before_user_deleted', $id);

			$this->user_info_model->delete_by('user_id', $id);

			$res = parent::delete($id);

			Events::trigger('after_user_deleted', $id);

			return $res;
		}
	}
