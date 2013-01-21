<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function write_string($module, $module_id, $field, $language, $value) {
		$CI = &get_instance();

		$CI->load->model('multilang/multilang_model');

		return $CI->multilang_model->insert(
										array(
											'module' 	=>	$module, 
											'module_id' =>	$module_id, 
											'field'		=>	$field, 
											'language'	=>	$language, 
											'value'		=>	$value, 
										), 
										TRUE 
									);
	}
