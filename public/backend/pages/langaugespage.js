"use strict";

var $ = jQuery.noConflict();
var RecordId = '';
var language_code = '';
var onDataTableLangauge;
var onDataTableLangaugeKeywords;
var initload = 0;

function onLangaugeCombo() {
	var method = $("#getLangaugeComboId").val();
    $.ajax({
		type: "POST",
		url: method,
		data:{},
		cache: false,
		dataType: 'json',
		success: function(dataResult){
			var datalist = dataResult.data;
			var html = '';
			var languageDefault = '';
			$.each(datalist, function (key, obj) {
				if(obj.language_default == 1){
					languageDefault = obj.language_code;
				}
				html += '<option value="' + obj.language_code + '">' + obj.language_name + '</option>';
			});
			
			$("#LangaugeComboId").html(html);
			$("#LangaugeComboId").chosen();
			$("#LangaugeComboId").val(languageDefault).trigger("chosen:updated");
			
			loadDataTableLangaugeKeywords();
			
			//Preloader and content
			$('#tw-content').show();
			$('#tw-loader').hide();
        }
    });
}

(function ($) {
	"use strict";
	
	$('#tw-content').hide();
	
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
		
		//DataTable Columns Adjust
		$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
		
	});

	//Langauge
 	onDataTableLangauge = $('#DataTable_LangaugeId').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		bSort: false,
		language: {
			url: DataTableLanFile
		},		
		ajax: {
			url: $("#getLangaugeDataId").val(),
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
				data: 'language_code',
				name: 'language_code',
				orderable: false,
				sWidth: "20%"
			}, {
				data: 'language_name',
				name: 'language_name',
				orderable: false,
				sWidth: "40%"
			},{
				data: null,
				sWidth: "20%",
				className: "text-center",
				searchable: false,
				orderable: false,
				render: function (data, type, row, meta) {
					if(data.language_default == 1){
						return '<span class="enable_btn">Enable</span>';
					}else{
						return '<span class="disable_btn">Disable</span>';
					}
				}
			},{
				data: null,
				sWidth: "15%",
				className: "text-center",
				searchable: false,
				orderable: false,
				render: function (data, type, row, meta) {
					if(data.language_code == 'en'){
						return "<a class='editIconBtn' title='"+langtext.Edit+"' href='javascript:void(0);'><i class='fa fa-edit'></i></a>"
					}else{
						return "<a class='editIconBtn' title='"+langtext.Edit+"' href='javascript:void(0);'><i class='fa fa-edit'></i></a>"
							+ "<a class='deleteIconBtn' title='"+langtext.Delete+"' href='javascript:void(0);'><i class='fa fa-remove'></i></a>"; 
					}
				}
			}
		]
	});
	
	//Langauge Edit/Delete Action
	$('#DataTable_LangaugeId').on('click', 'tr', function (e) {
		e.preventDefault();
		var cColumn = e.originalEvent.target;
		var className = cColumn.className;

		if ((className == 'editIconBtn')||(className == 'fa fa-edit')){
			var data = onDataTableLangauge.row(this).data();
			
			RecordId = data.id;
			$("#RecordId").val(data.id);
			$("#old_language_code").val(data.language_code);
			
			var msg = langtext.Do_you_really_want_to_edit_this_record;
			onCustomModal(msg, "onEditPanelTab_1");
		}
		
		if((className=='deleteIconBtn')||(className=='fa fa-remove')){
			var data = onDataTableLangauge.row( this ).data();
			
			RecordId = data.id; 
			language_code = data.language_code; 
			
			var msg = langtext.Do_you_really_want_to_delete_this_record;	                	  
			onCustomModal(msg, "onDeleteLangauge");
		}
	});
	
	onLangaugeCombo();
	
	$('#LangaugeComboId').change(function () {
		$("#DataTable_LangaugeKeywordsId").dataTable().fnDraw();
	});
	
})(jQuery);

