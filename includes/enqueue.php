<?php
/**
 * Business Pro Theme
 *
 * This file loads scripts and styles for the Business Pro theme.
 *
 * @package   BusinessProTheme
 * @link      https://seothemes.com/themes/business-pro
 * @author    SEO Themes
 * @copyright Copyright © 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'wp_enqueue_scripts', 'business_enqueue_scripts', 20 );
/**
 * Enqueue theme scripts.
 *
 * @since  1.1.0
 *
 * @return void
 */
function business_enqueue_scripts() {
	$suffix    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$directory = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '/min';

	// Enqueue fitvids script.
	wp_enqueue_script( 'fitvids', get_stylesheet_directory_uri() . "/assets/scripts{$directory}/jquery.fitvids{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Enqueue theme scripts.
	wp_enqueue_script( CHILD_THEME_HANDLE, get_stylesheet_directory_uri() . "/assets/scripts{$directory}/business-pro{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Enqueue responsive menu script.
	wp_enqueue_script( 'business-menu', get_stylesheet_directory_uri() . "/assets/scripts{$directory}/menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Localize responsive menus script.
	wp_localize_script( 'business-menu', 'genesis_responsive_menu', array(
		'mainMenu'         => __( 'Menu', 'business-pro-theme' ),
		'subMenu'          => __( 'Menu', 'business-pro-theme' ),
		'menuIconClass'    => null,
		'subMenuIconClass' => null,
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
		),
	) );
}

add_action( 'wp_enqueue_scripts', 'business_enqueue_styles', 20 );
/**
 * Enqueue theme styles.
 *
 * @since  1.1.0
 *
 * @return void
 */
function business_enqueue_styles() {

	// Remove Simple Social Icons CSS (included with theme).
	wp_dequeue_style( 'simple-social-icons-font' );

	// Enqueue Google fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:600|Hind:400', array(), CHILD_THEME_VERSION );

	// Enqueue WooCommerce styles conditionally.
	if ( class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ) ) {
		wp_enqueue_style( 'business-woocommerce', get_stylesheet_directory_uri() . '/woocommerce.css', array(), CHILD_THEME_VERSION );
	}
}
