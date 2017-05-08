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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'scotchbox' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'iEvRYf&E^<F8j-S[+kxl!fNOu;{CX*q^l9PaAC5|Bn+->cD??I~)Y/:dg;ZYA=r:');
define('SECURE_AUTH_KEY',  'XHJ0Nc.^s|}0H<CuIG/:dKO<)>_s]@=>6ZM^yW@O}UVy y9;uQwQHzlgv9zD`(D+');
define('LOGGED_IN_KEY',    '!-/=)_ob<pr%(d0.PZ [(ho^zCd<BRYSH{V-oRoQJohG<WF2Cb-C?6C66m_;p{${');
define('NONCE_KEY',        '*YDeg0MgQ.F>M{9{Y>7G~Sa(SLZSoTZ`D`g;g 8-FUab$KB?%VdWj>U`+=3*.6,<');
define('AUTH_SALT',        'rF!v+C?^+fYoshg0+k~xo$D_I(|FXTZ?aJD}>98]&Cg>L71HbBt]]|Df}HZfNddL');
define('SECURE_AUTH_SALT', 'N?OE=/];ql]~t<[2,IS=%<dts/P1O6zeo_lBgefL;$o+U#hczNoq93-y5U]aEb99');
define('LOGGED_IN_SALT',   'qMWCfFKNFf=q4]y~)X@Xmq])RR|t%dkOE^NJT?=^sQg/sNs?B2!s%.y5jx#mq`^i');
define('NONCE_SALT',       '7.K&l/oIs:R3?J#Be?~B-Uu+aF}2m(&fa`r,>R+NZw!UC!Xt#n0^V-.iE,;k,%8m');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
