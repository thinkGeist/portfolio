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

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'abstraction1');

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
define('AUTH_KEY',         'S}*BA6%f4&TZo=#U9mi@Mhd($]q1MbnT!CI;kT4R*/`ZXp!D(=#UU4J$9S?s/tz!');
define('SECURE_AUTH_KEY',  '^oul7cKW>8j@a,!IVIORl}d;%*=%~Ao3?Jj@X)k6,4pM~9mT2{{92O+Mkw$#+V*$');
define('LOGGED_IN_KEY',    'Y}r+cv$SC_Z PPGSfIc`/G4k)Lcr>y0.dWd^gTf_>5gu}4[_>Y|yV!fB#yuJ5MGE');
define('NONCE_KEY',        '45fLQ 39wiBR$X:yl8nz0K9=B>1y:_bJB%?r8l&mhK&G{|@llWZ[lg:v_<w0V*yb');
define('AUTH_SALT',        'j7osP8Xw+Coa-4B0I_/X%X&;;/h:?z*w+=9Malj^14:jL#M_&Ekr{5LTmC-Ks.&d');
define('SECURE_AUTH_SALT', '?2gI,&Ki2WwbpMri;.TaXDN)yZ: />7^hK{bGSettdRi]ANKBNC V# 6tD`F]Dcq');
define('LOGGED_IN_SALT',   'gF_EXHh h?CJ+d/`;!+|GzhNj&c7)[-IFZ(_[~5z[f<1bug^ypOlu;xJs4Bn(J?j');
define('NONCE_SALT',       'oNO.ZpyITzOL3]%+GTw9}~|CBY |j0Ff} ,ZI2Ioyd@!~ @X N&9ctDB>89Bs;=E');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
