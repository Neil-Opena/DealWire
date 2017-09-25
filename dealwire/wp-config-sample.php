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
define('DB_USER', 'dealuse');

/** MySQL database password */
define('DB_PASSWORD', '3mxKAvPHsbHBhuwt');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'sLg>/%)`2f<$pa6.2Ma/|?;b9Qo5*cDKwrh<Z+8PF|g[W8FNup.!Dq5m!gf+!3N0');
define('SECURE_AUTH_KEY',  'anwi}v$2.U!> t-UN7>duy&h+p)kUB++eBh-D9esR?z;#-+>IaMxo(6|h>8s]h+t');
define('LOGGED_IN_KEY',    'Y5tekG)>J8||U^1|B<vVpt}h+ 8(zDrWPMsbWF|BaWJW6T6p/u1Od#!wt#|6.|PD');
define('NONCE_KEY',        'u/w^cb~Eg V@2E.`tw#paSHXOo?VM){I1)|W0d_~5Mb25W|xP q6p+ :| %~:Rj|');
define('AUTH_SALT',        '5%>RUowe&4Ckm@DPN2@^cC:Ri!tb(0IhGI;Gm?@$-iLnc5;4Lcu0d|^@0D1li];r');
define('SECURE_AUTH_SALT', '|B}s%*:$_.qwYqBm]HKEL?*K}X7f~<TTRjV>*`mFDX1[8D{ YD2KeB||>Us0N=_G');
define('LOGGED_IN_SALT',   '-%K~<_yCl_iBGw]v2<>w3<+U;zwWp%nyhx`MH?sN+P^TQxjCB(9Dmi;`2/x5w4/b');
define('NONCE_SALT',       'A#QPG[xz0%{RSiu0#2D[_pbQyH_`RcO+XAZ xg:Sv|X;.0^!kN+J2CfF=<W,85O5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dw_';

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
