<?php
/**
 * TecScan
 *
 * This file loads scripts and styles for the TecScan.
 *
 * @package   TecScan
 * @link      https://seothemes.com/themes/tecscan
 * @author    SEO Themes
 * @copyright Copyright © 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'wp_enqueue_scripts', 'tecscan_enqueue_scripts', 20 );
/**
 * Enqueue theme scripts.
 *
 * @since  1.1.0
 *
 * @return void
 */
function tecscan_enqueue_scripts() {
	$suffix    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$directory = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '/min';

	// Enqueue fitvids script.
	wp_enqueue_script( 'fitvids', get_stylesheet_directory_uri() . "/assets/scripts{$directory}/jquery.fitvids{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Enqueue theme scripts.
	wp_enqueue_script( CHILD_THEME_HANDLE, get_stylesheet_directory_uri() . "/assets/scripts{$directory}/tecscan{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Enqueue responsive menu script.
	wp_enqueue_script( 'tecscan-menu', get_stylesheet_directory_uri() . "/assets/scripts{$directory}/menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Localize responsive menus script.
	wp_localize_script( 'tecscan-menu', 'genesis_responsive_menu', array(
		'mainMenu'         => __( 'Menu', 'tecscan' ),
		'subMenu'          => __( 'Menu', 'tecscan' ),
		'menuIconClass'    => null,
		'subMenuIconClass' => null,
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
		),
	) );
}

add_action( 'wp_enqueue_scripts', 'tecscan_enqueue_styles', 20 );
/**
 * Enqueue theme styles.
 *
 * @since  1.1.0
 *
 * @return void
 */
function tecscan_enqueue_styles() {

	// Remove Simple Social Icons CSS (included with theme).
	wp_dequeue_style( 'simple-social-icons-font' );

	// Enqueue Google fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans', array(), CHILD_THEME_VERSION );

	// Enqueue WooCommerce styles conditionally.
	if ( class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ) ) {
		wp_enqueue_style( 'tecscan-woocommerce', get_stylesheet_directory_uri() . '/woocommerce.css', array(), CHILD_THEME_VERSION );
	}
}
