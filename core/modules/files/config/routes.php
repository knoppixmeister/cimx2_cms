<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$route['files/admin/(dialog|folders)/(:any)']	= 'files_$1/$2';
	$route['files/admin/(dialog|folders)']			= 'files_$1';
