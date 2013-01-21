<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Parser extends CI_Parser {
		protected $CI;

		function __construct() {
			$this->CI = &get_instance();
		}

		function parse($file, $data=array(), $return=FALSE) {
			$content = $this->parse_string($this->CI->load->view($file, $data, TRUE), $data, TRUE);

			if(!$return) $this->CI->output->append_output($content);
			else return $content;
		}

		function parse_string($string, $data=array(), $return=FALSE) {
			$content = $this->CI->simpletags->parse($string, $data, array($this, 'parser_callback'));

			if(!$return) $this->CI->output->append_output($content['content']);
			else return $content['content'];
		}

		function parser_callback($data) {
			$tag_class	= $data['segments'][0];
			$tag_method	= $data['segments'][1];

			$location =	$this->_find_tag($tag_class);

			if(empty($location)) {
				$this->CI->load->config('parser');

				if(config_item('parser_error_no_tag')) show_error('Could not find tag: '.$tag_class.". Method: ".$tag_method);
				else return "";
			}

			require_once $location.$tag_class."_tag".EXT;

			$tag_class_name = ucfirst($tag_class)."_Tag";

			$tag = new $tag_class_name();

			$tag->set_attributes($data['attributes']);

			//if(method_exists($tag, $tag_method)) 
			$res = $tag->$tag_method();
			//else $res = $tag->$tag_method;

			if(!is_array($res)) return $this->parse_string($res, array(), TRUE);
			else {
				$content = "";

				foreach($res as $r) {
					$content .= $this->parse_string($data['content'], $r, TRUE);
				}

				return $content;
			}
		}

		function _find_tag($tag_slug, $locations=NULL) {
			if(empty($locations)) $locations = array(
													FCPATH.APPPATH."modules/".$tag_slug."/tags/", 
													FCPATH.APPPATH."tags/", 
													FCPATH.EXTPATH."tags/", 
													FCPATH.EXTPATH."modules/".$tag_slug."/tags/", 
												);

			if(!is_array($locations)) $locations = array($locations, );

			foreach($locations as $l) {
				if(file_exists($l.$tag_slug."_tag".EXT)) return $l;
			}

			return NULL;
		}
	}
