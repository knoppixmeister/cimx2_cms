<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Widget_Tag extends Tag {
		function show() {
			$id = $this->get_attribute("id");			

			include $this->_find_widget($id).$id."/".$id."_widget".EXT;

			$widget = ucfirst($id)."_Widget";

			$w = new $widget();

			return $w->display();
		}

		function _find_widget($widget_slug, $locations=NULL) {
			if(empty($locations)) $locations = array(
													FCPATH.APPPATH."widgets/", 
													FCPATH.EXTPATH."widgets/", 
												);

			if(!is_array($locations)) $locations = array($locations, );

			foreach($locations as $l) {
				if(file_exists($l."/".$widget_slug."/".$widget_slug."_widget".EXT)) return $l;
			}

			return NULL;
		}
	}
