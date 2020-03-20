<?php
/**
 * Genesis Sample.
 *
 * Onboarding config to load plugins and homepage content on theme activation.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

return apply_filters( 'business_pro_config_onboarding', [
	'dependencies'     => [
		'plugins' => business_get_plugin_dependencies( genesis_get_config( 'plugins' ) ),
	],
	'content'          => [
		'home'    => [
			'post_title'     => 'Home',
			'post_content'   => require __DIR__ . '/import/content/home.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'page_template'  => 'templates/blocks.php',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		],
		'blocks'  => [
			'post_title'     => 'Block Content Examples',
			'post_content'   => require __DIR__ . '/import/content/blocks.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'page_template'  => 'templates/blocks.php',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		],
		'about'   => [
			'post_title'     => 'About Us',
			'post_content'   => require __DIR__ . '/import/content/about.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'page_template'  => 'templates/blocks.php',
			'featured_image' => get_stylesheet_directory_uri() . '/config/import/images/about.jpg',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		],
		'contact' => [
			'post_title'     => 'Contact Us',
			'post_content'   => require __DIR__ . '/import/content/contact.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'featured_image' => get_stylesheet_directory() . '/config/import/images/contact.jpg',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		],
		'landing' => [
			'post_title'     => 'Landing Page',
			'post_content'   => require __DIR__ . '/import/content/landing.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'page_template'  => 'templates/landing.php',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		],
	],
	'navigation_menus' => [
		'primary' => [
			'home'    => [
				'title' => 'Home',
			],
			'about'   => [
				'title' => 'About Us',
			],
			'contact' => [
				'title' => 'Contact Us',
			],
			'blocks'  => [
				'title' => 'Block Examples',
			],
			'landing' => [
				'title' => 'Landing Page',
			],
		],
	],
] );
