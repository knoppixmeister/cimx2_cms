<?php require dirname(__FILE__).'/_top.php'; ?>

	<h3>Insert file from another website</h3>

	<div class="tabbable">
		<ul class="nav nav-pills">
			<li class="active"><a href="#url_1" data-toggle="tab">Image</a></li>
			<li><a href="#url_2" data-toggle="tab">Audio, video files</a></li>
		</ul>

		<table>
		<tr>
			<th style="width: 100px;">URL&nbsp;<font color="red">*</font></th>
			<td><?php e(form_input('file_url', set_value('file_url'), 'id="file_url" class="span12"'))?></td>
		</tr>
		<tr>
			<th style="width: 100px;">Title</th>
			<td><?php e(form_input('file_title', set_value('file_title'), 'id="file_url_title" class="span12"'))?></td>
		</tr>
		</table>

		<div class="tab-content">
			<div class="tab-pane active" id="url_1">

				<table>
				<tr>
					<th style="width: 100px;">Alternate text</th>
					<td><?php e(form_input('image_url', set_value('image_url'), 'class="span12"'))?></td>
				</tr>
				<tr>
					<th>Align</th>
					<td>
						<input type="radio" name="align" value="none" checked="checked"/> None&nbsp;
						<input type="radio" name="align" value="left"/> Left&nbsp;
						<input type="radio" name="align" value="center"/> Center&nbsp;
						<input type="radio" name="align" value="right"/> Right&nbsp;
					</td>
				</tr>
				<!--
				<tr>
					<th>Size</th>
					<td>
	
						<table>
						<tr>
							<th style="text-align: left;"><?php e(form_radio('size', 'thumb', TRUE))?> Thumbnail (150 x 150)</th>
						</tr>
						<tr>
							<th style="text-align: left;"><?php e(form_radio('size', 'full_size', FALSE))?> Full size (1000 x 500)</th>
						</tr>
						<tr>
							<th style="text-align: left;">
								<?php e(form_radio('size', 'custom', FALSE))?> Custom <?php e(form_input('cust_width', '', 'class="span1"'))?> x <?php e(form_input('cust_height', '', 'class="span1"'))?>
							</th>
						</tr>
						</table>
	
					</td>
				</tr>
				-->
				</table>

			</div>
			<div class="tab-pane" id="url_2"></div>
		</div>

	</div>
		
	<div style="margin-top: 10px;">
		<a class="btn" href="#" onclick="insert_by_url()">Insert</a>
	</div>

<?php require dirname(__FILE__).'/_bottom.php' ?>