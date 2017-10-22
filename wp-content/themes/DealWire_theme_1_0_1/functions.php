<?php
function classic_init() {
	load_child_theme_textdomain('fivehundred', get_template_directory().'/languages/');
}

add_action('after_setup_theme', 'classic_init');
add_action('after_setup_theme', 'classic_setup');

function classic_setup() {
	add_filter('fh_customization_style', 'classic_color_styles');
}


// Add Google Fonts
function load_fonts() {
    wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,900|PT+Serif:400,700,400italic');
    wp_enqueue_style( 'googleFonts');

}

function child_add_scripts() {
	wp_register_script(
		'quo', 
		get_stylesheet_directory_uri() .'/js/quo.js'
	);

	wp_register_script(
        'scripts',
        get_stylesheet_directory_uri() . '/js/scripts.js',
        array( 'jquery' ),
        '1.0',
        true
    );

    wp_enqueue_script('quo');
    wp_enqueue_script( 'scripts' );
}

add_action('wp_print_styles', 'load_fonts');
add_action( 'wp_enqueue_scripts', 'child_add_scripts' );

function classic_extra_fields() {
	global $wpdb;
	$projects = get_ign_projects();
	//print_r($res);
	$options = get_option('fivehundred_featured');
	if ($options) {
		$post_id = $options['post_id'];
		$project_id = $options['project_id'];
	}
	if (isset($_POST['submit-theme-settings'])) {
		if (isset($_POST['choose-featured'])) {
			$project_id = $_POST['choose-featured'];
			$get_id = $wpdb->prepare('SELECT post_id FROM '.$wpdb->prefix.'postmeta WHERE meta_key ="ign_project_id" AND meta_value = %d', $project_id);
			$return_id = $wpdb->get_row($get_id);
			$post_id = $return_id->post_id;
			if ($post_id) {
				$options = array(
					'post_id' => $post_id,
					'project_id' => $project_id);
				update_option('fivehundred_featured', $options);
			}
		}
		else {
			delete_option('fivehundred_featured');
		}
	}
	

	$output = '<tr>
					<td>
						<label for="choose-featured">'.__('Featured Project on Home Page', 'fivehundred').'</label><br/>
						<select id="choose-featured" name="choose-featured">
							<option>'.__('Choose Post to Feature', 'fivehundred').'</option>';
	foreach ($projects as $project) {
		$selected = null;
		if (isset($project_id) && $project_id == $project->id) {
			$selected = 'selected="selected"';
		}
		$output .= '<option value="'.$project->id.'" '.(isset($selected) ? $selected : '').'>'.$project->product_name.'</option>';
	}
	$output .='				</select>
					</td>
				</tr>';
	echo $output;
}

//add_action('fivehundred_extra_fields', 'classic_extra_fields');


//Custom image sizes
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'blog-thumb', 130, 130, true ); //(cropped)
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '">...Read more</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Color Customization

