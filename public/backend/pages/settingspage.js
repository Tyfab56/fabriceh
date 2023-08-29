"use strict";

var $ = jQuery.noConflict();
var FileUpload = '';
var public_path;
var RecordId = '';
var onDataTableEducation;
var onDataTableExperience;
var onDataTableMySkills;

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

    $("#load_favicon").on('change', function() {
		favicon_upload_form();
    });
	
    $("#load_front_logo").on('change', function() {
		front_logo_upload_form();
    });
	
    $("#load_back_logo").on('change', function() {
		back_logo_upload_form();
    });
	
    $("#load_seo_cover_image").on('change', function() {
		SEO_Cover_Image_upload_form();
    });

	$('#themeBackgroundColor').colorpicker({
		format: 'hex' //format - hex | rgb | rgba.
	});
	
	$('#themeTextColor').colorpicker({
		format: 'hex' //format - hex | rgb | rgba.
	});
	
	$('#themeHoverColor').colorpicker({
		format: 'hex' //format - hex | rgb | rgba.
	});
	
	$('#themeHeadingColor').colorpicker({
		format: 'hex' //format - hex | rgb | rgba.
	});
	
	$('#hpBackgroundColor').colorpicker({
		format: 'rgba' //format - hex | rgb | rgba.
	});
	
	$('#avaterBorderColor').colorpicker({
		format: 'rgba' //format - hex | rgb | rgba.
	});	
	
	$('#fillColor').colorpicker({
		format: 'hex' //format - hex | rgb | rgba.
	});
	
	$('#backendBackgroundColor').colorpicker({
		format: 'hex' //format - hex | rgb | rgba.
	});
	
	$('#backendTextColor').colorpicker({
		format: 'hex' //format - hex | rgb | rgba.
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
	});

	//Get Settings Table Data
	getSettingsTableData();	
	
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

//Favicon upload
function favicon_upload_form() {
	FileUpload = $("#FileUploadId").val();

	var data = new FormData();
		data.append('FileName', $('#load_favicon')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_favicon').val();
	var size  =  $('#load_favicon')[0].files[0].size;

	var ext =  imgname.substr((imgname.lastIndexOf('.') +1));

	if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG' || ext=='ico'){
	
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
					$("#favicon_show").html('<img src="'+public_path+'/media/'+filename+'">');
					$("#favicon").val(filename);
					$("#favicon_errorMgs").hide();
					$("#favicon_errorMgs").html('');
					
				} else {
					$("#favicon_show").html('');
					$("#favicon").val('');
					$("#favicon_errorMgs").show();
					$("#favicon_errorMgs").html(msg);
				}
			},
			error: function(){
				return false;
			}	        
		});

	}else{
		$("#favicon_show").html('');
		$("#favicon").val('');
		$("#favicon_errorMgs").show();
		$("#favicon_errorMgs").html(langtext.Sorry_only_you_can_upload_jpg_png_and_gif_file_type);
	}
}

//Front logo upload
function front_logo_upload_form() {
	FileUpload = $("#FileUploadId").val();

	var data = new FormData();
		data.append('FileName', $('#load_front_logo')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_front_logo').val();
	var size  =  $('#load_front_logo')[0].files[0].size;

	var ext =  imgname.substr((imgname.lastIndexOf('.') +1));

	if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG' || ext=='ico'){
	
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
					$("#front_logo_show").html('<img src="'+public_path+'/media/'+filename+'">');
					$("#front_logo").val(filename);
					$("#front_logo_errorMgs").hide();
					$("#front_logo_errorMgs").html('');
					
				} else {
					$("#front_logo_show").html('');
					$("#front_logo").val('');
					$("#front_logo_errorMgs").show();
					$("#front_logo_errorMgs").html(msg);
				}
			},
			error: function(){
				return false;
			}	        
		});

	}else{
		$("#front_logo_show").html('');
		$("#front_logo").val('');
		$("#front_logo_errorMgs").show();
		$("#front_logo_errorMgs").html(langtext.Sorry_only_you_can_upload_jpg_png_and_gif_file_type);
	}
}

