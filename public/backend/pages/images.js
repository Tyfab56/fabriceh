"use strict";

var $ = jQuery.noConflict();
var FileUpload = '';
var public_path;
var RecordId = '';
var onDataTableBlog;

//Reset Form
function resetForm(id) {
    $('#' + id).each(function () {
        this.reset();
    });
}

//Data Grid Panel
function onListPanel(id) {
	$('.parsley-error-list').hide();
    $('#list-panel-tabid-'+id+', .btn-form').show();
    $('#form-panel-tabid-'+id+', .btn-list').hide();
}

//Data Entry Form Panel
function onFormPanel(id) {
    resetForm("DataEntry_formId_"+id);
	RecordId = '';
	$('#blog_description').summernote('reset');
	$("#blog_image_show").html('');
	$("#blog_image").val('');	
	$("#Record_BlogId").val('');
    $('#list-panel-tabid-'+id+', .btn-form').hide();
    $('#form-panel-tabid-'+id+', .btn-list').show();
}

//Data Edit Form Panel
function onEditPanel(id) {
    $('#list-panel-tabid-'+id+', .btn-form').hide();
    $('#form-panel-tabid-'+id+', .btn-list').show();
}

//Error Show
function showPerslyError() {
    $('.parsley-error-list').show();
}

//Blog Image upload
function blog_Image_upload_form() {
	FileUpload = $("#FileUploadId").val();
	
	var data = new FormData();
		data.append('FileName', $('#load_blog_image')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_blog_image').val();
	var size  =  $('#load_blog_image')[0].files[0].size;

	var ext =  imgname.substr((imgname.lastIndexOf('.') +1));

	if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG'){
		
		$.ajax({
			url: FileUpload,
			type: "POST",
			dataType : "json",
			data:  data,
			contentType: false,
			cache: false,
			processData:false,
			enctype: 'multipart/form-data',
			mimeType:"multipart/form-data",
			success: function(response){
				var msgType = response.msgType;
				var msg = response.msg;
				var filename = response.FileName;
				if (msgType == 'success') {
					$("#blog_image_show").html('<img src="'+public_path+'/media/'+filename+'">');
					$("#blog_image").val(filename);
					$("#blog_image_errorMgs").hide();
					$("#blog_image_errorMgs").html('');
					
				} else {
					$("#blog_image_show").html('');
					$("#blog_image").val('');
					$("#blog_image_errorMgs").show();
					$("#blog_image_errorMgs").html(msg);
				}
			},
			error: function(){
				return false;
			}	        
		});
		
	}else{
		$("#blog_image_show").html('');
		$("#blog_image").val('');
		$("#blog_image_errorMgs").show();
		$("#blog_image_errorMgs").html(langtext.Sorry_only_you_can_upload_jpg_png_and_gif_file_type);
	}
}

//Form Submit 1 (Blog Tab 1)
jQuery('#DataEntry_formId_1').parsley({
    listeners: {
        onFieldValidate: function (elem) {
            if (!$(elem).is(':visible')) {
                return true;
            }else {
                showPerslyError();
                return false;
            }
        },
        onFormSubmit: function (isFormValid, event) {
            if (isFormValid) {
                onBlogAddEdit();
                return false;
            }
        }
    }
});

