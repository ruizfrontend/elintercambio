<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */


/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/scripts.js' ), array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

add_theme_support( 'post-thumbnails' );
add_image_size( 'proyect-thumbs', 432, 233, true);
add_image_size( 'proyect-main', 1300, 385, true);
add_image_size( 'proyect-second', 620, 380, true);
add_image_size( 'proyect-team', 300, 450, true);
