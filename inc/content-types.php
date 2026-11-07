<?php
/** Public content types plus private form administration types. */

defined( 'ABSPATH' ) || exit;

function alify_register_content_types() {
	$types = array(
		'service'     => array( 'Services', 'Service', 'services' ),
		'work'        => array( 'Work', 'Work Item', 'work' ),
		'case_study'  => array( 'Case Studies', 'Case Study', 'case-studies' ),
		'industry'    => array( 'Industries', 'Industry', 'industries' ),
		'faq'         => array( 'FAQs', 'FAQ', 'faqs' ),
		'pricing'     => array( 'Pricing', 'Pricing Item', 'pricing' ),
		'testimonial' => array( 'Testimonials', 'Testimonial', 'testimonials' ),
	);

	foreach ( $types as $slug => $details ) {
		list( $plural, $singular, $rewrite_slug ) = $details;
		register_post_type(
			$slug,
			array(
				'labels' => array(
					'name'                  => __( $plural, 'alify' ),
					'singular_name'         => __( $singular, 'alify' ),
					'add_new_item'          => sprintf( __( 'Add New %s', 'alify' ), $singular ),
					'edit_item'             => sprintf( __( 'Edit %s', 'alify' ), $singular ),
					'new_item'              => sprintf( __( 'New %s', 'alify' ), $singular ),
					'view_item'             => sprintf( __( 'View %s', 'alify' ), $singular ),
					'search_items'          => sprintf( __( 'Search %s', 'alify' ), $plural ),
					'not_found'             => sprintf( __( 'No %s found', 'alify' ), strtolower( $plural ) ),
					'not_found_in_trash'    => sprintf( __( 'No %s found in Trash', 'alify' ), strtolower( $plural ) ),
					'all_items'             => sprintf( __( 'All %s', 'alify' ), $plural ),
					'menu_name'             => __( $plural, 'alify' ),
				),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_rest'       => true,
				'has_archive'        => $rewrite_slug,
				'rewrite'            => array( 'slug' => $rewrite_slug, 'with_front' => false ),
				'menu_position'      => 20,
				'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
				'map_meta_cap'       => true,
			)
		);
	}

	// Form definitions and entries are admin-managed records, not public pages.
	alify_register_admin_post_type( 'alify_form', __( 'Forms', 'alify' ), __( 'Form', 'alify' ), 'dashicons-feedback', true );
	alify_register_admin_post_type( 'alify_form_template', __( 'Form Templates', 'alify' ), __( 'Form Template', 'alify' ), 'dashicons-media-text', true );
	alify_register_admin_post_type( 'alify_form_entry', __( 'Form Entries', 'alify' ), __( 'Form Entry', 'alify' ), 'dashicons-email-alt', false );
}
add_action( 'init', 'alify_register_content_types' );

/** Register an internal, non-public content type for the form admin area. */
function alify_register_admin_post_type( $slug, $plural, $singular, $icon, $hierarchical ) {
	register_post_type(
		$slug,
		array(
			'labels' => array(
				'name'          => $plural,
				'singular_name' => $singular,
				'add_new_item'  => sprintf( __( 'Add New %s', 'alify' ), $singular ),
				'edit_item'     => sprintf( __( 'Edit %s', 'alify' ), $singular ),
				'all_items'     => sprintf( __( 'All %s', 'alify' ), $plural ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'show_in_rest'    => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive'     => false,
			'hierarchical'    => $hierarchical,
			'menu_icon'       => $icon,
			'supports'        => array( 'title', 'editor', 'revisions', 'custom-fields' ),
			'map_meta_cap'    => true,
		)
	);
}
