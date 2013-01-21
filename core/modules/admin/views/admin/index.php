<style type="text/css">
	.summary ul li {
		display: inline;
	}
	
	.summary {
		overflow: hidden;
	}
	
	.summary ul li a {
		color: black;
		font-weight: bold;
		font-size: 20px;
	}
</style>

<h1>Dashboard</h1>
<div class="hero-unit">
	<h1>Welcome!</h1>
</div>
<?php
	$CI = &get_instance();

	$CI->load->models(
					array(
						'pages/pages_model', 
						'blog/blog_model', 
						'users/users_model', 
						'comments/comments_model', 
						'contacts/contacts_model', 
					)
				);
?>

<div class="well summary">
	<ul>
		<li class="span4"><a href="<?php e(admin_url('pages'))?>"><span class="count"><?php e($CI->pages_model->where_in('status', array('live', 'draft'))->count_by(array()))?></span> Page(s)</a></li>
		<li class="span4"><a href="<?php e(admin_url('blog'))?>"><span class="count"><?php e($CI->blog_model->count_all())?></span> Blog record(s)</a></li>
		<li class="span4"><a href="<?php e(admin_url('users'))?>"><span class="count"><?php e($CI->users_model->count_all())?></span> User(s)</a></li>
	</ul>
	<br/>
	<br/>
	<ul>
		<li class="span4"><a href="<?php e(admin_url('comments'))?>"><span class="count"><?php e($CI->comments_model->count_all())?></span> Comment(s)</a></li>
		<li class="span4"><a href="<?php e(admin_url('contacts'))?>"><span class="count"><?php e($CI->contacts_model->count_all())?></span> Contact message(s)</a></li>
	</ul>
</div>
<!--
<h2>Recent Activity</h2>
<table class="table table-bordered table-striped">
<thead>
<tr>
	<th>Project</th>
	<th>Client</th>
	<th>Type</th>
	<th>Date</th>
	<th>View</th>
</tr>
</thead>
<tbody>
		<tr>
			<td>
				Nike.com Redesign
			</td>
			<td>
				Monsters Inc
			</td>
			<td>
				New Task
			</td>
			<td>
				4 days ago
			</td>
			<td>
				<a class="view-link" href="#">View</a>
			</td>
		</tr>
		<tr>
			<td>
				Nike.com Redesign
			</td>
			<td>
				Monsters Inc
			</td>
			<td>
				New Message
			</td>
			<td>
				5 days ago
			</td>
			<td>
				<a class="view-link" href="#">View</a>
			</td>
		</tr>
		<tr>
			<td>
				Nike.com Redesign
			</td>
			<td>
				Monsters Inc
			</td>
			<td>
				New Project
			</td>
			<td>
				5 days ago
			</td>
			<td>
				<a class="view-link" href="#">View</a>
			</td>
		</tr>
		<tr>
			<td>
				Twitter Server Consulting
			</td>
			<td>
				Bad Robot
			</td>
			<td>
				New Task
			</td>
			<td>
				6 days ago
			</td>
			<td>
				<a class="view-link" href="#">View</a>
			</td>
		</tr>
		<tr>
			<td>
				Childrens Book Illustration
			</td>
			<td>
				Evil Genius
			</td>
			<td>
				New Message
			</td>
			<td>
				9 days ago
			</td>
			<td>
				<a class="view-link" href="#">View</a>
			</td>
		</tr>
		<tr>
			<td>
				Twitter Server Consulting
			</td>
			<td>
				Bad Robot
			</td>
			<td>
				New Task
			</td>
			<td>
				16 days ago
			</td>
			<td>
				<a class="view-link" href="#">View</a>
			</td>
		</tr>
		<tr>
			<td>
				Twitter Server Consulting
			</td>
			<td>
				Bad Robot
			</td>
			<td>
				New Project
			</td>
			<td>
				16 days ago
			</td>
			<td>
				<a class="view-link" href="#">View</a>
			</td>
		</tr>
		<tr>
			<td>
				Twitter Server Proposal
			</td>
			<td>
				Bad Robot
			</td>
			<td>
				Completed Project
			</td>
			<td>
				20 days ago
			</td>
			<td>
				<a class="view-link" href="#">View</a>
			</td>
		</tr>
	</tbody>
</table>
-->
