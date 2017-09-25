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
define('DB_USER', 'dealuser');

/** MySQL database password */
define('DB_PASSWORD', '3mxKAvPHsbHBhuwt');

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
define('AUTH_KEY',         's%gIhiI=%Pb7*gV!7O97S-p0 z*qH!&aVBPr4Rj5&,n(W0bcPue2GOK/#hVo%7^8');
define('SECURE_AUTH_KEY',  '<u2?GowI,XF5:EKg[v7s w?H3$l/}:+sl$ri2fY<gJ;uV1u#;tVwvPtvc*>xdGG^');
define('LOGGED_IN_KEY',    'aH,iHyDt}eB<tEUTl7[=eVOtETLcUyWmXUj?{pJ8vfPA7nm;q|_n>c07_YO1#hY$');
define('NONCE_KEY',        'p7avA={)R|(;eW?3&%eia3g;@>Mm}>iTj|$d#Vm?HV]r|7-kA?f` =>.F(x@nS4z');
define('AUTH_SALT',        'Q>md>^jIGyE:80<e^RdK#O|eZFU/r_;;5BeULrVPtwRTNzDRXFP#|:6D-N,}dIUy');
define('SECURE_AUTH_SALT', 'gD44)]E&l1Ww_l,z2~K[=U^T!,EL<{`VQL]>^=gw?)CybxT<PEvJhvtf!ey|9)bb');
define('LOGGED_IN_SALT',   '~ps1/nE(V24#,NVSF2R0DSZ,)P[VEsp9v,k.U:O+f89`0x70XqY=(Qm7~ gZ0XwB');
define('NONCE_SALT',       'L+#zvv&k(_o?InA,XzTR||wwfqeJQ|9@a7EEWhj6X*R3pLB(YB1Jt4k3W5RlClWS');

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
