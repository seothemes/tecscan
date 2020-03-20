<?php
/**
 * Business Pro Theme
 *
 * This file adds the page builder template to the Business Pro theme.
 * It removes everything between the site header and footer leaving
 * a blank template perfect for page builder plugins.
 *
 * Template Name: Page Builder
 *
 * @package      Business Pro
 * @link         https://seothemes.com/themes/business-pro
 * @author       SEO Themes
 * @copyright    Copyright © 2019 SEO Themes
 * @license      GPL-3.0-or-later
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Remove default hero section.
remove_action( 'genesis_before_content_sidebar_wrap', 'business_hero_section' );

// Remove before footer widget area.
remove_action( 'genesis_before_footer_wrap', 'business_before_footer_widget_area', 5 );

// Get site-header.
get_header();

// Custom loop, remove all hooks except entry content.
if ( have_posts() ) :

	the_post();

	do_action( 'genesis_entry_content' );

endif; // End loop.

// Get site-footer.
get_footer();
