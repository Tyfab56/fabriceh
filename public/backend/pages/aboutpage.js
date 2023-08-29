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

    $("#load_your_photo").on('change', function() {
		your_photo_upload_form();
    });
	
    $("#load_download_cv").on('change', function() {
		load_cv_upload_form();
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
		if(tabid != 1){
			//DataTable Columns Adjust
			$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
		}
	});

	//Education
 	onDataTableEducation = $('#DataTable_EducationId').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		bSort: false,
		language: {
			url: DataTableLanFile
		},		
		ajax: {
			url: $("#getEducationId").val(),
			dataType: "json",
			type: "POST",
			data:{
				category: $("#category_education").val()
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
	
	//Education Edit/Delete Action
	$('#DataTable_EducationId').on('click', 'tr', function (e) {
		e.preventDefault();
		var cColumn = e.originalEvent.target;
		var className = cColumn.className;

		if ((className == 'editIconBtn')||(className == 'fa fa-edit')){
			var data = onDataTableEducation.row(this).data();
			
			RecordId = data.id;

			var msg = langtext.Do_you_really_want_to_edit_this_record;
			onCustomModal(msg, "onEditPanelTab_2");
		}
		
		if((className=='deleteIconBtn')||(className=='fa fa-remove')){
			var data = onDataTableEducation.row( this ).data();
			
			RecordId = data.id; 
			
			var msg = langtext.Do_you_really_want_to_delete_this_record;	                	  
			onCustomModal(msg, "onDeleteEducation");
		}
	});
	
	//Experience
 	onDataTableExperience = $('#DataTable_ExperienceId').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		bSort: false,
		language: {
			url: DataTableLanFile
		},		
		ajax: {
			url: $("#getExperienceId").val(),
			dataType: "json",
			type: "POST",
			data:{
				category: $("#category_experience").val()
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
	
	//Experience Edit/Delete Action
	$('#DataTable_ExperienceId').on('click', 'tr', function (e) {
		e.preventDefault();
		var cColumn = e.originalEvent.target;
		var className = cColumn.className;

		if ((className == 'editIconBtn')||(className == 'fa fa-edit')){
			var data = onDataTableExperience.row(this).data();
			
			RecordId = data.id;

			var msg = langtext.Do_you_really_want_to_edit_this_record;
			onCustomModal(msg, "onEditPanelTab_3");
		}
		
		if((className=='deleteIconBtn')||(className=='fa fa-remove')){
			var data = onDataTableExperience.row( this ).data();
			
			RecordId = data.id; 
			
			var msg = langtext.Do_you_really_want_to_delete_this_record;	                	  
			onCustomModal(msg, "onDeleteExperience");
		}
	});
		
	//My Skills
 	onDataTableMySkills = $('#DataTable_MySkillsId').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		bSort: false,
		language: {
			url: DataTableLanFile
		},		
		ajax: {
			url: $("#getMySkillsId").val(),
			dataType: "json",
			type: "POST",
			data:{
				category: $("#category_MySkills").val()
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
	
	//My Skills Edit/Delete Action
	$('#DataTable_MySkillsId').on('click', 'tr', function (e) {
		e.preventDefault();
		var cColumn = e.originalEvent.target;
		var className = cColumn.className;

		if ((className == 'editIconBtn')||(className == 'fa fa-edit')){
			var data = onDataTableMySkills.row(this).data();
			
			RecordId = data.id;

			var msg = langtext.Do_you_really_want_to_edit_this_record;
			onCustomModal(msg, "onEditPanelTab_4");
		}
		
		if((className=='deleteIconBtn')||(className=='fa fa-remove')){
			var data = onDataTableMySkills.row( this ).data();
			
			RecordId = data.id; 
			
			var msg = langtext.Do_you_really_want_to_delete_this_record;	                	  
			onCustomModal(msg, "onDeleteMySkills");
		}
	});
	
	//Get About Data
	getAboutData();
	
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

//Your CV upload
function load_cv_upload_form() {
	FileUpload = $("#FileAttachmentId").val();

	var data = new FormData();
		data.append('FileName', $('#load_download_cv')[0].files[0]);
	var ReaderObj = new FileReader();
	var imgname  =  $('#load_download_cv').val();
	var size  =  $('#load_download_cv')[0].files[0].size;
	var ext =  imgname.substr((imgname.lastIndexOf('.') +1));

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
				$("#download_cv_show").html('<a target="_blank" href="'+public_path+'/media/'+filename+'">'+public_path+'/media/'+filename+'</a>');
				$("#download_cv").val(filename);
				$("#download_cv_errorMgs").hide();
				$("#download_cv_errorMgs").html('');
				
			} else {
				$("#download_cv_show").html('');
				$("#download_cv").val('');
				$("#download_cv_errorMgs").show();
				$("#download_cv_errorMgs").html(msg);
			}
		},
		error: function(){
			return false;
		}	        
	});
}

//Form Submit 1 (About Tab 1)
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
                onAboutAddEdit();
                return false;
            }
        }
    }
});

