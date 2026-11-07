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
				array( 'key' => 'field_alify_archive_description', 'label' => __( 'Archive Description', 'alify' ), 'name' => 'archive_description', 'type' => 'textarea', 'rows' => 3, 'instructions' => __( 'Optional introduction shown on database-driven archives.', 'alify' ) ),
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
			'key' => 'group_alify_content_builder',
			'title' => __( 'Alify Page Content', 'alify' ),
			'fields' => array(
				array( 'key' => 'field_alify_hero_eyebrow', 'label' => __( 'Hero Eyebrow', 'alify' ), 'name' => 'hero_eyebrow', 'type' => 'text' ),
				array( 'key' => 'field_alify_hero_title', 'label' => __( 'Hero Title', 'alify' ), 'name' => 'hero_title', 'type' => 'text' ),
				array( 'key' => 'field_alify_hero_description', 'label' => __( 'Hero Description', 'alify' ), 'name' => 'hero_description', 'type' => 'textarea', 'rows' => 3 ),
				array( 'key' => 'field_alify_hero_background', 'label' => __( 'Hero Background', 'alify' ), 'name' => 'hero_background', 'type' => 'select', 'choices' => array(
					'neon-lines-01.webp' => 'Neon 01', 'neon-lines-02.webp' => 'Neon 02', 'neon-lines-03.webp' => 'Neon 03', 'neon-lines-04.webp' => 'Neon 04',
					'neon-lines-05.webp' => 'Neon 05', 'neon-lines-06.webp' => 'Neon 06', 'neon-lines-07.webp' => 'Neon 07', 'neon-lines-08.webp' => 'Neon 08',
					'neon-lines-09.webp' => 'Neon 09', 'neon-lines-10.webp' => 'Neon 10', 'neon-lines-11.webp' => 'Neon 11', 'neon-lines-12.webp' => 'Neon 12',
					'neon-lines-13.webp' => 'Neon 13', 'neon-lines-14.webp' => 'Neon 14',
			), 'ui' => 1 ),
				array( 'key' => 'field_alify_page_sections', 'label' => __( 'Page Sections', 'alify' ), 'name' => 'page_sections', 'type' => 'flexible_content', 'button_label' => __( 'Add Section', 'alify' ), 'layouts' => array(
					'layout_alify_text_section' => array(
						'key' => 'layout_alify_text_section', 'name' => 'text_section', 'label' => __( 'Text Section', 'alify' ), 'display' => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_alify_text_eyebrow', 'label' => __( 'Eyebrow', 'alify' ), 'name' => 'eyebrow', 'type' => 'text' ),
							array( 'key' => 'field_alify_text_heading', 'label' => __( 'Heading', 'alify' ), 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_alify_text_body', 'label' => __( 'Body', 'alify' ), 'name' => 'body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0 ),
						),
					),
					'layout_alify_image_text' => array(
						'key' => 'layout_alify_image_text', 'name' => 'image_text', 'label' => __( 'Image & Text', 'alify' ), 'display' => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_alify_image_text_eyebrow', 'label' => __( 'Eyebrow', 'alify' ), 'name' => 'eyebrow', 'type' => 'text' ),
							array( 'key' => 'field_alify_image_text_heading', 'label' => __( 'Heading', 'alify' ), 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_alify_image_text_body', 'label' => __( 'Body', 'alify' ), 'name' => 'body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0 ),
							array( 'key' => 'field_alify_image_text_image', 'label' => __( 'Image', 'alify' ), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),
							array( 'key' => 'field_alify_image_text_alt', 'label' => __( 'Image Alt Text', 'alify' ), 'name' => 'image_alt', 'type' => 'text' ),
						),
					),
					'layout_alify_card_grid' => array(
						'key' => 'layout_alify_card_grid', 'name' => 'card_grid', 'label' => __( 'Card Grid', 'alify' ), 'display' => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_alify_cards_eyebrow', 'label' => __( 'Eyebrow', 'alify' ), 'name' => 'eyebrow', 'type' => 'text' ),
							array( 'key' => 'field_alify_cards_heading', 'label' => __( 'Heading', 'alify' ), 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_alify_cards_items', 'label' => __( 'Cards', 'alify' ), 'name' => 'cards', 'type' => 'repeater', 'layout' => 'row', 'button_label' => __( 'Add Card', 'alify' ), 'sub_fields' => array(
								array( 'key' => 'field_alify_card_title', 'label' => __( 'Title', 'alify' ), 'name' => 'title', 'type' => 'text', 'required' => 1 ),
								array( 'key' => 'field_alify_card_copy', 'label' => __( 'Description', 'alify' ), 'name' => 'copy', 'type' => 'textarea', 'rows' => 2 ),
								array( 'key' => 'field_alify_card_image', 'label' => __( 'Image', 'alify' ), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail' ),
								array( 'key' => 'field_alify_card_url', 'label' => __( 'Link URL', 'alify' ), 'name' => 'url', 'type' => 'url' ),
							), ),
						),
					),
					'layout_alify_faq_group' => array(
						'key' => 'layout_alify_faq_group', 'name' => 'faq_group', 'label' => __( 'FAQ Group', 'alify' ), 'display' => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_alify_faq_group_heading', 'label' => __( 'Heading', 'alify' ), 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_alify_faq_items', 'label' => __( 'Questions', 'alify' ), 'name' => 'questions', 'type' => 'repeater', 'layout' => 'row', 'button_label' => __( 'Add Question', 'alify' ), 'sub_fields' => array(
								array( 'key' => 'field_alify_faq_question', 'label' => __( 'Question', 'alify' ), 'name' => 'question', 'type' => 'text', 'required' => 1 ),
								array( 'key' => 'field_alify_faq_answer', 'label' => __( 'Answer', 'alify' ), 'name' => 'answer', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0 ),
							), ),
						),
					),
					'layout_alify_cta' => array(
						'key' => 'layout_alify_cta', 'name' => 'call_to_action', 'label' => __( 'Call to Action', 'alify' ), 'display' => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_alify_cta_heading', 'label' => __( 'Heading', 'alify' ), 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_alify_cta_copy', 'label' => __( 'Description', 'alify' ), 'name' => 'copy', 'type' => 'textarea', 'rows' => 3 ),
							array( 'key' => 'field_alify_cta_button', 'label' => __( 'Button Label', 'alify' ), 'name' => 'button_label', 'type' => 'text' ),
							array( 'key' => 'field_alify_cta_url', 'label' => __( 'Button URL', 'alify' ), 'name' => 'button_url', 'type' => 'url' ),
						),
					),
				), 'button_label' => __( 'Add Content Section', 'alify' ) ),
			),
			'location' => array(
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'service' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'work' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'case_study' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'industry' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'faq' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'pricing' ) ),
				array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ) ),
			),
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
					array( 'key' => 'field_alify_form_field_type', 'label' => __( 'Field Type', 'alify' ), 'name' => 'field_type', 'type' => 'select', 'choices' => array( 'text' => 'Text', 'email' => 'Email', 'tel' => 'Phone', 'url' => 'URL', 'textarea' => 'Textarea', 'select' => 'Select', 'checkbox' => 'Checkbox', 'radio' => 'Radio' ), 'default_value' => 'text', 'ui' => 1 ),
					array( 'key' => 'field_alify_form_field_required', 'label' => __( 'Required', 'alify' ), 'name' => 'required', 'type' => 'true_false', 'ui' => 1 ),
					array( 'key' => 'field_alify_form_field_options', 'label' => __( 'Options (one per line; use Label|value for custom values)', 'alify' ), 'name' => 'options', 'type' => 'textarea', 'rows' => 3 ),
				) ),
				array( 'key' => 'field_alify_form_template', 'label' => __( 'Use Form Template', 'alify' ), 'name' => 'form_template', 'type' => 'post_object', 'post_type' => array( 'alify_form_template' ), 'return_format' => 'id', 'ui' => 1, 'instructions' => __( 'Select a reusable form template. The form uses its field list when this form has no fields of its own.', 'alify' ) ),
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
