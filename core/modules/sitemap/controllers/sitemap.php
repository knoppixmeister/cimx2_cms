<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Sitemap extends Frontend_Controller {
		function __construct() {
			parent::__construct();
		}

		function xml() {
			header("Content-Type: text/xml");

			e('<?xml version="1.0" encoding="UTF-8"?>'."\r\n");
			e('<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

			foreach($this->modules_model->get_all() as $m) {
				if($m['slug'] != "sitemap" && file_exists($m['path']."".$m['slug']."/controllers/sitemap.php")) {
					if(config_item('lang_switch_method') == 'get_param') {
						e('	<sitemap>
								<loc>'.site_url($m['slug'].'/sitemap/xml').'</loc>
								<lastmod>'.date('c').'</lastmod>
							</sitemap>');
					}
					elseif(config_item('lang_switch_method') == 'url') {
						foreach(config_item('supported_languages') as $lang => $val) {
							e('	<sitemap>
									<loc>'.site_url($lang."/".$m['slug'].'/sitemap/xml').'</loc>
									<lastmod>'.date('c').'</lastmod>
								</sitemap>');
						}
					}
				}
			}

			e('</sitemapindex>');
		}
	}
