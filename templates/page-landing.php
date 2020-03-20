<?php
/**
 * TecScan
 *
 * This file adds the landing page template to the TecScan.
 *
 * Template Name: Landing Page
 *
 * @package TecScan
 * @author  SEOThemes
 * @license GPL-3.0-or-later
 * @link    https://seothemes.com/themes/tecscan
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_filter( 'body_class', 'tecscan_landing_page_body_class' );
/**
 * Add landing page body class.
 *
 * @since  1.0.0
 *
 * @param  array $classes Array of body classes.
 * @return array $classes Array of body classes.
 */
function tecscan_landing_page_body_class( $classes ) {
	$classes[] = 'landing-page';

	return $classes;
}

remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );
add_action( 'wp_enqueue_scripts', 'tecscan_dequeue_skip_links' );
/**
 * Dequeue skip links script.
 *
 * @since  1.0.0
 *
 * @return void
 */
function tecscan_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );
}

// Remove site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Remove default hero section.
remove_action( 'genesis_after_header', 'tecscan_hero_section_open', 20 );
remove_action( 'genesis_after_header', 'tecscan_hero_section_title', 24 );
remove_action( 'genesis_after_header', 'tecscan_hero_section_close', 28 );

// Add title back (removed in /includes/header.php).
add_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Remove navigation.
remove_theme_support( 'genesis-menus' );

// Remove breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove footer widgets.
remove_action( 'genesis_footer', 'genesis_footer_widget_areas', 6 );
remove_action( 'genesis_footer', 'tecscan_before_footer_widget_area', 5 );

// Remove site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'tecscan_footer_menu', 7 );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Run the Genesis loop.
genesis();
