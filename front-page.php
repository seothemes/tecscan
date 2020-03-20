<?php
/**
 * TecScan
 *
 * This file adds the front page to the TecScan.
 *
 * @package   TecScan
 * @link      https://seothemes.com/themes/tecscan
 * @author    SEO Themes
 * @copyright Copyright © 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

// Check if any front page widgets are active.
if ( is_active_sidebar( 'front-page-1' ) ||
     is_active_sidebar( 'front-page-2' ) ||
     is_active_sidebar( 'front-page-3' ) ||
     is_active_sidebar( 'front-page-4' ) ||
     is_active_sidebar( 'front-page-5' ) ||
     is_active_sidebar( 'front-page-6' ) ) {

	// Remove 'home' body class.
	add_filter( 'body_class', 'tecscan_remove_blog_class' );

	// Force full-width-content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Remove default hero section.
	remove_action( 'genesis_before_content_sidebar_wrap', 'tecscan_hero_section' );

	// Remove content-sidebar-wrap.
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

	// Remove default loop.
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'tecscan_front_page_loop' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.1.1
 *
 * @param $classes
 *
 * @return array
 */
function tecscan_remove_blog_class( $classes ) {
	$classes = array_diff( $classes, [ 'blog' ] );

	return $classes;
}

/**
 * Front page content.
 *
 * @since  1.0.5
 *
 * @return void
 */
function tecscan_front_page_loop() {

	// Get custom header markup.
	ob_start();
	the_custom_header_markup();
	$custom_header = ob_get_clean();

	// Check if using SEO slider.
	$hero_section = tecscan_sidebar_has_widget( 'front-page-1', 'seo_slider' ) ? '" role="banner">' : ' hero-section" role="banner">' . $custom_header;

	// Display Front Page 1 widget area.
	genesis_widget_area( 'front-page-1', [
		'before' => '<div class="front-page-1 widget-area' . $hero_section . '<div class="wrap">',
		'after'  => '</div></div>',
	] );

	// Front page 2 widget area.
	genesis_widget_area( 'front-page-2', [
		'before' => '<div class="front-page-2 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );

	// Front page 3 widget area.
	genesis_widget_area( 'front-page-3', [
		'before' => '<div class="front-page-3 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );

	// Front page 4 widget area.
	genesis_widget_area( 'front-page-4', [
		'before' => '<div class="front-page-4 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );

	// Front page 5 widget area.
	genesis_widget_area( 'front-page-5', [
		'before' => '<div class="front-page-5 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );

	// Front page 6 widget area.
	genesis_widget_area( 'front-page-6', [
		'before' => '<div class="front-page-6 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	] );
}

// Run Genesis.
genesis();
