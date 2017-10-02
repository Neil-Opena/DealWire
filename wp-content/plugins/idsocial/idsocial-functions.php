<?php
function idsocial_app_id() {
	$app_id = '';
	$settings = get_option('idsocial_settings');
	if (!empty($settings)) {
		$app_id = (!empty($settings['app_id']) ? $settings['app_id'] : '');
	}
	return $app_id;
}

function idsocial_fblogin() {
	$success = 0;
	if (isset($_POST['User'])) {
		$fb_user = $_POST['User'];
		$email = $fb_user['email'];
		if (!empty($email)) {
			$wp_user = get_user_by('email', $email);
			if (!empty($wp_user)) {
				if (is_user_logged_in()) {
					update_user_meta( $wp_user->ID, 'idsocial_fb_avatar', 'http://graph.facebook.com/'.$fb_user['id'].'/picture');
					$success = 1;
				}
				else {
					// would be better if we could perform this at beginning of an init hook
					$override = 0;
					if (isset($_POST['Override'])) {
						$override = $_POST['Override'];
					}
					$logged_out = get_transient('idsocial_logout_'.$wp_user->ID);
					if (!$logged_out || $override) {
						$signon = wp_set_auth_cookie($wp_user->ID, true);
						do_action('wp_login', $wp_user->user_login, $wp_user);
					//if (is_user_logged_in ()) {
						$success = 1;
						if ($override) {
							delete_transient('idsocial_logout_'.$wp_user->ID);
						}
					//}
					}
				}
			}
			else {
				// user does not exist
				$user = array(
					'user_login' => $email,
					'user_email' => $email,
					'first_name' => (isset($fb_user['first_name']) ? $fb_user['first_name'] : ''),
					'last_name' => (isset($fb_user['last_name']) ? $fb_user['last_name'] : ''),
					'user_nicename' => $fb_user['name'],
					'nickname' => $fb_user['name'],
					'user_pass' => idf_pw_gen()
					);
				$user_id = wp_insert_user($user);
				update_user_meta($user_id, 'idsocial_fb_avatar', 'http://graph.facebook.com/'.$fb_user['id'].'/picture');
				if ($user_id > 0) {
					do_action('idc_register_success', $user_id, $email);

					$signon = wp_set_auth_cookie($user_id, true);
					$wp_user = get_user_by('id', $user_id);
					do_action('wp_login', $wp_user->user_login, $wp_user);
					//if (is_user_logged_in()) {
						$success = 1;
					//}
				}
			}
		}
	}
	echo $success;
	exit;
}
add_action('wp_ajax_idsocial_fblogin', 'idsocial_fblogin');
add_action('wp_ajax_nopriv_idsocial_fblogin', 'idsocial_fblogin');

function idsocial_logout() {
	$user = wp_get_current_user();
	if (!empty($user)) {
		set_transient('idsocial_logout_'.$user->ID, 1);
	}
}

add_action('clear_auth_cookie', 'idsocial_logout');

function idsocial_delete_user($user_id) {
	delete_transient('idsocial_logout_'.$user_id);
}

add_action('delete_user', 'idsocial_delete_user');

function idsocial_home_image() {
	$social_settings = get_option('idsocial_settings');
	if (!empty($social_settings['home_image'])) {
		$home_image = wp_get_attachment_image_src($social_settings['home_image'], 'idsocial_home_image');
		return (isset($home_image[0]) ? $home_image[0] : null);
	} else {
		return null;
	}
}

function idf_idc_order_sharing_options($last_order) {
	$social_settings = get_option('idsocial_settings');
	if (!empty($social_settings['social_checks'])) {
		if (isset($last_order->id) && $last_order->id > 0) {
			$order_id = $last_order->id;
			$mdid_order = mdid_by_orderid($order_id);
			if (!empty($mdid_order)) {
				$pay_id = $mdid_order->pay_info_id;
				$id_order = new ID_Order($pay_id);
				$get_order = $id_order->get_order();
				if (!empty($get_order)) {
					$project_id = $get_order->product_id;
					$project = new ID_Project($project_id);
					$post_id = $project->get_project_postid();
					$description = $project->short_description();
					if ($post_id > 0) {
						include 'templates/_socialButtons.php';
					}
				}
			}
		}
	}
	//include_once('templates/_socialSharing.php');
}
add_action('idc_order_sharing_after', 'idf_idc_order_sharing_options', 10, 1);

