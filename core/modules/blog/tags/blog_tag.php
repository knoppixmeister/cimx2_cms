<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_Tag extends Tag {
		function posts() {
			$limit = $this->get_attribute('limit', 5);
			$offset = $this->get_attribute('offset', 0);

			$this->load->model('blog/blog_model');

			$posts = $this->blog_model->limit($limit, $offset)
										->order_by('id', 'desc')
										->get_many_by(array('status' => 'live', ));

			return $posts;
		}

		function categories() {
			return array();
		}
	}
