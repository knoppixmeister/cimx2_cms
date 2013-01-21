<h1 style="padding: 0; margin: 0;">{tag:lang:line name="news"}</h1>

<table style="width: 100%;">
<?php
	if(count($items) > 0) {
		foreach($items as $i) {
?>
<tr>
	<td>
		<h2><a href="<?php e(site_url('blog/'.date('Y/m/', $i['created_time']).$i['slug']))?>"><?php e($i['title_'.CURRENT_LANGUAGE])?></a></h2>

		<p>{tag:lang:line name="blog_record_posted"}: <?php e(date('d-m-Y', $i['created_time']))?></p>

		<?php e($i['preview_'.CURRENT_LANGUAGE])?>
	</td>
</tr>
<tr>
	<td><hr size="1"></td>
</tr>
<?php
		}
	}
	else {
?>
<tr>
	<td>{tag:lang:line name="blog_no_posts"}</td>
</tr>
<?php
	}
?>
</table>
<?php
	if(count($items) > 0) {
?>
{tag:pager:show base_url="<?php e(base_url_lang())?>" page="<?php e($page)?>" items_count="<?php e($items_count)?>" per_page="<?php e($per_page)?>"}
<?php
	}
?>