function idsocial_sharing_on_posts($content) {
	global $post_id, $post;
	$social_settings = get_option('idsocial_settings');
	if (!empty($social_settings)) {
		$show_social = false;
		// Check if this is a post and social icons are allowed on post
		if (!empty($post) && $post->post_type == "post") {
			if (isset($social_settings['show_social_on_post']) && $social_settings['show_social_on_post'] == 1) {
				$show_social = true;
			}
		}
		// If it's a page and social icons are allowed to be shown on a page in IDSocial settings
		if (!empty($post) && $post->post_type == "page") {
			if (isset($social_settings['show_social_on_pages']) && $social_settings['show_social_on_pages'] == 1) {
				$show_social = true;
			}
		}
		if ($show_social) {
			// Getting content from IDCF
			ob_start();
			include 'templates/_socialButtons.php';
			$new_content = ob_get_contents();
			ob_end_clean();

			$content .= '<div class="idsocial-post-icons ignitiondeck">'.
					$new_content.
				'</div>';
		}
	}
	return $content;
}
add_filter('the_content', 'idsocial_sharing_on_posts');

function idsocial_embed_box() {
	global $post;
	if ($post->post_type == "ignition_product") {
		// Getting project id
		$project_id = get_post_meta($post->ID, 'ign_project_id', true);
		echo '<div id="share-embed" class="social-share"><i class="fa fa-code"></i></div>'.
				'<div class="embed-box social-share" style="display: none;"><code>&#60;iframe frameBorder="0" scrolling="no" src="'.home_url().'/?ig_embed_widget=1&product_no='.(!empty($project_id) ? $project_id : '').'" width="214" height="366"&#62;&#60;/iframe&#62;</code>
			</div>';
	}
}
add_action('id_social_sharing_after', 'idsocial_embed_box', 2);

function idsocial_themes_icons($post_id, $project_id) {
	global $post;
	$social_settings = maybe_unserialize(get_option('idsocial_settings'));
	$settings = (object) $social_settings['social_checks'];

	$app_id = (isset($social_settings['app_id']) ? $social_settings['app_id'] : '');
	$social['show_facebook'] = (isset($settings->prod_page_fb) && $settings->prod_page_fb ? 1 : 0);
	$social['show_twitter'] = (isset($settings->prod_page_twitter) && $settings->prod_page_twitter ? 1 : 0);
	$social['show_google'] = (isset($settings->prod_page_google) && $settings->prod_page_google ? 1 : 0);
	$social['show_pinterest'] = (isset($settings->prod_page_pinterest) && $settings->prod_page_pinterest ? 1 : 0);
	$social['show_linkedin'] = (isset($settings->prod_page_linkedin) && $settings->prod_page_linkedin ? 1 : 0);

	$show_social = false;
	foreach ($social as $social_option => $option_show) {
		if ($option_show) {
			$show_social = true;
			break;
		}
	}
	echo '<div class="social">';
	if ($show_social) {
		echo '<div class="entry-share">';
	
		$share_title = '<span class="title">'.__( 'Share', 'idsocial' ).':</span>';
		echo apply_filters('idsocial_share_title', $share_title);

		$message = apply_filters( 'idsocial_share_message', sprintf( __( 'Check out %s on %s! %s', 'crowdpress' ), $post->post_title, get_bloginfo( 'name' ), get_permalink($post_id) ) );


		if ($social['show_twitter']) {
			$markup = '<a href="'.esc_url( sprintf( 'http://twitter.com/home?status=%s', urlencode( $message ) ) ).'" target="_blank" class="share-twitter"><i class="icon-twitter"></i></a>';
			echo apply_filters('idsocial_twitter_link_markup', $markup, $post_id, $message);
		}
	
		if ($social['show_google']) {
			$markup = '<a href="https://plus.google.com/share?url='.get_permalink($post_id).'" target="_blank" class="share-google"><i class="icon-gplus"></i></a>';
			echo apply_filters('idsocial_google_link_markup', $markup, $post_id);
		}
	
		if ($social['show_facebook']){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'campaign-thumb' );
			if (!empty($app_id)) {
				$markup = '<a href="https://www.facebook.com/dialog/share?app_id='.$app_id.'&display=popup&href='.urlencode( get_permalink($post_id) ).'&redirect_uri='.urlencode( get_permalink($post_id) ).'" class="share-facebook" target="_blank"><i class="icon-facebook"></i></a>';
			} else {
				$markup = '<a class="share-button share-facebook" role="button" data-share-type="facebook" data-li-uetrk-click="share-fb" data-li-uetrk-action="share" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode( get_permalink($post_id) ).'" target="_blank"><i class="icon-facebook"></i></a>';
			}
			echo apply_filters('idsocial_facebook_link_markup', $markup, $post_id);
		}
	
		if ($social['show_pinterest']) {
			$markup = '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
			<a href="http://pinterest.com/pin/create/button/?url='.get_permalink($post_id).'" data-pin-config="above" target="_blank" class="share-pinterest"><i class="icon-pinterest"></i></a>';
			// <a href="http://pinterest.com/pin/create/button/?url='.get_permalink($post_id).'" target="_blank" class="share-pinterest"><i class="icon-pinterest"></i></a>
			echo apply_filters('idsocial_pinterest_link_markup', $markup, $post_id);
		}
	
		if ($social['show_linkedin']) {
			$markup = '<a href="https://www.linkedin.com/shareArticle?mini=true&url='.get_permalink($post_id).'&summary=&source=" target="_blank"><i class="icon-linkedin"></i></a>';
			echo apply_filters('idsocial_linkedin_link_markup', $markup, $post_id);
		}
	
		$link_markup = '<a href="'.get_permalink($post_id).'" target="_blank" class="share-link"><i class="icon-link"></i></a>';
		echo apply_filters('idsocial_project_link_markup', $link_markup, $post_id);
				
		$embed_markup = '<a href="#campaign-widget-modal" class="share-widget modal-popup"><i class="icon-code"></i><span class="text">Embed</span></a>';
		echo apply_filters('idsocial_embed_link_markup', $embed_markup, $post_id);

		$widget_markup = '<div id="share-widget" class="modal">';
		ob_start();
		include_once 'templates/_embedWidgetMarkup.php';
		$widget_markup .= ob_get_contents();
		ob_clean();
		$widget_markup .= '</div>';
		$widget_markup .= '<div class="clearboth"></div>';
		echo apply_filters('idsocial_embed_widget_markup', $widget_markup);
			
		echo '</div>';
	}
	echo '</div>';
}
add_action('id_theme_after_project_image', 'idsocial_themes_icons', 10, 2);

