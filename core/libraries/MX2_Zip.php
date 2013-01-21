<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Zip extends CI_Zip {
		function __construct() {
			parent::__construct();
		}

		function unzip($zip_file, $directory) {
			$z = zip_open($zip_file);
			if($z) {
				while($zip_entry = zip_read($z)) {
					if(zip_entry_open($z, $zip_entry, "r")) {
						$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

						if(zip_entry_filesize($zip_entry) > 0) {
							$tmp = "";
							foreach(explode("/", dirname($directory.zip_entry_name($zip_entry))) as $k) {
								$tmp .= $k.'/';
								if(!file_exists($tmp)) @mkdir($tmp, 0777);
							}

							file_put_contents($directory.zip_entry_name($zip_entry), $buf);
						}
						else mkdir($directory.zip_entry_name($zip_entry));

						zip_entry_close($zip_entry);
					}
			    }

    			zip_close($z);

    			return TRUE;
			}

			return FALSE;
		}

		function make_zip_from_dir($dir, $zip_file) {
		}

		function make_zip_from_file($file, $zip_file) {
		}
	}
