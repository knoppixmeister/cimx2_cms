<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function rich_textarea($name, $item, $config=array()) {
		$cfg = "toolbar: [ ['Maximize'], 
						[ 'Files','Embed_video' ], 
						[ 'Cut','Copy','Paste','PasteFromWord' ], 
						[ 'Undo','Redo','-','Find','Replace' ], 
						['Link','Unlink'], 
						['Table','HorizontalRule','SpecialChar'], 
						['Bold','Italic','StrikeThrough'], 
						['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'], 
						['Format', 'FontSize', 'Subscript','Superscript', 'NumberedList','BulletedList','Outdent','Indent','Blockquote'], 
						['ShowBlocks', 'RemoveFormat'], 
						['Source'] ], extraPlugins: 'embed_video,files', ";

		$cfg .= "enterMode : CKEDITOR.ENTER_BR, defaultLanguage: 'en', language: 'en', tabSpaces: 4, ";
		foreach($config as $c) {
			$cfg .= $c.", ";
		}

		$cfg = trim($cfg, ", ");

		if(!defined('CKEDITOR_SCRIPT_DEF')) {
			$res = 	'<script type="text/javascript" src="'.base_url().'public/modules/ckeditor/ckeditor/ckeditor.js"></script>';
					//'<script type="text/javascript" src="http://ckeditor.com/apps/ckeditor/3.6/ckeditor.js"></script>';

			$res .= '<script type="text/javascript">
						CKEDITOR.plugins.addExternal("embed_video", "'.base_url().'public/modules/ckeditor/plugins/embed_video/");
						CKEDITOR.plugins.addExternal("files", "'.base_url().'public/modules/ckeditor/plugins/files/");
					</script>';

			define('CKEDITOR_SCRIPT_DEF', TRUE);//To prevent again include of ckeditor JS script
		}

		$res .= '	<textarea name="'.$name.'">'.set_value($name, $item[$name]).'</textarea>
					<script type="text/javascript">
						CKEDITOR.replace("'.$name.'", {'.$cfg.'});
					</script>';

		return $res;
	}

	function form_rich_textarea($name, $item, $config=array()) {//Alias for rich_textarea
		return rich_textarea($name, $item, $config);
	}
