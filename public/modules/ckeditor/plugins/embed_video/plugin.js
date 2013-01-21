//if(typeof BASE_ADMIN_URL == "undefined") alert('CKEditor need to be defined variable BASE_ADMIN_URL in embed_video plugin');

CKEDITOR.plugins.add('embed_video', {
    requires:	[ 'dialog' ], 
    init: 		function(editor) {
    				editor.addCommand('embed_video', new CKEDITOR.dialogCommand('embed_video_dialog'));
    				editor.ui.addButton('Embed_video', {
			        										label:		'Insert embedded video by link or code', 
			        										command:	'embed_video', 
			        										icon:		this.path+'images/icon.png' 
			        									});
    			}, 
});

CKEDITOR.dialog.add('embed_video_dialog', function(editor) {
	return {
		title: 		'Insert embedded video', 
		minWidth:	400, 
		minHeight:	250, 
		contents:
		[
			{
				id:			'tab1', 
				label:		'Insert by link', 
				elements:
				[
					{
						type:		'radio', 
						id:			'type', 
						label:		'Video embed type', 
						items:		[ [ 'Link', 'link' ], [ 'Code', 'code' ] ] , 
						'default':	'link', 
						//validate:	CKEDITOR.dialog.validate.notEmpty("Video link field cannot be empty")
						onClick : 	function() {
										// this = CKEDITOR.ui.dialog.radio
										//alert('Current value: ' + this.getValue());
									}
					}, 
					{
						type:		'vbox', 
						id:			'link_box', 
						children:
						[
							{
								type:	'text', 
								id:		'link', 
								label:	'Video link', 
							}, 
						]
					}, 
					{
						type:		'vbox', 
						id:			'code_box', 
						children:
						[
							{
								type:	'textarea', 
								id:		'code', 
								label:	'Embed code', 
							}, 
						]
					}, 
				]
			},
		], 
		onOk: function() {
			var dialog = this;
			/*
			var abbr = editor.document.createElement('abbr');
			abbr.setAttribute( 'title', dialog.getValueOf( 'tab1', 'title' ) );
			abbr.setText( dialog.getValueOf( 'tab1', 'abbr' ) );
			var id = dialog.getValueOf( 'tab2', 'id' );
			if ( id )
				abbr.setAttribute( 'id', id );
			
			editor.insertElement( abbr );
			*/
			if(dialog.getValueOf('tab1', 'type') == 'code') {
				editor.insertHtml(dialog.getValueOf('tab1', 'code'));
			}
			else {
				
			}
		}
	};
});
