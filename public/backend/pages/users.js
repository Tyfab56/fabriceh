"use strict";

var $ = jQuery.noConflict(); 
var FileUpload = '';
var public_path;
var RecordId = '';
var onDataTableUsers;
var onDataTableImages;

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
	
    $("#load_profile_photo").on('change', function() {
		Profile_Photo_upload_form();
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

	//Users
 	onDataTableUsers = $('#DataTable_UsersId').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		bSort: false,
		language: {
			url: DataTableLanFile
		},		
		ajax: {
			url: $("#getUsersDataId").val(),
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
				data: 'name',
				name: 'name',
				orderable: false,
				sWidth: "40%"
			}, {
				data: 'email',
				name: 'email',
				orderable: false,
				sWidth: "40%"
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

	// Images
	onDataTableImages = $('#DataTable_ImagesId').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		bSort: false,
		language: {
			url: DataTableLanFile
		},		
		ajax: {
			url: $("#getImageDataId").val(),
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
				data: 'titre',
				name: 'titre',
				orderable: false,
				sWidth: "20%"
			}, {
				data: 'description',
				name: 'description',
				orderable: false,
				sWidth: "40%"
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

	//Users Edit/Delete Action
	$('#DataTable_UsersId').on('click', 'tr', function (e) {
		e.preventDefault();
		var cColumn = e.originalEvent.target;
		var className = cColumn.className;

		if ((className == 'editIconBtn')||(className == 'fa fa-edit')){
			var data = onDataTableUsers.row(this).data();
			
			RecordId = data.id;
			$("#Record_UserId").val(data.id);
			
			var msg = langtext.Do_you_really_want_to_edit_this_record;
			onCustomModal(msg, "onEditPanelTab_1");
		}
		
		if((className=='deleteIconBtn')||(className=='fa fa-remove')){
			var data = onDataTableUsers.row( this ).data();
			
			RecordId = data.id; 
			
			var msg = langtext.Do_you_really_want_to_delete_this_record;	                	  
			onCustomModal(msg, "onDeleteUsers");
		}
	});
	
	$('.toggle-password').on('click', function() {
		$(this).toggleClass('fa-eye-slash');
			let input = $($(this).attr('toggle'));
		if (input.attr('type') == 'password') {
			input.attr('type', 'text');
		}else {
			input.attr('type', 'password');
		}
	});	
	
	//Preloader and content
	$('#tw-content').show();
	$('#tw-loader').hide();
	
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
	$("#profile_photo_show").html('');
	$("#profile_photo").val('');	
	$("#Record_UserId").val('');
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

//Profile Photo upload
function Profile_Photo_upload_form() {
	FileUpload = $("#FileUploadId").val();
	
	var data = new FormData();
		data.append('FileName', $('#load_profile_photo')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_profile_photo').val();
	var size  =  $('#load_profile_photo')[0].files[0].size;

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
					$("#profile_photo_show").html('<img src="'+public_path+'/media/'+filename+'">');
					$("#profile_photo").val(filename);
					$("#profile_photo_errorMgs").hide();
					$("#profile_photo_errorMgs").html('');
					
				} else {
					$("#profile_photo_show").html('');
					$("#profile_photo").val('');
					$("#profile_photo_errorMgs").show();
					$("#profile_photo_errorMgs").html(msg);
				}
			},
			error: function(){
				return false;
			}	        
		});

	}else{
		$("#profile_photo_show").html('');
		$("#profile_photo").val('');
		$("#profile_photo_errorMgs").show();
		$("#profile_photo_errorMgs").html(langtext.Sorry_only_you_can_upload_jpg_png_and_gif_file_type);
	}
}

//Form Submit 1 (Users Tab 1)
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
                onUsersAddEdit();
                return false;
            }
        }
    }
});

//Users Tab 1
function onUsersAddEdit() {
	var method = $("#saveUsersId").val();
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
				
				$("#DataTable_UsersId").dataTable().fnDraw();
				
				//Users Tab 1
				onListPanel(1);
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Data Edit Form Panel For Tab 1
function onEditPanelTab_1() {
	onLoadUserEditData();
}

function onLoadUserEditData() {
	var method = $("#UserById").val();
    $.ajax({
		type: "POST",
		url: method,
		data:{
			id: RecordId
		},
		cache: false,
		dataType: 'json',
		success: function(dataResult){
			var datalist = dataResult;

			$("#Record_UserId").val(datalist.id);
			if(datalist.name != null){
				$("#name").val(datalist.name);
			}else{
				$("#name").val('');
			}
			
			if(datalist.email != null){
				$("#email").val(datalist.email);
			}else{
				$("#email").val('');
			}

			if(datalist.bactive != null){
				$("#password").val(datalist.bactive);
			}else{
				$("#password").val('');
			}
			
			if(datalist.address != null){
				$("#address").val(datalist.address);
			}else{
				$("#address").val('');
			}
			
			if(datalist.image != null){
				$("#profile_photo_show").html('<img src="'+public_path+'/media/'+datalist.image+'">');
				$("#profile_photo").val(datalist.image);
				$("#profile_photo_errorMgs").hide();
				$("#profile_photo_errorMgs").html('');
			}else{
				$("#profile_photo_show").html('');
				$("#profile_photo").val('');
				$("#profile_photo_errorMgs").hide();
				$("#profile_photo_errorMgs").html('');
			}
			
			//Users Tab 1
			onEditPanel(1);
        }
    });
}

//Users Delete
function onDeleteUsers() {
	var method = $("#deleteUserId").val();
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
				$("#DataTable_UsersId").dataTable().fnDraw();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

