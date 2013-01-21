<h2>Blog settings</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('blog'))?>">Blog</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('blog/categories'))?>">Blog categories</a>
</div>

<hr>

<?php e(form_open(admin_url("blog/settings"), array('class' => "form-horizontal", )))?>

	<fieldset>

		<div class="control-group">
			<label for="" class="control-label">Enable blog on site</label>
			<div class="controls">
				<?php
					$enabled = $this->blog_settings_model->get_setting('enable_blog'); 

					if($enabled == DB_TRUE) $enabled = TRUE;
					else $enabled = FALSE;

					e(form_checkbox('enable_blog', 1, set_checkbox('enable_blog', 1, $enabled), 'id="enable_blog"'))
				?>
			</div>
		</div>
		<!--
		<div class="control-group">
			<label for="input01" class="control-label">Url format: </label>
			<div class="controls">
			<?php
				$formats = 	array(
								'Y/m/slug' => 'year/month/blog_rec_slug', 
							);

				e(form_dropdown('url_format', $formats));
			?>
			</div>
		</div>
		-->
		<div class="control-group">
			<label for="recs_per_page" class="control-label">Record(s) per page: </label>
			<div class="controls">
				<?php e(form_input('records_per_page', set_value('records_per_page', $this->blog_settings_model->get_setting('records_per_page')), 'id="recs_per_page"'))?>
			</div>
		</div>

		<div class="control-group">
			<label for="allow_comments" class="control-label">Allow comments: </label>
			<div class="controls">
			<?php
				$allow_comments = array(DB_TRUE => 'Yes', DB_FALSE => "No", );

				e(form_dropdown('allow_comments', $allow_comments, set_value('allow_comments'), 'id="allow_comments"'))
			?>
			</div>
		</div>

		<div class="control-group">
			<label for="anon_comments" class="control-label">Allow anonymous comments: </label>
			<div class="controls">
			<?php
				$anonymous_postings = array(DB_FALSE => 'No', DB_TRUE => "Yes", );

				e(form_dropdown('allow_anonymous_comments', $anonymous_postings, set_value('allow_anonymous_comments'), 'id="anon_comments"'));
			?>
			</div>
		</div>

		<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Save" name="save">
		</div>

	</fieldset>

<?php e(form_close())?>
