<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Widget {
		protected $widget_slug = NULL;

		function __construct() {
			if(empty($this->widget_slug)) {
				$class = preg_replace('/(_widget|_Widget)?$/', '', get_class($this));

				$this->widget_slug = strtolower($class);
			}
		}

		function settings_form($return=TRUE) {
			if($return) return $this->load->widget_view($this->widget_slug, 'settings');

			$this->load->widget_view($this->widget_slug, 'settings');
		}

		function display($return=TRUE) {
			$res = $this->load->widget_view($this->widget_slug, 'form', array('widget_variable' => 'AAAAAAAABBBB', ), TRUE);

			if($return) return $res;
		}
		
		function __get($key) {
			$CI = & get_instance();

			return $CI->$key;
		}
	}
