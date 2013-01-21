<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Calendar extends CI_Calendar {
		function __construct($config = array()) {		
			$this->CI = &get_instance();

			//if(!in_array('calendar_lang'.EXT, $this->CI->lang->is_loaded, TRUE)) 

			$this->local_time = time();

			if(count($config) > 0) $this->initialize($config);

			//$this->CI->lang->load('calendar', $this->lang);

			log_message('debug', "MX2_Calendar Class Initialized");
		}

		function initialize($config = array()) {	
			foreach($config as $key => $val) {
				if(isset($this->$key)) $this->$key = $val;
			}

			$this->CI->lang->load('calendar', $this->lang);
		}
	}
