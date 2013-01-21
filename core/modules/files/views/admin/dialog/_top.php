<ul class="nav nav-tabs">
	<li class="<?php e($controller == "index" ? 'active' : "")?>"><a href="<?php e(admin_url('files/dialog/'))?>">Select</a></li>
	<!--
	<li class="<?php e($controller == "url" ? 'active' : "")?>"><a href="<?php e(admin_url('files/dialog/insert_by_url'))?>">By URL</a></li>
	-->
	<li class="<?php e($controller == "upload" ? 'active' : "")?>"><a href="<?php e(admin_url('files/dialog/upload_files'))?>">Upload</a></li>
</ul>
<div class="tab-content">