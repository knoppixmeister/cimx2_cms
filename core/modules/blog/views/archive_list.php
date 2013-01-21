<?php
	foreach($items as $i) {
?>
<div class="post-block">

	<div class="storytitle">
		<h3><a rel="bookmark" href="<?php _site_url(blog_post_url($i['id']))?>">«<?php e($i['title'])?>»</a></h3>
	</div>
	<div style="clear: both;"></div>
	<div class="meta">
		Category: <a rel="category tag" title="Просмотреть все записи в рубрике «Finance1»" href="/category/blog"><?php e($i['category_title'])?></a> 
		<div class="postdate"><?php e(date('d-m-Y', $i['created_time']))?></div>
	</div>

	<div>
		<h3>Comments for blog entry <br>(<a title="Comments for blog entry «<?php e($i['title'])?>»" href="../govorite-malo-slushajte-bolshe#respond">всего 0</a>)</h3>
	</div>

</div>
<?php
	}
?>
