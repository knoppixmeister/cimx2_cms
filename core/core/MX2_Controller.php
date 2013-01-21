<?php
	defined('BASEPATH') || die('No direct script access allowed');

	require APPPATH."third_party/MX/Controller.php";

	class MX2_Controller extends MX_Controller {
		protected $data = array();

		function __construct() {
			if(	isset($_REQUEST['_profiler']) && 
				ENVIRONMENT == "development") 
			{
				$this->output->enable_profiler(TRUE);
			}

			parent::__construct();

			$this->form_validation->CI = &$this;//still DON't remove this. (CI ver 3.0-dev)

			$this->data['controller']	=	strtolower(get_class($this));
			$this->data['module']		=	strtolower($this->router->fetch_module());
			$this->data['function']		=	$this->router->method;

			$m = $this->modules_model->get_by_slug($this->data['module']);
			if(!empty($this->data['module']) && (empty($m) || $m['enabled'] == DB_FALSE)) show_404();

			$mod_path = $this->modules_model->_locate($this->data['module']).$this->data['module']."/";
			if(is_dir($mod_path.'models')) {
				if($handle = opendir($mod_path.'models')) {
					while(FALSE !== ($file = readdir($handle))) {
						if($file != "." && $file != "..") {
							if(	is_file($mod_path.'models/'.$file) && 
								str_ends_with($file, "_model.php")) 
							{
								$this->load->model(basename($file, ".php"));
							}
						}
					}

					closedir($handle);
				}
			}
		}
	}
