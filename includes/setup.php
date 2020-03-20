<?php
/**
 * TecScan
 *
 * This file adds the setup functions to the TecScan.
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

// Define theme constants (do not remove).
$child_theme = wp_get_theme();
define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
define( 'CHILD_THEME_HANDLE', $child_theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

// Set Localization (do not remove).
load_child_theme_textdomain( CHILD_THEME_HANDLE, apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', CHILD_THEME_HANDLE ) );

// Add support for structural wraps.
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'menu-primary',
	'menu-secondary',
	'hero-section',
	'footer-widgets',
	'footer',
) );

// Enable Accessibility support.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
) );

// Enable custom navigation menus.
add_theme_support( 'genesis-menus', array(
	'primary' => __( 'Header Menu', 'tecscan' ),
) );

// Enable support for footer widgets.
add_theme_support( 'genesis-footer-widgets', 4 );

// Enable viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Enable HTML5 markup structure.
add_theme_support( 'html5', array(
	'caption',
	'comment-form',
	'comment-list',
	'gallery',
	'search-form',
) );

// Enable support for post formats.
add_theme_support( 'post-formats', array(
	'aside',
	'audio',
	'chat',
	'gallery',
	'image',
	'link',
	'quote',
	'status',
	'video',
) );

// Enable support for WooCommerce.
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Enable support for Gutenberg.
add_theme_support( 'align-wide' );

// Enable support for fixed header.
add_theme_support( 'fixed-header' );

// Enable selective refresh and Customizer edit icons.
add_theme_support( 'customize-selective-refresh-widgets' );

// Enable theme support for custom background color.
add_theme_support( 'custom-background', array(
	'default-color' => 'ffffff',
) );

// Enable logo option in Customizer > Site Identity.
add_theme_support( 'genesis-custom-logo', array(
	'height'      => 100,
	'width'       => 300,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );

// Enable support for custom header image or video.
add_theme_support( 'custom-header', array(
	'header-selector'    => '.hero-section',
	'default_image'      => get_stylesheet_directory_uri() . '/assets/images/hero.jpg',
	'header-text'        => true,
	'default-text-color' => 'ffffff',
	'width'              => 1920,
	'height'             => 1080,
	'flex-height'        => true,
	'flex-width'         => true,
	'uploads'            => true,
	'video'              => true,
	'wp-head-callback'   => 'tecscan_custom_header',
) );

// Enable support for page excerpts.
add_post_type_support( 'page', 'excerpt' );

// Output featured images on singular content.
add_post_type_support( 'post', 'genesis-singular-images' );
add_post_type_support( 'page', 'genesis-singular-images' );

// Set hero image size.
add_image_size( 'hero', 1280, 720, true );

// Set portfolio image size to override plugin.
add_image_size( 'portfolio', 620, 380, true );

// Register default header (just in case).
register_default_headers( array(
	'child' => array(
		'url'           => '%2$s/assets/images/hero.jpg',
		'thumbnail_url' => '%2$s/assets/images/hero.jpg',
		'description'   => __( 'Hero Image', 'tecscan' ),
	),
) );

// Register custom layout.
genesis_register_layout( 'centered-content', array(
	'label' => __( 'Centered Content', 'tecscan' ),
	'img'   => get_stylesheet_directory_uri() . '/assets/images/layout.gif',
) );

// Remove unused sidebars and layouts.
unregister_sidebar( 'sidebar-alt' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_title_area', 'genesis_do_nav' );

// Reposition featured image on archives.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

// Reposition footer widgets.
//remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
//add_action( 'genesis_footer', 'genesis_footer_widget_areas', 6 );

// Genesis style trump.
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 99 );

// Enable shortcodes in HTML widgets.
add_filter( 'widget_text', 'do_shortcode' );

// Remove Genesis Portfolio Pro default styles.
add_filter( 'genesis_portfolio_load_default_styles', '__return_false' );

// Remove one click demo branding.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
