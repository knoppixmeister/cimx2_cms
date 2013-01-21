<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class User_Tag extends Tag {
		function is_logged_in() {
			$u = $this->session->userdata('user');

			if(!empty($u)) return TRUE;
			else return FALSE;
		}

		function __call($name, $arguments) {
			$id = $this->get_attribute('id', $this->session->userdata('user'));

			if(!empty($id)) return element($name, $this->users_model->get($id));
			else return FALSE;
		}

		function set_last_action_time() {
			$u = $this->session->userdata('user');

			if(!empty($u)) return $this->users_model->set_last_action_time($u);

			return FALSE;
		}
	}
