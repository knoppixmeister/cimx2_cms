<?php e(get_instance()->parser->parse_string('{tag:jqueryui:jqueryui_all}', array(), TRUE))?>	

<h2><?php e(ucfirst($action))?> page</h2>

<br/>

<?php e(form_open($action_url, 'id="page_edit_frm" class="form-horizontal"'))?>

	<div class="btn-group pull-right">
		<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Preview ...&nbsp;<span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?php
			foreach(config_item('supported_languages') as $k => $v) {
		?>
			<li><a target="_blank" onclick="preview_page('<?php e($k)?>')">in <?php e($v['name'])?></a></li>
		<?php
			}
		?>
	    </ul>
    </div>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#1" data-toggle="tab">General</a></li>
		<li><a href="#2" data-toggle="tab">Metadata</a></li>
		<li><a href="#3" data-toggle="tab">CSS</a></li>
		<li><a href="#4" data-toggle="tab">Javascript</a></li>
		<li><a href="#5" data-toggle="tab">Options</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="1">

				<fieldset>
        		<?php
					foreach(config_item('supported_languages') as $k => $v) {
				?>
					<div class="control-group">
						<label for="input01" class="control-label">Title <?php e(strtoupper($k))?>:</label>
						<div class="controls">
							<?php e(form_input('title_'.$k, set_value('title_'.$k, $item['title_'.$k]), 'id="title_'.$k.'" style="width: 70%;"'))?> 
							<?php e(($k == config_item('default_language') ? '<font color="blue">*</font>' : ''))?>
						</div>
					</div>
				<?php
					}
				?>
					<div class="control-group">
						<label for="input01" class="control-label">Slug: <font color="red">*</font></label>
						<div class="controls">
							<?php
								e(form_input('slug', set_value('slug', $item['slug']), 'id="slug" style="width: 70%;"'));

								if($action == "edit") {
							?>
							<div class="btn-group pull-right">
								<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Make slug ...&nbsp;<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">.. from Title EN</a></li>
								</ul>
							</div>
							<?php
								}
							?>
						</div>
					</div>
					<div class="control-group">
						<label for="prependedInput" class="control-label">Page URL: </label>
						<div class="controls">
							<div class="input-prepend">
								<nobr>
                				<span class="add-on">
                					<?php
                						$langs = "";
										foreach(config_item('supported_languages') as $l => $v) {
											$langs .= $l."/";
										}

										$langs = trim($langs, '/');
									?>	
                					<?php e(site_url(''))?><?php e(config_item('lang_switch_method') == "url" ?	'['.$langs.']/' : '')?>
                				</span><input style="width: 450px;" name="url" value="<?php e(set_value('url', $item['uri'])) ?>" disabled="disabled" type="text" size="16" id="">
                				</nobr>
              				</div>
						</div>
					</div>
				<div class="control-group">
					<label for="select01" class="control-label">Layout: <font color="red">*</font></label>
					<div class="controls">
						<?php e(form_dropdown('layout', $layouts, set_value('layout', $item['layout_id'])))?>
					</div>
				</div>
				<div class="control-group">
					<label for="select01" class="control-label">Status: <font color="red">*</font></label>
					<div class="controls">
						<?php e(form_dropdown('status', $page_statuses, set_value('status', $item['status'])))?>
					</div>
				</div>
				<div class="control-group">
					<label for="select01" class="control-label">Parent page: </label>
					<div class="controls">
						<?php e(form_dropdown('parent', $pages_options_tree, set_value('parent', $item['parent_id'])))?>
					</div>
				</div>
				<?php
					foreach(config_item('supported_languages') as $k => $v) {
				?>
				<div class="control-group">
					<label for="select01" class="control-label">Text <?php e(strtoupper($k))?>:</label>
					<div class="controls">
						<?php e(form_rich_textarea('text_'.$k, $item)) ?>
					</div>
				</div>
				<?php
					}
				?>
				<div class="control-group">
					<label for="is_def" class="control-label">Is default?</label>
					<div class="controls">
						<label class="checkbox">
							<?php
								if(!isset($item['is_default'])) $is_def = FALSE;
								else {
									$is_def = ($item['is_default'] == DB_FALSE ? FALSE : TRUE);
								} 

								e(form_checkbox('is_default', 1, set_value('is_default', $is_def), 'id="is_def"'))
							?>
							Set this checkbox if page must be seen as main page (index page)
						</label>
					</div>
				</div>

			</fieldset>

		</div>
		<div class="tab-pane" id="2">

			<fieldset>

				<?php
					foreach(config_item('supported_languages') as $k => $v) {
				?>
				<div class="control-group">
					<label for="meta_title_<?php e($k)?>" class="control-label">Title <?php e(strtoupper($k))?></label>
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
						<input type="text"
								id="meta_keywords_<?php e($k)?>"
								name="meta_keywords_<?php e($k)?>"
								value="<?php e(set_value('meta_keywords_'.$k, $item['meta_keywords_'.$k]))?>"
								class="input-xlarge span10"/>
		            </div>
          		</div>
				<div class="control-group">
					<label for="meta_description_<?php e($k)?>" class="control-label">Description <?php e(strtoupper($k))?></label>
					<div class="controls">
						<textarea rows="10"
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
		<div class="tab-pane" id="3">

			<table style="width: 100%;">
			<tr>
				<th style="width: 100px;">CSS</th>
				<td><textarea rows="20" cols="90" name="css" class="span8"><?php e(set_value('css', $item['css']))?></textarea></td>
			</tr>
			</table>

		</div>
		<div class="tab-pane" id="4">

			<table style="width: 100%;">
			<tr>
				<th style="width: 100px;">Javascript</th>
				<td><textarea rows="20" cols="90" name="javascript" class="span8"><?php e(set_value('javascript', $item['javascript']))?></textarea></td>
			</tr>
			</table>

		</div>
		<div class="tab-pane" id="5">

			<fieldset>

				<div class="control-group">
					<label for="comm_enabled" class="control-label">Comments enabled?</label>
					<div class="controls">
						<label class="checkbox">
						<?php
							$ce = ($item['comments_enabled'] == DB_TRUE ? TRUE : FALSE);

							e(form_checkbox('comments_enabled', 1, set_checkbox('comments_enabled', 1, $ce)));
						?>
						</label>
					</div>
				</div>

				<div class="control-group">
					<label for="input01" class="control-label">Visibility</label>
					<div class="controls">
						<?php e(form_dropdown('visibility', config_item('pages_visibilities'), set_value('visibility', $item['visibility']), 'id="visibility"'))?>

						<br/>
						<span id="password_pane" style="display: <?php e($item['visibility'] == 'password' ? 'inline' : 'none')?>;">
							Password:<br/>
							<?php e(form_input('password', set_value('password', $item['password'])))?>
						</span>

						<script type="text/javascript">
							function _check_status() {
								if($("#visibility").val() == "password") $("#password_pane").css('display', 'inline');
								else $("#password_pane").css('display', 'none');
							}
		
							$("#visibility").change(_check_status);
		
							_check_status();
						</script>

					</div>
				</div>

				<div class="control-group">
					<label for="input01" class="control-label">Start publish<br/>(date & time)</label>
					<div class="controls">
					<?php
						e(form_input('start_date', set_value('start_date', date('d-m-Y', nvl($item['publish_start_date'], time()))), 'id="start_date"')."&nbsp;");

						$hours = array();
						for($i=0; $i<=23; $i++) {
							$hours[$i] = str_pad($i, 2, '0', STR_PAD_LEFT);
						}

						$start_hour = is_numeric($item['publish_start_hour']) ? $item['publish_start_hour'] : date('H');
						e(form_dropdown('start_hour', $hours, set_value('start_hour', $start_hour), 'id="start_hour"').":");

						$minutes = array();
						for($i=0; $i<=59; $i++) {
							$minutes[$i] = str_pad($i, 2, '0', STR_PAD_LEFT);
						}

						$start_min = is_numeric($item['publish_start_min']) ? $item['publish_start_min'] : date('i');
						e(form_dropdown('start_min', $minutes, set_value('start_min', $start_min), 'id="start_min"'));
					?>
					</div>
				</div>

				<div class="control-group">
					<label for="input01" class="control-label">End publish<br/>(date & time)</label>
					<div class="controls">
					<?php
						if(empty($item['publish_end_date'])) $ed = "";
						else $ed = date('d-m-Y', $item['publish_end_date']);

						e(form_input('end_date', set_value('end_date', $ed), 'id="end_date"')."&nbsp;");

						$hours		=	array_merge(array('' => '', ), $hours);
						$minutes	=	array_merge(array('' => '', ), $minutes);

						e(form_dropdown('end_hour',	$hours,		set_value('end_hour', $item['publish_end_hour']),	'id="end_hour"'));
						e(form_dropdown('end_min',	$minutes,	set_value('end_min', $item['publish_end_min']),		'id="end_min"'));
					?>
					</div>
				</div>

        	</fieldset>

		</div>

	</div>

	<fieldset>

		<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Save" name="save">
			<input class="btn" type="submit" value="Save & Exit" name="save_exit">
			<span style="padding-left: 20px;">
				<a class="btn" href="<?php e(admin_url('pages'))?>">Cancel</a>
			</span>
			<?php
				if($action == "edit") {
			?>
			<a href="<?php e(admin_url('pages/delete/'.$item['id']))?>" class="btn btn-danger pull-right">Delete</a>
			<?php
				}
			?>
		</div>

	</fieldset>

<?php e(form_close())?>

<script type="text/javascript">
	var page_loaded = false;

	function preview_page(lang) {
		if(page_loaded) {
			(function($) {
				$('#page_edit_frm').attr({
					'target': '_blank', 
					'action': '<?php e(admin_url('pages/preview/'))?>'+lang 
				}).submit();
			})(jQuery);
		}
	}

	window.onload = function() {
		page_loaded = true;

		if(typeof jQuery == "undefined") alert('This page requires JQuery library to be installed');

		(function($) {
			$(window).unload(function() {
				return false;
			});

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

				if($action == "edit") {
			?>
			$('#make_slug_btn').click(function() {
				alert('');
			});
			<?php
				}
			?>
			$(".form-actions input").click(function() {
				$('#page_edit_frm').attr({
					'target': '_self', 
					'action': '<?php e($action_url)?>' 
				});
			});

			$("#start_date, #end_date").datepicker({
				showOn:				'both', 
				buttonImage:		'<?php e(base_url())?>/public/modules/jqueryui/images/calendar.gif', 
				buttonImageOnly: 	true, 
				dateFormat:			'dd-mm-yy', 
				showOtherMonths: 	true, 
				selectOtherMonths: 	true, 
				changeMonth: 		true, 
				changeYear: 		true 
			});
		})(jQuery);
	};
</script>

<style type="text/css">
	#url {
		float: left;
	}

	#start_hour, 
	#start_min, 
	#end_hour, 
	#end_min {
		width: 50px;
	}
</style>
