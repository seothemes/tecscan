<?php
/**
 * TecScan
 *
 * This file adds the service page template to the TecScan, it adds
 * some basic schema.org micro data to the site inner div and H1 heading.
 *
 * Template Name: Service Page
 *
 * @package      TecScan
 * @link         https://seothemes.com/themes/tecscan
 * @author       SEO Themes
 * @copyright    Copyright © 2019 SEO Themes
 * @license      GPL-3.0-or-later
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_filter( 'genesis_attr_site-inner', 'tecscan_service_site_inner' );
/**
 * Filter the site-inner div.
 *
 * Adds schema.org microdata to the site-inner div to declare
 * the contents as a service.
 *
 * @since 1.0.0
 *
 * @param  array $attr Array of site-inner values.
 * @return array
 */
function tecscan_service_site_inner( $attr ) {
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/Service';

	return $attr;
}

add_filter( 'tecscan_hero_title_markup', 'tecscan_service_title' );
/**
 * Filter the page title.
 *
 * Adds the correct schema.org markup for service type heading.
 * The type of service being offered, e.g. veterans' benefits,
 * emergency relief, etc.
 *
 * @since 1.0.0
 *
 * @link   http://schema.org/serviceType
 * @return string
 */
function tecscan_service_title() {
	return '<h1 itemprop="serviceType">';
}

// Run Genesis.
genesis();
