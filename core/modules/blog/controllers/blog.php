<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog extends Frontend_List_Controller {
		function __construct() {
			parent::__construct();

			if(blog_get_setting('enable_blog') == 0) show_404();
		}

		function _list($page=1) {
			$this->data['page'] 	= max(1, (int)$page);
			$this->data['per_page'] = 10;

			$this->data['items'] =	//$this->mx2_cache->model('blog_model', 'get_all', array('status' => 'live', ), 3000);
									$this->blog_model->order_by('created_time', 'DESC')
													->limit(
														$this->data['per_page'], 
														$this->data['per_page']*$this->data['page']-$this->data['per_page'] 
													)
													->get_many_by('tbl.status', 'live');

			if($page > 1 && count($this->data['items']) == 0) show_404();

			$this->data['items_count'] = $this->blog_model->count_by('status', 'live');

			$this->data['blog_categories'] = $this->blog_categories_model->order_by('id', 'DESC')
																		 ->get_all();

			$this->data['arch_months'] = $this->blog_model->get_archive_months();

			$this->data['title'] = lang('blog_blog');

			$this->template->build('blog/index', $this->data);
		}

		function view_by_date($year=NULL, $month=NULL, $slug=NULL) {
			if(!is_numeric($year) || !is_numeric($month)) show_404();

			if(empty($slug)) {
				$this->data['items'] = $this->blog_model->where(
															array(
																'tbl.created_time >= '	=>	strtotime('01-'.$month."-".$year), 
																'tbl.created_time < '	=>	mktime(0, 0, 0, $month+1, 1, $year), 
															)
														)
														->order_by('tbl.created_time', 'DESC')
														->get_many_by('tbl.status', 'live');

				$this->template->build('blog/archive_list', $this->data);
			}
			else {
				$this->data['item'] = $this->blog_model->get_by(
															array(
																'tbl.slug'		=>	strtolower($slug), 
																'tbl.status'	=>	'live', 
															)
														);

				if(empty($this->data['item'])) show_404();

				$this->data['title'] = lang('blog_blog')." | ".$this->data['item']['title_'.CURRENT_LANGUAGE];

				$this->data['meta_description'] = htmlspecialchars($this->data['item']['title_'.CURRENT_LANGUAGE]);

				$this->template->build('blog/view', $this->data);
			}
		}

		function category($slug=NULL, $action="page", $param=1) {
			$c = $this->blog_categories_model->get_by('slug', strtolower($slug));

			if(empty($c) || $action != "page" || !is_numeric($param)) show_404();

			$this->data['page'] 	= max(1, (int)$param);
			$this->data['per_page'] = 10;

			$this->data['items'] = $this->blog_model->order_by('id', 'DESC')
													->limit(
														$this->data['per_page'], 
														$this->data['per_page']*$this->data['page']-$this->data['per_page'] 
													)
													->get_many_by(
														array(
															'tbl.category_id'	=>	$c['id'], 
															'tbl.status'		=>	'live', 
														)
													);

			$this->data['items_count'] = $this->blog_model->count_by(
																array(
																	'category_id'	=>	$c['id'], 
																	'status'		=>	'live', 
																)
															);

			$this->template->build('blog/category/index', $this->data);
		}

		function xmlrpc() {
			if(empty($_POST)) {
				header("Content-Type: text/plain");

				die('XML-RPC server accepts POST requests only.');
			}
		}
	}
