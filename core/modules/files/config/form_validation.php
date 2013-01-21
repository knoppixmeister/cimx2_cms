<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$config = 	array(
					'admin/edit_folder'	=>	array(
												array(
													'field' =>	'parent_folder_id', 
													'label'	=>	'Parent folder', 
													'rules'	=>	'required|numeric', 
												), 
												array(
													'field' =>	'name', 
													'label'	=>	'Folder name', 
													'rules'	=>	'required|trim', 
												), 
											), 
					'file_folders/_edit'	=>	array(
													array(
															'field' =>	'parent', 
															'label'	=>	'Parent folder', 
															'rules'	=>	'required|numeric',
													),
													array(
															'field' =>	'name',
															'label'	=>	'Folder name',
															'rules'	=>	'required|trim',
													), 
												), 
				);
