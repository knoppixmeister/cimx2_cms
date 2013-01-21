<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Files_dialog extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			$this->data['page'] 	= max(1, (int)$page);

			$this->data['folder'] 	= max(0, (int)get_post('folder'));

			$f = $this->files_folders_model->get($this->data['folder']);
			if($this->data['folder'] > 0 &&	empty($f)) show_404();

			$this->data['controller'] = "index";

			$this->data['items'] = $this->files_model->order_by('id', 'DESC')
													->limit(
														5, 
														$this->data['page']*5-5 
													)
													->get_many_by('folder_id', $this->data['folder']);

			if($this->data['page'] > 1 && count($this->data['items']) == 0) show_error('Wrong page');

			$this->data['items_count'] = $this->files_model->count_by('folder_id', $this->data['folder']);

			$this->files_folders_model->get_folders_options_tree(0, 2);

			$this->data['parent_folders'] = $this->files_folders_model->_folders_options_tree;

			$this->data['params'] = "?folder=".$this->data['folder'];

			$this->template->set_theme('admin')
							->set_layout('file_browser.php')
							->build('files/admin/dialog/index', $this->data);
		}

		function insert_by_url() {
			$this->data['controller'] = "url";

			$this->template->set_theme('admin')
							->set_layout('file_browser.php')
							->build('files/admin/dialog/by_url', $this->data);
		}

		function upload_files() {
			$this->data['controller'] = "upload";

			$this->files_folders_model->get_folders_options_tree(0, 2);

			$this->data['parent_folders'] = $this->files_folders_model->_folders_options_tree;

			$config['upload_path'] 		=	FCPATH.'public/uploads/'.date('Y/m');

			if(!file_exists($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

			$config['allowed_types'] 	=	'*';

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('file')) {
				$this->data['in_dialog'] = TRUE;

				if($_FILES)	$this->data['error'] = $this->upload->display_errors();

				$this->template->set_theme('admin')
								->set_layout('file_browser.php')
								->build('files/admin/dialog/upload', $this->data);
			}
			else {
				$upload_data = $this->upload->data();

				$data = array(
							'title'				=>	mb_strtolower(url_title($upload_data['raw_name'])), 
							'description'		=>	'', 
							'file_name' 		=>	$upload_data['file_name'], 
							'file_size'			=>	$upload_data['file_size'], 
							'file_mime_type' 	=>	$upload_data['file_type'], 
							'created_time'		=>	time(), 
						);

				if($upload_data['is_image']) {
					$data['image_width'] 	= $upload_data['image_width'];
					$data['image_height'] 	= $upload_data['image_height'];
				}

				$id = $this->files_model->insert($data, TRUE);

				$this->session->set_flashdata('success_msg', 'File uploaded.');

				redirect(admin_url('files/dialog/upload_files?simple_uploader'));
			}
		}
	}
