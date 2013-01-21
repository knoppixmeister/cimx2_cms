<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Pages extends Frontend_Controller {
		function __construct() {
			parent::__construct();
		}

		function _remap($method=NULL, $params=NULL) {
			$uri = $this->uri->uri_string();

			$uri_parts = explode('/', $uri);
			for($i=0; $i<count($uri_parts); $i++) {
				if(empty($uri_parts[$i])) unset($uri_parts[$i]);
			}

			$lang = NULL;
			if(config_item('lang_switch_method') == 'url') {//lang switching by url /../
				if(!empty($uri_parts[0])) {
					$lang = $uri_parts[0];
					array_shift($uri_parts);
				}
				else redirect(base_url_lang());
			}

			$uri = implode('/', $uri_parts);

			if(!empty($uri) && strpos($uri, "_") === 0) $this->_404(); 

			$this->_page($uri);
		}

		function _page($uri=NULL) {
			if(empty($uri)) $p = $this->pages_model->get_by(array('is_default' => DB_TRUE, 'status' => 'live', ));
			else $p = $this->pages_model->get_by(array('uri' => $uri, 'status' => 'live', ));

			if(empty($p) || (time() < $p['publish_start_time'])) $this->_404();
			else {
				$text = str_replace(array('&#39;', '&quot;'), array("'", '"'), $p['text_'.CURRENT_LANGUAGE]);

				$this->data['page_slug'] = $p['slug'];

				if($p['layout_id'] > 0) {
					$pl = $this->page_layouts_model->get_by(array('id' 	=>	$p['layout_id'], 'theme' =>	CURRENT_THEME, ));

					$this->template->set_layout($pl['layout_file']);
				}
				else $this->template->set_layout('default.php');

				$this->data['text'] 	= $this->parser->parse_string($text, $this->data, TRUE);
				$this->data['title'] 	= $p['title_'.CURRENT_LANGUAGE];

				$this->data['page_css']	= $p['css'];
				$this->data['page_js']	= $p['javascript'];

				$this->data['meta_keywords'] 	= $p['keywords_'.CURRENT_LANGUAGE];
				$this->data['meta_description'] = $p['description_'.CURRENT_LANGUAGE];

				if($p['visibility'] == "password") {
					$c = $this->input->cookie('page_password_'.$p['id']);

					if(empty($c)) {
						$this->form_validation->set_rules('password', 'Password', 'required|callback__check_page_password['.$p['id'].']');

						if(!$this->form_validation->run()) {
							$this->data['page_data'] = $p;

							$this->template->build('pages/password', $this->data);
						}
						else {
							set_cookie('page_password_'.$p['id'], md5($p['id'].$p['password']), 0);//deny page access when browser will close.

							redirect(site_url($uri));
						}
					}
					elseif(md5($p['id'].$p['password']) == $c) $this->template->build('pages/index', $this->data);
					else redirect(site_url($uri));
				}
				elseif($p['visibility'] == "registered") redirect('login?next='.$uri);
				else $this->template->build('pages/index', $this->data);
			}
		}

		function _404() {
			$p = $this->pages_model->get_by(array('uri' => '404', 'status' => 'live', ));

			if(empty($p)) show_404();
			else $this->_page('404');
		}

		function _check_page_password($password, $page_id) {
			$p = $this->pages_model->get_by(
										array(
											'id' 			=>	$page_id, 
											'password' 		=>	$password, 
											'visibility'	=>	'password', 
										)
									);

			if(empty($p)) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											lang('pages_page_wrong_password') 
										);

				return FALSE;
			}

			return TRUE;
		}
	}
