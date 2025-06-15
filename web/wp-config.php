<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u296270978_WBCH2' );

/** Database username */
define( 'DB_USER', 'u296270978_BJs9l' );

/** Database password */
define( 'DB_PASSWORD', 'MlWWp6G56c' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'OvM%<:$&WB3 ^Ard=zkJ^T[q Q:Oiy;7i~d/Ohv<Qrc<kOT?HS=/Y._>5$cg<c.`' );
define( 'SECURE_AUTH_KEY',   '`pY.46eN%aC@zt]-hyJ/.f|4dgc1@2Iq$/o`EhfHoS|iau|p-~&kS>?6keF$Kef*' );
define( 'LOGGED_IN_KEY',     '-*(>E6e=<RN%Q&bDe1}blojbULEAwm@ds5BA^-SJe+ ]^~v>=T/O|D|}pn2p-Yi?' );
define( 'NONCE_KEY',         'bv,o#1)VY)VHJYRSeMvNUhUsO!+1_Qp `B..Wp^N?Y7|aDHJT56b+DeqMZ_h-YZL' );
define( 'AUTH_SALT',         'D~WLB4`??/m>W}]RLZo{psV<YORiJlWt{Po0t@!=68!,(S7uab^)=5#z>>lZ`X^5' );
define( 'SECURE_AUTH_SALT',  'iWHoc#X{J{:lG9h#jZ00Z>8<Y:*mX6V.s/An<vfI)1J+ShqF<i;Ux,A;IIzQi4Ar' );
define( 'LOGGED_IN_SALT',    ']lAD[&}t|d_1pu@zJB%&`5Ofo1!f;Q&}uV8 DV]Fjwz~ln3sS$8MBD7L0p?9ZZyU' );
define( 'NONCE_SALT',        '!lE;(PZ*:+Pq7N?Y^>#Dn&/G}D@ s Z4>Zhy^1Safwv-AR*h^TXA V7F>|m#V#Nn' );
define( 'WP_CACHE_KEY_SALT', 'Cvqf37T`d@4qXz<7W9F]v@Gz,O2JsaS.b[[}RD%0vV|D[x5fllbAqr?&|]Eb^EMR' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '595ed9b1dc6588bd07b48d32e1665a2c' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
