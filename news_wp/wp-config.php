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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wagokoro_news' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '123' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '..zg;G/|BDA`GW!g?9tVGMcsU[n-l 92b(:}P, A$9SN2Rt~HbcJkUr)zdzxHB@U' );
define( 'SECURE_AUTH_KEY',  '|d@qf5xML!NrG~w/+H-z^<VI?}Xk.nvJA/M<6bDkX|oj,*ZO)&nboxfZdaOPPPVI' );
define( 'LOGGED_IN_KEY',    ' |S2WCA0pewtrPNIYTX[eOx7Z_>0R>mCTlP}<MIFj!7$ldFnn1xSA9t&udqNuTw`' );
define( 'NONCE_KEY',        'C~C1m+gJ1()Y^byxUVnR,N7J$|Hjx`0qT k!0sctD~,Mg1B {Pmxim?uv]/solJS' );
define( 'AUTH_SALT',        '{(<jqu:)XEJ?3n$|,;^`ToQ>C-FVY4P}QX~:d((BrQ:,56k/J5Junp7e+=*ANxbk' );
define( 'SECURE_AUTH_SALT', 'T1@X>j7CBs-.+^[qVtCF{|`<]>7LON]g)~EnW^%OKKDsgtn&cA#bGN~cbX]DV{-N' );
define( 'LOGGED_IN_SALT',   '^`V%@51Zan4Dy~Q*0QDlPYK$0%:pOn6BPQVLu[@F45@61H9SaJv3FSnV2Dbwp!f`' );
define( 'NONCE_SALT',       'v)R7.R:x0R]1 ^jOQqp5x4,nC[;^06aI5nO4]2*Fx;+TBbqol%S`}[3u&ft%:Bk`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
