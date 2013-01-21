<div class="accordion-group uploaded-file-preview">

	<table style="width: 100%;">
	<tr>
		<td style="width: 35px;">
		<?php
			if($data['is_image']) {
		?>
			<img src="<?php e(base_url(TRUE))?>public/uploads/<?php e(date('Y/m', $data['created_time'])."/".$data['file_name'])?>" width="30"/>
		<?php
			}
		?>
		</td>
		<td><?php e($data['file_name'])?></td>
	</tr>
	</table>

</div>