//Language Keywords
function loadDataTableLangaugeKeywords() {

	if(initload > 0){
		$("#DataTable_LangaugeKeywordsId").dataTable().fnDraw();
	}
	
	if(initload == 0){
		onDataTableLangaugeKeywords = $('#DataTable_LangaugeKeywordsId').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			bSort: false,
			language: {
				url: DataTableLanFile
			},			
			ajax: {
				url: $("#getLanguagekeywordDataId").val(),
				dataType: "json",
				type: "POST",
                data: function (data) {
					data.language_code = $('#LangaugeComboId').val()
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
					data: 'language_keywords',
					name: 'language_keywords',
					orderable: false,
					sWidth: "40%"
				}, {
					data: 'language_text',
					name: 'language_text',
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
		
		//Language Keywords Edit/Delete Action
		$('#DataTable_LangaugeKeywordsId').on('click', 'tr', function (e) {
			e.preventDefault();
			var cColumn = e.originalEvent.target;
			var className = cColumn.className;

			if ((className == 'editIconBtn')||(className == 'fa fa-edit')){
				var data = onDataTableLangaugeKeywords.row(this).data();
				
				RecordId = data.id;
				$("#LanguagekeywordId").val(data.id);
				
				var msg = langtext.Do_you_really_want_to_edit_this_record;
				onCustomModal(msg, "onEditPanelTab_2");
			}
			
			if((className=='deleteIconBtn')||(className=='fa fa-remove')){
				var data = onDataTableLangaugeKeywords.row( this ).data();
				
				RecordId = data.id;
				language_code = data.language_code;
				
				var msg = langtext.Do_you_really_want_to_delete_this_record;	                	  
				onCustomModal(msg, "onDeleteLangaugeKeywords");
			}
		});
		
		initload++;
	}
}

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
	$('.filter').show();
}

//Data Entry Form Panel
function onFormPanel(id) {
    resetForm("DataEntry_formId_"+id);
	RecordId = '';
	$("#RecordId").val('');
	$("#old_language_code").val('');
    $('#list-panel-tabid-'+id+', .btn-form').hide();
    $('#form-panel-tabid-'+id+', .btn-list').show();
    $('.filter').hide();
	$('#language_code').prop('readonly', false);
	$('#language_keywords').prop('readonly', false);
}

//Data Edit Form Panel
function onEditPanel(id) {
    $('#list-panel-tabid-'+id+', .btn-form').hide();
    $('#form-panel-tabid-'+id+', .btn-list').show();
	$('#language_code').prop('readonly', true);
	$('#language_keywords').prop('readonly', true);
	$('.filter').hide();
}

//Error Show
function showPerslyError() {
    $('.parsley-error-list').show();
}

//Form Submit 1 (Langauge Tab 1)
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
                onLangaugeAddEdit();
                return false;
            }
        }
    }
});

//Langauge Tab 1
function onLangaugeAddEdit() {
	var method = $("#saveLangaugeId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_1').serialize(),
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
				
				$("#DataTable_LangaugeId").dataTable().fnDraw();
				
				onLangaugeCombo();
				
				//Langauge Tab 1
				onListPanel(1);
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Data Edit Form Panel For Tab 1
function onEditPanelTab_1() {
	onLoadLangaugeEditData();
}

function onLoadLangaugeEditData() {
	var method = $("#LangaugeById").val();
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

			$("#RecordId").val(datalist.id);
			if(datalist.language_code != null){
				$("#language_code").val(datalist.language_code);
				$("#old_language_code").val(datalist.language_code);
			}else{
				$("#language_code").val('');
				$("#old_language_code").val('');
			}
			
			if(datalist.language_name != null){
				$("#language_name").val(datalist.language_name);
			}else{
				$("#language_name").val('');
			}
			
			if (datalist.language_default == 1) {
				document.getElementById("language_default").checked = true;
			} else {
				document.getElementById("language_default").checked = false;
			}
			
			//Langauge Tab 1
			onEditPanel(1);
        }
    });
}

//Langauge Delete
function onDeleteLangauge() {
	var method = $("#deleteLangaugeId").val();

    $.ajax({
		type: "POST",
		url: method,
		data:{
			id: RecordId,
			language_code: language_code
		},
		cache: false,
		dataType: 'json',
		success: function(response){
            var msgType = response.msgType;
            var msg = response.msg;

            if (msgType == "success") {
				onSuccessMsg(msg);
				$("#DataTable_LangaugeId").dataTable().fnDraw();
				onLangaugeCombo();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Form Submit 2 (Language Keyword Tab 2)
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
                onLanguageKeywordAddEdit();
                return false;
            }
        }
    }
});

//Language Keyword Tab 2
function onLanguageKeywordAddEdit() {
	var method = $("#saveLanguageKeywordId").val();
    $.ajax({
        "type": "POST",
        "url": method,
        "dataType": "json",
        "data": $('#DataEntry_formId_2').serialize()+ '&language_code='+$("#LangaugeComboId").val(),
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
				
				$("#DataTable_LangaugeKeywordsId").dataTable().fnDraw();
				
				//Language Keyword Tab 2
				onListPanel(2);
            } else {
                onErrorMsg(msg);
            }
        }
    });
}

//Data Edit Form Panel For Tab 2
function onEditPanelTab_2() {
	onLoadLanguageKeywordEditData();
}

function onLoadLanguageKeywordEditData() {
	var method = $("#LanguageKeywordById").val();
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

			$("#LanguagekeywordId").val(datalist.id);
			if(datalist.language_keywords != null){
				$("#language_keywords").val(datalist.language_keywords);
			}else{
				$("#language_keywords").val('');
			}
			
			if(datalist.language_text != null){
				$("#language_text").val(datalist.language_text);
			}else{
				$("#language_text").val('');
			}
				
			//LanguageKeyword Tab 2
			onEditPanel(2);
        }
    });
}

//Langauge Keywords Delete
function onDeleteLangaugeKeywords() {
	var method = $("#deleteLangaugeKeywordsId").val();

    $.ajax({
		type: "POST",
		url: method,
		data:{
			id: RecordId,
			language_code: language_code
		},
		cache: false,
		dataType: 'json',
		success: function(response){
            var msgType = response.msgType;
            var msg = response.msg;

            if (msgType == "success") {
				onSuccessMsg(msg);
				$("#DataTable_LangaugeKeywordsId").dataTable().fnDraw();
            } else {
                onErrorMsg(msg);
            }
        }
    });
}