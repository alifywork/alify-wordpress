<?php
/** Theme supports and navigation locations. */

defined( 'ABSPATH' ) || exit;

function alify_theme_setup() {
	load_theme_textdomain( 'alify', ALIFY_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 120, 'width' => 320, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'alify' ),
			'footer'  => __( 'Footer Menu', 'alify' ),
		)
	);
}
add_action( 'after_setup_theme', 'alify_theme_setup' );

/** Expose editable summaries for imported static-design Pages. */
function alify_enable_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'alify_enable_page_excerpts' );

/** Refresh rewrite rules once per theme version, after CPTs and taxonomies have registered. */
function alify_maybe_flush_rewrite_rules() {
	$version = defined( 'ALIFY_THEME_VERSION' ) ? ALIFY_THEME_VERSION : '';
	if ( ! $version || $version === get_option( 'alify_rewrite_rules_version' ) ) {
		return;
	}
	flush_rewrite_rules();
	update_option( 'alify_rewrite_rules_version', $version, false );
}
add_action( 'wp_loaded', 'alify_maybe_flush_rewrite_rules', 99 );
