<?php
/**
 * Business Pro Theme
 *
 * @package   BusinessProTheme
 * @link      https://seothemes.com/themes/business-pro
 * @author    SEO Themes
 * @copyright Copyright © 2019 SEO Themes
 * @license   GPL-3.0-or-later
 */

// If this file is called directly, abort..
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Start the engine (do not remove).
include_once get_template_directory() . '/lib/init.php';

// Load setup functions.
include_once __DIR__ . '/includes/setup.php';

// Load helper functions.
include_once __DIR__ . '/includes/helpers.php';

// Load scripts and styles.
include_once __DIR__ . '/includes/enqueue.php';

// Load general functionality.
include_once __DIR__ . '/includes/general.php';

// Load hero section.
include_once __DIR__ . '/includes/hero.php';

// Load widget areas.
include_once __DIR__ . '/includes/widgets.php';

// Load Customizer settings.
include_once __DIR__ . '/includes/customize.php';

// Load default settings.
include_once __DIR__ . '/includes/defaults.php';
