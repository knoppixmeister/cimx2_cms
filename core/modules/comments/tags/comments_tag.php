<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Comments_Tag extends Tag {
		function show() {
			$module		=	$this->get_attribute('module');
			$module_id	=	$this->get_attribute('module_id');

			$this->load->model('comments/comments_model');

			return $this->comments_model->get_many_by(array('module' => $module, 'module_id' => $module_id, ));
		}

		function form() {
			$this->load->language('comments/titles');
			$this->load->model('comments/comments_model');

			$module 	=	$this->get_attribute('module');
			$module_id	=	$this->get_attribute('module_id');

			$limit		=	$this->get_attribute('limit');
			$offset		=	$this->get_attribute('offset');

			if($_POST) {
				$data = array(
							'module'		=>	$module, 
							'module_id'		=>	$module_id, 
							'title'			=>	'', 
							'text'			=>	get_post('comment'), 
							'created_by'	=>	$this->data['user']['id'], 
							'created_time'	=>	time(), 
						);

				$this->comments_model->insert($data, TRUE);
			}

			$data['items'] = $this->comments_model->order_by('id', 'desc')->get_all();

			return $this->load->view('comments/comments_form', $data, TRUE);
		}
	}
