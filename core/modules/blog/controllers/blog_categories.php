<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_Categories extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			$this->data['title'] = "Blog categories";

			$this->data['items'] = $this->blog_categories_model->get_categories_tree();

			$this->template->build('blog/admin/categories/index', $this->data);
		}

		function _edit($id=NULL, $action="edit") {
			if(get_post('cancel')) redirect(admin_url('blog/categories'));

			$this->data['action'] = strtolower($action);

			$this->form_validation->set_rules('parent_category', 'Parent category', 'numeric|callback__parent_category_check');
			foreach(config_item('supported_languages') as $l => $v) {
				$this->form_validation->set_rules('title_'.$l, 'Title '.strtoupper($l), 'required|trim');
			}
			$this->form_validation->set_rules('slug', 'Slug', 'required|trim|alpha_dash|callback__category_slug_uniq'.($this->data['action'] == "edit" ? "[".$id."]" : "" ));
			$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');

			if(!$this->form_validation->run()) {
				if($this->data['action'] == "edit") {
					$this->data['action_url'] = admin_url('blog/categories/edit/'.$id, TRUE);

					$this->data['item'] = $this->blog_categories_model->get($id);
				}
				else $this->data['action_url'] = admin_url('blog/categories/create', TRUE);

				$this->data['title'] = "Edit category";

				$this->data['parent_categories'] = array('' => '', );

				$where = array();
				if($this->data['action'] == "edit") {
					$where = array('id != ' => $id, );
				}

				$bcs = $this->blog_categories_model->get_many_by($where);
				foreach($bcs as $bc) {
					$this->data['parent_categories'][$bc['id']] = $bc['title_'.config_item('default_language')];
				}

				$this->template->build('blog/admin/categories/edit', $this->data);
			}
			else {
				$parent_id	= get_post('parent_category');
				$parent_id	= (!empty($parent_id) ? $parent_id : 0);

				$data = array(
							'parent_id'	=>	$parent_id, 
							'slug' 		=>	get_post('slug'), 
						);

				$lang_fields = array();
				foreach(config_item('supported_languages') as $k => $v) {
					$lang_fields[]	= 	array(
											'field' 	=>	'title', 
											'language' 	=>	$k, 
											'text'		=>	get_post('title_'.$k), 
										);
				}

				if($this->data['action'] == "add") {
					$id = $this->blog_categories_model->insert($data, $lang_fields);
				}
				else $this->blog_categories_model->update($id, $data, $lang_fields);

				$this->session->set_flashdata('success_msg', "Data saved");

				if(get_post('save_exit')) redirect(admin_url('blog/categories'));
				else redirect(admin_url('blog/categories/edit/'.$id));
			}
		}

		function delete($id=NULL) {
			$this->blog_categories_model->delete($id);

			redirect(admin_url('blog/categories'));
		}

		function add_child($parent_id=NULL) {
			

			redirect(admin_url('blog/categories'));
		}

		function _parent_category_check($id) {
			return TRUE;
		}

		function get_archives_by_months() {
			

			return array();
		}

		/*
		function _category_slug_uniq($category_slug, $id=NULL) {
			Debug::dump(func_get_args());
			
			$_cond = array('slug' => strtolower($category_slug), );

			if(is_numeric($id)) $_cond['id'] = $id;

			$c = $this->blog_categories_model->get_by($_cond);
			if(!empty($c)) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											'Such category URL already exists. Please change to another one'
										);

				return FALSE;
			}

			return TRUE;
		}
		*/
	}
