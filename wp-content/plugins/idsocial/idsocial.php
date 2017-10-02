<?php

/*
Plugin Name: IgnitionDeck Social
URI: http://IgnitionDeck.com
Description: Social login, sharing, and analytics for the IgnitionDeck platform
Version: 1.0.10
Author: IgnitionDeck
Author URI: http://ignitiondeck.com
License: GPL2
*/

define( 'IDSOCIAL_PATH', plugin_dir_path(__FILE__) );

include 'idsocial-admin.php';
include 'idsocial-functions.php';
include IDSOCIAL_PATH.'inc/idsocial-facebook.php';
$idsocial_settings = get_option('idsocial_settings');
if (!empty($idsocial_settings['enable_twitterlogin']) && $idsocial_settings['enable_twitterlogin']) {
	include IDSOCIAL_PATH.'inc/idsocial-twitter.php';
}
add_action( 'init', 'idsocial_init' );
function idsocial_init() {
	if (!class_exists('IDF')) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		deactivate_plugins(plugin_basename(__FILE__));
		wp_die( __("IgnitionDeck Social requires installation of the IgnitionDeck Framework prior to activation.", "idsocial")."<br/> <a href='".admin_url('plugin-install.php?tab=search&s=ignitiondeck')."'>".__("Click here to install", "idsocial")."</a>" );
	}
	load_plugin_textdomain( 'idsocial', false, dirname( plugin_basename( __FILE__ ) ).'/languages/' );
	idsocial_upgrade_check();
}

function idsocial_upgrade_check() {
	$idsocial_li_upgrade = get_option('idsocial_li_upgrade');
	if (!$idsocial_li_upgrade) {
		$idsocial_settings = maybe_unserialize(get_option('idsocial_settings'));
		if (!empty($idsocial_settings['theme_500']['li_via'])) {
			$liname = $idsocial_settings['theme_500']['li_via'];
			$liname = 'https://linkedin.com/in/'.$liname;
			$idsocial_settings['theme_500']['li_via'] = $liname;
			update_option('idsocial_settings', $idsocial_settings);
			update_option('idsocial_li_upgrade', 1);
		}
	}
}

function idsocial_activation() {
	// If IDF doesn't exist, deactivate the plugin
	if (!class_exists('IDF')) {
		deactivate_plugins(plugin_basename(__FILE__));
		wp_die( __("IgnitionDeck Social requires installation of the IgnitionDeck Framework prior to activation.", "idsocial")."<br/> <a href='".admin_url('plugin-install.php?tab=search&s=ignitiondeck')."'>".__("Click here to install", "idsocial")."</a>" );
	}

	// Importing social settings already in IDCF
	if (class_exists('ID_Project')) {
		$idcf_settings = ID_Project::get_id_settings();
	}
	$idsocial_settings = maybe_unserialize(get_option('idsocial_settings'));
	$theme_500_settings = maybe_unserialize(get_option('fivehundred_theme_settings'));
	$update = false;
	if (empty($idsocial_settings['social_checks'])) {
		$new_settings = array(
		    'app_id' => (isset($idsocial_settings['app_id']) ? $idsocial_settings['app_id'] : ''),
		    'social_checks' => array(),
			'theme_500' => array()
		);
		if (isset($idcf_settings->prod_page_fb) && $idcf_settings->prod_page_fb) {
			$idsocial_settings['social_checks']['prod_page_fb'] = '1';
		}
		if (isset($idcf_settings->prod_page_twitter) && $idcf_settings->prod_page_twitter) {
			$idsocial_settings['social_checks']['prod_page_twitter'] = '1';
		}
		if (isset($idcf_settings->prod_page_linkedin) && $idcf_settings->prod_page_linkedin) {
			$idsocial_settings['social_checks']['prod_page_linkedin'] = '1';
		}
		if (isset($idcf_settings->prod_page_google) && $idcf_settings->prod_page_google) {
			$idsocial_settings['social_checks']['prod_page_google'] = '1';
		}
		if (isset($idcf_settings->prod_page_pinterest) && $idcf_settings->prod_page_pinterest) {
			$idsocial_settings['social_checks']['prod_page_pinterest'] = '1';
		}
		$update = true;
	}

	// Copying theme 500 social settings
	if (!empty($theme_500_settings) && !empty($idsocial_settings['theme_500'])) {
		if (isset($theme_500_settings['twitter']) && $theme_500_settings['twitter'] == 1) {
			$idsocial_settings['theme_500']['twitter'] = '1';
			$idsocial_settings['theme_500']['twitter_via'] = $theme_500_settings['twitter_via'];
		}
		if (isset($theme_500_settings['fb']) && $theme_500_settings['fb'] == 1) {
			$idsocial_settings['theme_500']['fb'] = '1';
			$idsocial_settings['theme_500']['fb_via'] = $theme_500_settings['fb_via'];
		}
		if (isset($theme_500_settings['google']) && $theme_500_settings['google'] == 1) {
			$idsocial_settings['theme_500']['google'] = '1';
			$idsocial_settings['theme_500']['g_via'] = $theme_500_settings['g_via'];
		}
		if (isset($theme_500_settings['li']) && $theme_500_settings['li'] == 1) {
			$idsocial_settings['theme_500']['li'] = '1';
			$idsocial_settings['theme_500']['li_via'] = $theme_500_settings['li_via'];
		}
		$update = true;
	}
	if ($update) {
		update_option('idsocial_settings', $idsocial_settings);
	}
}
register_activation_hook( __FILE__, 'idsocial_activation' );

add_action('wp_enqueue_scripts', 'idsocial_scripts', 9);
add_action('login_enqueue_scripts', 'idsocial_scripts', 9);
function idsocial_scripts() {
	wp_register_script('idsocial', plugins_url('js/idsocial.js', __FILE__));
	wp_register_script('facebook', plugins_url('js/facebook.js', __FILE__));
	wp_register_script('idsocial-fb', plugins_url('js/idsocial-fb.js', __FILE__));
	wp_register_style('idsocial-style', plugins_url('css/style.css', __FILE__));
	wp_enqueue_script('jquery');
	wp_enqueue_script('idsocial');
	wp_enqueue_script('facebook');
	wp_enqueue_script('idsocial-fb');
	wp_enqueue_style('idsocial-style');
	$settings = get_option('idsocial_settings');
	wp_localize_script('facebook', 'idsocial_fb_app_id', (isset($settings['app_id']) ? $settings['app_id'] : ''));
	wp_localize_script('facebook', 'idsocial_logged_in', (is_user_logged_in() ? '1' : '0'));
}

add_action ('admin_enqueue_scripts', 'id_fb_sdk_admin');
add_action('login_enqueue_scripts', 'id_fb_sdk_admin');
function id_fb_sdk_admin() {
	wp_register_script('idsocial-admin', plugins_url('js/idsocial-admin.js', __FILE__));
	wp_enqueue_script('jquery');
	wp_enqueue_script('idsocial-admin');
}
?>