<?php
/**
 * TecScan
 *
 * This file contains theme specific functions for the TecScan.
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

add_filter( 'body_class', 'tecscan_body_classes' );
/**
 * Add additional classes to the body element.
 *
 * Adds some extra classes to the body element which help with styling the
 * same elements differently depending on which settings the user has
 * chosen from either the Customizer, Widget Areas or Navigation.
 *
 * @since  0.1.0
 *
 * @param  array $classes Body classes.
 *
 * @return array
 */
function tecscan_body_classes( $classes ) {

	if ( '1' == get_theme_mod( 'tecscan_fixed_header', '0' ) ) {
		$classes[] = 'has-fixed-header';
	}

	if ( is_active_sidebar( 'before-header' ) ) {
		$classes[] = 'has-before-header';
	}

	if ( has_nav_menu( 'secondary' ) ) {
		$classes[] = 'has-nav-secondary';
	}

	if ( tecscan_sidebar_has_widget( 'front-page-1', 'seo_slider' ) ) {
		$classes[] = 'has-hero-slider';
	}

	if ( current_theme_supports( 'fixed-header' ) ) {
		$classes[] = 'has-fixed-header';
	}

	$classes[] = 'no-js';

	return $classes;
}

add_action( 'genesis_before', 'tecscan_js_nojs_script', 1 );
/**
 * Echo out the script that changes 'no-js' class to 'js'.
 *
 * Adds a no-js body class to the front end, and a script on the genesis_before
 * hook which immediately changes the class to js if JavaScript is enabled.
 * This is how WP does things on the back end, to allow different styles
 * for the same elements depending if JavaScript is active or not.
 *
 * Outputting the script immediately also reduces a flash of incorrectly styled
 * content, as the page does not load with no-js styles, then switch to js
 * once everything has finished loading.
 *
 * @since  0.1.0
 *
 * @return void
 */
function tecscan_js_nojs_script() {
	?>
	<script>
		//<![CDATA[
		( function() {
			var c = document.body.classList;
			c.remove( 'no-js' );
			c.add( 'js' );
		} )();
		//]]>
	</script>
	<?php
}

add_action( 'gts', 'tecscan_wrap_open', 3 );
/**
 * Custom opening wrapper div.
 *
 * @since  1.0.0
 *
 * @return void
 */
function tecscan_wrap_open() {
	echo '<div class="wrap">';
}

add_action( 'gts', 'tecscan_wrap_close', 13 );
/**
 * Custom closing wrapper div.
 *
 * @since  1.0.0
 *
 * @return void
 */
function tecscan_wrap_close() {
	echo '</div>';
}

add_action( 'genesis_entry_header', 'tecscan_reposition_post_meta', 0 );
/**
 * Reposition post info and remove excerpts on archives.
 *
 * Small customization to reposition the post info and remove the excerpt links
 * on all archive pages including search results, blog page, categories etc.
 *
 * @since 0.1.0
 *
 * @return void
 */
function tecscan_reposition_post_meta() {
	if ( is_archive() || is_home() || is_search() || is_post_type_archive() ) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		add_action( 'genesis_entry_header', 'genesis_post_info', 1 );
	}
}

add_filter( 'genesis_post_info', 'tecscan_post_info_date' );
/**
 * Change the default post info on archives.
 *
 * Replaces the default post info (author, comments, edit link) with just the
 * date of the post, which is then repositioned above the entry title with
 * the tecscan_reposition_post_meta() function above on archive pages.
 *
 * @since  0.1.0
 *
 * @param  string $post_info The default post information.
 *
 * @return string
 */
function tecscan_post_info_date( $post_info ) {
	if ( is_archive() || is_home() || is_search() || is_post_type_archive() ) {
		$post_info = '[post_date]';
	}

	return $post_info;
}

add_filter( 'genesis_post_meta', 'tecscan_post_meta_filter' );
/**
 * Customize the entry meta in the entry footer.
 *
 * This function filters the genesis post meta to display SVG icons before the
 * post categories and post tags on archive pages including the search page,
 * blog, category and tag pages. SVG images are included with the theme.
 *
 * @since  0.1.0
 *
 * @param  string $post_meta Default post meta.
 *
 * @return string
 */
function tecscan_post_meta_filter( $post_meta ) {
	if ( is_archive() || is_home() || is_search() || ! is_post_type_archive() ) {
		$cat_img   = '<img width=\'20\' height=\'20\' src=\'' . get_stylesheet_directory_uri() . '/assets/images/cats.svg\'>';
		$tag_img   = '<img width=\'20\' height=\'20\' src=\'' . get_stylesheet_directory_uri() . '/assets/images/tags.svg\'>';
		$post_meta = '[post_categories before="' . $cat_img . '" sep=",&nbsp;"] [post_tags before="' . $tag_img . '" sep=",&nbsp;"]';
	}

	return $post_meta;
}

