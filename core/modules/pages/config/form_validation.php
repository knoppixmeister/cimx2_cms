<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	foreach(config_item('supported_languages') as $k => $v) {
		$config['pages/_edit'][] = 	array(
										'field'	=>	'title_'.$k, 
										'label'	=>	'Title '.strtoupper($k), 
										'rules'	=>	'trim', 
									);
	}

	$cfg = array(
				array(
					'field'	=>	'slug', 
					'label'	=>	'Slug', 
					'rules'	=>	'required|trim|strtolower|alpha_dash', 
				), 
				array(
					'field'	=>	'layout', 
					'label'	=>	'Layout', 
					'rules'	=>	'required|numeric', 
				), 
				array(
					'field'	=>	'status', 
					'label'	=>	'Status', 
					'rules'	=>	'required|trim', 
				), 
				array(
					'field'	=>	'parent', 
					'label'	=>	'Parent page', 
					'rules'	=>	'numeric', 
				), 
				array(
					'field'	=>	'is_default', 
					'label'	=>	'Is Default', 
					'rules'	=>	'xss_clean', //don't leave empty check rules
				), 
				array(
					'field'	=>	'css', 
					'label'	=>	'CSS', 
					'rules'	=>	'trim|xss_clean', 
				), 
				array(
					'field'	=>	'javascript', 
					'label'	=>	'Javascript', 
					'rules'	=>	'trim', 
				), 
				array(
					'field'	=>	'comments_enabled', 
					'label'	=>	'Comments enabled', 
					'rules'	=>	'xss_clean', 
				), 
			);

	$config['pages/_edit'] = array_merge($config['pages/_edit'], $cfg);

	foreach(config_item('supported_languages') as $k => $v) {
		$config['pages/_edit'][] = 	array(
										'field'	=>	'text_'.$k, 
										'label'	=>	'Text '.strtoupper($k), 
										'rules'	=>	'trim', 
									);
		$config['pages/_edit'][] = 	array(
										'field'	=>	'meta_title_'.$k,
										'label'	=>	'Meta Title '.strtoupper($k),
										'rules'	=>	'trim',
									);
		$config['pages/_edit'][] = 	array(
										'field'	=>	'meta_keywords_'.$k,
										'label'	=>	'Meta Keywords '.strtoupper($k),
										'rules'	=>	'trim', 
									);
		$config['pages/_edit'][] = 	array(
										'field'	=>	'meta_description_'.$k,
										'label'	=>	'Meta Description '.strtoupper($k),
										'rules'	=>	'trim',
									);
	}
	