<h1><?php e(ucfirst($action))?> letter template</h1>
<hr>

<?php e(form_open($action_url, array('class' => "form-horizontal", )))?>

	<fieldset>

		<div class="control-group">
			<label for="name" class="control-label">Name <font color="red">*</font></label>
			<div class="controls">
				<?php e(form_input('name', set_value('name', $item['name']), 'id="name" class="span8"'))?>
			</div>
		</div>

		<div class="control-group">
			<label for="slug" class="control-label">Slug <font color="red">*</font></label>
			<div class="controls">
				<?php e(form_input('slug', set_value('slug', $item['slug']), 'id="slug" class="span8"'))?>

				<script type="text/javascript">
					$("#name").keyup(function() {
						$.get('<?php e(base_url())?>ajax/url_title?title='+$("#name").val(), function(data) {
							$("#slug").val(data);
						});
					});
				</script>
			</div>
		</div>

		<div class="control-group">
			<label for="language" class="control-label">Language <font color="red">*</font></label>
			<div class="controls">
				<?php e(form_dropdown('language', $languages, set_value('language', $item['language']), 'id="language"'))?>
			</div>
		</div>

		<div class="control-group">
			<label for="description" class="control-label">Description</label>
			<div class="controls">
				<?php e(form_input('description', set_value('description', $item['description']), 'id="description" class="span8"'))?>
			</div>
		</div>

		<div class="control-group">
			<label for="subject" class="control-label">Subject</label>
			<div class="controls">
				<?php e(form_input('subject', set_value('subject', $item['subject']), 'id="subject" class="span8"'))?>
			</div>
		</div>

		<div class="control-group">
			<label for="body" class="control-label">Body</label>
			<div class="controls">
				<?php e(rich_textarea('body', $item))?>
			</div>
		</div>

		<div class="form-actions">
			<input type="submit" class="btn btn-primary" value="Save" name="save"/>
			<input type="submit" class="btn" value="Save & Exit" name="save_exit"/>
			<span style="padding-left: 20px;">
				<a href="<?php _admin_url('letter_templates')?>" class="btn">Cancel</a>
			</span>
			<?php
				if($action == "edit") {
			?>
			<a href="#" class="btn btn-danger pull-right">Delete</a>
			<?php
				}
			?>
		</div>

	</fieldset>

<?php e(form_close())?>
