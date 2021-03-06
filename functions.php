<?php
/**
 * OnAir2 Child theme
 * custom functions.php file
 */

//wp_register_style( 'borderradio-custom', get_template_directory_uri() . '/script.css' );

// Homepage: allow to change the splash screen
// https://gitpull.it/T581
if( !defined( 'ONAIR2_HOMEPAGE_SPLASH_IMG' ) ) {
	define( 'ONAIR2_HOMEPAGE_SPLASH_IMG', '/wp-content/uploads/2020/12/border-radio-splash-2020.jpeg' );
}

/**
 * Add parent and child stylesheets
 */
add_action( 'wp_enqueue_scripts', 'qantumthemes_child_enqueue_styles' );
if(!function_exists('qantumthemes_child_enqueue_styles')) {
function qantumthemes_child_enqueue_styles() {
    wp_enqueue_style(  'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(  'child-style', get_stylesheet_uri() );
//    wp_enqueue_script( 'borderradio-custom' );
}}

/**
 * Upon activation flush the rewrite rules to avoid 404 on custom post types
 */
add_action( 'after_switch_theme', 'qantumthemes_child_rewrite_flush_child' );
if(!function_exists('qantumthemes_child_rewrite_flush_child')) {
function qantumthemes_child_rewrite_flush_child() {
    flush_rewrite_rules();
}}


/**
 * Setup Onair2 Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function qantumthemes_child_theme_setup() {
	load_child_theme_textdomain( 'onair2-child',  get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'qantumthemes_child_theme_setup' );

/**
 * Customize how posts are queried
 */
add_filter( 'pre_get_posts', function( $query ) {

	if( !is_admin() && $query->is_main_query() ) {

		/**
		 * Display all the Speakers in one single page
		 *
		 * See https://gitpull.it/T162
		 * See https://gitpull.it/T178
		 */
		if ( is_tax( 'membertype' ) ) {
			$query->set( 'nopaging', true );

		/**
		 * Increase Podcasts per page
		 *
		 * See https://gitpull.it/T160
		 * See https://gitpull.it/T178
		 *
		 */
		} elseif( is_post_type_archive( 'podcast' ) || is_tax( 'podcastfilter' ) ) {
			$query->set( 'posts_per_archive_page', 16 );
		}

	}
} );

// Allow SVG upload in Border Radio website
// https://gitpull.it/T591
add_filter( 'upload_mimes', function( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
} );

/**
 * Local Google Font cache
 */
define( 'GOOGLE_FONT_CACHE', 'gfont-proxy.border-radio.it' );

/**
 * Convert a Google Font domain to your local proxy cache
 *
 * See https://gitpull.it/T776
 */
function convert_google_font_to_local_proxy_cache( $url ) {
	return str_replace( 'fonts.googleapis.com', GOOGLE_FONT_CACHE, $url );
}

/**
 * Avoid Google Fonts in your stylesheets
 *
 * https://gitpull.it/T186
 */
add_filter( 'style_loader_src', 'convert_google_font_to_local_proxy_cache' );

/**
 * Avoid Google Fonts in your DNS prefetch
 *
 * https://gitpull.it/T186
 */
add_filter( 'wp_resource_hints', function( $urls ) {
	foreach( $urls as & $url ) {
		$url = convert_google_font_to_local_proxy_cache( $url );
	}
	return $urls;
} );
