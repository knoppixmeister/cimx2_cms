<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Pages_preview extends MX2_Controller {
		function __construct() {
			parent::__construct();

			$u = $this->session->userdata('user');
			if(empty($u)) redirect(admin_url('login', TRUE));
			else $this->data['user'] = $this->users_model->get($u);
		}

		function create_preview($lang=NULL) {
			if(empty($_POST)) $this->template->build('pages/admin/preview_error', $this->data);
			else {
				$lang = strtolower($lang);

				$lang_keys = array_keys(config_item('supported_languages'));

				if(empty($lang) || !in_array($lang, $lang_keys)) {
					$this->template->build('pages/admin/preview_error', $this->data);
				}

				$this->_page_preview(NULL, $lang);
			}
		}

		function _page_preview($page_id=NULL, $lang=NULL) {
			if($this->form_validation->run('pages/_edit')) {
				$is_def = get_post('is_default');

				$comments_enabled	=	get_post('comments_enabled');
				$comments_enabled 	=	!empty($comments_enabled) ? DB_TRUE : DB_FALSE;

				$parent_id = get_post('parent');

				$visibility = get_post('visibility', TRUE);

				$data = array(
							'parent_id'			=>	(is_numeric($parent_id) ? $parent_id : 0), 
							'slug'				=>	get_post('slug'), 
							'layout_id'			=>	get_post('layout'), 
							'status'			=>	"_preview", 
							'is_default' 		=>	(!empty($is_def) ? DB_TRUE : DB_FALSE), 
							'css'				=>	get_post('css'), 
							'javascript'		=>	get_post('javascript'), 

							'visibility'		=>	$visibility,
							'password'			=>	($visibility != 'password' ? "" : get_post('password', TRUE)), 

							'publish_start_time'	=>	time(), //strtotime(get_post('start_date')), 

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
											'field'		=>	'keywords', 
											'language'	=>	$k, 
											'text'		=>	get_post('keywords_'.$k), 
										);
					$lang_fields[]	=	array(
											'field'		=>	'description', 
											'language'	=>	$k, 
											'text'		=>	get_post('description_'.$k), 
										);
				}

				if(empty($parent_id)) $data['uri'] = $data['slug'];
				else $data['uri'] = $this->_make_page_uri($id, $parent_id);

 				$data['created_by']		=	$this->data['user']['id'];
				$data['created_time']	=	time();

				$id = $this->pages_model->insert($data, $lang_fields);

				$page = $this->pages_model->get_by(
												array(
													'tbl.id'		=>	$id, 
													'tbl.status' 	=>	'_preview', 
												)
											);//get page preview data after it's been saved.

				$t = system_get_setting('frontend_theme');

				if(empty($t)) show_error("Default theme is not set");

				define('CURRENT_THEME', $t);

				$this->template->set_theme(CURRENT_THEME);

				if($page['layout_id'] > 0) {
					$pl = $this->page_layouts_model->get_by(array('id' => $page['layout_id'], 'theme' => CURRENT_THEME, ));

					$this->template->set_layout($pl['layout_file']);
				}
				else $this->template->set_layout('default.php');

				$this->data['page_slug'] =	$page['slug'];

				$this->data['text'] 	=	$page['text_'.$lang];
				$this->data['title'] 	=	$page['title_'.$lang];

				$this->data['page_css']	=	$page['css'];
				$this->data['page_js']	=	$page['javascript'];

				$this->template->build('pages/index', $this->data);
			}
			else $this->load->view('pages/admin/preview_error', $this->data);
		}
	}
