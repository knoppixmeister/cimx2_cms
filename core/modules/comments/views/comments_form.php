<hr size="1">

<h2>Comments</h2>

<table border="0" id="comments_list_tbl">
<?php
	foreach($items as $i) {
?>
<tr>
	<td></td>
	<td>
		Posted by: admin on June 12, 2012 at 10:10<br/>
		<p>
			<?php e(nl2br($i['text']))?>
		</p>
	</td>
</tr>
<?php
	}
?>
</table>

<h2>Leave reply</h2>

<?php e(form_open(get_url_without_lang(), 'id="comments_form"'))?>

	<table id="post_comment_tbl">
	<tr>
		<th>{tag:lang:line name="comments_email"}</th>
		<td><input type="email" id="email" name="email" value="<?php e(set_value('email'))?>"></td>
	</tr>
	<tr>
		<th>{tag:lang:line name="comments_comment"}</th>
		<td><textarea rows="5" id="comment" name="comment" cols="40"><?php e(set_value('comment'))?></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="{tag:lang:line name='comments_post_comment'}"></td>
	</tr>
	</table>

<?php e(form_close())?>
