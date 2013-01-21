<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Files extends Frontend_Controller {
		function __construct() {
			parent::__construct();
		}

		function thumb($id=NULL, $width=100, $height=NULL) {
			$file =	$this->files_model->get($id);

			$cp = config_item('cache_path');
			$images_cache = (empty($cp) ? FCPATH.APPPATH."cache/images_cache/" : $cp."images_cache/");

			$config['source_image'] 	=	FCPATH.'public/uploads/'.date('Y', $file['created_time'])."/".date('m', $file['created_time'])."/".$file['file_name'];

			if(!file_exists($config['source_image'])) show_error('Image file not exists. '.$config['source_image']);

			if(!file_exists($images_cache)) mkdir($images_cache, 0777, TRUE);

			$config['image_library'] 	=	'gd2';
			$config['maintain_ratio']	=	(empty($height) ? TRUE : FALSE);
			$config['width']			= 	$width;

			$config['height'] = ( !empty($height) ? $height : ($file['image_height']*($file['image_width']/$file['image_height'])) );

			$uid = md5($config['source_image']." ".$width." ".$config['height']);

			$config['new_image']		=	$images_cache."file_".$uid.".".pathinfo($config['source_image'], PATHINFO_EXTENSION);

			if(	!file_exists($config['new_image']) || 
				filemtime($config['source_image']) > filemtime($config['new_image']))
			{
				$this->image_lib->initialize($config);

				if(!$this->image_lib->resize()) die('Resize error. '.$this->image_lib->display_errors());
			}

			header('Content-type: '.$file['file_mime_type']);
			header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($config['new_image'])).' GMT');

			readfile($config['new_image']);
		}

		function download($id=NULL) {
			if(!is_numeric($id)) show_404();

			$file = $this->files_model->get($id);

			if(empty($file)) show_404();

			header('Content-type: '.$file['file_mime_type']);
			header('Content-Disposition: attachment; filename="'.$file['file_name'].'"');
			//header('Content-Length: 16047757');
			header('Content-Transfer-Encoding: binary');

			if(readfile(FCPATH."public/uploads/".date('Y/m', $file['created_time'])."/".$file['file_name'])) {
				$this->files_model->update($file['id'], array('download_count' => $file['download_count']+1, ), TRUE);
			}
		}
	}
