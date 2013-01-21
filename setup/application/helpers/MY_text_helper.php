<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function str_ends_with($haystack, $needle) {
		return strrpos($haystack, $needle) === strlen($haystack)-strlen($needle);
	}

	function str_starts_with($haystack, $needle) {
		return strpos($haystack, $needle) === 0;
	}

	if(!function_exists("e")) {
		function e($text="") {
			echo $text;
		}
	}

	if(!function_exists("_")) {
		function _($text="") {
			echo $text;
		}
	}
