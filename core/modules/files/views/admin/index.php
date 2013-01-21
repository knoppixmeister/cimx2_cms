<h2>Files</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('files/upload'))?>">Upload file(s)</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('files/folders/create'))?>" id="create_folder_btn">Make subfolder</a> 
</div>

<?php //require dirname(__FILE__).'/partials/popups/edit_folder.php' ?>
<!--
Folder: <?php e(form_dropdown('folder', $parent_folders, array(), 'id="folder"'))?>
-->

<?php require dirname(__FILE__).'/folders/content.php' ?>


<!--
<script type="text/javascript" src="<?php e(base_url())?>public/modules/files/js/files.js"></script>
-->