//Back logo upload
function back_logo_upload_form() {
	FileUpload = $("#FileUploadId").val();

	var data = new FormData();
		data.append('FileName', $('#load_back_logo')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_back_logo').val();
	var size  =  $('#load_back_logo')[0].files[0].size;

	var ext =  imgname.substr((imgname.lastIndexOf('.') +1));

	if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG' || ext=='ico'){
	
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
					$("#back_logo_show").html('<img src="'+public_path+'/media/'+filename+'">');
					$("#back_logo").val(filename);
					$("#back_logo_errorMgs").hide();
					$("#back_logo_errorMgs").html('');
					
				} else {
					$("#back_logo_show").html('');
					$("#back_logo").val('');
					$("#back_logo_errorMgs").show();
					$("#back_logo_errorMgs").html(msg);
				}
			},
			error: function(){
				return false;
			}	        
		});

	}else{
		$("#back_logo_show").html('');
		$("#back_logo").val('');
		$("#back_logo_errorMgs").show();
		$("#back_logo_errorMgs").html(langtext.Sorry_only_you_can_upload_jpg_png_and_gif_file_type);
	}
}

//Form Submit 1 (Global Setting Tab 1)
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
                onGlobalSettingAddEdit();
                return false;
            }
        }
    }
});

//Global Setting Add/Edit
function onGlobalSettingAddEdit() {
	var method = $("#saveGlobalSettingId").val();
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
				getSettingsTableData();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Get Settings Table Data
function getSettingsTableData() {
		
	var method = $("#SettingsTableId").val();
	
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
				
				if(obj.site_title != null){
					$("#site_title").val(obj.site_title);
				}else{
					$("#site_title").val('');
				}

				if(obj.favicon != null){
					$("#favicon").val(obj.favicon);
					$("#favicon_show").html('<img src="'+public_path+'/media/'+obj.favicon+'">');
				}else{
					$("#favicon").val('');
					$("#favicon_show").html('');
				}

				if(obj.front_logo != null){
					$("#front_logo").val(obj.front_logo);
					$("#front_logo_show").html('<img src="'+public_path+'/media/'+obj.front_logo+'">');
				}else{
					$("#front_logo").val('');
					$("#front_logo_show").html('');
				}

				if(obj.back_logo != null){
					$("#back_logo").val(obj.back_logo);
					$("#back_logo_show").html('<img src="'+public_path+'/media/'+obj.back_logo+'">');
				}else{
					$("#back_logo").val('');
					$("#back_logo_show").html('');
				}
				
				if(obj.copyright != null){
					$("#copyright").val(obj.copyright);
				}else{
					$("#copyright").val('');
				}
				
				if (obj.recaptcha == 1) {
					document.getElementById("recaptcha").checked = true;
				} else {
					document.getElementById("recaptcha").checked = false;
				}
			
				if(obj.sitekey != null){
					$("#sitekey").val(obj.sitekey);
				}else{
					$("#sitekey").val('');
				}
				
				if(obj.secretkey != null){
					$("#secretkey").val(obj.secretkey);
				}else{
					$("#secretkey").val('');
				}
				
				if (obj.ismail == 1) {
					document.getElementById("ismail").checked = true;
				} else {
					document.getElementById("ismail").checked = false;
				}
				
				if(obj.fromname != null){
					$("#fromname").val(obj.fromname);
				}else{
					$("#fromname").val('');
				}
				
				if(obj.frommailaddress != null){
					$("#frommailaddress").val(obj.frommailaddress);
				}else{
					$("#frommailaddress").val('');
				}
				
				if(obj.toname != null){
					$("#toname").val(obj.toname);
				}else{
					$("#toname").val('');
				}
				
				if(obj.tomailaddress != null){
					$("#tomailaddress").val(obj.tomailaddress);
				}else{
					$("#tomailaddress").val('');
				}
				
				var social_media = JSON.parse(obj.social_media);

				if(social_media != null){
					
					if(social_media.twitter != null){
						$("#twitter").val(social_media.twitter);
					}else{
						$("#twitter").val('');
					}
					
					if(social_media.facebook != null){
						$("#facebook").val(social_media.facebook);
					}else{
						$("#facebook").val('');
					}
					
					if(social_media.linkedin != null){
						$("#linkedin").val(social_media.linkedin);
					}else{
						$("#linkedin").val('');
					}
					
					if(social_media.github != null){
						$("#github").val(social_media.github);
					}else{
						$("#github").val('');
					}
					
					if(social_media.instagram != null){
						$("#instagram").val(social_media.instagram);
					}else{
						$("#instagram").val('');
					}
				}

				var metatag = JSON.parse(obj.metatag);

				if(metatag != null){
					
					if(metatag.site_name != null){
						$("#seo_site_name").val(metatag.site_name);
					}else{
						$("#seo_site_name").val('');
					}
					
					if(metatag.keywords != null){
						$("#seo_keywords").val(metatag.keywords);
					}else{
						$("#seo_keywords").val('');
					}
					
					if(metatag.description != null){
						$("#seo_description").val(metatag.description);
					}else{
						$("#seo_description").val('');
					}
					
					if(metatag.url != null){
						$("#seo_url").val(metatag.url);
					}else{
						$("#seo_url").val('');
					}
					
					if(metatag.app_id != null){
						$("#seo_app_id").val(metatag.app_id);
					}else{
						$("#seo_app_id").val('');
					}
					
					if(metatag.twitter_site != null){
						$("#seo_twitter_site").val(metatag.twitter_site);
					}else{
						$("#seo_twitter_site").val('');
					}
					
					if(metatag.cover_image != null){
						$("#seo_cover_image").val(metatag.cover_image);
						$("#seo_cover_image_show").html('<img src="'+public_path+'/media/'+metatag.cover_image+'">');
					}else{
						$("#seo_cover_image").val('');
						$("#seo_cover_image_show").html('');
					}
				}

				var theme_color = JSON.parse(obj.theme_color);

				if(theme_color != null){

					if(theme_color.theme_background_color != null){
						$("#theme_background_color").colorpicker('setValue', theme_color.theme_background_color);
					}else{
						$("#theme_background_color").colorpicker('setValue', '');
					}
					
					if(theme_color.theme_text_color != null){
						$("#theme_text_color").colorpicker('setValue', theme_color.theme_text_color);
					}else{
						$("#theme_text_color").colorpicker('setValue', '');
					}
					
					if(theme_color.theme_hover_color != null){
						$("#theme_hover_color").colorpicker('setValue', theme_color.theme_hover_color);
					}else{
						$("#theme_hover_color").colorpicker('setValue', '');
					}
					
					if(theme_color.theme_heading_color != null){
						$("#theme_heading_color").colorpicker('setValue', theme_color.theme_heading_color);
					}else{
						$("#theme_heading_color").colorpicker('setValue', '');
					}
					
					if(theme_color.hp_background_color != null){
						$("#hp_background_color").colorpicker('setValue', theme_color.hp_background_color);
					}else{
						$("#hp_background_color").colorpicker('setValue', '');
					}
					
					if(theme_color.avater_border_color != null){
						$("#avater_border_color").colorpicker('setValue', theme_color.avater_border_color);
					}else{
						$("#avater_border_color").colorpicker('setValue', '');
					}
					
					if(theme_color.fill_color != null){
						$("#fill_color").colorpicker('setValue', theme_color.fill_color);
					}else{
						$("#fill_color").colorpicker('setValue', '');
					}
					
					if(theme_color.backend_background_color != null){
						$("#backend_background_color").colorpicker('setValue', theme_color.backend_background_color);
					}else{
						$("#backend_background_color").colorpicker('setValue', '');
					}
					
					if(theme_color.backend_text_color != null){
						$("#backend_text_color").colorpicker('setValue', theme_color.backend_text_color);
					}else{
						$("#backend_text_color").colorpicker('setValue', '');
					}
				}
				
				if (obj.is_gmap == 1) {
					document.getElementById("is_gmap").checked = true;
				} else {
					document.getElementById("is_gmap").checked = false;
				}

				var gmap = JSON.parse(obj.gmap);

				if(gmap != null){

					if(gmap.api_key != null){
						$("#api_key").val(gmap.api_key);
					}else{
						$("#api_key").val('');
					}
					
					if(gmap.Latitude != null){
						$("#Latitude").val(gmap.Latitude);
					}else{
						$("#Latitude").val('');
					}
					
					if(gmap.Longitude != null){
						$("#Longitude").val(gmap.Longitude);
					}else{
						$("#Longitude").val('');
					}
					
					if(gmap.zoom != null){
						$("#zoom").val(gmap.zoom);
					}else{
						$("#zoom").val('');
					}
				}
				
			}else{
				$("#site_title").val('');
				$("#favicon").val('');
				$("#favicon_show").html('');
				$("#front_logo").val('');
				$("#front_logo_show").html('');
				$("#back_logo").val('');
				$("#back_logo_show").html('');
				$("#copyright").val('');
			}
			
			//Preloader and content
			$('#tw-content').show();
			$('#tw-loader').hide();
        }
    });
}

