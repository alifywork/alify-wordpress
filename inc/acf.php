<?php
/** Optional ACF Pro options pages and foundational site settings. */

defined( 'ABSPATH' ) || exit;

function alify_register_acf_options_pages() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Theme Settings', 'alify' ),
			'menu_title' => __( 'Theme Settings', 'alify' ),
			'menu_slug'  => 'alify-theme-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
			'icon_url'   => 'dashicons-admin-customizer',
			'position'   => 59,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'General Settings', 'alify' ),
			'menu_title'  => __( 'General', 'alify' ),
			'parent_slug' => 'alify-theme-settings',
		)
	);
	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Header & Footer Settings', 'alify' ),
			'menu_title'  => __( 'Header & Footer', 'alify' ),
			'parent_slug' => 'alify-theme-settings',
		)
	);
	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Forms Settings', 'alify' ),
			'menu_title'  => __( 'Forms', 'alify' ),
			'parent_slug' => 'alify-theme-settings',
		)
	);
}
add_action( 'acf/init', 'alify_register_acf_options_pages' );

/** Local ACF field groups make the core settings available immediately with ACF Pro. */
function alify_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key' => 'group_alify_general_settings',
			'title' => __( 'General Theme Settings', 'alify' ),
			'fields' => array(
				array( 'key' => 'field_alify_site_logo', 'label' => __( 'Site Logo', 'alify' ), 'name' => 'site_logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'library' => 'all' ),
				array( 'key' => 'field_alify_contact_email', 'label' => __( 'Contact Email', 'alify' ), 'name' => 'contact_email', 'type' => 'email' ),
				array( 'key' => 'field_alify_contact_phone', 'label' => __( 'Contact Phone', 'alify' ), 'name' => 'contact_phone', 'type' => 'text' ),
				array( 'key' => 'field_alify_address', 'label' => __( 'Business Address', 'alify' ), 'name' => 'business_address', 'type' => 'textarea', 'rows' => 3 ),
			),
			'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-general' ) ) ),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'active' => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key' => 'group_alify_header_footer_settings',
			'title' => __( 'Header & Footer Settings', 'alify' ),
			'fields' => array(
				array( 'key' => 'field_alify_header_cta_label', 'label' => __( 'Header Call-to-Action Label', 'alify' ), 'name' => 'header_cta_label', 'type' => 'text' ),
				array( 'key' => 'field_alify_header_cta_url', 'label' => __( 'Header Call-to-Action URL', 'alify' ), 'name' => 'header_cta_url', 'type' => 'url' ),
				array( 'key' => 'field_alify_footer_copyright', 'label' => __( 'Footer Copyright Text', 'alify' ), 'name' => 'footer_copyright', 'type' => 'text' ),
				array( 'key' => 'field_alify_social_links', 'label' => __( 'Social Links', 'alify' ), 'name' => 'social_links', 'type' => 'repeater', 'layout' => 'row', 'button_label' => __( 'Add Social Link', 'alify' ), 'sub_fields' => array(
					array( 'key' => 'field_alify_social_label', 'label' => __( 'Network Name', 'alify' ), 'name' => 'label', 'type' => 'text', 'required' => 1 ),
					array( 'key' => 'field_alify_social_url', 'label' => __( 'Profile URL', 'alify' ), 'name' => 'url', 'type' => 'url', 'required' => 1 ),
				) ),
			),
			'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-header-footer' ) ) ),
			'menu_order' => 0,
			'position' => 'normal',
			'active' => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key' => 'group_alify_form_settings',
			'title' => __( 'Forms Configuration', 'alify' ),
			'fields' => array(
				array( 'key' => 'field_alify_forms_notification_email', 'label' => __( 'Default Notification Email', 'alify' ), 'name' => 'forms_notification_email', 'type' => 'email' ),
				array( 'key' => 'field_alify_forms_success_message', 'label' => __( 'Default Success Message', 'alify' ), 'name' => 'forms_success_message', 'type' => 'textarea', 'rows' => 3 ),
				array( 'key' => 'field_alify_forms_privacy_page', 'label' => __( 'Privacy Policy Page', 'alify' ), 'name' => 'forms_privacy_page', 'type' => 'post_object', 'post_type' => array( 'page' ), 'return_format' => 'id', 'ui' => 1 ),
			),
			'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-forms' ) ) ),
			'menu_order' => 0,
			'position' => 'normal',
			'active' => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key' => 'group_alify_form_definition',
			'title' => __( 'Form Definition', 'alify' ),
			'fields' => array(
				array( 'key' => 'field_alify_form_fields', 'label' => __( 'Fields', 'alify' ), 'name' => 'form_fields', 'type' => 'repeater', 'layout' => 'row', 'button_label' => __( 'Add Form Field', 'alify' ), 'sub_fields' => array(
					array( 'key' => 'field_alify_form_field_label', 'label' => __( 'Label', 'alify' ), 'name' => 'label', 'type' => 'text', 'required' => 1 ),
					array( 'key' => 'field_alify_form_field_name', 'label' => __( 'Field Name', 'alify' ), 'name' => 'field_name', 'type' => 'text', 'required' => 1 ),
					array( 'key' => 'field_alify_form_field_type', 'label' => __( 'Field Type', 'alify' ), 'name' => 'field_type', 'type' => 'select', 'choices' => array( 'text' => 'Text', 'email' => 'Email', 'tel' => 'Phone', 'textarea' => 'Textarea', 'select' => 'Select', 'checkbox' => 'Checkbox', 'radio' => 'Radio' ), 'default_value' => 'text', 'ui' => 1 ),
					array( 'key' => 'field_alify_form_field_required', 'label' => __( 'Required', 'alify' ), 'name' => 'required', 'type' => 'true_false', 'ui' => 1 ),
					array( 'key' => 'field_alify_form_field_options', 'label' => __( 'Options (one per line)', 'alify' ), 'name' => 'options', 'type' => 'textarea', 'rows' => 3, 'conditional_logic' => array( array( array( 'field' => 'field_alify_form_field_type', 'operator' => '==', 'value' => 'select' ) ) ) ),
				) ),
				array( 'key' => 'field_alify_form_recipient', 'label' => __( 'Notification Recipient', 'alify' ), 'name' => 'notification_recipient', 'type' => 'email' ),
				array( 'key' => 'field_alify_form_success', 'label' => __( 'Success Message', 'alify' ), 'name' => 'success_message', 'type' => 'textarea', 'rows' => 3 ),
			),
			'location' => array(
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'alify_form' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'alify_form_template' ) ),
			),
			'active' => true,
		)
	);
}
add_action( 'acf/init', 'alify_register_acf_fields' );
