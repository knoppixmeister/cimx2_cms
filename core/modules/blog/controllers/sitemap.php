<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Sitemap extends Frontend_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
		}

		function xml() {
			header("Content-Type: text/xml; charset=utf-8");

			e('<?xml version="1.0" encoding="UTF-8"?>');
			e('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

			if(blog_get_setting('enable_blog') == DB_TRUE) {
				$recs = $this->blog_model->order_by('tbl.id', 'DESC')
										->limit(500)
										->get_many_by('tbl.status', 'live');

				foreach($recs as $r) {
					e('	<url>
							<loc>'.site_url(blog_post_url($r['id'])).'</loc>
							<lastmod>'.date('Y-m-d', $r['created_time']).'</lastmod>
							<changefreq>always</changefreq>
							<priority>1</priority>
						</url>');
				}

				$categories = $this->blog_categories_model->get_all();
				foreach($categories as $c) {
					e('	<url>
							<loc>'.site_url('blog/category/'.$c['slug']).'</loc>
							<lastmod>'.date('Y-m-d', $r['created_time']).'</lastmod>
							<changefreq>always</changefreq>
							<priority>1</priority>
						</url>');
				}

				$old_arch_rec = $this->blog_model->order_by('tbl.created_time', 'DESC')
													->get_by('tbl.status', 'live');

				$min_year = date('Y', $old_arch_rec['created_time']);
				$min_month = date('m', $old_arch_rec['created_time']);

				for($y=$min_year; $y<=date('Y'); $y++) {
					$m = $min_month;
					while($m <= 12) {
						$items = $this->blog_model->where(
														array(
															'tbl.created_time >= '	=>	strtotime('01-'.$m."-".$y), 
															'tbl.created_time < '	=>	mktime(0, 0, 0, $m+1, 1, $y), 
														)
													)
													->order_by('tbl.created_time', 'DESC')
													->get_many_by('tbl.status', 'live');

						foreach($items as $i) {
							e('	<url>
									<loc>'.site_url('blog/'.$y."/".$m."/".$c['slug']).'</loc>
									<lastmod>'.date('Y-m-d', $i['created_time']).'</lastmod>
									<changefreq>always</changefreq>
									<priority>1</priority>
								</url>');
						}

						++$m;
					}
				}
			}

			e('</urlset>');
		}
	}
