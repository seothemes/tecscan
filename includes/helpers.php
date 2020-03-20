<?php
/**
 * Business Pro Theme
 *
 * This file adds helper functions to the Business Pro theme.
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

/**
 * Gets the child theme config or a sub config.
 *
 * @since 1.1.0
 *
 * @param string $sub_config Sub config of the child theme config array.
 *
 * @return array
 */
function business_get_config( $sub_config ) {
	$config = require get_stylesheet_directory() . '/config/defaults.php';

	if ( $sub_config ) {
		$config = $config[ $sub_config ];
	}

	return $config;
}

/**
 * Sanitize number values.
 *
 * Ensure number is an absolute integer (whole number, zero or greater). If
 * input is an absolute integer, return it. Otherwise, return default.
 *
 * @since  1.0.0
 *
 * @param string $number  The rgba color to sanitize.
 * @param string $setting Sanitized value.
 *
 * @return string
 */
function business_sanitize_number( $number, $setting ) {
	$number = absint( $number );

	return ( $number ? $number : $setting->default );
}

/**
 * Sanitize RGBA values.
 *
 * If string does not start with 'rgba', then treat as hex then
 * sanitize the hex color and finally convert hex to rgba.
 *
 * @since  1.0.0
 *
 * @param  string $color The rgba color to sanitize.
 *
 * @return string $color Sanitized value.
 */
function business_sanitize_rgba_color( $color ) {

	// Return invisible if empty.
	if ( empty( $color ) || is_array( $color ) ) {
		return 'rgba(0,0,0,0)';
	}

	// Return sanitized hex if not rgba value.
	if ( false === strpos( $color, 'rgba' ) ) {
		return sanitize_hex_color( $color );
	}

	// Finally, sanitize and return rgba.
	$color = str_replace( ' ', '', $color );
	sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

	return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
}

/**
 * Minify CSS helper function.
 *
 * Quick PHP function to minify common parts of CSS. May not support some of the
 * more complex syntaxes of CSS3. For that, use a proper parser and minifier.
 *
 * @since  1.0.0
 *
 * @author Gary Jones
 * @link   https://github.com/GaryJones/Simple-PHP-CSS-Minification
 *
 * @param  string $css The CSS to minify.
 *
 * @return string Minified CSS.
 */
function business_minify_css( $css ) {

	// Normalize whitespace.
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove spaces before and after comment.
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );

	// Remove comment blocks, everything between /* and */, unless preserved with /*! ... */ or /** ... */.
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );

	// Remove ; before }.
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >.
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { } ( ) >.
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px).
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0).
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Converts all zeros value into short-hand.
	$css = preg_replace( '/0 0 0 0/', '0', $css );

	// Shorten 6-character hex color codes to 3-character where possible.
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );

}

/**
 * Custom header image callback.
 *
 * Loads custom header or featured image depending on what is set on a per page
 * basis. If a featured image is set for a page, it will override the default
 * header image. It also gets the image for custom post types by looking for
 * a page with the same slug as the CPT e.g the Portfolio CPT archive will
 * pull the image from a page with the slug of 'portfolio', if it exists.
 *
 * @since  1.1.1
 *
 * @return string
 */
function business_custom_header() {
	$id  = '';
	$url = '';

	// Get the current page ID.
	if ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$id = wc_get_page_id( 'shop' );

	} elseif ( is_post_type_archive() ) {
		$id = get_page_by_path( get_query_var( 'post_type' ) );
		$id = $id && has_post_thumbnail( $id->ID ) ? $id->ID : false;

	} elseif ( is_category() ) {
		$id = get_page_by_title( 'category-' . get_query_var( 'category_name' ), OBJECT, 'attachment' );

	} elseif ( is_tag() ) {
		$id = get_page_by_title( 'tag-' . get_query_var( 'tag' ), OBJECT, 'attachment' );

	} elseif ( is_tax() ) {
		$id = get_page_by_title( 'term-' . get_query_var( 'term' ), OBJECT, 'attachment' );

	} elseif ( is_front_page() ) {
		$id = get_option( 'page_on_front' );

	} elseif ( is_home() ) {
		$id = get_option( 'page_for_posts' );

	} elseif ( is_search() ) {
		$id = get_page_by_path( 'search' );

	} elseif ( is_404() ) {
		$id = get_page_by_path( 'error' );

	} elseif ( is_singular() ) {
		$id = get_the_id();
	}

	if ( is_object( $id ) ) {
		$url = wp_get_attachment_image_url( $id->ID, 'hero' );

	} elseif ( $id ) {
		$url = get_the_post_thumbnail_url( $id, 'hero' );
	}

	if ( ! $url ) {
		$url = get_header_image();
	}

	if ( $url ) {
		$selector = get_theme_support( 'custom-header', 'header-selector' );

		return printf( '<style id="hero-section" type="text/css">' . esc_attr( $selector ) . '{background-image:url(%s)}</style>' . "\n", esc_url( $url ) );

	} else {
		return '';
	}
}

/**
 * Helper function to check if we're on a WooCommerce page.
 *
 * @since  2.0.0
 *
 * @link   https://docs.woocommerce.com/document/conditional-tags/.
 *
 * @return bool
 */
function business_is_woocommerce_page() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return false;
	}

	if ( is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ) {
		return true;

	} else {
		return false;
	}
}

add_filter( 'http_request_args', 'business_dont_update_theme', 5, 2 );
/**
 * Don't Update Theme.
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @param  array  $request Request arguments.
 * @param  string $url     Request url.
 *
 * @return array  request arguments
 */
function business_dont_update_theme( $request, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) ) {
		return $request;
	}

	$themes = unserialize( $request['body']['themes'] );

	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );

	$request['body']['themes'] = serialize( $themes );

	return $request;
}

/**
 * Checks if a widget area contains a specific widget.
 *
 * @since  1.1.0
 *
 * @uses   $sidebars_widgets
 *
 * @param  string $sidebar Name of sidebar, e.g `primary`.
 * @param  string $widget  Widget ID to check, e.g `custom_html`.
 *
 * @return bool
 */
function business_sidebar_has_widget( $sidebar, $widget ) {
	global $sidebars_widgets;

	if ( ! empty( $sidebars_widgets[ $sidebar ][0] ) && strpos( $sidebars_widgets[ $sidebar ][0], $widget ) !== false && is_active_sidebar( $sidebar ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns formatted array of plugin dependencies.
 *
 * @since 1.2.0
 *
 * @param array $slugs Array of plugin slugs ('folder-name/file-name.php').
 *
 * @return array
 */
function business_get_plugin_dependencies( $slugs ) {
	$plugins = [];

	foreach ( $slugs as $slug ) {
		$handle    = strtok( $slug, '/' );
		$plugins[] = [
			'slug'       => $slug,
			'name'       => ucwords( str_replace( '-', ' ', $handle ) ),
			'public_url' => 'https://wordpress.org/plugins/' . trailingslashit( $handle ),
		];
	}

	return $plugins;
}
