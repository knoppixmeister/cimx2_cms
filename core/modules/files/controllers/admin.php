<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		protected $_folders_options_tree = array();

		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			$this->data['title'] = "Files";

			$this->data['items'] = $this->files_folders_model->folder_content_by_id(0);

			$this->template->build('files/admin/folders/content', $this->data);
		}

		function _edit($id=NULL, $action="edit") {
			parent::_edit($id, $action);

			$this->form_validation->set_rules(
										array(
											array(	
												'field'	=>	'folder', 
												'label'	=>	'Folder', 
												'rules'	=>	'required|numeric', 
											), 
											array(
												'field' =>	'file_title', 
												'label' =>	'Title', 
												'rules'	=>	'required', 
											), 
											array(
												'field' =>	'description', 
												'label' =>	'Description', 
												'rules'	=>	'xss_clean', 
											), 
										)
									);

			if(!$this->form_validation->run()) {
				$this->data['title'] = "Edit file";

				$this->files_folders_model->get_folders_options_tree(0, 2);

				$this->data['parent_folders'] = $this->files_folders_model->_folders_options_tree;

				$this->template->build('files/admin/edit', $this->data);
			}
			else {
				$data = array(
							'folder_id'		=>	get_post('folder'), 
							'title'			=>	get_post('file_title'), 
							'description'	=>	get_post('description'), 
						);

				if($action == "edit") $this->files_model->update($id, $data, TRUE);

				$this->session->set_flashdata('success_msg', 'Data saved');

				if(get_post('save_exit')) redirect(admin_url('files'));
				if(get_post('save')) redirect(admin_url('files/edit/'.$id));
			}
		}

		function upload() {
			$config['upload_path'] 		=	FCPATH.'public/uploads/'.date('Y/m');

			if(!file_exists($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

			$config['allowed_types'] 	=	'*';

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('file')) {
				$this->data['title'] = 'Files upload';

				if($_FILES)	$this->data['upload_errors'] = $this->upload->display_errors();

				$this->files_folders_model->get_folders_options_tree(0, 2);

				$this->data['parent_folders'] = $this->files_folders_model->_folders_options_tree;

				$this->template->build('files/admin/upload', $this->data);
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

				redirect(admin_url('files/edit/'.$id));
			}
		}

		function simple_upload() {
			$config['upload_path'] 		=	FCPATH.'public/uploads/'.date('Y/m');

			if(!file_exists($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

			$config['allowed_types'] 	=	'*';

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('file')) {
				$this->data['title'] = 'Files. Simple upload';

				if($_FILES)	$this->data['upload_errors'] = $this->upload->display_errors();

				$this->template->build('files/admin/partials/simple_upload', $this->data);
			}
			else {
				$upload_data = $this->upload->data();

				$data = array(
							'title'				=>	'', 
							'file_name' 		=>	$upload_data['file_name'], 
							'file_size'			=>	$upload_data['file_size'], 
							'file_mime_type' 	=>	$upload_data['file_type'], 
							'created_time'		=>	time(), 
						);

				if($upload_data['is_image']) {
					$data['image_width'] 	= $upload_data['image_width'];
					$data['image_height'] 	= $upload_data['image_height'];
				}

				$file_id = $this->files_model->insert($data, TRUE);

				redirect(admin_url('files/edit/'.$file_id));
			}
		}

		function ajax_upload() {
			$config['upload_path'] 		= 	FCPATH.'public/uploads/'.date('Y/m')."/";

			if(!file_exists($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

			$config['allowed_types'] 	= 	'*';

			$this->upload->initialize($config);

			if(!$this->upload->do_upload()) {
				die($this->upload->display_errors());
			}
			else {
				$upload_data = $this->upload->data();

				$upload_data['created_time'] = time();

				$data = array(
							'folder_id'			=>	get_post('folder'), 
							'file_name' 		=>	$upload_data['file_name'], 
							'title'				=>	mb_strtolower(url_title($upload_data['raw_name'])), 
							'description'		=>	'', 
							'file_size'			=>	$upload_data['file_size'], 
							'file_mime_type' 	=>	$upload_data['file_type'], 
							'created_time'		=>	$upload_data['created_time'], 
						);

				if($upload_data['is_image']) {
					$data['image_width'] 	= $upload_data['image_width'];
					$data['image_height'] 	= $upload_data['image_height'];
				}

				$this->files_model->insert($data, TRUE);

				$this->data['data'] = $upload_data;

				e($this->load->view('files/admin/includes/file_preview', $this->data, TRUE));
			}
		}

		function dialog_files_list() {
			$page = get_post('page');

			$page = max(1, (int)$page);
			
		}

		function images_dialog($action=NULL, $param=NULL) {
			if($action == "page") $this->data['page'] = max(1, (int)$param);
			else $this->data['page'] = 1;

			$config['upload_path']	=	FCPATH.'public/uploads/'.date('Y')."/".date('m')."/";

			if(!file_exists($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('image')) {
				if($_FILES)	$this->data['error'] = $this->upload->display_errors();

				$this->data['items'] = $this->files_model->order_by('id', 'DESC')
														->limit(
															5, 
															$this->data['page']*5-5 
														)
														->get_all();

				if($this->data['page'] > 1 && count($this->data['items']) == 0) show_error('Wrong page');

				$this->data['items_count'] = $this->files_model->count_all();

				$this->files_folders_model->get_folders_options_tree(0, 2);
				
				$this->data['parent_folders'] = $this->files_folders_model->_folders_options_tree;
				
				$this->template->set_theme('admin')
								->set_layout('file_browser.php')
								->build('files/admin/images_dialog', $this->data);
			}
			else {
				$upload_data = $this->upload->data();

				$this->files_model->insert(
										array(
											'file_size'		=>	$upload_data['file_size'], 
											'file_mime_type'=>	$upload_data['file_type'], 
											'file_name'		=>	$upload_data['file_name'], 
											'image_width'	=>	$upload_data['image_width'], 
											'image_height'	=>	$upload_data['image_height'], 
											'created_time'	=>	time(), 
										)
									);

				redirect(admin_url('files/images_dialog'));
			}
		}

		function files_dialog($action=NULL, $param=NULL) {
			//if($_FILES)	$this->data['error'] = $this->upload->display_errors();

			$this->data['items'] = $this->files_model->order_by('id', 'DESC')
													->get_many_by(array('image_width' => NULL, 'image_height' => NULL, ));

			if($this->data['page'] > 1 && count($this->data['items']) == 0) show_error('Wrong page');

			$this->data['items_count'] = $this->files_model->count_by(array('image_width' => NULL, 'image_height' => NULL, ));

			if(!$this->upload->do_upload('image')) {
				$this->template->set_theme('admin')
								->set_layout('file_browser.php')
								->build('files/admin/files_dialog', $this->data);
			}
			else {
				
				
			}
		}

		function ajax_delete($id=NULL) {
			$f = $this->files_model->get($id);

			$this->files_model->delete($f['id']);
		}

		function delete($id=NULL) {
			$f = $this->files_model->get($id);

			$this->files_model->delete($f['id']);

			redirect(admin_url('files/folders/content/'.$f['folder_id']));
		}

		function _get_folders_options_tree($parent_id=0, $padding=0) {
			$folders = $this->file_folders_model->get_many_by(array('parent_id' => $parent_id, ));

			foreach($folders as $f) {
				$this->_folders_options_tree[$f['id']] = str_repeat("&nbsp;", $padding).$f['name'];

				$this->_get_folders_options_tree($f['id'], $padding+3);
			}
		}
	}
