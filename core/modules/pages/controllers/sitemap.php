<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Sitemap extends Frontend_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
		}

		function xml() {
			header("Content-Type: text/xml");

			e('<?xml version="1.0" encoding="UTF-8"?>');
			e('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

			$main_page = $this->pages_model->get_by('is_default', DB_TRUE); 
			if(!empty($main_page)) {
				e('	<url>
						<loc>'.site_url('').'</loc>
						<lastmod>'.date('Y-m-d', $main_page['created_time']).'</lastmod>
						<changefreq>always</changefreq>
						<priority>1</priority>
					</url>');
			}

			$pages = $this->pages_model->order_by('tbl.id', 'DESC')
										->get_many_by(
											array(
												'tbl.status' =>	'live', 
											)
										);

			foreach($pages as $p) {
				if(!str_starts_with($p['slug'], "_")) {
					e('	<url>
							<loc>'.site_url($p['uri']).'</loc>
							<lastmod>'.date('Y-m-d', $p['created_time']).'</lastmod>
							<changefreq>always</changefreq>
							<priority>1</priority>
						</url>');
				}
			}

			e('</urlset>');
		}
	}