//Blog Tab 1
function onBlogAddEdit() {
	var method = $("#saveBlogId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_1').serialize(),
        async: true,
        cache: false,
        timeout: 30000,
        error: function () {
            return true;
        },
        "success": function (response) {

            var msgType = response.msgType;
            var msg = response.msg;

            if (msgType == "success") {
				onSuccessMsg(msg);
				
				$("#DataTable_BlogId").dataTable().fnDraw();
				
				//Portfolio Tab 1
				onListPanel(1);
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Data Edit Form Panel For Tab 1
function onEditPanelTab_1() {
	onLoadBlogEditData();
}

function onLoadBlogEditData() {
	var method = $("#BlogById").val();
    $.ajax({
		type: "POST",
		url: method,
		data:{
			id: RecordId
		},
		cache: false,
		dataType: 'json',
		success: function(dataResult){
			var datalist = dataResult.data;
			
			$("#Record_BlogId").val(datalist.id);
			
			if(datalist.title != null){
				$("#blog_title").val(datalist.title);
			}else{
				$("#blog_title").val('');
			}
			
			if(datalist.description != null){
				$('#blog_description').summernote('code', datalist.description);
			}else{
				$('#blog_description').summernote('code', '');
			}
			
			if(datalist.seo_keywords != null){
				$("#seo_keywords").val(datalist.seo_keywords);
			}else{
				$("#seo_keywords").val('');
			}
			
			if(datalist.seo_desc != null){
				$("#seo_desc").val(datalist.seo_desc);
			}else{
				$("#seo_desc").val('');
			}
			
			if(datalist.image != null){
				$("#blog_image_show").html('<img src="'+public_path+'/media/'+datalist.image+'">');
				$("#blog_image").val(datalist.image);
				$("#blog_image_errorMgs").hide();
				$("#blog_image_errorMgs").html('');
			}else{
				$("#blog_image_show").html('');
				$("#blog_image").val('');
				$("#blog_image_errorMgs").hide();
				$("#blog_image_errorMgs").html('');
			}
			
			//Blog Tab 1
			onEditPanel(1);
        }
    });
}

//Blog Delete
function onDeleteBlog() {
	var method = $("#deleteBlogId").val();
    $.ajax({
		type: "POST",
		url: method,
		data:{
			id: RecordId
		},
		cache: false,
		dataType: 'json',
		success: function(response){
            var msgType = response.msgType;
            var msg = response.msg;

            if (msgType == "success") {
				onSuccessMsg(msg);
				$("#DataTable_BlogId").dataTable().fnDraw();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

(function ($) {
	"use strict";
	
	$('#tw-content').hide();
	
	public_path = $("#public_path").val();
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	//Default First Tab Active
	onListPanel(1);

    $("#load_blog_image").on('change', function() {
		blog_Image_upload_form();
    });

	//Form Submit
    $('.submit-form-class').on('click', function () {
		var submitformid = $(this).data("submitformid");
        $("#DataEntry_formId_"+submitformid).submit();
    });	
	
	//Tab Show and Hide
	$('.link-tab').on('click', function () {
		var tabid = $(this).data("tabid");
		$(".tab-link-content").hide();
		$(".link-tab").removeClass("active");
		$(this).addClass("active");
		$("#tabId-"+tabid).show();
		onListPanel(tabid);
		if(tabid == 1){
			//DataTable Columns Adjust
			$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
		}
	});

	//Blog
 	onDataTableBlog = $('#DataTable_BlogId').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		bSort: false,
		language: {
			url: DataTableLanFile
		},		
		ajax: {
			url: $("#getBlogDataId").val(),
			dataType: "json",
			type: "POST",
			data:{},			
		},		
		columns: [{
				data: null,
				className: "text-center",
				sWidth: "5%",
				searchable: false,
				orderable: false,
				render: function (data, type, row, meta) {
					return  meta.row + meta.settings._iDisplayStart + 1;
				}
			}, {
				data: 'title',
				name: 'title',
				orderable: false,
				sWidth: "80%"
			},{
				data: null,
				sWidth: "15%",
				className: "text-center",
				searchable: false,
				orderable: false,
				defaultContent: "<a class='editIconBtn' title='"+langtext.Edit+"' href='javascript:void(0);'><i class='fa fa-edit'></i></a>"
					+ "<a class='deleteIconBtn' title='"+langtext.Delete+"' href='javascript:void(0);'><i class='fa fa-remove'></i></a>" 	
			}
		]
	});
	
	//Blog Edit/Delete Action
	$('#DataTable_BlogId').on('click', 'tr', function (e) {
		e.preventDefault();
		var cColumn = e.originalEvent.target;
		var className = cColumn.className;

		if ((className == 'editIconBtn')||(className == 'fa fa-edit')){
			var data = onDataTableBlog.row(this).data();
			
			RecordId = data.id;
			$("#Record_BlogId").val(data.id);
			
			var msg = langtext.Do_you_really_want_to_edit_this_record;
			onCustomModal(msg, "onEditPanelTab_1");
		}
		
		if((className=='deleteIconBtn')||(className=='fa fa-remove')){
			var data = onDataTableBlog.row( this ).data();
			
			RecordId = data.id; 
			
			var msg = langtext.Do_you_really_want_to_delete_this_record;	                	  
			onCustomModal(msg, "onDeleteBlog");
		}
	});
	
	//Summernote
	$('#blog_description').summernote({
		tabDisable: false,
		height: 200,
		toolbar: [
		  ['style', ['style']],
		  ['font', ['bold', 'italic', 'underline', 'clear']],
		  ['para', ['ul', 'ol', 'paragraph']],
		  ['table', ['table']],
		  ['insert', ['link', 'unlink']],
		  ['misc', ['undo', 'redo']],
		  ['view', ['codeview', 'help']]
		]
	});
	
	//Preloader and content
	$('#tw-content').show();
	$('#tw-loader').hide();
		
})(jQuery);
