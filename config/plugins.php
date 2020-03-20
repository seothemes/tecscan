<?php

$plugins = [
	'tecscanfile/tecscanfile.php',
	'genesis-portfolio-pro/genesis-portfolio-pro.php',
	'genesis-simple-faq/genesis-simple-faq.php',
	'genesis-simple-share/plugin.php',
	'wpstudio-testimonial-slider/genesis-testimonials.php',
	'genesis-widget-column-classes/genesis-widget-column-classes.php',
	'icon-widget/icon-widget.php',
	'wp-featherlight/wp-featherlight.php',
	'wpforms-lite/wpforms.php',
	'genesis-enews-extended/plugin.php',
	'simple-social-icons/simple-social-icons.php',
];

// Add Genesis Connect if WooCommerce is installed.
class_exists( 'WooCommerce' ) && $plugins[] = 'genesis-connect-woocommerce/genesis-connect-woocommerce.php';

return $plugins;
