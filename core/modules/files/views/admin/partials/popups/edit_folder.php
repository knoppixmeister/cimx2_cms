<div class="modal" id="edit_folder_popup" style="display: none;">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Create folder</h3>
	</div>
	<div class="modal-body">
		<div id="alert_div" class="alert alert-success" style="display: none;">
			<a href="#" data-dismiss="alert" class="close">×</a>
			<p id="alert_msg"></p>
		</div>
		<p id="result_p"></p>
		<?php require dirname(__FILE__).'/../edit_folder.php'?>
	</div>
	<div class="modal-footer">
		<a href="#" id="ajax_folder_edit_btn" class="btn btn-primary">Save changes</a> 
		<a href="#" id="ajax_folder_edit_cancel" class="btn">Cancel</a>
	</div>
</div>
