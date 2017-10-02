<?php
include IDSOCIAL_PATH.'lib/twitteroauth-master/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

add_action('init', 'idsocial_twitter_init', 1);

function idsocial_twitter_init() {
	if (!session_status()) {
		session_start();
	}
	if (isset($_GET['oauth_token']) && isset($_SESSION['oauth_token'])) {
		// remove the FB login button to prevent misclick
		remove_action('login_form', 'idsocial_wp_login_fb_login', 11, 1);
		remove_action('register_form', 'idsocial_wp_login_fb_login', 11, 1);
		remove_action('idc_below_login_form', 'idsocial_wp_login_fb_login', 11);
		remove_action('idc_below_register_form', 'idsocial_wp_login_fb_login', 11);

		$tw_vars = idsocial_twitter_creds();
		$oauth_token = $_GET['oauth_token'];
		$oauth_verifier = $_GET['oauth_verifier'];
		if ($oauth_token !== $_SESSION['oauth_token']) {
			return;
		}
		if (isset($_SESSION['oauth_token_secret'])) {
			try {
				$connection = new TwitterOAuth($tw_vars['public'], $tw_vars['secret'], $oauth_token, $_SESSION['oauth_token_secret']);
			}
			catch(exception $e) {
				//
				return;
			}
			try {
				$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
			}
			catch(exception $e) {
				//
				return;
			}
			$_SESSION['twitter_access_token'] = $access_token;
			try {
				$connection = new TwitterOAuth($tw_vars['public'], $tw_vars['secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
			}
			catch(exception $e) {
				//
				return;
			}
			try {
				$user = $connection->get("account/verify_credentials");
				do_action('idsocial_twitter_user_retrieved');
				if (!empty($user)) {
					$user_fullname = $user->name;
					$user_names = explode(' ', $user_fullname);
					$user_firstname = (isset($user_names[0]) ? $user_names[0] : '');
					$user_lastname = (isset($user_names[1]) ? $user_names[1] : '');
					$user->firstname = $user_firstname;
					$user->lastname = $user_lastname;
					
					add_filter('idc_reg_first-name', function($first_name) use($user_firstname) {
						return $user_firstname;
					});
					add_filter('idc_reg_last-name', function($last_name) use($user_lastname) {
						return $user_lastname;
					});
					add_action('md_register_extrafields', function() use($user) {
						echo '<div class="form-row"><input type="hidden" name="twitter_user_id" value="'.$user->id.'"/></div>';
					});
				}
			}
			catch(exception $e) {
				//
				return;
			}
		}
	}
	else {
		add_action('login_form', 'idsocial_twitter_login', 11, 1);
		add_action('register_form', 'idsocial_twitter_login', 11, 1);
		add_action('idc_below_login_form', 'idsocial_twitter_login', 11);
		add_action('idc_below_register_form', 'idsocial_twitter_login', 11);
		// prep for user creation
		add_action('idc_register_post_extra', 'convert_twitter_user', 10, 3);
	}
}

function idsocial_twitter_creds() {
	$settings = get_option('idsocial_settings');
	if (!empty($settings)) {
		$public = (!empty($settings['tw_consumer']) ? $settings['tw_consumer'] : null);
		$secret = (!empty($settings['tw_secret']) ? $settings['tw_secret'] : null);
		$callback = (!empty($settings['tw_url']) ? $settings['tw_url'] : null);
		$callback = md_get_durl().idf_get_querystring_prefix().'action=register';
		return array('public' => $public, 'secret' => $secret, 'callback' => $callback);
	}
}

function convert_twitter_user($user, $email, $fields) {
	if (isset($_SESSION['twitter_access_token'])) {
		foreach ($fields as $field) {
			if ($field['name'] == 'twitter_user_id') {
				if ($field['value'] == $_SESSION['twitter_access_token']['user_id']) {
					// bingo!
					update_user_meta($user, 'twitter_access_token', $_SESSION['twitter_access_token']);
					break;
				}
			}
		}
	}
}

function idsocial_twitter_login($args) {
	$tw_vars = idsocial_twitter_creds();
	try {
		$connection = new TwitterOAuth($tw_vars['public'], $tw_vars['secret']);
	}
	catch(exception $e) {
		//
		return;
	}
	try {
		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $tw_vars['callback']));
	}
	catch(exception $e) {
		//
		return;
	}

	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	$css_class = '';
	if (current_filter() == "idc_below_login_form" || current_filter() == "idc_below_register_form") {
		$css_class = 'idsocial-no-padding';
	}
	include IDSOCIAL_PATH.'templates/_twitterloginForm.php';
}

add_action('idsocial_twitter_user_retrieved', 'idsocial_set_lower_filters');

function idsocial_set_lower_filters() {
	add_action('idc_dashboard_title', function($title) {
		return __('Complete Registration', 'idsocial');
	});
}
?>