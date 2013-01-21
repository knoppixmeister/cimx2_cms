<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Setup extends CI_Controller {
		function __construct() {
			parent::__construct();

			$this->load->helper(array('url', 'text', 'form', 'html', ));

			$this->load->library(
							array(
								'form_validation', 
								'session', 
								'fileconfig', 
							)
						);
		}

		function index() {
			$this->step1();
		}

		function step1() {
			$data['step_num'] = 1;

			$this->load->view('header', $data);
			$this->load->view('step1');
			$this->load->view('footer');
		}

		function step2() {
			$data['step_num'] = 2;

			$this->form_validation->set_rules('server', 'Server', 'required|trim');

			if(!$this->form_validation->run()) {
				$this->load->view('header', $data);
				$this->load->view('paths');
				$this->load->view('footer');
			}
			else {
				

				redirect(site_url('setup/step3'));
			}
		}

		function step3() {
			$this->form_validation->set_rules('server', 'Server', '');

			if(!$this->form_validation->run()) {
				$this->load->view('header', $data);
				$this->load->view('extensions');
				$this->load->view('footer');
			}
			else {
				redirect(site_url('setup/step4'));
			}
		}

		function step4() {//database
			$this->form_validation->set_rules('db_hostname', 	'DB Hostname',	'required|trim');
			$this->form_validation->set_rules('db_port', 		'DB Port',		'required|numeric');
			$this->form_validation->set_rules('db_username', 	'DB Username',	'required|trim');
			$this->form_validation->set_rules('db_password', 	'DB Password',	'required|trim');
			$this->form_validation->set_rules('db_name', 		'DB name', 		'required|trim|callback__check_db_connect');
			$this->form_validation->set_rules('db_create_db', 	'Create DB', 	'');

			$this->form_validation->set_rules('first_name', 		'First name', 		'required|trim');
			$this->form_validation->set_rules('last_name', 			'Last name', 		'required|trim');
			$this->form_validation->set_rules('username', 			'Username', 		'required|strtolower|trim');
			$this->form_validation->set_rules('email', 				'E-mail',			'required|trim|strtolower|valid_email');
			$this->form_validation->set_rules('password',			'Password',			'required|trim|min_length[4]');
			$this->form_validation->set_rules('confirm_password',	'Confirm Password', 'required|trim|min_length[4]|matches[password]');

			if(!$this->form_validation->run()) {
				$this->load->view('header', $data);
				$this->load->view('database');
				$this->load->view('footer');
			}
			else {
				/*
				echo '<pre>';
				var_dump($_REQUEST);
				echo '</pre>';
				*/
				$db_host		=	$this->input->get_post('db_hostname');
				$db_port		=	$this->input->get_post('db_port');
				$db_username	=	$this->input->get_post('db_username');
				$db_password	=	$this->input->get_post('db_password');
				$db_name		=	$this->input->get_post('db_name');

				$create_db = $this->input->get_post('db_create_db');

				if(($res = @mysql_connect($db_host.":".$db_port, $db_username, $db_password)) !== FALSE) {
					if(!empty($create_db)) mysql_query("CREATE DATABASE IF NOT EXISTS ".$db_name, $res);
				}

				$code = '	$active_group = "default";
							$active_record = TRUE;';

				$db['default'] = array(
									'hostname' => $db_host, 
									'username' => $db_username, 
									'password' => $db_password, 
									'database' => $db_name, 
									'dbdriver' => 'mysql', 
									'dbprefix' => '', 
									'pconnect' => FALSE, 
									'db_debug' => FALSE, 
									'cache_on' => FALSE, 
									'cachedir' => '', 
									'char_set' => 'utf8', 
									'dbcollat' => 'utf8_general_ci', 
									'swap_pre' => '', 
									'autoinit' => TRUE, 
									'stricton' => FALSE, 
								);

				$db_consts = '	if($db[$active_group]["dbdriver"] == "mysql") {
									define("DB_TRUE", 1);
									define("DB_FALSE", 0);
								}
								elseif($db[$active_group]["dbdriver"] == "postgre") {
									define("DB_TRUE", "t");
									define("DB_FALSE", "f");
								}';

				if(file_exists(FCPATH."../application/config/database.php")) unlink(FCPATH."../application/config/database.php");
				if(file_exists(APPPATH."config/database.php")) unlink(APPPATH."config/database.php");

				$this->fileconfig->load_file(FCPATH."../application/config/database.php")
								->security_str()
								->set_code($code)
								->set_code('$db = '.var_export($db, TRUE).";")
								->set_code($db_consts)
								->write();

				copy(
					FCPATH."../application/config/database.php", 
					APPPATH."config/database.php" 
				);

				$this->load->database();

				$this->session->set_userdata('db_admin_data', $_REQUEST);

				$sql_content = @file_get_contents(FCPATH.'ci_mx_dump.sql');

				$sqls = preg_split('#;\s*#', $sql_content, -1, PREG_SPLIT_NO_EMPTY);

				foreach($sqls as $sql) {
					$this->db->query($sql);
				}

				$this->db->query("	INSERT INTO `users` (`first_name`, `last_name`, `username`, `password`, `email`, `role_id`, `status`, `reset_code`, `activated`, `activation_code`, `created_time`) 
									VALUES (
										'".$this->input->get_post('first_name')."', 
										'".$this->input->get_post('last_name')."', 
										'".$this->input->get_post('username')."', 
										'".md5($this->input->get_post('password'))."', 
										'".$this->input->get_post('email')."', 
										1, 
										'active', 
										NULL, 1, NULL, ".time().");");

				redirect(site_url('setup/step5'));
			}
		}

		function step5() {
			$this->load->view('header', $data);
			$this->load->view('emailer');
			$this->load->view('footer');
		}

		function finish() {
			$this->load->view('header', $data);
			$this->load->view('finish');
			$this->load->view('footer');
		}

		function _check_db_connect($db_name) {
			$db_host		=	$this->input->get_post('db_hostname');
			$db_port		=	$this->input->get_post('db_port');
			$db_username 	=	$this->input->get_post('db_username');
			$db_password	=	$this->input->get_post('db_password');

			if(!@mysql_connect($db_host.":".$db_port, $db_username, $db_password)) {			
				$this->form_validation->set_message(__FUNCTION__, 'Could not connect to db');

				return FALSE;
			}

			return TRUE;
		}
	}
