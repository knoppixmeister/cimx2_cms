<h2><a href="<?php e(site_url('blog'))?>">{tag:lang:line name="blog_blog"}</a> | <?php e($item['title_'.CURRENT_LANGUAGE])?></h2>

<p>Posted: <?php e(date('d-m-Y', $item['created_time']))?></p>

<?php e($item['text_'.CURRENT_LANGUAGE])?>
<br/>

<?php
	if($item['comments_enabled'] == DB_TRUE) {
?>

	{tag:comments:form module="blog" module_id="<?php e($item['id'])?>"}

<?php
	}
?>
