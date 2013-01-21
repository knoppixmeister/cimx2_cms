<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_events {
		function __construct() {
			Events::register('blog_record_created', array($this, 'blog_record_created'));
			Events::register('blog_record_before_delete', array($this, 'blog_record_before_delete'));
			Events::register('blog_record_after_delete', array($this, 'blog_record_after_delete'));
			Events::register('blog_record_published', array($this, 'blog_record_published'));
			Events::register('blog_record_unpublished', array($this, 'blog_record_unpublished'));
		}

		function blog_record_created($blog_record_id) {

			return TRUE;
		}

		function blog_record_before_delete($blog_record_id) {

			return TRUE;
		}

		function blog_record_after_delete($blog_record_id) {

			return TRUE;
		}

		function blog_record_unpublished() {

			return TRUE;
		}

		function blog_record_published() {

			return TRUE;
		}
	}
