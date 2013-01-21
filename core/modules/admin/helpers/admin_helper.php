<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function admin_menu_tree() {
		$menus = array();

		$CI = &get_instance();

		$res = $CI->db->where('admin_menu IS NOT NULL', NULL, FALSE)
						->get_where(
							'modules', 
							array(
								'enabled' 	=>	DB_TRUE, 
								'is_admin' 	=>	DB_TRUE, 
								'is_system'	=>	DB_TRUE, 
							)
						)->result_array();

		foreach($res as $r) {
			$menus['system_mods'][] = unserialize($r['admin_menu']);
		}

		$menus['user_mods'] = array();

		Debug::dump($menus);
	}
