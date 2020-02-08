<?php
/**
 * OnAir2 Child theme
 * custom functions.php file
 */

//wp_register_script('borderradio-custom', get_template_directory_uri() . '/script.js' );

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
	} elseif( $query->get_queried_object()->name === 'podcast' ) {
		$query->set( 'posts_per_page', 16 );
	}
} );