//Form Submit 2 (Copyright Tab 2)
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
                onCopyrightAddEdit();
                return false;
            }
        }
    }
});

//Copyright Add/Edit
function onCopyrightAddEdit() {
	var method = $("#saveCopyrightId").val();
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
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Form Submit 3 (Social Media Tab 3)
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
                onSocialMediaAddEdit();
                return false;
            }
        }
    }
});

//Social Media Add/Edit
function onSocialMediaAddEdit() {
	var method = $("#saveSocialMediaId").val();
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
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//SEO Cover Image upload
function SEO_Cover_Image_upload_form() {
	FileUpload = $("#FileUploadId").val();

	var data = new FormData();
		data.append('FileName', $('#load_seo_cover_image')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_seo_cover_image').val();
	var size  =  $('#load_seo_cover_image')[0].files[0].size;

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
					$("#seo_cover_image_show").html('<img src="'+public_path+'/media/'+filename+'">');
					$("#seo_cover_image").val(filename);
					$("#seo_cover_image_errorMgs").hide();
					$("#seo_cover_image_errorMgs").html('');
					
				} else {
					$("#seo_cover_image_show").html('');
					$("#seo_cover_image").val('');
					$("#seo_cover_image_errorMgs").show();
					$("#seo_cover_image_errorMgs").html(msg);
				}
			},
			error: function(){
				return false;
			}	        
		});

	}else{
		$("#seo_cover_image_show").html('');
		$("#seo_cover_image").val('');
		$("#seo_cover_image_errorMgs").show();
		$("#seo_cover_image_errorMgs").html(langtext.Sorry_only_you_can_upload_jpg_png_and_gif_file_type);
	}
}

