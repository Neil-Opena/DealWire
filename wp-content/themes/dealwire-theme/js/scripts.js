jQuery(document).ready(function() {
	if (jQuery('li.filter_choice a').hasClass('active')) {
		jQuery('li.filter_choice a.active').parent('li').prependTo('ul.filter-menu');
	}
});


//adds dropdown mobile tap

$$('.filter-menu').tap( function() {
	$$(this).toggleClass('mobile-dd');
});