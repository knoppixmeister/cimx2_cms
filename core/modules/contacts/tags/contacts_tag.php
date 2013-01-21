<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Contacts_Tag extends Tag {
		function gmap_address() {
			$address = $this->get_attribute('address', '');

			return $this->load->view('contacts/includes/map', array('address' => $address, ));
		}
	}
