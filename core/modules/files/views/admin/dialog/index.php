<?php require dirname(__FILE__).'/_top.php' ?>

	Folder: <?php e(form_dropdown('dialog_folder', $parent_folders, $folder, 'id="dialog_folder"'))?>

	<div id="accordion">
	<?php
		foreach($items as $item) {
	?>
		<div class="accordion-group">
			<div class="accordion-heading">
				<table style="width: 100%;">
				<tr>
					<td style="width: 30px;">
					<?php
						if(!empty($item['image_width']) && !empty($item['image_height'])) {
					?>
						<a href="#collapse<?php e($item['id'])?>" data-parent="#accordion" data-toggle="collapse">
							<img title="Image preview" data-content='<img src="<?php e(site_url('files/thumb/'.$item['id']."/150"))?>">' class="img_prev" alt="" src="<?php e(site_url('files/thumb/'.$item['id']."/30/30"))?>">
						</a>
					<?php
						}
					?>
					</td>
					<td>
						<a href="#collapse<?php e($item['id'])?>" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
							<?php e($item['title'])?>
                		</a>
					</td>
				</tr>
				</table>
			</div>
			<div class="accordion-body collapse" id="collapse<?php e($item['id'])?>">
			<div class="accordion-inner">

				<table>
				<tr>
					<td style="width: 150px; text-align: center;">
					<?php
						if(is_numeric($item['image_width']) && is_numeric($item['image_height'])) {
							if($item['image_width'] > 40) {
					?>
						<a target="_blank" href="<?php e(base_url(TRUE))?>public/uploads/<?php e(date('Y/m', $item['created_time']))?>/<?php e($item['file_name'])?>">
							<img style="border: 1px solid gray;" src="<?php e(site_url('files/thumb/'.$item['id']."/150"))?>"/>
						</a>
					<?php
							}
							else {
					?>
						<a target="_blank" href="<?php e(base_url(TRUE))?>public/uploads/<?php e(date('Y/m', $item['created_time']))?>/<?php e($item['file_name'])?>">
							<img style="width: 150px;" alt="" src="<?php e(base_url(TRUE))?>public/uploads/<?php e(date('Y/m', $item['created_time'])."/".$item['file_name'])?>"/>
						</a>
					<?php
							}
						}
					?>
					</td>
					<td>

						<table>
						<tr>
							<th>File name</th>
							<td><?php e($item['file_name'])?></td>
						</tr>
						<tr>
							<th>File type</th>
							<td><?php e($item['file_mime_type'])?></td>
						</tr>
						<tr>
							<th>File size</th>
							<td><?php e($item['file_size']." Kb")?></td>
						</tr>
						<tr>
							<th>Upload date</th>
							<td><?php e(date('d.m.Y', $item['created_time']))?></td>
						</tr>
						<?php
							if(!empty($item['image_width']) && !empty($item['image_height'])) {
						?>
						<tr>
							<th>Dimensions</th>
							<td><?php e($item['image_width']."&nbsp;x&nbsp;".$item['image_height'])?></td>
						</tr>
						<?php
							}
						?>
						</table>

					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top: 10px;">&nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td>

						<table>
						<tr>
							<th style="width: 100px;">Title&nbsp;<font color="red">*</font></th>
							<td><?php e(form_input('file_title_'.$item['id'], $item['title'], 'id="file_title_'.$item['id'].'" class="span5 file_title"'))?></td>
						</tr>
						<?php
							if(!empty($item['image_width']) && !empty($item['image_height'])) {
						?>
	    				<tr>
							<th style="width: 100px;">Alternate text</th>
							<td><?php e(form_input('alt_text_'.$item['id'], set_value('alt_text'), 'class="span5" id="alt_text_'.$item['id'].'"'))?></td>
						</tr>
						<?php
							}
						?>
						<tr>
							<th>File URL</th>
							<td>
								<?php e(form_input('file_url', base_url(TRUE)."public/uploads/".date('Y/m', $item['created_time'])."/".$item['file_name'], 'class="span6" id="file_url" onclick="this.select()" readonly'))?> 
								<a href="<?php e(base_url(TRUE))?>public/uploads/<?php e(date('Y/m', $item['created_time'])."/".$item['file_name'])?>" target="_blank">Link</a>
							</td>
						</tr>
						<?php
							if(!empty($item['image_width']) && !empty($item['image_height'])) {
						?>
						<tr>
							<th>Align</th>
							<td>
								<input type="radio" id="align_<?php e($item['id'])?>" name="align_<?php e($item['id'])?>" value="none" checked="checked"/> None&nbsp;
								<input type="radio" id="align_<?php e($item['id'])?>" name="align_<?php e($item['id'])?>" value="left"/> Left&nbsp;
								<input type="radio" id="align_<?php e($item['id'])?>" name="align_<?php e($item['id'])?>" value="center"/> Center&nbsp;
								<input type="radio" id="align_<?php e($item['id'])?>" name="align_<?php e($item['id'])?>" value="right"/> Right&nbsp;
							</td>
						</tr>
						<tr>
							<th>Size</th>
							<td>

								<table>
								<tr>
									<th style="text-align: left;">
										<?php e(form_radio('size_'.$item['id'], 'thumb', TRUE, 'id="size_'.$item['id'].'"'))?> Thumbnail (150 x 150)
									</th>
								</tr>
								<tr>
									<th style="text-align: left;">
										<?php e(form_radio('size_'.$item['id'], 'full_size', FALSE, 'id="size_'.$item['id'].'"'))?> Full size (<?php e($item['image_width'])?>&nbsp;x&nbsp;<?php e($item['image_height'])?>)
									</th>
								</tr>
								<tr>
									<th style="text-align: left;">
										<?php e(form_radio('size_'.$item['id'], 'custom', FALSE, 'id="size_'.$item['id'].'"'))?> 
										Custom <?php e(form_input('cust_width_'.$item['id'], $item['image_width'], 'id="cust_width_'.$item['id'].'" class="span1"'))?> x <?php e(form_input('cust_height_'.$item['id'], $item['image_height'], 'id="cust_height_'.$item['id'].'" class="span1"'))?>
									</th>
								</tr>
								</table>

							</td>
						</tr>
						<tr>
							<th>Wrap by full size image</th>
							<td><?php e(form_checkbox('wrap_by_large_img_'.$item['id'], 1, TRUE, 'id="wrap_by_large_img_'.$item['id'].'"'))?></td>
						</tr>
						<?php
							}
						?>
						</table>

					</td>
				</tr>
				</table>
			<?php
				if(!empty($item['image_width']) && !empty($item['image_height'])) {
			?>
				<div class="btn-group dropup" style="margin-top: 5px;">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Insert&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu" style="text-align: left;">
						<li><a href="#" onclick="insert_resizer_img(<?php e($item['id'])?>, '<?php e(resizer_image_path($item['id']))?>', '<?php e(file_path($item['id']))?>')">By image resizer</a></li>
						<li><a href="#" onclick="insert_orig_img('<?php e(file_path($item['id']))?>')">As resized image</a></li>

						<!-- 
						<li><a href="#" onclick="insert_resizer_img('<?php e(resizer_image_path($f['id'], 100))?>', '<?php e(file_path($f['id']))?>')">By image resizer</a></li>
						<li><a href="#">As prepared resized image</a></li>
						<li><a href="#"">As resized image</a></li>
						<li><a href="#" onclick="insert_orig_size('<?php e(file_path($f['id']))?>')">By original size</a></li>
						-->

					</ul>
				</div>
			<?php
				}
				else {
					$file_url = base_url()."public/uploads/".date('Y/m', $item['created_time'])."/".$item['file_name'];

					$file_url_down = site_url('files/download/'.$item['id']);
			?>
				<div class="btn-group dropup" style="margin-top: 5px;">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Insert&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu" style="text-align: left;">
						<li><a href="#" onclick="insert_file_url('<?php e($file_url_down)?>', '<?php e($item['id'])?>')">As downloader link</a></li>
						<li><a href="#" onclick="insert_file_url('<?php e($file_url)?>', <?php e($item['id'])?>)">As file url</a></li>
					</ul>
				</div>
			<?php
				}
			?>
	              	</div>
            	</div>
            </div>
            <?php
				}
            ?>
		</div>

		{tag:pager:show base_url="<?php e(admin_url('files/dialog'))?>" params="<?php e($params)?>" page="<?php e($page)?>" items_count="<?php e($items_count)?>" per_page="5" type="ul"}

<?php require dirname(__FILE__).'/_bottom.php' ?>
