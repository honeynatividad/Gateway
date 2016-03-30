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
define('DB_NAME', 'emptoriu_wp265');

/** MySQL database username */
define('DB_USER', 'emptoriu_wp265');

/** MySQL database password */
define('DB_PASSWORD', ')311S4[Pny');

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
define('AUTH_KEY',         '4hyw5wmwszu41cyskhsujqndp4wb3qobcdjwlwpj7sz42vh5c8iiwwtvxt3twolt');
define('SECURE_AUTH_KEY',  '3y7otz1jv5bhexslp7hs8ikxxzjqrw659nslmgtipqu9hneebd8vyn17geohfwmd');
define('LOGGED_IN_KEY',    'wdxp9oviljdqgwxw7ctci1aszrjndfsjx6ygb73dawol54mcdbz0uxqhbfsuec0u');
define('NONCE_KEY',        '47hqcfhacnz3sxxfawfmibyiikwchl1nkrvevltt7dm0drgexwctypbomhoiwu88');
define('AUTH_SALT',        'no33y2gn9wqrb4lgbq5c247mhltirhoqranoh17kww1srnxzj3po9hc1ckfaxegj');
define('SECURE_AUTH_SALT', 'ceimsjm1xeurki0ellfttujhfpaiycb10fk3bofms88pr8lplkl2gol9bf1y9ips');
define('LOGGED_IN_SALT',   'xctlka3owygmojuvliasu8twfpzzapjo8qwcw4bu6eozwjwfxpbntx7vl1nslycy');
define('NONCE_SALT',       'pgji8yewof1n3xaawbjqqi3rxgzdfvctgxfgyj01ai2l5ttt5masi3jkhlvyq2jb');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpev_';

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
define( 'WP_MEMORY_LIMIT', '128M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );
