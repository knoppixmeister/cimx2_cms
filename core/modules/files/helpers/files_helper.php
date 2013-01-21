<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function file_path($id) {
		$CI = &get_instance();

		$CI->load->model('files/files_model');

		$file = $CI->files_model->get($id);

		if(!$file) return NULL;

		return base_url(TRUE).'public/uploads/'.date('Y/m', $file['created_time'])."/".$file['file_name'];
	}

	function resizer_image_path($id, $width=NULL, $height=NULL) {
		$CI = &get_instance();

		$CI->load->model('files/files_model');

		$file = $CI->files_model->get($id);

		if(!$file || !is_numeric($file['image_width']) || !is_numeric($file['image_height'])) return NULL;

		$sizes = "";
		if(!empty($width)) {
			$sizes .= $width;

			$sizes .= is_numeric($height) ? "/".$height : "";
		}

		return site_url('files/thumb/'.$file['id']."/".$sizes);
	}
