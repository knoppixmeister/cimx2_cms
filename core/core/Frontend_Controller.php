<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Frontend_Controller extends MX2_Controller {
		function __construct() {
			parent::__construct();

			$s = system_get_setting('frontend_opened');			
			if($s == DB_FALSE) die('Site is not available for some time!');

			$res = $this->modules_model->get_by_slug($this->data['module']);
			if($res['is_frontend'] == DB_FALSE) show_404();  

			$t = system_get_setting('frontend_theme');

			if(empty($t)) show_error("Default theme is not set");

			define('CURRENT_THEME', $t);

			$this->template->add_theme_location(FCPATH.APPPATH.'themes/')
							->add_theme_location(FCPATH.EXTPATH.'themes/')
							->set_theme($t)
							->set_layout('default.php');

			/*
			 * LOAD GLOBAL LANGUAGE FILES 
			 * 
			 */

			$lang_dir_bases =	array(
									FCPATH.EXTPATH, 
									FCPATH.APPPATH, 
								);

			foreach($lang_dir_bases as $ldb) {
				if(	is_dir($ldb."language/".CURRENT_LANGUAGE_FOLDER) && 
					$handle = opendir($ldb.'language/'.CURRENT_LANGUAGE_FOLDER)) {
					while(($file = readdir($handle)) !== FALSE) {
						if($file != "." && $file != "..") {
							if(	!is_dir($ldb.'language/'.CURRENT_LANGUAGE_FOLDER."/".$file) && 
								str_ends_with($file, "_lang.php"))
							{
								$this->load->language(basename($file, "_lang.php"), CURRENT_LANGUAGE, FALSE, TRUE, $ldb);
							}
						}
					}

					closedir($handle);
				}
			}

			$this->load->language('form_validation');

			/*
			 * LOAD MODULE *_lang FILES FOR CURRENT LANGUAGE
			 */

			$mod_path = $this->modules_model->_locate($this->data['module']).$this->data['module']."/";
			if(is_dir($mod_path.'language/')) {
				if(	file_exists($mod_path.'language/'.CURRENT_LANGUAGE_FOLDER) && 
					$handle = opendir($mod_path.'language/'.CURRENT_LANGUAGE_FOLDER)) {
					while(FALSE !== ($file = readdir($handle))) {
						if($file != "." && $file != "..") {
							if(	!is_dir($mod_path.'language/'.CURRENT_LANGUAGE_FOLDER."/".$file) && 
								str_ends_with($file, "_lang.php"))
							{
								$this->load->language(
												$this->data['module']."/".basename($file, "_lang.php"), 
												CURRENT_LANGUAGE 
											);
							}
						}
					}

					closedir($handle);
				}
			}
		}
	}
