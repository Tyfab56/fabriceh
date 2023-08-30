"use strict";

var $ = jQuery.noConflict();
var FileUpload = '';
var public_path;

(function ($) {
	"use strict";
	
	$('#tw-content').hide();
	
	//public_path = $("#public_path").val();
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
    $("#load_profile_photo").on('change', function() {
		Profile_Photo_upload_form();
    });

	//Form Submit
    $('.submit-form-class').on('click', function () {
        $("#DataEntry_formId").submit();
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
	
	//Load My Profile data
	onLoadUserEditData();

})(jQuery);

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

//Form Submit My Profile
jQuery('#DataEntry_formId').parsley({
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
                onMyProfileAddEdit();
                return false;
            }
        }
    }
});

//Add/Edit My Profile
function onMyProfileAddEdit() {
	var method = $("#saveUsersId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId').serialize(),
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
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Load My Profile data
function onLoadUserEditData() {
	var method = $("#UserById").val();
    $.ajax({
		type: "POST",
		url: method,
		data:{
			id: $("#Record_UserId").val()
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
			
			//Preloader and content
			$('#tw-content').show();
			$('#tw-loader').hide();
        }
    });
}
