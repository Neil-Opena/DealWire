<?php

define( 'GD_VIP', '198.71.233.47' );
define( 'GD_RESELLER', 1 );
define( 'GD_ASAP_KEY', 'c77cd7f0b5a148dc1e4e72b190e1f5d0' );
define( 'GD_STAGING_SITE', false );
define( 'GD_EASY_MODE', true );
define( 'GD_SITE_CREATED', 1497075450 );

// Newrelic tracking
if ( function_exists( 'newrelic_set_appname' ) ) {
	newrelic_set_appname( '319ac97d-8dce-44b4-a171-8aa10415d80b;' . ini_get( 'newrelic.appname' ) );
}

/**
 * Is this is a mobile client?  Can be used by batcache.
 * @return array
 */
function is_mobile_user_agent() {
	return array(
	       "mobile_browser"             => !in_array( $_SERVER['HTTP_X_UA_DEVICE'], array( 'bot', 'pc' ) ),
	       "mobile_browser_tablet"      => false !== strpos( $_SERVER['HTTP_X_UA_DEVICE'], 'tablet-' ),
	       "mobile_browser_smartphones" => in_array( $_SERVER['HTTP_X_UA_DEVICE'], array( 'mobile-iphone', 'mobile-smartphone', 'mobile-firefoxos', 'mobile-generic' ) ),
	       "mobile_browser_android"     => false !== strpos( $_SERVER['HTTP_X_UA_DEVICE'], 'android' )
	);
}