//Form Submit 4 (SEO Tab 4)
jQuery('#DataEntry_formId_4').parsley({
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
                onSEOAddEdit();
                return false;
            }
        }
    }
});

//SEO Add/Edit
function onSEOAddEdit() {
	var method = $("#saveMetaTagId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_4').serialize(),
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

//Form Submit 5 (Color Tab 5)
jQuery('#DataEntry_formId_5').parsley({
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
                onColorAddEdit();
                return false;
            }
        }
    }
});

//Theme Color Add/Edit
function onColorAddEdit() {
	var method = $("#saveColorId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_5').serialize(),
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

//Form Submit 6 (Google reCAPTCHA Tab 6)
jQuery('#DataEntry_formId_6').parsley({
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
                onGooglereCAPTCHAAddEdit();
                return false;
            }
        }
    }
});

//Google reCAPTCHA Add/Edit
function onGooglereCAPTCHAAddEdit() {
	var method = $("#saveGooglereCAPTCHAId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_6').serialize(),
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

//Form Submit 7 (Contact Form Setting Tab 7)
jQuery('#DataEntry_formId_7').parsley({
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
                onContactFormSettingAddEdit();
                return false;
            }
        }
    }
});

//Contact Form Setting Add/Edit
function onContactFormSettingAddEdit() {
	var method = $("#saveContactFormSettingId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_7').serialize(),
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


//Form Submit 8 (Google Map Tab 8)
jQuery('#DataEntry_formId_8').parsley({
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
                onGoogleMapAddEdit();
                return false;
            }
        }
    }
});

//Google Map Add/Edit
function onGoogleMapAddEdit() {
	var method = $("#saveGoogleMapId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_8').serialize(),
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
