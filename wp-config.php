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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db1vraz1xjms5c' );

/** MySQL database username */
define( 'DB_USER', 'ute0g4jvucba0' );

/** MySQL database password */
define( 'DB_PASSWORD', 'csyqqqxblgcq' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'KtR`lV~aea=V)m;|<{3o1QXYL+WSc)STV.8=S79l@7E)3.eQ`43qHA6sM7Sv62Co' );
define( 'SECURE_AUTH_KEY',   '}0}xo:*nvA{J8Ck#!BWkP+:;2LI-b^]<[ 6g!M27 f16S=5,S<cw$cW-m#$VLZhb' );
define( 'LOGGED_IN_KEY',     '<YVS;yySIGwdKQ4K80@sLf>|,m2.0aZn*WJ1CY?jr>tAQ6~PF4[:VNntb9&BS&X0' );
define( 'NONCE_KEY',         'QN5htfQ_[M7PQ|v*#0ow02Vdl7Fo:G>yU4Ftn*g*8/E$b/YT(|mlFA0kX*%;KF A' );
define( 'AUTH_SALT',         '56VF:^%b9 N$R_S(8g$BbY58F!Kts8-tg;oQj;:o=3tE$j]9vFn ObE^_rTeC*JK' );
define( 'SECURE_AUTH_SALT',  '%#=Ge,0~nZvLK_wrP9)K?J&nLN&S7v}Gb_T/N;^::vsZ4.P3TmwPS;%fNj1J`sFM' );
define( 'LOGGED_IN_SALT',    '4S37751kYx0jA<IF:DR)S#Frk!%~;yxlQ>#6%C57=;WRBCB4L{LI}ZvF]YI&%y+G' );
define( 'NONCE_SALT',        'fF,Kv.! NF#xptp.%(u>,o:;U{7P>nK}rB+)e*jvx6L7_uCwVj%TYn@R2XC1qI#S' );
define( 'WP_CACHE_KEY_SALT', 'I`8@<9~s{Iwumsk8^_F>weYnD5tk7Nc!<Ig5u)XUK]1lu->D/gWRU xbW0.s?,Og' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'arq_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