function classic_color_styles($css) {
	$primary_color = get_option('fh_primary_color');
	$primary_light_color = get_option('fh_primary_light_color');
	$primary_dark_color = get_option('fh_primary_dark_color');
	$secondary_color = get_option('fh_secondary_color');
	$secondary_dark_color = get_option('fh_secondary_dark_color');
	$text_color = get_option('fh_text_color');
	$text_subtle_color = get_option('fh_text_subtle_color');
	$text_onprimary_color = get_option('fh_text_onprimary_color');
	$site_background_color = get_option('fh_site_background_color');
	$container_background_color = get_option('fh_container_background_color');

	$customized = false;
	if (!empty($primary_color) || !empty($primary_light_color) || !empty($primary_dark_color) || !empty($secondary_color) || !empty($secondary_dark_color) || !empty($text_color) || !empty($text_subtle_color) || !empty($text_onprimary_color) || !empty($site_background_color) || !empty($container_background_color)) {
		$customized = true;
	}
	if ($customized) {
		// Convert Sidebar from Hex to RGB
		if ( !empty($primary_color) && $primary_color !== '#3B7BB3') {
			$hexs = str_replace("#", "", $primary_color);

			if (strlen($hexs) == 3) {
				$rs = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gs = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bs = hexdec(substr($hexs,2,1).substr($hexs,2,1));

			}
			else {
				$rs = hexdec(substr($hexs,0,2));
				$gs = hexdec(substr($hexs,2,2));
				$bs = hexdec(substr($hexs,4,2));
			}
		}
		if ( !empty($text_color) && $text_color !== '#3B7BB3') {
			$hexs = str_replace("#", "", $text_color);

			if (strlen($hexs) == 3) {
				$rt = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gt = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bt = hexdec(substr($hexs,2,1).substr($hexs,2,1));

			}
			else {
				$rt = hexdec(substr($hexs,0,2));
				$gt = hexdec(substr($hexs,2,2));
				$bt = hexdec(substr($hexs,4,2));
			}
		}
		if (!empty($site_background_color) && $site_background_color !== '#F1F4F7') {
			$hexs = str_replace("#", "", $site_background_color);

			if (strlen($hexs) == 3) {
				$rb = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gb = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bb = hexdec(substr($hexs,2,1).substr($hexs,2,1));
			}
			else {
				$rb = hexdec(substr($hexs,0,2));
				$gb = hexdec(substr($hexs,2,2));
				$bb = hexdec(substr($hexs,4,2));
			} 
		}
		if (!empty($container_background_color) && $container_background_color !== '#F1F4F7') {
			$hexs = str_replace("#", "", $container_background_color);

			if (strlen($hexs) == 3) {
				$rc = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gc = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bc = hexdec(substr($hexs,2,1).substr($hexs,2,1));
			}
			else {
				$rc = hexdec(substr($hexs,0,2));
				$gc = hexdec(substr($hexs,2,2));
				$bc = hexdec(substr($hexs,4,2));
			} 
		}
		$css = 
		'<style>
			html, body { background: '.$primary_color.'; background: -moz-linear-gradient(left,  '.$primary_color.' 0%, '.$secondary_color.' 46%, '.$secondary_color.' 46%, '.$primary_color.' 100%); 		background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.$primary_color.'), color-stop(46%,'.$secondary_color.'), color-stop(46%,'.$secondary_color.'), color-stop(100%,'.$primary_color.'));	background: -webkit-linear-gradient(left,  '.$primary_color.' 0%,'.$secondary_color.' 46%,'.$secondary_color.' 46%,'.$primary_color.' 100%); 		background: -o-linear-gradient(left,  '.$primary_color.' 0%,'.$secondary_color.' 46%,'.$secondary_color.' 46%,'.$primary_color.' 100%); background: -ms-linear-gradient(left,  '.$primary_color.' 0%,'.$secondary_color.' 46%,'.$secondary_color.' 46%,'.$primary_color.' 100%); background: linear-gradient(to right,  '.$primary_color.' 0%,'.$secondary_color.' 46%,'.$secondary_color.' 46%,'.$primary_color.' 100%); }
			.featured-info .ign-progress-bar, #content .ign-project-summary .ign-progress-bar { background: '.$primary_color.'; background: -moz-linear-gradient(left,  '.$primary_color.' 0%, '.$secondary_color.' 100%); 		background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.$primary_color.'), color-stop(100%,'.$secondary_color.')); background: -webkit-linear-gradient(left,  '.$primary_color.' 0%,'.$secondary_color.' 100%); background: -o-linear-gradient(left,  '.$primary_color.' 0%,'.$secondary_color.' 100%); background: -ms-linear-gradient(left,  '.$primary_color.' 0%,'.$secondary_color.' 100%); background: linear-gradient(to right,  '.$primary_color.' 0%,'.$secondary_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='.$primary_color.', endColorstr=#'.$secondary_color.',GradientType=1 ); }
			body a, .single-ignition_product .featured-inner .featured-item.project-ct-dollar, .featured-info .featured-button-share, #content #home-sharing ul li a, #content #home-sharing ul li.ign-more-projects, #content #home-sharing ul li.ign-more-projects a, #ign-project-content #updateslink h3 span, #ign-project-content #faqlink h3 span, #content h2.entry-title, .nav-previous a, .nav-next a, #menu-header ul li ul.sub-menu li a:hover, #menu-header ul.defaultMenu li ul.children li a:hover, #menu-header .menu ul li ul.children li a:hover, .featured-wrap .video.hasvideo:hover:after, #content .ign-project-summary .title h3:hover, #ign-product-levels .ign-level-counts, #content .ign-project-summary .ign-summary-days strong, .idc_lightbox .form_header  { color: '.$primary_color.' !important;}
			.featured-info .featured-button, .single-ignition_product .ignitiondeck.idc_lightbox .lb_wrapper .form .form-row.submit input[type=submit], .ign-supportnow.mobile, #menu-header .menu li.login:hover, #menu-header .menu li.createaccount:hover, .ignitiondeck form .form-row .idc-dropdown:before {background-color: '.$primary_color.' !important;}
			.project-sidebar .level-group, .featured-info .featured-button-share, #share-popup {border-color: '.$primary_color.';}
			'.(isset($rs) ? '.featured-wrap .video.hasvideo:after { color: rgba(' . $rs . ',' . $gs . ', ' . $bs . ', .5); } ' : '').
			'
			'.(isset($rs) ? '.#container .fullwindow-internal, #container .ign-content-alert { background-color: rgba(' . $rs . ',' . $gs . ', ' . $bs . ', .5); } ' : '').
			'
			body a:hover, body a:active, #content #home-sharing ul li a:hover, .nav-previous a:hover, .nav-next a:hover  { color: '.$primary_light_color.' !important; }
			.featured-inner .featured-item { color: '.$primary_dark_color.'; }
			.featured-button .icon-arrow-right, .single-ignition_product .ignitiondeck.idc_lightbox .form-row.submit:before, .ignitiondeck.idc_lightbox .form-row.submit input[type=submit], #fivehundred .ignitiondeck.idc_lightbox .form-row.submit input[type=submit] { background-color: '.$primary_dark_color.' !important; }
			.ign-project-summary .project-tag, #content p {
				color: '.$text_color.';
			}
.featured-info .featured-button, #menu-header .menu li.login:hover a, #menu-header .menu li.createaccount:hover a, #container .fullwindow-internal, #container .ign-content-alert, #container .contentwide .ign-content-fullalt h3, #container .contentwide .constrained, .featured-info .featured-button:hover .icon-arrow-right, .single-ignition_product .ignitiondeck form .form-row .idc-dropdown:after, .ignitiondeck.idc_lightbox .form-row.submit:after, .ignitiondeck.idc_lightbox .form-row.submit input[type=submit]:hover, #fivehundred .ignitiondeck.idc_lightbox .form-row.submit input[type=submit]:hover, .ignitiondeck.idc_lightbox .form-row.submit input[type=submit], #fivehundred .ignitiondeck.idc_lightbox .form-row.submit input[type=submit], .ignitiondeck form .form-row .idc-dropdown::after, .ignitiondeck form .form-row.pretty_dropdown::after,  
.ignition_project .project-tag-single a  { color: '.$text_onprimary_color.' !important; }
			#menu-header .menu li.login, #menu-header .menu li.createaccount { background-color: '.$text_onprimary_color.'; }

			#content .ign-project-summary .ign-summary-container:hover, .project-sidebar .level-group:hover { border-color: '.$secondary_color.';}

			header#header, #wrapper, .single-ignition_product #containerwrapper.containerwrapper, .single-ignition_product .containerwrapper, .single-ignition_product .entry-title, #ign-project-content #sidebar.project-sidebar #ign-product-levels, .home #content h2.entry-title, .home .containerwrapper-home, .widget-area .widget-container h3, .featured-info .featured-button:hover, .featured-info .ign-progress-wrapper, #content .ign-project-summary .ign-progress-wrapper, .archive #content h2.entry-title, .grid-header .swap, .grid-header .filter-menu, .grid-header .filter-menu li a, .grid-header ul li a.active, #menu-header ul.menu ul.sub-menu, #menu-header div.menu ul.defaultMenu ul.children, #menu-header .menu ul ul.children, .idc_lightbox {background-color: '.$site_background_color.' !important;}
			footer, .single-ignition_product #site-description h1, .single-ignition_product #site-description h2, #menu-footer ul.menu li a:hover, #menu-footer ul.menu li a, .footer_widgets .footer-widget-container h3, .footer_widgets .footer-widget-container, .footer_widgets .footer-widget-container a, footer #copyright, footer #copyright a { color: '.$site_background_color.' !important; }
			ul.content_tabs { color: '.$container_background_color.'; }
			.breakout-out .breakout-in, .hDeck-head .featured-item, .project-sidebar #ign-product-levels .ign-level-title, #menu-header ul li ul.sub-menu li a:hover, #menu-header ul.defaultMenu li ul.children li a:hover, #menu-header .menu ul li ul.children li a:hover { background-color: '.$container_background_color.'; }
			'.(isset($rc) ? '.project-sidebar #ign-product-levels .level-group:hover .ign-level-title, #content .ign-project-summary .ign-summary-container, .home #content .more-hr, .home #content .entry-title-hr, .archive #content .entry-title-hr, .grid-header .filter-menu li a:hover, #ign-project-content h3.product-dashed-heading, #ign-project-content h3.product-dashed-heading1, .blog-header { background-color: rgba(' . $rc . ',' . $gc . ', ' . $bc . ', .5) !important; }' : '').
			'
			'.(isset($rc) ? '.project-sidebar .level-group, .project-sidebar .level-group:hover, #content .ign-project-summary .ign-summary-container:hover, #fivehundred .ignitiondeck.id-creatorprofile, #ign-project-content #prodfaq, #ign-project-content #produpdates, #ign-project-content #updateslink #produpdates { background-color: rgba(' . $rc . ',' . $gc . ', ' . $bc . ', .3) !important;}' : '').
			'
			'.(isset($rc) ? '#menu-header .menu li.login, #menu-header .menu li.createaccount, div.pagination, .footer_widgets .footer-widget-container h3  { border-color: rgba(' . $rc . ',' . $gc . ', ' . $bc . ', .5) !important; }' : '').
			'


			footer, .cat-sort a:hover, #searchform input#searchsubmit,.single-ignition_product .ignitiondeck form .form-row .idc-dropdown:before, .single-ignition_product #site-description:before  { background-color: '.$text_color.'; }
			body, header #site-title a, header #site-title a h1, .grid-header .filter-menu li a, .grid-header .filter-menu li a:hover, .grid-header ul li a.active, .grid-header ul li.filter_submenu:hover span, #content .ign-project-summary .title h3, .widget-area .widget-container h3, .project-sidebar #ign-product-levels .ign-level-title span, .project-sidebar #ign-product-levels .ign-level-title .level-price, .single-ignition_product .hDeck-head .featured-item, .project-end, .featured-info .featured-button:hover, #menu-header ul.menu li a:hover, ul.menu li a:active, #menu-header ul.defaultMenu li a:hover,  #menu-header ul.defaultMenu li a:active, #menu-header .menu ul li a:active, #fivehundred .ignitiondeck.id-creatorprofile, #ign-project-content h3.product-dashed-heading, #ign-project-content h3.product-dashed-heading1#ign-project-content #faqlink #prodfaq, #ign-project-content #updateslink #produpdates, #content h2.entry-title a, .featured-info h3, .featured-info p, #content .ign-project-summary .ign-summary-desc, #content .ign-project-summary .ign-summary-days, #content .ign-project-summary .ign-progress-percentage, #content .ign-project-summary .ign-progress-raised, #ign-product-levels .ign-level-desc, #ign-project-content h3.product-dashed-heading, #ign-project-content h3.product-dashed-heading1, #ign-project-content #faqlink #prodfaq, #fivehundred .ignitiondeck form .form-row label, .idc_lightbox .text, ul.content_tabs span, ul.content_tabs li.active span, ul.content_tabs li:hover span { color: '.$text_color.' !important; }
			#menu-header .menu ul ul.children, #menu-header ul.menu ul.sub-menu:before, #menu-header div.menu ul.defaultMenu ul.children:before, #menu-header .menu ul ul.children:before { border-color: '.$text_color.' transparent; }
			.grid-header .filter-menu, #menu-header ul.menu ul.sub-menu, #menu-header div.menu ul.defaultMenu ul.children, .grid-header .swap, #content .ign-project-summary .ign-summary-container, #searchform input[type="text"] { border-color: '.$text_color.'; }
			'.(isset($rt) ? '.constrainedwrapper { background-color: rgba(' . $rt . ',' . $gt . ', ' . $bt . ', .9); }' : '').
			'
			'.(isset($rt) ? '.single-ignition_product .featured-wrap .featured-info, .hDeck-head, #fivehundred .ignitiondeck.id-creatorprofile, #ign-project-content h3.product-dashed-heading, #ign-project-content h3.product-dashed-heading1, #ign-project-content #prodfaq, #ign-project-content #produpdates { border-color: rgba(' . $rt . ',' . $gt . ', ' . $bt . ', .3); }' : '').
			'

			 #menu-header ul.menu li.current-menu-item a, #menu-header ul.menu li.current_page_item a, #menu-header ul.menu li.current-menu-ancestor a, 
			 #menu-header .menu ul li.current-menu-ancestor a, #menu-header ul.menu li a, #menu-header ul.defaultMenu li a { 
			 color: '.$text_color.' !important;
			 /* background-color: '.$text_subtle_color.' !important; */ }
			 
			 .memberdeck .md-profile .md-credits span.green, .memberdeck .md-profile .md-credits span, .memberdeck .dashboardmenu a, .memberdeck .dashboardmenu a:visited { color: '.$text_onprimary_color.'; }
				a.comment-reply-link, a.comment-reply-link:hover, a.comment-reply-link:focus, a.comment-reply-link:active, a.comment-reply-link, .ignitiondeck form .main-btn, .ignitiondeck form input[type=submit], a.comment-reply-link, .ignitiondeck form .main-btn, .ignitiondeck form input[type=submit]:hover, .memberdeck .dashboardmenu a, .memberdeck .dashboardmenu a:hover { color: '.$text_subtle_color.'; }
			.memberdeck .md-profile .project-status 
			{background: '.$primary_color.'; background-color: '.$primary_color.' ; color: '.$text_onprimary_color.';}
			.memberdeck .dashboardmenu li:hover, .memberdeck .dashboardmenu li.active a { background-color: '.$primary_dark_color.';
			color: '.$text_onprimary_color.' !important; }
			.memberdeck .dashboardmenu a, .memberdeck .dashboardmenu a:hover { color: '.$text_onprimary_color.' !important; }
			.ignitiondeck form#fes .form-row textarea, .ignitiondeck form .form-row textarea, .ignitiondeck form#fes .form-row input, .ignitiondeck form .form-row input, .ignitiondeck form#fes .form-row .idc-dropdown__select, .ignitiondeck form .form-row .idc-dropdown__select, .ignitiondeck form#fes .form-row.pretty_dropdown select, .ignitiondeck form .form-row.pretty_dropdown select{ background-color: '.$text_subtle_color.';  color: '.$text_onprimary_color.' !important; }
		.ignitiondeck .fes_section h3, .memberdeck .md-profile.paypal-settings h3, .memberdeck .md-profile.mail-chimp h3, .memberdeck .md-profile.stripe-settings h3, .memberdeck form .form-row label, .ignitiondeck form#fes .form-row label, .ignitiondeck form .form-row label{ color:  '.$text_color.'}
		.ignitiondeck form#fes input[type=submit], .ignitiondeck form input[type=submit]{background: '.$primary_color.'; background-color: '.$primary_color.' ; color: '.$text_onprimary_color.'!important;}
		.ignitiondeck form#fes input[type=submit]:hover, .ignitiondeck form input[type=submit]:hover {
			background: '.$primary_dark_color.'; background-color: '.$primary_dark_color.' ; }
			.memberdeck form .form-row input { background-color: '.$text_subtle_color.'; border-color: '.$text_subtle_color.';  color: '.$text_onprimary_color.' !important; }
			.memberdeck form a, .ignitiondeck.backer_profile .backer_data .backer_supported, .memberdeck .md-box table td a i { color: '.$primary_color.'; }
			.memberdeck form a:hover {color: '.$primary_dark_color.';}
			.ignitiondeck.backer_profile .backer_projects li.backer_project_mini .backers_days_left {background-color: '.$primary_color.' ; color: '.$text_onprimary_color.'!important;}
			.ignitiondeck.backer_profile .backer_projects li.backer_project_mini .backers_funded, .memberdeck .md-profile .project-funded { color: '.$primary_color.'; }
			.ignitiondeck.backer_profile .backer_projects li.backer_project_mini .backer_project_title a, .memberdeck .md-profile .project-name { color: '.$text_onprimary_color.' ;}
			
		 .ignition_project #ign-hDeck-right .internal strong, .ignition_project #ign-hDeck-right .internal div, #site-description.project-single span,
	 .ign-project-title .product-author-details i
	  {color: '.$text_onprimary_color.'; }
	 .ignitiondeck form#fes .form-row input, .ignitiondeck form .form-row input {color: '.$container_background_color.' !important;} 
	#ign-project-content .entry-content {background-color: '.$container_background_color.'; color: '.$text_onprimary_color.';}
	.memberdeck .checkout-title-bar span.active {color: '.$text_subtle_color.'; }
	.memberdeck .checkout-title-bar span.active:after {border-bottom-color: '.$primary_color.';}
	.memberdeck .checkout-title-bar span.currency-symbol, {color: '.$primary_dark_color.';}
	.memberdeck form .payment-type-selector a.active, .memberdeck form .payment-type-selector a:hover {border-color: '.$primary_color.';}
	 .memberdeck .checkout-title-bar span.currency-symbol .checkout-tooltip i.tooltip-color { color: '.$primary_color.';}
	 .ignitiondeck form .form-row input, .ignitiondeck form .form-row textarea, .ignitiondeck form .form-row select, #content .ign-project-summary .ign-summary-container, #content .ign-project-summary .ign-summary-container .ign-summary-image, .ignitiondeck .id-purchase-form, .ignitiondeck .dd-select  { border-color: '.$text_subtle_color.';}
		.ign-supportnow a, .memberdeck button, .memberdeck input[type="submit"], .memberdeck form .form-row input[type="submit"], .memberdeck .button {background: '.$primary_color.'; background-color: '.$primary_color.' ;}
		
		.ign-supportnow a:hover, .memberdeck button:hover, .memberdeck input[type="submit"]:hover, .memberdeck form .form-row input[type="submit"]:hover, .memberdeck .button:hover {background: '.$primary_light_color.'; background-color: '.$primary_light_color.' ;}
		
			'
			
		?>
		<?php $css .=
		'</style>';
	}
	return (isset($css) ? $css : '');
}

?>