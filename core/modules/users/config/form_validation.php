<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$config = 	array(
					'users_roles/_edit' =>	array(
												array(
													'field'	=>	'name',	
													'label'	=>	'Name',	
													'rules'	=>	'required|trim|max_length[50]', 
												), 
												array(
													'field'	=>	'description',	
													'label'	=>	'Description',	
													'rules'	=>	'trim|xss_clean', 
												), 
											), 
				);
