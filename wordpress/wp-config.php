<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dealwire');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '{XNi,2H$~r{EiF<*&i3;rT>tW2Yi|z3HVDK^el@7i|%cSkq @L9x{tyvp{`Gg -8');
define('SECURE_AUTH_KEY',  '=<}N0?^Vl&R:y[,J-1P-w5W$HBCSw<A# 9I}LR/+dRqUV}vH[sm#@W/iA[UO*;1t');
define('LOGGED_IN_KEY',    '=u9:g-D^YPrZuU_*,RtNHfV]JLD(+4~t;u8Wc:|OR}rB<J{2ch{glq/iXv9~)7R^');
define('NONCE_KEY',        '!8e3j}C<-4`ggpH+_;`F@jmJo-4.pifj(|%] `X;K0Zp-5ha9=ks<Y}Ep65~DRf=');
define('AUTH_SALT',        '9:f)7nV_Ui9f,Dd?P#p`xbpvLAT-=@QY4]@fr5p,Y<||8s)%0!pzgHt4(UJ#sD /');
define('SECURE_AUTH_SALT', 'w$pW]m}m1n=jf?-tzesjY,SVxGk=r]_q?:*TM_pcs3j.yuDNAdoH,TX[P60(BZu)');
define('LOGGED_IN_SALT',   'ofc*N1ArK^c=JPONW4uWO}W{T61Mc,C_:/2QnO/No:Y`.c|w;{5S)^:LRz@.N]I ');
define('NONCE_SALT',       '(Ow=^/iV;@8</%+DB>!![0&j`q!`wi5T/@qj2/|uFhm=J+$`tY i9Jbps|7z{NL*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
