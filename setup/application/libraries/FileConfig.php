<?php
	

	class FileConfig {
		protected $CI;
		protected $_file;
		protected $_content = "<?php\r\n";

		function __construct() {
			$this->CI = & get_instance();
		}

		function load_file($file) {
			$this->_file = $file;

			return $this;
		}

		function security_str() {
			$this->_content .= "defined('BASEPATH') || exit('No direct script access allowed');\r\n";

			return $this;
		}

		function set_code($code) {
			$this->_content .= "\r\n".$code."\r\n";

			return $this;
		}

		function set_comment($comment) {
			$this->_content .= "\r\n /* \r\n".$comment."\r\n */";
				
			return $this;
		}
		
		function set_comment_line($comment) {
			$this->_content .= "\r\n//".$comment."\r\n";
			
			return $this;
		}

		function write() {
			file_put_contents($this->_file, $this->_content);
		}
	}
