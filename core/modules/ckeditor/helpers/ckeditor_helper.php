<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function ckeditor($name, $item, $config=array(), $source='external') {
		//['Images', 'Embed_video'], 

		$cfg = "toolbar: [	['Maximize'], 
							['Embed_video'], 
							['Cut','Copy','Paste','PasteFromWord'], 
							['Undo','Redo','-','Find','Replace'], 
							['Link','Unlink'], 
							['Table','HorizontalRule','SpecialChar'], 
							['Bold','Italic','StrikeThrough'], 
							['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'], 
							['Format', 'FontSize', 'Subscript','Superscript', 'NumberedList','BulletedList','Outdent','Indent','Blockquote'], 
							['ShowBlocks', 'Source'] ], extraPlugins: 'embed_video', ";
		//, extraPlugins: 'images,embed_video', 

		$cfg .= "enterMode: CKEDITOR.ENTER_BR, defaultLanguage: 'en', language: 'en', tabSpaces: 4, ";
		foreach($config as $c) {
			$cfg .= $c.", ";
		}

		$cfg = trim($cfg, ", ");

		if(!defined('CKEDITOR_SCRIPT_DEF')) {
			if($source == 'external') $_js_src = 'http://ckeditor.com/apps/ckeditor/3.6/ckeditor.js';
			else $_js_src = base_url('')."public/modules/ckeditor/ckeditor/ckeditor.js";

			$res = '<script type="text/javascript" src="'.$_js_src.'"></script>
					<script type="text/javascript">
						//CKEDITOR.plugins.addExternal("images", "'.base_url(TRUE).'public/themes/admin/js/ckeditor/plugins/images/");
						CKEDITOR.plugins.addExternal("embed_video", "'.base_url(TRUE).'public/modules/ckeditor/plugins/embed_video/");
					</script>';

			define('CKEDITOR_SCRIPT_DEF', TRUE);
		}

		$res .= '<textarea class="ckeditor" rows="10" cols="50" name="'.$name.'">'.set_value($name, $item[$name]).'</textarea>
				<script type="text/javascript">
					CKEDITOR.replace("'.$name.'", {'.$cfg.'});
				</script>';

		return $res;
	}
