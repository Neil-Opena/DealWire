<?php
global $post;
do_action('id_social_sharing_before');
if (isset($social_settings['social_checks']['prod_page_fb'])) {
	echo '<div id="fb-root"></div><div id="share-fb" class="fb-share-button social-share social-button" data-href="'.(!empty($post_id) ? get_permalink($post_id) : get_permalink($post->ID)).'"data-layout="button_count"></div>';
}
if (isset($social_settings['social_checks']['prod_page_twitter'])) {
	//$post_output .= '<div style="float:right;"><a href="http://twitter.com/share" target="_new" class="twitter-share-button button twitter" data-count="vertical">tweet</a></div>';
	echo '<div id="share-twitter" class="social-share social-button"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.(!empty($post_id) ? get_permalink($post_id) : get_permalink($post->ID)).'">'.__('Tweet', 'idsocial').'</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>';
}
if (isset($social_settings['social_checks']['prod_page_linkedin'])) {
	
	echo '<div id="share-linkedin" class="social-share social-button"><script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
	<script type="IN/Share" data-url="'.(!empty($post_id) ? get_permalink($post_id) : get_permalink($post->ID)).'"></script></div>';
}
if (isset($social_settings['social_checks']['prod_page_google'])) {
	
	echo '<div id="share-google" class="social-share social-button"><span class="g-plus" data-action="share" data-href="'.(!empty($post_id) ? get_permalink($post_id) : get_permalink($post->ID)).'" data-annotation="none"><script src="https://apis.google.com/js/platform.js" async defer></script></span></div>';
}
if (isset($social_settings['social_checks']['prod_page_pinterest'])) {
	
	echo '<div id="share-pinterest" class="social-share social-button"><a href="https://www.pinterest.com/pin/create/button/?url='.(!empty($post_id) ? get_permalink($post_id) : get_permalink($post->ID)).'&media='.(get_the_post_thumbnail(isset($post_id) ? $post_id : $post->ID)).'&description='.(isset($description) ? urlencode($description) : null).'" data-pin-do="buttonPin" data-pin-save="true"></a><script async defer src="//assets.pinterest.com/js/pinit.js"></script></div>';
}

do_action('id_social_sharing_after');
?>