function idsocial_global_social_buttons($post_id, $project_id) {
	// Getting social settings
	$social_settings = maybe_unserialize(get_option('idsocial_settings'));

	ob_start();
	include 'templates/_socialButtons.php';
	$new_content = ob_get_contents();
	ob_end_clean();

	echo $new_content;
}
add_action('idf_general_social_buttons', 'idsocial_global_social_buttons', 10, 2);

/**
 * Action hook to show FB Avatar in WP
 * @param string   $avatar 		Image tag of avatar
 * @param variable $id_or_email User ID, or email or User Object
 * @param int      $size 		sie of the image
 * @param int      $default 	
 * @param string   $alt         Alternate text
 * @return string  Image tag of the avatar
 */
function idsocial_fb_avatar($avatar, $id_or_email, $size, $default, $alt) {
	// Check that default avatar is mystery/blank, then get FB avatar
	$fb_avatar = get_user_meta($id_or_email, 'idsocial_fb_avatar', true);
	if (!empty($fb_avatar)) {
		$avatar_path = $fb_avatar;
	} else {
		// FB avatar doesn't exist, so return default avatar
		return $avatar;
	}

	$user = false;
	if (is_numeric($id_or_email)) {
		$id = (int) $id_or_email;
		$user = get_user_by('id', $id);
	}
	else if (is_object($id_or_email)) {
		if (!empty($id_or_email->user_id)) {
			$id = (int) $id_or_email->user_id;
			$user = get_user_by('id', $id);
		}
	} else {
		$user = get_user_by('email', $id_or_email);
	}

	if ($user && is_object($user) && !empty($avatar_path)) {
		$avatar = '<img alt="'.$alt.'" src="'.$avatar_path.'" class="avatar avatar-'.$size.' photo" height="'.$size.'" width="'.$size.'" />';
	}
		
	return $avatar;
}
add_filter('get_avatar', 'idsocial_fb_avatar', 10, 5);
?>