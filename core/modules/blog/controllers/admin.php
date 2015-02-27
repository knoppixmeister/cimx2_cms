<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			if(get_post('delete')) {
				foreach(get_post('items') as $i) {
					if(is_numeric($i)) $this->blog_model->delete($i);
				}

				redirect(admin_url('blog'));
			}

			$this->data['title'] = "Blog";

			parent::_list($page, FALSE, 10, FALSE);

			$this->data['items'] = $this->blog_model->where_in('tbl.status', array('live', 'draft'))
													->limit(
														$this->data['per_page'], 
														$this->data['per_page']*$this->data['page']-$this->data['per_page']
													)
													->order_by('tbl.id', 'DESC')
													->get_all();

			$this->data['items_count'] = $this->blog_model->where_in('status', array('live', 'draft'))
															->count_by();

			$this->template->build('blog/admin/index', $this->data);
		}

		function _edit($id=NULL, $action="edit") {
			parent::_edit($id, $action);

			foreach(config_item('supported_languages') as $l => $v) {
				$this->form_validation->set_rules('title_'.$l, 'Title '.strtoupper($l), 'trim|xss_clean');
			}

			$this->form_validation->set_rules('slug', 		'Slug',		'required|trim|strtolower|alpha_dash|xss_clean|callback__slug_uniq['.$action.']');
			$this->form_validation->set_rules('category', 	'Category',	'numeric|callback__category_check');
			$this->form_validation->set_rules('status', 	'Status',	'required|trim|xss_clean|callback__status_check');

			foreach(config_item('supported_languages') as $l => $v) {
				$this->form_validation->set_rules('preview_'.$l,	'Preview '.strtoupper($l),	'');
			}
			foreach(config_item('supported_languages') as $l => $v) {
				$this->form_validation->set_rules('text_'.$l,		'Text '.strtoupper($l),		'');
			}

			$this->form_validation->set_rules('comments_enabled', 'Comments enabled', '');

			if(!$this->form_validation->run()) {
				$this->data['categories'] = array(0 => '-- None --', );
				foreach($this->blog_categories_model->get_all() as $bc) {
					$this->data['categories'][$bc['id']] = $bc['title'];
				}

				$this->data['statuses'] = array();
				foreach(config_item('blog_statuses') as $k => $v) {
					if(!str_starts_with($k, "_")) $this->data['statuses'][$k] = $v;
				}

				$this->data['title'] = "Blog entry edit";

				$this->template->enable_body_parser(false)
								->build('blog/admin/edit', $this->data);
			}
			else {
				$comments_enabled	=	get_post('comments_enabled');
				$comments_enabled 	=	!empty($comments_enabled) ? DB_TRUE : DB_FALSE;

				$data = array(
							'slug'				=>	get_post('slug'), 
							'category_id'		=>	get_post('category'), 
							'status'			=>	get_post('status'), 
							'comments_enabled'	=>	$comments_enabled,
							'user_id'			=>	2,
						);

				$lang_fields = array();
				foreach(config_item('supported_languages') as $k => $v) {
					$lang_fields[]	= 	array(
											'field' 	=>	'title', 
											'language' 	=>	$k, 
											'text'		=>	get_post('title_'.$k), 
										);
					$lang_fields[]	=	array(
											'field'		=>	'preview', 
											'language'	=>	$k, 
											'text'		=>	get_post('preview_'.$k), 
										);
					$lang_fields[]	=	array(
											'field'		=>	'text', 
											'language'	=>	$k, 
											'text'		=>	get_post('text_'.$k), 
										);

					$lang_fields[]	=	array(
						'field'		=>	'meta_title',
						'language'	=>	$k,
						'text'		=>	get_post('meta_title_'.$k),
					);
					$lang_fields[]	=	array(
						'field'		=>	'meta_keywords',
						'language'	=>	$k,
						'text'		=>	get_post('meta_keywords_'.$k),
					);
					$lang_fields[]	=	array(
						'field'		=>	'meta_description',
						'language'	=>	$k,
						'text'		=>	get_post('meta_description_'.$k),
					);
				}

				if($this->data['action'] == "add") {
					$data['created_by']		=	$this->data['user']['id'];
					$data['created_time'] 	=	time();

					$id = $this->blog_model->insert($data, $lang_fields);
				}
				else $this->blog_model->update($id, $data, $lang_fields);

				$this->session->set_flashdata('success_msg', "Data saved");

				if(get_post('save_exit')) redirect(admin_url('blog', TRUE));
				redirect(admin_url("blog/edit/".$id, TRUE));
			}
		}
	}
