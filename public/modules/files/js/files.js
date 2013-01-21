var _doc_loaded = false;
var CKEDITOR = window.parent.CKEDITOR;

function windowClose() {
	CKEDITOR.dialog.getCurrent().hide();
}

function insert_file_url(file_url, file_id) {
	if(_doc_loaded) {
		var file_title = $('#file_title_'+file_id).val();

		if(file_title != "") {
			CKEDITOR.dialog
					.getCurrent()
					.getParentEditor()
					.insertHtml('<a href="'+file_url+'" class="mx2_file_url" target="_blank">'+file_title+'</a>');

			windowClose();
		}
		else alert('Enter title');
	}
}

function insert_resizer_img(img_id, resizer_url_img, large_img_url) {
	if(_doc_loaded) {
		if($('#file_title_'+img_id).val() == "") alert('Title required.');
		else {
			/*
			alert(	img_id+" "+
					$('#file_title_'+img_id).val()+" "+
					$('#alt_text_'+img_id).val()+" "+
					$('#align_'+img_id+":checked").val()+" "+
					$('#size_'+img_id+":checked").val()
			);
	
			//alert( $('#wrap_by_large_img_'+img_id).is(':checked') );
			*/
	
			//<a href="'+large_img_url+'" class="mx2_image_large" rel="group1" target="_blank">
			//<img src="'+resizer_img_url+'" alt="" class="mx2_image mx2_resizer_img"/></a>'

			var _w = 100;
			//var _h = 100;

			var _alt_text = $('#alt_text_'+img_id).val();
			var _title = $('#file_title_'+img_id).val();

			var html = '<img src="'+resizer_url_img+_w+'" alt="'+_alt_text+'" title="'+_title+'" class="mx2_image mx2_resizer_img"/>';

			if($('#wrap_by_large_img_'+img_id).is(':checked')) {
				var img_wrp = '<a href="'+large_img_url+'" class="mx2_image_large" rel="group1" target="_blank">';

				html = img_wrp+html+'</a>';
			}

			CKEDITOR.dialog
					.getCurrent()
					.getParentEditor()
					.insertHtml(html);
	
			windowClose();
		}
	}
}

function insert_orig_img(img_url) {
	if(_doc_loaded) {
		CKEDITOR.dialog
				.getCurrent()
				.getParentEditor()
				.insertHtml('<a href="'+img_url+'" class="mx2_image_large" rel="group1" target="_blank"><img src="'+img_url+'" alt="" class="mx2_image"/></a>');

		windowClose();
	}
}

function insert_by_url() {
	alert('');

	windowClose();
}

window.onload = function() {
	if(typeof jQuery == "undefined") alert('Files module requires JQuery installed.');
	else if(typeof BASE_ADMIN_URL == "undefined") alert('Please define BASE_ADMIN_URL variable.');
	else if(typeof CSRF_TOKEN_NAME == "undefined" || typeof CSRF_VALUE == "undefined") alert('Define CSRF_TOKEN_NAME & CSRF_VALUE');
	else {
		(function($) {
			_doc_loaded = true;

			$('#data').load(BASE_ADMIN_URL+'/files');

			$('#folder').change(function() {
				$('#data').load(BASE_ADMIN_URL+'/files?folder='+this.value);
			});

			$('#fileupload').fileupload({
				dropZone:	$('#dropzone'), 
				url:		BASE_ADMIN_URL+'files/ajax_upload?folder='+$("#parent_folder").val(), 
				formData:	[ { name: CSRF_TOKEN_NAME, value: CSRF_VALUE } ], 
				done:		function(e, data) {
								$("#uploaded-files-preview").prepend(data.result);
							}
			})
			/*
			.bind('fileuploadadd', function (e, data) {
				alert('lalla: '+data.files.length);
			})
			*/
			.bind('fileuploadsubmit', function (e, data) {
				//alert('nnnnnnn: '+data.files.length);

				//return false;
			});

			$("#parent_folder").change(function() {
				$('#fileupload').fileupload(
									'option', 
									'url', 
									BASE_ADMIN_URL+'files/ajax_upload?folder='+this.value 
								);
			});

			$('#create_folder_btn').click(function() {
				$('#edit_folder_popup').modal('show');

				return false;
			});

			$('.img_prev').popover();

			$("#dialog_folder").change(function() {
				location.href = BASE_ADMIN_URL+"files/dialog?folder="+this.value;
			});

			$('#ajax_folder_edit_cancel').click(function() {
				$('#result_p').html('');
				$('#folder_name').val('');

				$('#edit_folder_popup').modal('hide');
			});

			$('#edit_folder_popup').on('hide', function () {
				$('#result_p').html('');
				$('#folder_name').val('');
			});

			$("#ajax_folder_edit_btn").click(function() {
				$(".alert").alert();

				$.get(
					BASE_ADMIN_URL+'files/folders/create', 
					{
						parent:	$('#parent_folder_id').val(), 
						name:	$('#folder_name').val() 
					}, 
					function(data) {
						if(data.status == "success") {
							$('#result_p').html($('#alert_div').clone()
																.css('display', 'block')
																.attr('id', 'alert_div_cloned'));

							$('#alert_div_cloned #alert_msg').html(data.message);
						}
						else {
							$('#result_p').html($('#alert_div').clone()
																.attr('class', 'alert alert-warning')
																.css('display', 'block')
																.attr('id', 'alert_div_cloned')
											);

							$('#alert_div_cloned #alert_msg').html(data.message);
						}
					}, 
					"json");
			});
		})(jQuery);
	}
};





/*
window.onload = function() {
	(function($) {
		$('#fileaaa_url').blur(function() {
			if(this.value != "") {
				$.get(this.value, function() {
				    alert("success");
				})
				.success(function() {
					alert("second success");
				})
				.error(function() {
					alert("error");
				});
			}
		});
	})(jQuery);
};
*/




/*
	$(window).ready(function() {
		window.parent.jQuery('.cke_dialog_footer').hide();
	});
 */




