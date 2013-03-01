<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		protected $_options = array(0 => '', ); 

		function __construct() {
			parent::__construct();

			$this->load->language('pages/pages');
		}

		protected function _list($page=1) {
			if(get_post('delete')) {
				foreach(get_post('items') as $i) {
					if(is_numeric($i)) $this->pages_model->delete($i);
				}

				redirect(admin_url('pages'));
			}

			parent::_list($page, FALSE);

			$this->data['items'] = $this->pages_model->get_pages_tree();

			$this->data['items_count'] = $this->pages_model
												->where_in('status', array('live', 'draft'))
												->count_by(array());

			$this->data['title'] = 	lang('pages_pages');

			$this->template->enable_body_parser(FALSE)
							->build('pages/admin/index', $this->data);
		}

		protected function _edit($id=NULL, $action="edit", $parent_id=NULL) {
			parent::_edit($id, $action);

			if(!$this->form_validation->run('pages/_edit')) {
				$this->data['title'] = ucfirst($action)." page";

				$this->data['layouts'] = array(0 => 'Default', );
				foreach($this->page_layouts_model->get_all() as $l) {
					$this->data['layouts'][$l['id']] = $l['title'];
				}

				foreach(config_item('pages_statuses') as $k => $v) {
					if(!str_starts_with($k, '_')) $this->data['page_statuses'][$k] = $v;
				}

				//if($action == "edit") $this->pages_model->where('id != ', $id);
				/*
				$ps = $this->pages_model->get_all();
				foreach($ps as $p) {
					$this->data['parents'][$p['id']] = $p['title_'.config_item('default_language')]." (".$p['slug'].")";
				}
				*/

				$this->make_options_tree($this->pages_model->get_pages_tree(), $id);
				$this->data['pages_options_tree'] = $this->_options;

				$this->template->enable_body_parser(FALSE)
								->build('pages/admin/edit', $this->data);
			}
			else {
				$is_def = get_post('is_default');
				if(!empty($is_def)) $this->pages_model->update_all(array('is_default' => DB_FALSE, ));

				$comments_enabled	=	get_post('comments_enabled');
				$comments_enabled 	=	!empty($comments_enabled) ? DB_TRUE : DB_FALSE;

				$parent_id = get_post('parent');

				$visibility = get_post('visibility', TRUE);

				$data = array(
							'parent_id'			=>	(is_numeric($parent_id) ? $parent_id : 0), 
							'slug'				=>	get_post('slug', TRUE), 
							'layout_id'			=>	get_post('layout'), 
							'status'			=>	get_post('status'), 
							'is_default' 		=>	(!empty($is_def) ? DB_TRUE : DB_FALSE), 
							'css'				=>	get_post('css', TRUE), 
							'javascript'		=>	get_post('javascript'), 

							'visibility'	=>	$visibility,
							'password'		=>	($visibility != 'password' ? "" : get_post('password', TRUE)),

							'publish_start_time'	=>	strtotime(get_post('start_date')), 

							'comments_enabled' 	=>	$comments_enabled, 
						);

				$lang_fields = array();
				foreach(config_item('supported_languages') as $k => $v) {
					$lang_fields[]	= 	array(
											'field' 	=>	'title', 
											'language' 	=>	$k, 
											'text'		=>	get_post('title_'.$k), 
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

				if(empty($parent_id)) $data['uri'] = $data['slug'];
				else $data['uri'] = $this->_make_page_uri($data['slug'], $parent_id);

				if($action == "add") {
					$data['created_by']		=	$this->data['user']['id'];
					$data['created_time']	=	time();

					$id = $this->pages_model->insert($data, $lang_fields);

					Events::trigger('page_created', $this->pages_model->get($id));

					//die('bbb');
				}
				else $this->pages_model->update($id, $data, $lang_fields);

				/*				
					foreach()
	
					$full_url =	config_item('base_url').
								config_item('index_page').
								(config_item('index_page') != "" ? "/" : "");
				*/
				$this->session->set_flashdata('success_msg', "Data saved");

				if(get_post('save_exit')) redirect(admin_url('pages'));
				else redirect(admin_url('pages/edit/'.$id));
			}
		}

		function add_child($parent_id=NULL) {
			$pp = $this->pages_model->get($parent_id);

			if(empty($pp)) redirect(admin_url('pages'));

			$this->_edit(NULL, 'add', $parent_id);
		}

		private function _make_page_uri($page_slug, $parent_page_id) {
			$pp = $this->pages_model->get($parent_page_id);

			return trim($pp['uri']."/".$page_slug, '/');
		}

		private function make_options_tree($items, $exclude_page, $padding=0) {
			foreach($items as $i) {
				if($exclude_page != $i['id']) {
					$this->_options[$i['id']] = str_repeat('&nbsp;', $padding)." (".$i['slug'].")";
	
					if(!empty($i['child_pages'])) $this->make_options_tree($i['child_pages'], $exclude_page, $padding+2);
				}
			}
		}
	}
