<h2>Simple file uploader</h2> 

<?php e(form_open_multipart(admin_url('files/simple_upload'))) ?>

	<input type="file" name="file"><br/>
	<input class="btn btn-primary" type="submit" value="Submit"><br/>

<?php e(form_close()) ?>

<p>
	You are using the browser’s built-in file uploader.<br/>
	The CIMX2 uploader includes multiple file selection and drag and drop capability.<br/>
	Switch to the <a href="<?php e(admin_url('files/upload'))?>">multi-file uploader</a>.<br/>
	Maximum upload file size: <?php e(ini_get('post_max_size'))?>. After a file has been uploaded, you can edit it's information.
</p>
