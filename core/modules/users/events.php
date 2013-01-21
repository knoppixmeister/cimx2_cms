<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Users_events {
		function __construct() {
			Events::register('user_created', array($this, 'user_created'));
			Events::register('before_user_deleted', array($this, 'before_user_deleted'));
			Events::register('after_user_deleted', array($this, 'after_user_deleted'));
		}

		function user_created() {
		}

		function before_user_deleted() {
		}

		function after_user_deleted() {
		}
	}