//About Add/Edit
function onAboutAddEdit() {
	var method = $("#saveAboutId").val();
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
				getAboutData();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Get About Data
function getAboutData() {
	
	var method = $("#AboutId").val();
	var category = $("#category_about").val();
	
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
					$("#about_title").val(post_title);
				}else{
					$("#about_title").val('');
				}
				
				if(obj.description != null){
					$('#about_description').val(obj.description);
				}else{
					$('#about_description').val('');
				}
				
				if(obj.name != null){
					$("#about_name").val(obj.name);
				}else{
					$("#about_name").val('');
				}
				
				if(obj.email != null){
					$("#about_email").val(obj.email);
				}else{
					$("#about_email").val('');
				}
				
				if(obj.skype != null){
					$("#about_skype").val(obj.skype);
				}else{
					$("#about_skype").val('');
				}
				
				if(obj.phone != null){
					$("#about_phone").val(obj.phone);
				}else{
					$("#about_phone").val('');
				}
				
				if(obj.experience != null){
					$("#about_experience").val(obj.experience);
				}else{
					$("#about_experience").val('');
				}
				
				if(obj.address != null){
					$("#about_address").val(obj.address);
				}else{
					$("#about_address").val('');
				}
				
				if(obj.hire_me != null){
					$("#about_hire_me").val(obj.hire_me);
				}else{
					$("#about_hire_me").val('');
				}

				var your_photo = obj.your_photo;
				if(your_photo != null){
					$("#your_photo").val(your_photo);
					$("#your_photo_show").html('<img src="'+public_path+'/media/'+your_photo+'">');
				}else{
					$("#your_photo").val('');
					$("#your_photo_show").html('');
				}
				
				var download_cv = obj.download_cv;
				if(download_cv != null){
					$("#download_cv").val(download_cv);
					$("#download_cv_show").html('<a target="_blank" href="'+public_path+'/media/'+download_cv+'">'+public_path+'/media/'+download_cv+'</a>');
				}else{
					$("#download_cv").val('');
					$("#download_cv_show").html('');
				}
				
			}else{
				$("#about_title").val('');
				$('#about_description').val('');
				$("#about_name").val('');
				$("#about_email").val('');
				$("#about_skype").val('');
				$("#about_phone").val('');
				$("#about_experience").val('');
				$("#about_address").val('');
				$("#about_hire_me").val('');
				$("#your_photo").val('');
				$("#your_photo_show").html('');			
				$("#download_cv").html('');			
				$("#download_cv_show").val('');
			}
			
			//Preloader and content
			$('#tw-content').show();
			$('#tw-loader').hide();
        }
    });
}

//Form Submit 2 (Education Tab 2)
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
                onEducationAddEdit();
                return false;
            }
        }
    }
});

//Education Tab 2
function onEducationAddEdit() {
	var method = $("#saveEducationId").val();
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
				
				$("#DataTable_EducationId").dataTable().fnDraw();
				
				//Education Tab 2
				onListPanel(2);
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Data Edit Form Panel For Tab 2
function onEditPanelTab_2() {
	onLoadEducationEditData();
}

function onLoadEducationEditData() {
	
	var method = $("#EducationById").val();
	
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
			var obj = JSON.parse(datalist.post_content);

			$("#Record_educationId").val(datalist.id);
			$("#education_title").val(datalist.post_title);
			if(obj != null){
				$("#education_year").val(obj.year);
				$("#education_description").val(obj.description);
			}else{
				$("#education_year").val('');
				$("#education_description").val('');
			}
			
			//Education Tab 2
			onEditPanel(2);
        }
    });
}

//Education Delete
function onDeleteEducation() {
	var method = $("#deleteEducationId").val();
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
				$("#DataTable_EducationId").dataTable().fnDraw();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Form Submit 3 (Experience Tab 3)
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
                onExperienceAddEdit();
                return false;
            }
        }
    }
});

//Experience Tab 3
function onExperienceAddEdit() {
	var method = $("#saveExperienceId").val();
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
				
				$("#DataTable_ExperienceId").dataTable().fnDraw();
				
				//Experience Tab 3
				onListPanel(3);
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Data Edit Form Panel For Tab 3
function onEditPanelTab_3() {
	onLoadExperienceEditData();
}

function onLoadExperienceEditData() {
	
	var method = $("#ExperienceById").val();
	
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
			var obj = JSON.parse(datalist.post_content);

			$("#Record_ExperienceId").val(datalist.id);
			$("#experience_title").val(datalist.post_title);
			if(obj != null){
				$("#experience_year").val(obj.year);
				$("#experience_description").val(obj.description);
			}else{
				$("#experience_year").val('');
				$("#experience_description").val('');
			}
			
			//Experience Tab 3
			onEditPanel(3);
        }
    });
}

//Experience Delete
function onDeleteExperience() {
	var method = $("#deleteExperienceId").val();
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
				$("#DataTable_ExperienceId").dataTable().fnDraw();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Form Submit 4 (My Skills Tab 4)
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
                onMySkillsAddEdit();
                return false;
            }
        }
    }
});

//My Skills Tab 4
function onMySkillsAddEdit() {
	var method = $("#saveMySkillsId").val();
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
				
				$("#DataTable_MySkillsId").dataTable().fnDraw();
				
				//My Skills Tab 4
				onListPanel(4);
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Data Edit Form Panel For Tab 4
function onEditPanelTab_4() {
	onLoadMySkillsEditData();
}

function onLoadMySkillsEditData() {
	
	var method = $("#MySkillsById").val();
	
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
			var obj = JSON.parse(datalist.post_content);

			$("#Record_MySkillsId").val(datalist.id);
			$("#skill_title").val(datalist.post_title);
			if(obj != null){
				$("#skill_percentage").val(obj.percentage);
			}else{
				$("#skill_percentage").val('');
			}
			
			//My Skills Tab 4
			onEditPanel(4);
        }
    });
}

//My Skills Delete
function onDeleteMySkills() {
	var method = $("#deleteMySkillsId").val();
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
				$("#DataTable_MySkillsId").dataTable().fnDraw();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}
