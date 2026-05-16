import tippy from 'tippy.js';

tippy('#account-menu', {
    content: 'Account Details',
    placement: 'right'
});

tippy('#introduction-menu', {
    content: 'Introduction',
    placement: 'right'
});

tippy('#content-menu', {
    content: 'Content Notes',
    placement: 'right'
});

tippy('#design-menu', {
    content: 'Design Notes',
    placement: 'right'
});

tippy('#plugins-menu', {
    content: 'Plugins / Other Tools',
    placement: 'right'
});

tippy('#business-menu', {
    content: 'Business Details',
    placement: 'right'
});

tippy('#google-menu', {
    content: 'Google Business Profile',
    placement: 'right'
});

tippy('#domain-menu', {
    content: 'Domain Information',
    placement: 'right'
});

$('.custom-floating-btns a[data-tooltip]').each(function() {
    tippy(this, {
        content: $(this).data('tooltip'),
        placement: 'left',
    });
});

$('.sticky--menu--list li > a').click(function(e){
    e.preventDefault();
    
    var _hash = $(this).attr('href');

    $('html, body').animate({
		scrollTop: $(_hash).offset().top - 150
	}, 300);
})