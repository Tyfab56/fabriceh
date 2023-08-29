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
	
	//Get Contact Data
	getContactData();

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

//Form Submit 1 (Contact Tab 1)
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
                onContactAddEdit();
                return false;
            }
        }
    }
});

//Contact Add/Edit
function onContactAddEdit() {
	var method = $("#saveContactId").val();
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
				getContactData();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Get Contact Data
function getContactData() {
	
	var method = $("#ContactId").val();
	var category = $("#category_contact").val();
	
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
					$("#contact_title").val(post_title);
				}else{
					$("#contact_title").val('');
				}
				
				if(obj.email != null){
					$("#contact_email").val(obj.email);
				}else{
					$("#contact_email").val('');
				}
				
				if(obj.skype != null){
					$("#contact_skype").val(obj.skype);
				}else{
					$("#contact_skype").val('');
				}
				
				if(obj.phone != null){
					$("#contact_phone").val(obj.phone);
				}else{
					$("#contact_phone").val('');
				}
				
				if(obj.address != null){
					$("#contact_address").val(obj.address);
				}else{
					$("#contact_address").val('');
				}
				
			}else{
				$("#contact_title").val('');
				$("#contact_email").val('');
				$("#contact_skype").val('');
				$("#contact_phone").val('');
				$("#contact_address").val('');
			}
			
			//Preloader and content
			$('#tw-content').show();
			$('#tw-loader').hide();
        }
    });
}
