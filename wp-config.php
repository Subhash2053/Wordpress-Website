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
define('DB_NAME', 'wordpress');
define( 'FS_METHOD', 'direct' );
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
define('AUTH_KEY',         '(8LrSffJvKO[ $;:d##:C3d9}?-S%d-q]xbWaYcC=+f*&lV|(?x/h#t|PRZ_^D/l');
define('SECURE_AUTH_KEY',  'Z$lA2EcWTk8J1t~Nn7NY#wXNMo~y vW65hz[K/6GK;WTlxVR=IF)s.pB_i/(O!hL');
define('LOGGED_IN_KEY',    '69^xygQw`ScUi9O*}&l:Ll=WGr{/zEkzDXx!Wtx&Pkz-BvRw Zw[Xv n!rz&@}MA');
define('NONCE_KEY',        'WOkv?pz1a5XDj+<-Q+7M{)+]:!T3AVFxEZw8OIOee.Sa5P8?Gsz?qyRN3%ixZ^Aa');
define('AUTH_SALT',        't h0GeeEU4ZSUNzm{5n<6uB+Gf8#^}Qyu#/85;ICK8Eo)MmB$bo:B(1bTMg(,uro');
define('SECURE_AUTH_SALT', 'lvb&w&)&UuVQ&I`-bGAIn1$~GkpeQ#a=g0C9;(WTpc<+P=sUHyPd9kLe7v7ZB!m}');
define('LOGGED_IN_SALT',   'vbfJA{Mcp3aUXnJ&-&4Ogag`A%Z_@!*_I.A2SUk8q%kQEWbASx~JjZ}ZBOV_%U+>');
define('NONCE_SALT',       'P!iqVj:DFGna|QKxt0;M]Si-s!S<I$-/%([NJEd!v<u|>zreZ;*4K22~AH-u`5|J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_gc';

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