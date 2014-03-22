<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */


$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define("DB_NAME", trim($url["path"], "/"));
// define("DB_NAME", "heroku_4eed1f5663e035f");

/** MySQL database username */
define("DB_USER", trim($url["user"]));
// define("DB_USER", "b7cfc877a785ae");

/** MySQL database password */
define("DB_PASSWORD", trim($url["pass"]));
// define("DB_PASSWORD", "db3717c2");

/** MySQL hostname */
define("DB_HOST", trim($url["host"]));
// define("DB_HOST", "us-cdbr-east-03.cleardb.com");

/** MySQL database port  */
// define("DB_PORT", trim($url["port"]));

/** Database Charset to use in creating database tables. */
define("DB_CHARSET", "utf8");

/** Allows both foobar.com and foobar.herokuapp.com to load media assets correctly. */
define("WP_SITEURL", "http://" . $_SERVER["HTTP_HOST"]);

/** WP_HOME is your Blog Address (URL). */
// define('WP_HOME', "http://" . $_SERVER["HTTP_HOST"]);

define("FORCE_SSL_LOGIN", getenv("FORCE_SSL_LOGIN") == "true");
define("FORCE_SSL_ADMIN", getenv("FORCE_SSL_ADMIN") == "true");
if ($_SERVER["HTTP_X_FORWARDED_PROTO"] == "https")
  $_SERVER["HTTPS"] = "on";

/** The Database Collate type. Don't change this if in doubt. */
define("DB_COLLATE", "");

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6FixlK[6dTN#~<[[]qL<HI+0&Ki}/aq7KnS1E_tz@*J?md??L(Ev:[stN+?8@3t,');
define('SECURE_AUTH_KEY',  '?ZX+*r:EBso0&[SU]REw|lAA-s;%1dTP M,JgXY?od|(q}K^w<*rrCK+zVf)r8mX');
define('LOGGED_IN_KEY',    'E36_.sO!6_T73@],07w-OE|Xb`E59SB@q>/oVRQ@@Ts0wi$%BuB%-)#AsxJ+gGe>');
define('NONCE_KEY',        ';8|^+~X[RG<P,G80nDGe#&ib&|F&wb7I*%|o-RRna-Riu)~0Z);+L9FuJRwXk7|I');
define('AUTH_SALT',        'ItxJ}=C3t<&,./ 2{!-rN;70+;;sx@)3g3LFG#LQJ}tTaK`Yj-58u-=h-9v,|!@a');
define('SECURE_AUTH_SALT', 'Q-m3Y~D&>Nw<AWy*7X:SsQ{[tx/9%&>@4+t{/I;{e D]/WD%$UP ?(@}x+mL|..)');
define('LOGGED_IN_SALT',   '4P:&Wx3r^(|[`is=X]b,H./R(572E%_lKg}GBlGq#7_dddI_N`Oa)vY~jQ.~,6y%');
define('NONCE_SALT',       '+ztT6~cU|B2vu]9RHYxX_RWc;F!ceVA=,L}OvFz&n5ULb::JMLKv`uga;aL|(wD3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = "wp_";

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to "de_DE" to enable German
 * language support.
 */
define("WPLANG", "");

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define("WP_DEBUG", false);

/* WPRO AWS Constants */
define('WPRO_ON', true); // Enables the plugin and use configuration from contants.
define('WPRO_SERVICE', 's3'); // Amazon S3 is the service.
define('WPRO_FOLDER', ''); // Prepend all URI paths at S3 with this folder. In most cases, you probably want this to be empty.
define('WPRO_AWS_KEY', '');
define('WPRO_AWS_SECRET', '');
define('WPRO_AWS_BUCKET', ''); // The name of the Amazon S3 bucket where your files should be stored.
define('WPRO_AWS_ENDPOINT', 's3.amazonaws.com'); // The Amazon endpoint datacenter where your S3 bucket is. Se list of endpoints below.

/**
 * Enable the WordPress Object Cache
 */
define("WP_CACHE", getenv("WP_CACHE") == "true");

/**
 * Disable the built-in cron job
 */
define("DISABLE_WP_CRON", getenv("DISABLE_WP_CRON") == "true");

/**
 * Disable automatic updates, they won't survive restarting and scaling dynos
 */
define( 'AUTOMATIC_UPDATER_DISABLED', true );

/* That"s all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined("ABSPATH") )
  define("ABSPATH", dirname(__FILE__) . "/");

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . "wp-settings.php");
