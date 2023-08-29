
"use strict";

var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : { allow_single_deselect: true },
  '.chosen-select-no-single' : { disable_search_threshold: 10 },
  '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
  '.chosen-select-rtl'       : { rtl: true },
  '.chosen-select-width'     : { width: '95%' }
}

for (var selector in config) {
  $(selector).chosen(config[selector]);
}

(function ($) {
	"use strict";
	
	//Menu active
	var href = location.href;
	$('.left-main-menu li a').parent().removeClass('active');
	$('.left-main-menu li a[href="' + href + '"]').parent().addClass('active');
	
	$(".sidebar-wrapper").mCustomScrollbar({
		theme: "minimal"
	});	
	
    $("#menu-toggle").on('click', function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
	
})(jQuery);
