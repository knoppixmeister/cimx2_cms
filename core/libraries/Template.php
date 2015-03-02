<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Template {
		protected $theme = NULL;
		protected $layout = NULL;

		protected $body_parser_enabled = TRUE;

		protected $theme_locations = array();

		function __construct($config=array()) {
			$this->theme_locations = 	array(
											FCPATH.EXTPATH."themes/", 
											FCPATH.APPPATH."themes/", 
										);
			
			$this->initialize($config);
		}

		function initialize($config=array()) {
		}

		function add_theme_location($path) {
			$this->theme_locations[] = $path;

			return $this;
		}

		function set_theme($theme) {
			$this->theme = $theme;

			return $this;
		}

		function set_layout($layout) {
			$this->layout = $layout;

			return $this;
		}

		function enable_body_parser($enabled) {
			$this->body_parser_enabled = $enabled;

			return $this;
		}

		function build($view='', $data=array(), $return=false) {
			if(empty($this->theme)) $this->set_theme('default');

			if(!empty($view)) {
				$data['tag:template:body'] = (($this->body_parser_enabled) ? $this->parser->parse($view, $data, TRUE) : 
																			 $this->load->view($view, $data, TRUE));
			}

			$data['tag:template:meta_title']	=	empty($data['meta_title']) ? '' : $data['meta_title'];
			$data['tag:template:title']			=	empty($data['title']) ? '' : $data['title'];

			$out = $data['tag:template:body'];

			$data['item'] = array(
				'meta_title'		=>	empty($data['meta_title']) ? '' : $data['meta_title'],
				'title'				=>	empty($data['title']) ? '' : $data['title'],
				'meta_description'	=>	!empty($data['meta_description']) ? $data['meta_description'] : '',
				'meta_keywords'		=>	!empty($data['meta_keywords']) ? $data['meta_keywords'] : '',
			);

			if(!empty($this->layout)) {
				if(!$this->body_parser_enabled) {
					$tmp_out = $data['tag:template:body'];

					$data['tag:template:body'] = '%tag:template:body%';
				}

				if(str_ends_with($this->layout, ".php")) {
					extract($data);

					ob_start();

					require $this->find_theme($this->theme)."/".$this->theme."/layouts/".$this->layout;

					$str = ob_get_clean();
				}
				else $str = file_get_contents($this->find_theme($this->theme)."/".$this->theme."/layouts/".$this->layout);

				$out = $this->parser->parse_string($str, $data, true);

				if(!$this->body_parser_enabled) $out = str_ireplace('%tag:template:body%', $tmp_out, $out);
			}

			if(!$return) $this->output->set_output($out);

			return $out;
		}

		function find_theme($slug, $locations=NULL) {	
			if(empty($locations)) $locations = $this->theme_locations;

			if(!is_array($locations)) $locations = array($locations, );

			foreach($locations as $l) {
				if(file_exists($l."/".$slug)) return $l;
			}

			return NULL;
		}

		function __get($key) {
			$CI = & get_instance();

			return $CI->$key;
		}
	}
