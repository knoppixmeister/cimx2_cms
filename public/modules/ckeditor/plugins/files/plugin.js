if(typeof jQuery == "undefined") alert('Images plugin requires Jquery library');
if(typeof BASE_ADMIN_URL == "undefined") alert('CKEditor need to be defined variable BASE_ADMIN_URL in "files" plugin');

CKEDITOR.plugins.add('files', {
		requires:	[ 'iframedialog' ], 
		init: 		function(editor) {
						CKEDITOR.dialog.addIframe(
											'files_dialog', 
											'Files', 
											BASE_ADMIN_URL+'/files/dialog', 
											$(window).width()/6*5, 
											$(window).height()/6*5 
										);

						editor.addCommand('files_dialog', new CKEDITOR.dialogCommand('files_dialog'));
						editor.ui.addButton('Files', 	{
															label:		'Insert file into document', 
															command:	'files_dialog', 
															icon:		this.path+'images/icon.png' 
														});
					}
});
