<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_preview extends MX2_Controller {
		function __construct() {
			parent::__construct();

			$u = $this->session->userdata('user');
			if(empty($u)) redirect(admin_url('login', TRUE));
			else $this->data['user'] = $this->users_model->get($u);
		}

		function index($lang=NULL) {
			if(empty($lang) || empty($_POST)) {
				$this->template->build('pages/admin/preview_error', $this->data);
			}
			else {
				$lang = strtolower($lang);

				$lang_keys = array_keys(config_item('supported_languages'));
				if(empty($lang) || !in_array($lang, $lang_keys)) $this->template->build('pages/admin/preview_error', $this->data);

				foreach(config_item('supported_languages') as $l => $v) {
					$this->form_validation->set_rules('title_'.$l, 'Title '.strtoupper($l), 'trim|xss_clean');
				}

				$this->form_validation->set_rules('slug',		'Slug',		'required|trim|strtolower|alpha_dash|xss_clean|callback__slug_uniq['.$action.']');
				$this->form_validation->set_rules('category',	'Category',	'numeric|callback__category_check');
				$this->form_validation->set_rules('status',		'Status',	'required|trim|xss_clean|callback__status_check');

				foreach(config_item('supported_languages') as $l => $v) {
					$this->form_validation->set_rules('preview_'.$l, 'Preview '.strtoupper($l),	'');
				}
				foreach(config_item('supported_languages') as $l => $v) {
					$this->form_validation->set_rules('text_'.$l, 'Text '.strtoupper($l), '');
				}
	
				if($this->form_validation->run()) {
					$is_def = get_post('is_default');
	
					//$comments_enabled	=	get_post('comments_enabled');
					//$comments_enabled 	=	!empty($comments_enabled) ? DB_TRUE : DB_FALSE;
	
					//$visibility = get_post('visibility', TRUE);
	
					$data = array(
							'slug'				=>	get_post('slug'), 
							'status'			=>	"_preview", 
	
							//'visibility'		=>	$visibility, 
							//'password'		=>	($visibility != 'password' ? "" : get_post('password', TRUE)), 
	
							//'publish_start_date'	=>	time(), //strtotime(get_post('start_date')),
							//'publish_start_hour'	=>	date('H'),	//get_post('start_hour'),
							//'publish_start_min'		=>	date('i'),	//get_post('start_min'),
				
							//'comments_enabled' 	=>	$comments_enabled,
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
						
					}
	
					$data['created_by']		=	$this->data['user']['id'];
					$data['created_time']	=	time();
	
					$id = $this->blog_model->insert($data, $lang_fields);
	
					$blog_rec = $this->blog_model->get_by(
														array(
															'tbl.id'		=>	$id, 
															'tbl.status'	=>	'_preview', 
														)
													);//get page preview data after it's been saved.

					$t = system_get_setting('frontend_theme');

					if(empty($t)) show_error("Default theme is not set");

					define('CURRENT_THEME', $t);
	
					$this->data['item'] = $blog_rec;
	
					$this->template->set_theme($t)
									->set_layout('default.php')
									->build('blog/view', $this->data);
				}
				else $this->load->view('pages/admin/preview_error', $this->data);
			}
		}
	}
