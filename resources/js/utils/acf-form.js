//Label Animation
// $(".acf-field-text .acf-input-wrap input, .acf-field-textarea textarea").on("focus", function () {
// 	$(this)
// 		.closest(".acf-field")
// 		.find(".acf-label label")
// 		.addClass("label-upward");
// });
// $(".acf-field-text .acf-input-wrap input, .acf-field-textarea textarea").on("blur", function () {
// 	if ($(this).val() === "") {
// 		$(this)
// 			.closest(".acf-field")
// 			.find(".acf-label label")
// 			.removeClass("label-upward");
// 	}
// });

$('.hero--content--text > a').click(function(e) {
	e.preventDefault();

	$('html, body').animate({
		scrollTop: $('#content').offset().top - 250
	}, 300);
});

$('.menu-list > li > a').click(function(e){
	e.preventDefault();

	var _href = $(this).data('href');
	var _fields = $('.acf-field-group');
	var _sticky_menu = $('.sticky--menu');

	$('.menu-list > li > a').removeClass('active');
	$(this).addClass('active');

	if( _href === 'all' ) {
		_fields.fadeIn();
		_sticky_menu.fadeIn();
	}
	else {
		_fields.each(function() {
		
			if( $(this).data('key') != _href ) {
				$(this).fadeOut();
			}
			else {
				$(this).fadeIn();
			}
		});
		_sticky_menu.fadeOut();
	}
});