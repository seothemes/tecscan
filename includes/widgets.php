<?php
/**
 * TecScan
 *
 * This file registers widget areas for the TecScan.
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

// Register Front Page 1 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'tecscan' ),
	'description' => __( 'This is the Front Page 1 widget area.', 'tecscan' ),
	'before_title' => '<h1 itemprop="headline">',
	'after_title'  => '</h1>',
) );

// Register Front Page 2 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'tecscan' ),
	'description' => __( 'This is the Front Page 2 widget area.', 'tecscan' ),
) );

// Register Front Page 3 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'tecscan' ),
	'description' => __( 'This is the Front Page 3 widget area.', 'tecscan' ),
) );

// Register Front Page 4 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'tecscan' ),
	'description' => __( 'This is the Front Page 4 widget area.', 'tecscan' ),
) );

// Register Front Page 5 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'tecscan' ),
	'description' => __( 'This is the Front Page 5 widget area.', 'tecscan' ),
) );

// Register Front Page 6 widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-6',
	'name'        => __( 'Front Page 6', 'tecscan' ),
	'description' => __( 'This is the Front Page 6 widget area.', 'tecscan' ),
) );

// Register before footer widget area.
genesis_register_sidebar( array(
	'id'          => 'before-footer',
	'name'        => __( 'Before Footer', 'tecscan' ),
	'description' => __( 'This is the before footer widget area.', 'tecscan' ),
) );

add_action( 'genesis_before_footer', 'tecscan_before_footer_widget_area', 5 );
/**
 * Display before-footer widget area.
 *
 * @since 1.0.0
 *
 * @return void
 */
function tecscan_before_footer_widget_area() {
	genesis_widget_area( 'before-footer', array(
		'before' => '<div class="before-footer"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}
