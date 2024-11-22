<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ncit_wp_ooysa' );

/** Database username */
define( 'DB_USER', 'ncit_wp_fspif' );

/** Database password */
define( 'DB_PASSWORD', 'VTdSlUt5*~YG1a9Y' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '%F6&S+u%7!:5TCYq;&Rx2ds[aT@#8ru*Oc#[|0E#4L@dwE@Dp0Qtj0!np(5ODEZ]');
define('SECURE_AUTH_KEY', '_418Kb(72(MW1V6Bhi42#G/#-gh[M_j4h1Io50Y5V7&QKd;@zJ)gFY7SpV*x1ygc');
define('LOGGED_IN_KEY', 'A%o&B3XPBZA1N3l#DmvOz02(_L|7CjY19z64MjZ;~0Ad-:4K0w/b53T95F#d2#!H');
define('NONCE_KEY', '9q6XQeM*~*&Hhx[|m239WExUP[9YW|s-KM7|2/)3qv7W21/5Ah1Gl5d~jrh0G%(b');
define('AUTH_SALT', '%)yYlH~G8Gb*%so9WX!2Ir8n6P10%%@*L:/gkis)/98AIGVaK1x4&wQ5CEiigY0E');
define('SECURE_AUTH_SALT', '&!;Xc#at5@Y7~mz~~FPb;%+dS[X|d%)oS[SO!5z~nnk8Y7gL!yXr_mU3Xo0;LkEN');
define('LOGGED_IN_SALT', 'R@4p@Vb%2zfC&Z0nQQjN01!t#U*J3e285F7il4z)W[Giq48Y8W(f-x@]Z67D_yA1');
define('NONCE_SALT', 'i(q0j2j+L@6!F(04cJ2K5(+r|-t9c07xZ__dsOo%5~HS;QH9-30-Ojv~(Mx9IurW');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'esVPp6_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
