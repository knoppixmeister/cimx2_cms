<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$autoload['config'] = array('blog/config', 'blog/form_validation', );

	$autoload['helper'] = array('blog/blog_settings', 'blog/blog', );
