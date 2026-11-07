<?php
/** Register manageable category and tag taxonomies for each content section. */

defined( 'ABSPATH' ) || exit;

function alify_register_taxonomies() {
	$sections = array(
		'service'     => array( 'service', 'Services', 'Service' ),
		'work'        => array( 'work', 'Work', 'Work' ),
		'case_study'  => array( 'case-study', 'Case Studies', 'Case Study' ),
		'industry'    => array( 'industry', 'Industries', 'Industry' ),
		'faq'         => array( 'faq', 'FAQs', 'FAQ' ),
		'pricing'     => array( 'pricing', 'Pricing', 'Pricing Item' ),
		'testimonial' => array( 'testimonial', 'Testimonials', 'Testimonial' ),
	);

	foreach ( $sections as $post_type => $details ) {
		list( $base, $label, $singular ) = $details;
		$category = $base . '_category';
		$tag      = $base . '_tag';

		register_taxonomy(
			$category,
			array( $post_type ),
			array(
				'labels' => array(
					'name'          => sprintf( __( '%s Categories', 'alify' ), $label ),
					'singular_name' => sprintf( __( '%s Category', 'alify' ), $singular ),
					'menu_name'     => __( 'Categories', 'alify' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => $base . '-category', 'with_front' => false ),
			)
		);

		register_taxonomy(
			$tag,
			array( $post_type ),
			array(
				'labels' => array(
					'name'          => sprintf( __( '%s Tags', 'alify' ), $label ),
					'singular_name' => sprintf( __( '%s Tag', 'alify' ), $singular ),
					'menu_name'     => __( 'Tags', 'alify' ),
				),
				'public'            => true,
				'hierarchical'      => false,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'rewrite'           => array( 'slug' => $base . '-tag', 'with_front' => false ),
			)
		);
	}
}
add_action( 'init', 'alify_register_taxonomies', 20 );
