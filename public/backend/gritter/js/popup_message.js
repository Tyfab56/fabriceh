function onSuccessMsg(msg){
	$('.gritter-item p').html(msg);
	$('.gritter-item p, #gritter-notice-wrapper').attr('class','success');		
	onAnimateMsg(msg,'gritter-success','success');
}
function onWarningMsg(msg){
	$('.gritter-item p').html(msg);
	$('.gritter-item p').attr('class','warning');
	$('.gritter-item p, #gritter-notice-wrapper').attr('class','warning');
	onAnimateMsg(msg,'gritter-warning','warning');	
}
function onErrorMsg(msg){
	$('.gritter-item p').html(msg);
	$('.gritter-item p').attr('class','error');
	$('.gritter-item p, #gritter-notice-wrapper').attr('class','error');
	onAnimateMsg(msg,'gritter-danger','error');	
}
function onInfoMsg(msg){
	$('.gritter-item p').html(msg);
	$('.gritter-item p').attr('class','info');
	$('.gritter-item p, #gritter-notice-wrapper').attr('class','info');
	onAnimateMsg(msg,'gritter-info','info');	
}
function onAnimateMsg(msg,class_name,title){		
	$.gritter.add({
		title: '<div class="gritter-title-text"></div>',
		text: msg,
		sticky: false,
		time: 2000,
		class_name: class_name
	});
	return false;
}	
jQuery(function(){		
	jQuery('#lightCustomModal').popup({
			pagecontainer: '.container',
			 transition: 'all 0.3s'
		});
});
function onConfirm(){}
function onCustomModal(msg, onConfirm){
	$('.m-top-none').html(msg);
	$('.lightCustomModal_close.green-btn').attr('onClick', onConfirm + '()')
	$('.lightCustomModal_open').click();
}