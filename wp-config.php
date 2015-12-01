<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'yummyfunny');

/** MySQL database username */
define('DB_USER', 'armen');

/** MySQL database password */
define('DB_PASSWORD', 'Ye7884j9@');

/** MySQL hostname */
define('DB_HOST', 'yummyfunnycom2.ipagemysql.com');

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
define('AUTH_KEY',         'W>$A*-=T6+DsQC:bHS-6pax*r!tmIa( 3$~<@wKF}V7aVc:3fL06<3G})6{ve]$p');
define('SECURE_AUTH_KEY',  'aLR6I2w%v_?r`%?/CIz#4N|cI{qt@%;TDndG#Pa-G}2XZl9|jB8H?}jrQ;RW&8Ck');
define('LOGGED_IN_KEY',    '~/6 QL!%4q:nO@!6hi42[?#8c)|8Tt0dhT6Y1m^Tf7IV%tS{Z|dAv|&zbb95%CFN');
define('NONCE_KEY',        '$c R$#e+a[p+cXx,6?e4tIyx)-zmD}2qV,yi<$L3pWZ+zQ(beNW5T-D=~uCIu/)w');
define('AUTH_SALT',        'z!Y:y/vGQdi}4Iv`fHUit?HW>R{aS8.n7k1hVW3vb@(UTCt-%; Z&3s L%#bto/N');
define('SECURE_AUTH_SALT', 'OVB)1*r{L-)Y1KC&^8!e@@Zd<wV[8nN|7E{ZiE,=?$Yek/L!b/(,Z1!Gb!3V8R;$');
define('LOGGED_IN_SALT',   'Dr*hl/_e:+]U]U& eDZC@*ejqmzwj.:aU,-c<[#B1fda.P2M]_iC}Szx6($F|lr4');
define('NONCE_SALT',       '<{0=}ceRd_[moCyvqL-~&}w@C):@r+<JZA/?9o/lVcl$RDp,G*~<t9y:;0bcV%8*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
//Disable File Edits
define('DISALLOW_FILE_EDIT', true);