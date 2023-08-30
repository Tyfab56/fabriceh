"use strict";

var $ = jQuery.noConflict();
var FileUpload = '';
var public_path;
var RecordId = '';
var onDataTable;

(function ($) {
	"use strict";
	
	$('#tw-content').hide();
	
	//public_path = $("#public_path").val();
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	//Default First Tab Active
	onListPanel(1);

    $("#load_your_photo").on('change', function() {
		your_photo_upload_form();
    });
	
    $("#load_background").on('change', function() {
		load_background_upload_form();
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
		if(tabid == 3){
			//DataTable Columns Adjust
			$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
		}
	});
	
	//Get Home Page Version
	getHomepageVersion();

	//Animated Clip Text
 	onDataTable = $('#DataTable_AnimatedClipTextId').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		bSort: false,
		language: {
			url: DataTableLanFile
		},		
		ajax: {
			url: $("#AnimatedClipTextId").val(),
			dataType: "json",
			type: "POST",
			data:{
				category: $("#category_animated_clip_text").val()
			},			
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
				data: 'post_title',
				name: 'post_title',
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
	
	$('#DataTable_AnimatedClipTextId').on('click', 'tr', function (e) {
		e.preventDefault();
		var cColumn = e.originalEvent.target;
		var className = cColumn.className;

		if ((className == 'editIconBtn')||(className == 'fa fa-edit')){
			var data = onDataTable.row(this).data();
			
			RecordId = data.id;

			var msg = langtext.Do_you_really_want_to_edit_this_record;
			onCustomModal(msg, "onEditPanelTab_3");
		}
		
		if((className=='deleteIconBtn')||(className=='fa fa-remove')){
			var data = onDataTable.row( this ).data();
			
			RecordId = data.id; 
			
			var msg = langtext.Do_you_really_want_to_delete_this_record;	                	  
			onCustomModal(msg, "onAnimatedClipTextDelete");
		}
	});

})(jQuery);

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

//Get Home Page Version
function getHomepageVersion() {

	var method = $("#getHomepageVersionId").val();
	
    $.ajax({
		type: "POST",
		url: method,
		data:{
			bactive: 1
		},
		cache: false,
		dataType: 'json',
		success: function(dataResult){
			var datalist = dataResult;

			if(datalist.length>0){
				var obj = datalist[0];
				if(obj.home_page != null){
					$(".HomepageVersion").hide();
					$("#"+obj.home_page+'_select').show();
				}else{
					$(".HomepageVersion").hide();
				}		
				$(".HomepageVersion").hide();
				$("#"+obj.home_page+'_select').show();
			}else{
				$(".HomepageVersion").hide();
			}
			
			//Preloader and content
			$('#tw-content').show();
			$('#tw-loader').hide();
			
			getHomeContent();
        }
    });
}

//Homepage Versions Add/Edit
function onHomepageVersionAddEdit(home_page) {
	var method = $("#saveHomepageVersionId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
		"data":{
			home_page: home_page,
			bactive: 1
		},
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
				getHomepageVersion();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Get Home Content
function getHomeContent() {
	
	var method = $("#HomeContentId").val();
	var category = $("#category_Home_Content").val();
	
    $.ajax({
		type: "POST",
		url: method,
		data:{
			category: category
		},
		cache: false,
		dataType: 'json',
		success: function(dataResult){
		
			var datalist = dataResult.data;
			if(datalist != null){
				var obj = JSON.parse(datalist.post_content);

				var post_title = datalist.post_title;
				if(post_title != null){
					$("#name").val(post_title);
				}else{
					$("#name").val('');
				}
				
				var your_photo = obj.your_photo;
				if(your_photo != null){
					$("#your_photo").val(your_photo);
					$("#your_photo_show").html('<img src="'+public_path+'/media/'+your_photo+'">');
				}else{
					$("#your_photo").val('');
					$("#your_photo_show").html('');
				}
				
				var background_image = obj.background_image;
				if(background_image != null){
					$("#background_image").val(background_image);
					$("#background_show").html('<img src="'+public_path+'/media/'+background_image+'">');
				}else{
					$("#background_image").val('');
					$("#background_show").html('');
				}
				
				var video_background = obj.video_background;
				if(video_background != null){
					$("#video_background").val(video_background);
				}else{
					$("#video_background").val('');
				}
			}else{
				$("#name").val('');
				$("#your_photo").val('');
				$("#your_photo_show").html('');				
				$("#background_image").val('');
				$("#background_show").html('');				
				$("#video_background").val('');
			}
        }
    });
}

//Home Content Add/Edit
function onHomeContentAddEdit() {
	var method = $("#saveHomeContentId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_2').serialize(),
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
				getHomeContent();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Form Submit 2
jQuery('#DataEntry_formId_2').parsley({
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
                onHomeContentAddEdit();
                return false;
            }
        }
    }
});

//Your Photo upload
function your_photo_upload_form() {
	FileUpload = $("#FileUploadId").val();

	var data = new FormData();
		data.append('FileName', $('#load_your_photo')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_your_photo').val();
	var size  =  $('#load_your_photo')[0].files[0].size;

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
					$("#your_photo_show").html('<img src="'+public_path+'/media/'+filename+'">');
					$("#your_photo").val(filename);
					$("#your_photo_errorMgs").hide();
					$("#your_photo_errorMgs").html('');
					
				} else {
					$("#your_photo_show").html('');
					$("#your_photo").val('');
					$("#your_photo_errorMgs").show();
					$("#your_photo_errorMgs").html(msg);
				}
			},
			error: function(){
				return false;
			}	        
		});
		
	}else{
		$("#your_photo_show").html('');
		$("#your_photo").val('');
		$("#your_photo_errorMgs").show();
		$("#your_photo_errorMgs").html(langtext.Sorry_only_you_can_upload_jpg_png_and_gif_file_type);
	}
}

