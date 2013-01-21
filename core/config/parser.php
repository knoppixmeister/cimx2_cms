<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$config['parser_start_tag'] 	= "tag:";
	$config['parser_error_no_tag'] 	= ((defined('ENVIRONMENT') && ENVIRONMENT == "development") ? TRUE : FALSE);