add_filter( 'genesis_markup_title-area_close', 'tecscan_after_title_area', 10, 2 );
/**
 * Appends HTML to the closing markup for .title-area.
 *
 * Adding something between the title + description and widget area used to require
 * re-building genesis_do_header(). However, since the title-area closing markup
 * now goes through genesis_markup(), it means we now have some extra filters
 * to play with. This function makes use of this and adds in an extra hook
 * after the title-area used for displaying the primary navigation menu.
 *
 * @since  1.0.5
 *
 * @param  string $close_html HTML tag being processed by the API.
 * @param  array  $args       Array with markup arguments.
 *
 * @return string
 */
function tecscan_after_title_area( $close_html, $args ) {
	if ( $close_html ) {
		ob_start();
		do_action( 'genesis_after_title_area' );
		$close_html = $close_html . ob_get_clean();
	}

	return $close_html;
}

add_action( 'init', 'tecscan_structural_wrap_hooks' );
/**
 * Add hooks immediately before and after Genesis structural wraps.
 *
 * @since   2.3.0
 *
 * @version 1.1.0
 * @author  Tim Jensen
 * @link    https://timjensen.us/add-hooks-before-genesis-structural-wraps
 *
 * @return void
 */
function tecscan_structural_wrap_hooks() {
	$wraps = get_theme_support( 'genesis-structural-wraps' );

	foreach ( $wraps[0] as $context ) {

		/**
		 * Inserts an action hook before the opening div and after the closing div
		 * for each of the structural wraps.
		 *
		 * @param string $output   HTML for opening or closing the structural wrap.
		 * @param string $original Either 'open' or 'close'.
		 *
		 * @return string
		 */
		add_filter( "genesis_structural_wrap-{$context}", function ( $output, $original ) use ( $context ) {
			$position = ( 'open' === $original ) ? 'before' : 'after';

			ob_start();
			do_action( "genesis_{$position}_{$context}_wrap" );
			if ( 'open' === $original ) {
				return ob_get_clean() . $output;
			} else {
				return $output . ob_get_clean();
			}
		}, 10, 2 );
	}
}

add_action( 'genesis_after_content_sidebar_wrap', 'tecscan_prev_next_post_nav_cpt', 99 );
/**
 * Enable prev/next links in portfolio.
 *
 * @since  1.0.0
 *
 * @return void
 */
function tecscan_prev_next_post_nav_cpt() {
	if ( ! is_singular( 'portfolio' ) && ! is_singular( 'product' ) ) {
		return;
	}

	genesis_markup( [
		'html5'   => '<div %s><div class="wrap">',
		'xhtml'   => '<div class="navigation">',
		'context' => 'adjacent-entry-pagination',
	] );

	echo '<div class="pagination-previous alignleft">';
	previous_post_link();
	echo '</div>';
	echo '<div class="pagination-next alignright">';
	next_post_link();
	echo '</div>';

	echo '</div></div>';
}

add_action( 'genesis_before', 'tecscan_remove_sidebars' );
/**
 * Force full-width-layout for custom layout.
 *
 * @since  1.0.0
 *
 * @return void
 */
function tecscan_remove_sidebars() {
	$site_layout = genesis_site_layout();

	if ( 'centered-content' !== $site_layout ) {
		return;
	}

	add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
}

add_action( 'genesis_before', 'tecscan_woocommerce_demo_store' );
/**
 * Reposition WooCommerce store notice.
 *
 * @since  1.0.5
 *
 * @return void
 */
function tecscan_woocommerce_demo_store() {
	if ( tecscan_is_woocommerce_page() ) {
		remove_action( 'wp_footer', 'woocommerce_demo_store' );
		add_action( 'genesis_before_header_wrap', 'woocommerce_demo_store' );
	}
}

add_filter( 'header_video_settings', 'tecscan_header_video_min_width', 10, 1 );
/**
 * Change minimum width to show the header video.
 *
 * @since 1.1.0
 *
 * @link  https://make.wordpress.org/core/2016/11/26/video-headers-in-4-7/
 *
 * @param array $settings Custom header video settings.
 *
 * @return array
 */
function tecscan_header_video_min_width( $settings ) {
	$settings['minWidth'] = 1025;

	return $settings;
}
