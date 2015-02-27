<h2 style="margin-bottom: 10px;"><?php e(ucfirst($action))?> blog record</h2>

<?php e(form_open($action_url, 'id="blog_rec_edit_frm" class="form-horizontal"'))?>

	<div class="btn-group pull-right">
		<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Preview ...&nbsp;<span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?php
			foreach(config_item('supported_languages') as $k => $v) {
		?>
			<li><a target="_blank" onclick="preview_blog_rec('<?php e($k)?>')">in <?php e($v['name'])?></a></li>
		<?php
			}
		?>
	    </ul>
    </div>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab1" data-toggle="tab">Generals</a></li>
		<li><a href="#tab2" data-toggle="tab">SEO data</a></li>
		<li><a href="#tab3" data-toggle="tab">Options</a></li>
    </ul>
    <div class="tab-content">
	    <div class="tab-pane active" id="tab1">

	    	<fieldset>

				<?php
					foreach(config_item('supported_languages') as $l => $v) {
				?>
				<div class="control-group">
					<label for="title_<?php e($l)?>" class="control-label">Title <?php e(strtoupper($l))?></label>
					<div class="controls">
						<input type="text" id="title_<?php e($l)?>" name="title_<?php e($l)?>" style="width: 80%;" value="<?php e(set_value('title_'.$l, $item['title_'.$l]))?>">
						<?php e(($l == config_item('default_language') ? '<font color="blue">*</font>' : ""))?>
					</div>
				</div>
				<?php
					}
				?>

				<div class="control-group">
					<label for="slug" class="control-label">Slug&nbsp;<font color="red">*</font></label>
					<div class="controls">
						<?php e(form_input('slug', set_value('slug', $item['slug']), 'id="slug" style="width: 80%;"'))?>
					</div>
				</div>

				<div class="control-group">
					<label for="prependedInput" class="control-label">Blog Url:&nbsp;</label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on">
							<?php
								$langs = "";
								foreach(config_item('supported_languages') as $l => $v) {
									$langs .= $l."/";
								}

								$langs = trim($langs, '/');
							?>
							<?php e(site_url(''))?><?php e(config_item('lang_switch_method') == "url" ?	'['.$langs.']/' : '')?>blog/<?php e(date('Y/m'))?>/</span><input name="url" value="<?php e(set_value('url', $item['slug'])) ?>" disabled="disabled" type="text" size="16" id="">
						</div>
					</div>
				</div>

				<div class="control-group">
					<label for="status" class="control-label">Status&nbsp;<font color="red">*</font></label>
					<div class="controls">
						<?php e(form_dropdown('status', $statuses, set_value('status', $item['status']), 'id="status"'))?>
					</div>
				</div>

				<div class="control-group">
					<label for="category" class="control-label">Category&nbsp;</label>
					<div class="controls">
						<?php e(form_dropdown('category', $categories, set_value('category', $item['category_id']), 'id="category"'))?>
					</div>
				</div>

				<?php
					foreach(config_item('supported_languages') as $l => $v) {
				?>
				<div class="control-group">
					<label for="preview_<?php e($l)?>" class="control-label">Preview&nbsp;<?php e(strtoupper($l))?></label>
					<div class="controls"><?php e(form_rich_textarea('preview_'.$l, $item))?></div>
				</div>
				<?php
					}

					foreach(config_item('supported_languages') as $l => $v) {
				?>
				<div class="control-group">
					<label for="text_<?php e($l)?>" class="control-label">Text <?php e(strtoupper($l))?></label>
					<div class="controls"><?php e(form_rich_textarea('text_'.$l, $item))?></div>
				</div>
				<?php
					}
				?>

			</fieldset>

	    </div>
	    <div class="tab-pane" id="tab2">

	    	<fieldset>
				<?php
					foreach(config_item('supported_languages') as $k => $v) {
				?>
				<div class="control-group">
					<label	for="meta_title_<?php e($k)?>"
							class="control-label">Title <?php e(strtoupper($k))?></label>
					<div class="controls">
						<input 	type="text"
								id="meta_title_<?php e($k)?>"
								name="meta_title_<?php e($k)?>"
								value="<?php e(set_value('meta_title_'.$k, $item['meta_title_'.$k]))?>" class="input-xlarge span10"/>
		            </div>
          		</div>
				<div class="control-group">
					<label for="meta_keywords_<?php e($k)?>" class="control-label">Keywords <?php e(strtoupper($k))?></label>
					<div class="controls">
						<input	type="text"
								id="meta_keywords_<?php e($k)?>"
								name="meta_keywords_<?php e($k)?>"
								value="<?php e(set_value('meta_keywords_'.$k, $item['meta_keywords_'.$k]))?>"
								class="input-xlarge span10"/>
		            </div>
          		</div>
				<div class="control-group">
					<label for="meta_description_<?php e($k)?>" class="control-label">Description <?php e(strtoupper($k))?></label>
					<div class="controls">
						<textarea	rows="10"
									id="meta_description_<?php e($k)?>"
									name="meta_description_<?php e($k)?>" 
									class="input-xlarge span10"><?php e(set_value('meta_description_'.$k, $item['meta_description_'.$k]))?></textarea>
					</div>
				</div>
				<?php
					}
				?>
        	</fieldset>
	    	
	    </div>
	    <div class="tab-pane" id="tab3">

	    	<fieldset>

				<div class="control-group">
					<label for="comments_enabled" class="control-label">Comments enabled?</label>
					<div class="controls">
						<label class="checkbox">
							<?php
								if(!isset($item['comments_enabled'])) $ce = TRUE;
								else $ce = ($item['comments_enabled'] == DB_TRUE ? TRUE : FALSE);

								e(form_checkbox('comments_enabled', 1, set_checkbox('comments_enabled', 1, $ce)));
							?>
						</label>
					</div>
				</div>

			</fieldset>

	    </div>

    </div>

    <fieldset>

	    <div class="form-actions">
			<input class="btn btn-primary" type="submit" name="save" value="Save"> 
			<input class="btn" type="submit" value="Save & Exit" name="save_exit"/>
			<span style="padding-left: 20px;">
				<a class="btn" href="<?php e(admin_url('blog'))?>">Cancel</a>
			</span>
			<?php
				if($action == 'edit') {
			?>
			<a href="<?php e(admin_url('blog/delete/'.$item['id']))?>" class="btn btn-danger pull-right">Delete</a>
			<?php
				}
			?>
		</div>

	</fieldset>

<?php e(form_close())?>

<script type="text/javascript">
	var page_loaded = false;

	function preview_blog_rec(lang) {
		if(page_loaded) {
			(function($) {
				$('#blog_rec_edit_frm').attr({
					'target': '_blank', 
					'action': '<?php e(admin_url('blog/preview/'))?>'+lang 
				}).submit();
			})(jQuery);
		}
	}

	window.onload = function() {
		page_loaded = true;

		if(typeof jQuery == "undefined") alert('This page requires JQuery library to be installed');

		(function($) {
			$('#slug').keyup(function() {
				$('input[name="url"]').val(this.value);
			});

			<?php
				if($action != "edit") {
			?>
			$("#title_<?php e(config_item('default_language'))?>").keyup(function() {
				$.get("<?php e(site_url('ajax/url_title?title='))?>"+this.value, function(data) {
					$('input[id="slug"]').val(data);
					$('input[name="url"]').val(data);
				});
			});
			<?php
				}
			?>

			$(".form-actions input").click(function() {
				$('#blog_rec_edit_frm').attr({
					'target': '_self', 
					'action': '<?php e($action_url)?>' 
				});
			});
		})(jQuery);
	};
</script>
