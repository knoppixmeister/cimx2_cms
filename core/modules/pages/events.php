<?php
	

	class Pages_events {
		function __construct() {
			Events::register('page_created', array($this, 'page_created'));
		}

		function page_created($page_data) {
			Debug::dump($page_data);

			//die();
		}
	}
