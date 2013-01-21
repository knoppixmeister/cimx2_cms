<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function blog_post_url($post_id) {
		$CI = &get_instance();

		$CI->load->model('blog/blog_model');

		$post = $CI->blog_model->get($post_id);

		if(!empty($post)) return 'blog/'.date('Y/m', $post['created_time'])."/".$post['slug'];
		else return NULL;
	}
