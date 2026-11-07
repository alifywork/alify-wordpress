<?php
/**
 * Alify Custom theme bootstrap.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

define( 'ALIFY_THEME_VERSION', '1.0.0' );
define( 'ALIFY_THEME_DIR', get_template_directory() );
define( 'ALIFY_THEME_URI', get_template_directory_uri() );

require_once ALIFY_THEME_DIR . '/inc/setup.php';
require_once ALIFY_THEME_DIR . '/inc/content-types.php';
require_once ALIFY_THEME_DIR . '/inc/taxonomies.php';
require_once ALIFY_THEME_DIR . '/inc/acf.php';
require_once ALIFY_THEME_DIR . '/inc/forms.php';