//Background image upload
function load_background_upload_form() {
	FileUpload = $("#FileUploadId").val();

	var data = new FormData();
		data.append('FileName', $('#load_background')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_background').val();
	var size  =  $('#load_background')[0].files[0].size;

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
					$("#background_show").html('<img src="'+public_path+'/media/'+filename+'">');
					$("#background_image").val(filename);
					$("#background_errorMgs").hide();
					$("#background_errorMgs").html('');
					
				} else {
					$("#background_show").html('');
					$("#background_image").val('');
					$("#background_errorMgs").show();
					$("#background_errorMgs").html(msg);
				}
			},
			error: function(){
				return false;
			}	        
		});

	}else{
		$("#background_show").html('');
		$("#background_image").val('');
		$("#background_errorMgs").show();
		$("#background_errorMgs").html(langtext.Sorry_only_you_can_upload_jpg_png_and_gif_file_type);
	}
}

//Form Submit 3 (Animated Clip Text Tab 3)
jQuery('#DataEntry_formId_3').parsley({
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
                onAnimatedClipTextAddEdit();
                return false;
            }
        }
    }
});

//Animated Clip Text Tab 3
function onAnimatedClipTextAddEdit() {
	var method = $("#saveAnimatedClipTextId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_3').serialize(),
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
				
				$("#DataTable_AnimatedClipTextId").dataTable().fnDraw();
				
				//Animated Clip Text Tab 3
				onListPanel(3);
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Data Edit Form Panel For Tab 3
function onEditPanelTab_3() {
	onLoadAnimatedClipTextEditData();
}

function onLoadAnimatedClipTextEditData() {
	
	var method = $("#AnimatedClipTextById").val();
	
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
			$("#Record_AnimatedClipTextId").val(datalist.id);
			$("#clip_text").val(datalist.post_title);
			
			//Animated Clip Text Tab 3
			onEditPanel(3);
        }
    });
}

//Animated Clip Text Delete
function onAnimatedClipTextDelete() {
	var method = $("#AnimatedClipTextDeleteId").val();
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
				$("#DataTable_AnimatedClipTextId").dataTable().fnDraw();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}
