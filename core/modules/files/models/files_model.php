<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Files_model extends MX2_Model {
		function __construct() {
			parent::__construct();
		}

		function save_by_upload_data($upload_data, $folder_id=0) {
			$data = array(
						'folder_id'			=>	$folder_id, 
						'title'				=>	mb_strtolower(url_title($upload_data['raw_name'])), 
						'description'		=>	'', 
						'file_name' 		=>	$upload_data['file_name'], 
						'file_size'			=>	$upload_data['file_size'], 
						'file_mime_type' 	=>	$upload_data['file_type'], 
						'created_time'		=>	time(), 
					);

			if($upload_data['is_image']) {
				$data['image_width'] 	= $upload_data['image_width'];
				$data['image_height'] 	= $upload_data['image_height'];
			}

			return $this->files_model->insert($data, TRUE);
		}

		function delete($id) {
			$file = $this->get($id);

			if(@unlink(FCPATH."public/uploads/".date('Y/m', $file['created_time'])."/".$file['file_name'])) {
				return parent::delete($id);
			}

			return FALSE;
		}

		function delete_by() {
			$where =& func_get_args();
			$this->_set_where($where);

			foreach($this->db->get($this->_table)->result_array() as $f) {
				if(!$this->delete($f['id'])) return FALSE;
			}

			return TRUE;
		}
	}
