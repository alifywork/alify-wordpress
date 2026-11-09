<?php
/** Source-derived ACF page and archive fields. */
defined( 'ABSPATH' ) || exit;

/** Load the generated source inventory once per request. */
function alify_get_acf_page_field_data() {
	static $data = null;
	if ( null === $data ) {
		$file = __DIR__ . '/acf-page-field-data.json';
		$data = is_readable( $file ) ? json_decode( file_get_contents( $file ), true ) : array();
		$data = is_array( $data ) ? $data : array();
	}
	return $data;
}

/** Dynamic archives have no singular record, so their editors live in options. */
function alify_get_acf_archive_page_slugs() {
	return array( 'blog', 'case-studies', 'faqs', 'industries', 'pricing', 'projects', 'services', 'testimonials' );
}

/** Source single layouts available as structured starters for every matching content type. */
function alify_get_acf_single_template_types() {
	return array( 'blog-single' => 'post', 'service-single' => 'service', 'project-single' => 'work', 'case-study-single' => 'case_study', 'industry-single' => 'industry' );
}

/** Add selectors for source pages and type-wide single-template groups. */
function alify_acf_register_source_page_location_rule( $choices ) {
	$choices['Alify']['alify_source_page'] = __( 'Alify source page', 'alify' );
	$choices['Alify']['alify_source_single_type'] = __( 'Alify single content type', 'alify' );
	$choices['Alify']['alify_not_source_managed'] = __( 'Not managed by a source template', 'alify' );
	return $choices;
}
add_filter( 'acf/location/rule_types', 'alify_acf_register_source_page_location_rule' );

function alify_acf_source_page_location_values( $choices ) {
	foreach ( alify_get_acf_page_field_data() as $slug => $page ) {
		$choices[ $slug ] = isset( $page['title'] ) ? sanitize_text_field( $page['title'] ) : $slug;
	}
	return $choices;
}
add_filter( 'acf/location/rule_values/alify_source_page', 'alify_acf_source_page_location_values' );

function alify_acf_source_single_type_values( $choices ) {
	$labels = array( 'post' => __( 'Blog Posts', 'alify' ), 'service' => __( 'Services', 'alify' ), 'work' => __( 'Work', 'alify' ), 'case_study' => __( 'Case Studies', 'alify' ), 'industry' => __( 'Industries', 'alify' ) );
	foreach ( array_unique( alify_get_acf_single_template_types() ) as $type ) {
		$choices[ $type ] = $labels[ $type ] ?? $type;
	}
	return $choices;
}
add_filter( 'acf/location/rule_values/alify_source_single_type', 'alify_acf_source_single_type_values' );


function alify_acf_source_managed_values( $choices ) {
	$choices['1'] = __( 'No source-template field group applies', 'alify' );
	return $choices;
}
add_filter( 'acf/location/rule_values/alify_not_source_managed', 'alify_acf_source_managed_values' );

function alify_acf_current_editor_post_id() {
	$post_id = 0;
	if ( isset( $_GET['post'] ) ) {
		$post_id = absint( wp_unslash( $_GET['post'] ) );
	} elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = absint( wp_unslash( $_POST['post_ID'] ) );
	}
	return $post_id;
}



function alify_is_source_template_managed( $post_id ) {
	$post_id = absint( $post_id );
	if ( ! $post_id ) {
		return false;
	}
	$slug = sanitize_title( (string) get_post_meta( $post_id, '_alify_source_slug', true ) );
	if ( ! $slug ) {
		$slug = sanitize_title( (string) get_post_field( 'post_name', $post_id ) );
	}
	if ( 'home' === $slug ) {
		$slug = 'index';
	}
	$data = alify_get_acf_page_field_data();
	$is_source_page = isset( $data[ $slug ] ) && ! in_array( $slug, alify_get_acf_archive_page_slugs(), true );
	$is_source_single = in_array( get_post_type( $post_id ), array_values( alify_get_acf_single_template_types() ), true );
	return $is_source_page || $is_source_single;
}


function alify_use_block_editor_for_source_managed_records( $use_block_editor, $post ) {
	if ( $post instanceof WP_Post && alify_is_source_template_managed( $post->ID ) ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'alify_use_block_editor_for_source_managed_records', 10, 2 );

/** Keep the Gutenberg block builder off for the site's public content types. */
function alify_disable_block_editor_for_alify_content_types( $use_block_editor, $post_type ) {
	$alify_content_types = array( 'page', 'post', 'service', 'work', 'case_study', 'industry', 'faq', 'pricing', 'testimonial' );
	return in_array( $post_type, $alify_content_types, true ) ? false : $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'alify_disable_block_editor_for_alify_content_types', 10, 2 );

function alify_hide_standard_editor_for_source_managed_records() {
	global $post;
	if ( $post instanceof WP_Post && alify_is_source_template_managed( $post->ID ) ) {
		remove_meta_box( 'postdivrich', $post->post_type, 'normal' );
	}
}
add_action( 'add_meta_boxes', 'alify_hide_standard_editor_for_source_managed_records', 99 );

function alify_acf_match_not_source_managed( $match, $rule, $options, $field_group ) {
	$post_id = 0;
	if ( isset( $options['post_id'] ) && is_numeric( $options['post_id'] ) ) {
		$post_id = absint( $options['post_id'] );
	} elseif ( isset( $options['post_id'] ) && preg_match( '/^post_(\d+)$/', (string) $options['post_id'], $post_match ) ) {
		$post_id = absint( $post_match[1] );
	}
	if ( ! $post_id ) {
		$post_id = alify_acf_current_editor_post_id();
	}
	if ( ! $post_id ) {
		return false;
	}
	$matches = ! alify_is_source_template_managed( $post_id );
	$operator = isset( $rule['operator'] ) ? $rule['operator'] : '==';
	return '!=' === $operator ? ! $matches : $matches;
}
add_filter( 'acf/location/rule_match/alify_not_source_managed', 'alify_acf_match_not_source_managed', 10, 4 );

function alify_acf_match_source_page_location( $match, $rule, $options, $field_group ) {
	$post_id = 0;
	if ( isset( $options['post_id'] ) && is_numeric( $options['post_id'] ) ) {
		$post_id = absint( $options['post_id'] );
	} elseif ( isset( $options['post_id'] ) && preg_match( '/^post_(\d+)$/', (string) $options['post_id'], $post_match ) ) {
		$post_id = absint( $post_match[1] );
	}
	if ( ! $post_id ) {
		$post_id = alify_acf_current_editor_post_id();
	}
	if ( ! $post_id ) {
		return false;
	}
	$slug = sanitize_title( (string) get_post_meta( $post_id, '_alify_source_slug', true ) );
	if ( ! $slug ) {
		$slug = sanitize_title( (string) get_post_field( 'post_name', $post_id ) );
	}
	if ( 'home' === $slug ) {
		$slug = 'index';
	}
	$operator = isset( $rule['operator'] ) ? $rule['operator'] : '==';
	$value    = isset( $rule['value'] ) ? (string) $rule['value'] : '';
	$equal    = $slug === $value;
	return '!=' === $operator ? ! $equal : $equal;
}
add_filter( 'acf/location/rule_match/alify_source_page', 'alify_acf_match_source_page_location', 10, 4 );

function alify_acf_match_source_single_type( $match, $rule, $options, $field_group ) {
	$post_id = 0;
	if ( isset( $options['post_id'] ) && is_numeric( $options['post_id'] ) ) {
		$post_id = absint( $options['post_id'] );
	} elseif ( isset( $options['post_id'] ) && preg_match( '/^post_(\\d+)$/', (string) $options['post_id'], $post_match ) ) {
		$post_id = absint( $post_match[1] );
	}
	if ( ! $post_id ) {
		$post_id = alify_acf_current_editor_post_id();
	}
	if ( ! $post_id || get_post_type( $post_id ) !== $rule['value'] ) {
		return false;
	}
	$source_slug = sanitize_title( (string) get_post_meta( $post_id, '_alify_source_slug', true ) );
	if ( ! $source_slug ) {
		$source_slug = sanitize_title( (string) get_post_field( 'post_name', $post_id ) );
	}
	$data = alify_get_acf_page_field_data();
	$template_types = array_flip( alify_get_acf_single_template_types() );
	$template_slug = $template_types[ get_post_type( $post_id ) ] ?? '';
	$matches_specific_source = isset( $data[ $source_slug ] ) && ! in_array( $source_slug, alify_get_acf_archive_page_slugs(), true ) && $source_slug !== $template_slug;
	$operator = isset( $rule['operator'] ) ? $rule['operator'] : '==';
	$equal = ! $matches_specific_source;
	return '!=' === $operator ? ! $equal : $equal;
}
add_filter( 'acf/location/rule_match/alify_source_single_type', 'alify_acf_match_source_single_type', 10, 4 );

/** Seed shared hero defaults from each source page's inventory. */
function alify_acf_load_source_hero_default( $field ) {
	$names = array(
		'hero_eyebrow'     => 'eyebrow',
		'hero_title'       => 'title',
		'hero_description' => 'description',
		'hero_background'  => 'background',
		'hero_variant'     => 'variant',
	);
	$name = isset( $field['name'] ) ? $field['name'] : '';
	if ( ! isset( $names[ $name ] ) ) {
		return $field;
	}
	$post_id = alify_acf_current_editor_post_id();
	if ( ! $post_id ) {
		return $field;
	}
	$slug = sanitize_title( (string) get_post_meta( $post_id, '_alify_source_slug', true ) );
	if ( ! $slug ) {
		$slug = sanitize_title( (string) get_post_field( 'post_name', $post_id ) );
	}
	if ( 'home' === $slug ) {
		$slug = 'index';
	}
	$data = alify_get_acf_page_field_data();
	if ( ! isset( $data[ $slug ] ) ) {
		$template_types = array_flip( alify_get_acf_single_template_types() );
		$post_type = get_post_type( $post_id );
		if ( isset( $template_types[ $post_type ] ) ) {
			$slug = $template_types[ $post_type ];
		}
	}
	$key  = $names[ $name ];
	if ( isset( $data[ $slug ]['hero'][ $key ] ) && '' !== $data[ $slug ]['hero'][ $key ] ) {
		$value = $data[ $slug ]['hero'][ $key ];
		$field['default_value'] = 'background' === $key ? wp_basename( $value ) : $value;
	}
	return $field;
}
foreach ( array( 'hero_eyebrow', 'hero_title', 'hero_description', 'hero_background', 'hero_variant' ) as $alify_hero_field_name ) {
	add_filter( 'acf/load_field/name=' . $alify_hero_field_name, 'alify_acf_load_source_hero_default' );
}

/** Build structured fields for one section, including fixed content and repeatable cards. */
function alify_build_structured_section_fields( $section, $name_prefix, $key_prefix, $include_cards = true ) {
	$fields = array();
	foreach ( $section['elements'] ?? array() as $element ) {
		$element_number = sprintf( '%02d', absint( $element['index'] ) );
		$tag_labels = array( 'h1' => __( 'Heading', 'alify' ), 'h2' => __( 'Heading', 'alify' ), 'h3' => __( 'Heading', 'alify' ), 'h4' => __( 'Heading', 'alify' ), 'p' => __( 'Paragraph', 'alify' ), 'li' => __( 'List item', 'alify' ), 'a' => __( 'Link label', 'alify' ), 'button' => __( 'Button label', 'alify' ), 'label' => __( 'Label', 'alify' ), 'blockquote' => __( 'Quote', 'alify' ), 'span' => __( 'Inline text', 'alify' ), 'small' => __( 'Small text', 'alify' ), 'time' => __( 'Date/time', 'alify' ), 'summary' => __( 'Summary', 'alify' ), 'figcaption' => __( 'Image caption', 'alify' ), 'dt' => __( 'Term', 'alify' ), 'dd' => __( 'Definition', 'alify' ), 'th' => __( 'Table heading', 'alify' ), 'td' => __( 'Table cell', 'alify' ) );
		$label = $tag_labels[ $element['tag'] ] ?? __( 'Content', 'alify' );
		$preview = sanitize_text_field( $element['label'] ?? '' );
		if ( '' !== $preview ) {
			$label .= ' — ' . wp_trim_words( $preview, 8, '…' );
		}
		$field = array( 'key' => $key_prefix . '_element_' . $element_number, 'label' => $label, 'name' => $name_prefix . 'element_' . $element_number, 'type' => $element['type'], 'default_value' => $element['default'] ?? '' );
		if ( 'wysiwyg' === $field['type'] ) {
			$field += array( 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 1 );
		} elseif ( 'textarea' === $field['type'] ) {
			$field['rows'] = 3;
		}
		$fields[] = $field;
	}
	$cards = $include_cards ? ( $section['cards'] ?? array() ) : array();
	if ( ! $cards ) {
		return $fields;
	}
	if ( ! empty( $section['cards_repeatable'] ) ) {
		$sub_fields = array();
		$default_rows = array();
		foreach ( $cards as $card ) {
			$row = array();
			foreach ( $card['elements'] ?? array() as $element ) {
				$element_number = sprintf( '%02d', absint( $element['index'] ) );
				$sub_name = 'element_' . $element_number;
				$row[ $sub_name ] = $element['default'] ?? '';
				if ( ! isset( $sub_fields[ $sub_name ] ) ) {
					$sub_fields[ $sub_name ] = array( 'key' => $key_prefix . '_cards_' . $sub_name, 'label' => sprintf( __( 'Card %s', 'alify' ), $element['tag'] ), 'name' => $sub_name, 'type' => $element['type'], 'default_value' => $element['default'] ?? '' );
					if ( 'wysiwyg' === $element['type'] ) {
						$sub_fields[ $sub_name ] += array( 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 1 );
					} elseif ( 'textarea' === $element['type'] ) {
						$sub_fields[ $sub_name ]['rows'] = 3;
					}
				}
			}
			foreach ( $card['links'] ?? array() as $link ) {
				$link_number = sprintf( '%02d', absint( $link['index'] ) );
				$name = 'link_' . $link_number . '_url';
				$row[ $name ] = $link['href'] ?? '';
				if ( ! isset( $sub_fields[ $name ] ) ) {
					$sub_fields[ $name ] = array( 'key' => $key_prefix . '_cards_' . $name, 'label' => sprintf( __( 'Card link %s URL', 'alify' ), $link_number ), 'name' => $name, 'type' => 'text', 'default_value' => $link['href'] ?? '' );
				}
			}
			foreach ( $card['images'] ?? array() as $image ) {
				$image_number = sprintf( '%02d', absint( $image['index'] ) );
				$name = 'image_' . $image_number;
				$alt_name = $name . '_alt';
				$row[ $alt_name ] = $image['alt'] ?? '';
				if ( ! isset( $sub_fields[ $name ] ) ) {
					$sub_fields[ $name ] = array( 'key' => $key_prefix . '_cards_' . $name, 'label' => sprintf( __( 'Card image %s', 'alify' ), $image_number ), 'name' => $name, 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'library' => 'all' );
					$sub_fields[ $alt_name ] = array( 'key' => $key_prefix . '_cards_' . $alt_name, 'label' => sprintf( __( 'Card image %s alternative text', 'alify' ), $image_number ), 'name' => $alt_name, 'type' => 'text', 'default_value' => $image['alt'] ?? '' );
				}
			}
			$default_rows[] = $row;
		}
		$fields[] = array( 'key' => $key_prefix . '_cards', 'label' => __( 'Cards / items', 'alify' ), 'name' => $name_prefix . 'cards', 'type' => 'repeater', 'layout' => 'block', 'button_label' => __( 'Add card/item', 'alify' ), 'sub_fields' => array_values( $sub_fields ), 'default_value' => $default_rows, 'min' => 0 );
		return $fields;
	}
	foreach ( $cards as $card ) {
		$card_number = sprintf( '%02d', absint( $card['index'] ) );
		foreach ( $card['elements'] ?? array() as $element ) {
			$element_number = sprintf( '%02d', absint( $element['index'] ) );
			$name = 'card_' . $card_number . '_element_' . $element_number;
			$field = array( 'key' => $key_prefix . '_' . $name, 'label' => sprintf( __( 'Card %s — %s', 'alify' ), $card_number, sanitize_text_field( $element['label'] ?? $element['tag'] ), ), 'name' => $name_prefix . $name, 'type' => $element['type'], 'default_value' => $element['default'] ?? '' );
			if ( 'wysiwyg' === $field['type'] ) {
				$field += array( 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 1 );
			} elseif ( 'textarea' === $field['type'] ) {
				$field['rows'] = 3;
			}
			$fields[] = $field;
		}
		foreach ( $card['links'] ?? array() as $link ) {
			$link_number = sprintf( '%02d', absint( $link['index'] ) );
			$name = 'card_' . $card_number . '_link_' . $link_number . '_url';
			$fields[] = array( 'key' => $key_prefix . '_' . $name, 'label' => sprintf( __( 'Card %s link %s URL', 'alify' ), $card_number, $link_number ), 'name' => $name_prefix . $name, 'type' => 'text', 'default_value' => $link['href'] ?? '' );
		}
		foreach ( $card['images'] ?? array() as $image ) {
			$image_number = sprintf( '%02d', absint( $image['index'] ) );
			$name = 'card_' . $card_number . '_image_' . $image_number;
			$fields[] = array( 'key' => $key_prefix . '_' . $name, 'label' => sprintf( __( 'Card %s image %s', 'alify' ), $card_number, $image_number ), 'name' => $name_prefix . $name, 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'library' => 'all' );
			$fields[] = array( 'key' => $key_prefix . '_' . $name . '_alt', 'label' => sprintf( __( 'Card %s image %s alternative text', 'alify' ), $card_number, $image_number ), 'name' => $name_prefix . $name . '_alt', 'type' => 'text', 'default_value' => $image['alt'] ?? '' );
		}
	}
	return $fields;
}


/** Build one source-template-matched repeater for a repeated UL/OL item group. */
function alify_build_structured_list_fields( $group, $name_prefix, $key_prefix ) {
	if ( empty( $group['repeatable'] ) || empty( $group['items'] ) ) {
		return array();
	}
	$group_number = sprintf( '%02d', absint( $group['index'] ) );
	$group_field_name = sanitize_key( $group['field_name'] ?? ( 'list_' . $group_number . '_items' ) );
	$repeater_name = $name_prefix . $group_field_name;
	$sub_fields = array();
	$default_rows = array();
	foreach ( $group['items'] as $item ) {
		$row = array();
		foreach ( $item['elements'] ?? array() as $element ) {
			$number = sprintf( '%02d', absint( $element['index'] ) );
			$name = 'element_' . $number;
			$row[ $name ] = $element['default'] ?? '';
			if ( ! isset( $sub_fields[ $name ] ) ) {
				$sub_fields[ $name ] = array( 'key' => $key_prefix . '_list_' . $group_number . '_' . $name, 'label' => sprintf( __( 'Item %s', 'alify' ), sanitize_text_field( $element['label'] ?? $element['tag'] ) ), 'name' => $name, 'type' => $element['type'], 'default_value' => $element['default'] ?? '' );
				if ( 'wysiwyg' === $element['type'] ) {
					$sub_fields[ $name ] += array( 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 1 );
				} elseif ( 'textarea' === $element['type'] ) {
					$sub_fields[ $name ]['rows'] = 3;
				}
			}
		}
		foreach ( $item['links'] ?? array() as $link ) {
			$name = 'link_' . sprintf( '%02d', absint( $link['index'] ) ) . '_url';
			$row[ $name ] = $link['href'] ?? '';
			if ( ! isset( $sub_fields[ $name ] ) ) {
				$sub_fields[ $name ] = array( 'key' => $key_prefix . '_list_' . $group_number . '_' . $name, 'label' => sprintf( __( 'Item link %s URL', 'alify' ), sprintf( '%02d', absint( $link['index'] ) ) ), 'name' => $name, 'type' => 'text', 'default_value' => $link['href'] ?? '' );
			}
		}
		foreach ( $item['images'] ?? array() as $image ) {
			$number = sprintf( '%02d', absint( $image['index'] ) );
			$name = 'image_' . $number;
			$alt_name = $name . '_alt';
			$row[ $alt_name ] = $image['alt'] ?? '';
			if ( ! isset( $sub_fields[ $name ] ) ) {
				$sub_fields[ $name ] = array( 'key' => $key_prefix . '_list_' . $group_number . '_' . $name, 'label' => sprintf( __( 'Item image %s', 'alify' ), $number ), 'name' => $name, 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'library' => 'all' );
				$sub_fields[ $alt_name ] = array( 'key' => $key_prefix . '_list_' . $group_number . '_' . $alt_name, 'label' => sprintf( __( 'Item image %s alternative text', 'alify' ), $number ), 'name' => $alt_name, 'type' => 'text', 'default_value' => $image['alt'] ?? '' );
			}
		}
		foreach ( $item['attributes'] ?? array() as $attribute => $default_value ) {
			$attribute_name = 'attribute_' . str_replace( '-', '_', sanitize_key( $attribute ) );
			$row[ $attribute_name ] = $default_value;
			if ( ! isset( $sub_fields[ $attribute_name ] ) ) {
				$sub_fields[ $attribute_name ] = array( 'key' => $key_prefix . '_repeater_' . $group_number . '_' . $attribute_name, 'label' => sprintf( __( '%s / filter value', 'alify' ), sanitize_text_field( $attribute ) ), 'name' => $attribute_name, 'type' => 'text', 'default_value' => $default_value );
			}
		}
		$default_rows[] = $row;
	}
	return array(
		array( 'key' => $key_prefix . '_repeater_' . $group_number, 'label' => sprintf( __( '%s items', 'alify' ), sanitize_text_field( $group['label'] ?? 'List' ) ), 'name' => $repeater_name, 'type' => 'repeater', 'layout' => 'block', 'button_label' => __( 'Add item', 'alify' ), 'sub_fields' => array_values( $sub_fields ), 'default_value' => $default_rows, 'min' => 0 ),
	);
}

/** Register page-specific SEO, section, form-copy, link, and image fields. */
function alify_register_source_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	$archive_slugs = alify_get_acf_archive_page_slugs();
	foreach ( alify_get_acf_page_field_data() as $slug => $page ) {
		if ( in_array( $slug, $archive_slugs, true ) || empty( $page['sections'] ) || ! is_array( $page['sections'] ) ) {
			continue;
		}
		$safe_slug = sanitize_key( $slug );
		$single_types = alify_get_acf_single_template_types();
		$single_type = $single_types[ $slug ] ?? '';
		$name_prefix = $single_type ? 'alify_single_' . sanitize_key( $single_type ) . '_' : 'alify_';
		$seo       = isset( $page['seo'] ) && is_array( $page['seo'] ) ? $page['seo'] : array();
		$fields    = array(
			array( 'key' => 'field_alify_' . $safe_slug . '_seo_tab', 'label' => __( 'SEO Metadata', 'alify' ), 'name' => 'alify_' . $safe_slug . '_seo_tab', 'type' => 'tab', 'placement' => 'top' ),
			array( 'key' => 'field_alify_' . $safe_slug . '_seo_title', 'label' => __( 'SEO Title', 'alify' ), 'name' => 'alify_seo_title', 'type' => 'text', 'default_value' => isset( $seo['title'] ) ? sanitize_text_field( $seo['title'] ) : '', 'instructions' => __( 'Optional browser/search title. Leave blank to use the WordPress title.', 'alify' ) ),
			array( 'key' => 'field_alify_' . $safe_slug . '_meta_description', 'label' => __( 'Meta Description', 'alify' ), 'name' => 'alify_meta_description', 'type' => 'textarea', 'rows' => 3, 'default_value' => isset( $seo['description'] ) ? sanitize_textarea_field( $seo['description'] ) : '', 'instructions' => __( 'Plain-text summary for search/social previews.', 'alify' ) ),
		);
		$hero = isset( $page['hero'] ) && is_array( $page['hero'] ) ? $page['hero'] : array();
		$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_hero_tab', 'label' => __( 'Hero', 'alify' ), 'name' => 'alify_' . $safe_slug . '_hero_tab', 'type' => 'tab', 'placement' => 'top' );
		foreach ( array( 'eyebrow' => __( 'Hero eyebrow', 'alify' ), 'title' => __( 'Hero heading', 'alify' ), 'description' => __( 'Hero description', 'alify' ) ) as $hero_key => $hero_label ) {
			if ( empty( $hero[ $hero_key ] ) ) {
				continue;
			}
			$field_name = 'hero_' . $hero_key;
			$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_' . $field_name, 'label' => $hero_label, 'name' => $field_name, 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 1, 'default_value' => $hero[ $hero_key ] );
		}
		if ( ! empty( $hero['background'] ) ) {
			$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_hero_background', 'label' => __( 'Hero background image', 'alify' ), 'name' => 'hero_background', 'type' => 'select', 'choices' => array_combine( array_map( function ( $n ) { return sprintf( 'neon-lines-%02d.webp', $n ); }, range( 1, 14 ) ), array_map( function ( $n ) { return sprintf( __( 'Neon %02d', 'alify' ), $n ); }, range( 1, 14 ) ) ), 'default_value' => wp_basename( $hero['background'] ) );
		}
		if ( ! empty( $hero['variant'] ) ) {
			$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_hero_variant', 'label' => __( 'Hero layout variant', 'alify' ), 'name' => 'hero_variant', 'type' => 'select', 'choices' => array( '' => __( 'Default', 'alify' ), 'mirror-right' => __( 'Mirror Right', 'alify' ), 'close-up' => __( 'Close Up', 'alify' ), 'soft-focus' => __( 'Soft Focus', 'alify' ) ), 'default_value' => $hero['variant'] );
		}
		$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_intro', 'label' => __( 'Page Sections', 'alify' ), 'name' => 'alify_' . $safe_slug . '_content_tab', 'type' => 'tab', 'placement' => 'top' );
		foreach ( $page['sections'] as $section ) {
			$number = absint( $section['index'] );
			$suffix = sprintf( '%02d', $number );
			$label  = isset( $section['label'] ) ? sanitize_text_field( $section['label'] ) : sprintf( __( 'Section %d', 'alify' ), $number );
			$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_tab', 'label' => sprintf( __( '%1$02d. %2$s', 'alify' ), $number, $label ), 'name' => $name_prefix . 'section_' . $suffix . '_tab', 'type' => 'tab', 'placement' => 'top' );
			$fields = array_merge( $fields, alify_build_structured_section_fields( $section, $name_prefix . 'section_' . $suffix . '_', 'field_alify_' . $safe_slug . '_section_' . $suffix ) );
			foreach ( $section['list_groups'] ?? array() as $list_group ) {
				$fields = array_merge( $fields, alify_build_structured_list_fields( $list_group, $name_prefix . 'section_' . $suffix . '_', 'field_alify_' . $safe_slug . '_section_' . $suffix ) );
			}
			foreach ( $section['forms'] ?? array() as $form ) {
				$form_number = sprintf( '%02d', absint( $form['index'] ) );
				$form_prefix = $name_prefix . 'section_' . $suffix . '_form_' . $form_number . '_';
				$fields = array_merge( $fields, alify_build_structured_section_fields( array( 'elements' => $form['elements'] ?? array() ), $form_prefix, 'field_alify_' . $safe_slug . '_section_' . $suffix . '_form_' . $form_number ) );
			}
			foreach ( $section['links'] ?? array() as $link ) {
				$link_number = absint( $link['index'] );
				$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_link_' . sprintf( '%02d', $link_number ), 'label' => sprintf( __( 'Link %1$d URL — %2$s', 'alify' ), $link_number, sanitize_text_field( $link['label'] ?? __( 'Link', 'alify' ) ) ), 'name' => $name_prefix . 'section_' . $suffix . '_link_' . sprintf( '%02d', $link_number ) . '_url', 'type' => 'text', 'default_value' => $link['href'] ?? '', 'instructions' => __( 'Optional URL override; blank retains the section HTML destination.', 'alify' ) );
			}
			foreach ( $section['images'] ?? array() as $image ) {
				$image_number = absint( $image['index'] );
				$image_suffix = sprintf( '%02d', $image_number );
				$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_image_' . $image_suffix, 'label' => sprintf( __( 'Image %1$d — %2$s', 'alify' ), $image_number, wp_basename( $image['src'] ?? '' ) ), 'name' => $name_prefix . 'section_' . $suffix . '_image_' . $image_suffix, 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'library' => 'all', 'instructions' => __( 'Optional replacement image.', 'alify' ) );
				$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_image_' . $image_suffix . '_alt', 'label' => sprintf( __( 'Image %d alternative text', 'alify' ), $image_number ), 'name' => $name_prefix . 'section_' . $suffix . '_image_' . $image_suffix . '_alt', 'type' => 'text', 'default_value' => $image['alt'] ?? '', 'instructions' => __( 'Describe informative images; leave blank for decorative images.', 'alify' ) );
			}
		}
		acf_add_local_field_group( array( 'key' => 'group_alify_source_page_' . $safe_slug, 'title' => sprintf( __( '%1$s — %2$s', 'alify' ), $single_type ? __( 'Alify Single Fields', 'alify' ) : __( 'Alify Page Fields', 'alify' ), sanitize_text_field( $page['title'] ?? $slug ) ), 'fields' => $fields, 'location' => $single_type ? array( array( array( 'param' => 'alify_source_single_type', 'operator' => '==', 'value' => $single_type ) ) ) : array( array( array( 'param' => 'alify_source_page', 'operator' => '==', 'value' => $slug ) ) ), 'menu_order' => 1, 'position' => 'normal', 'style' => 'default', 'label_placement' => 'top', 'instruction_placement' => 'field', 'active' => true ) );
	}

	// Dynamic archives have no singular record, so expose their source fields in Theme Settings.
	$archive_fields = array();
	$data           = alify_get_acf_page_field_data();
	foreach ( $archive_slugs as $slug ) {
		if ( empty( $data[ $slug ] ) ) {
			continue;
		}
		$page  = $data[ $slug ];
		$safe  = sanitize_key( $slug );
		$hero  = $page['hero'] ?? array();
		$seo   = $page['seo'] ?? array();
		$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_tab', 'label' => sprintf( __( '%s Archive', 'alify' ), sanitize_text_field( $page['title'] ?? $slug ) ), 'name' => 'alify_archive_' . $safe . '_tab', 'type' => 'tab', 'placement' => 'top' );
		$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_seo_title', 'label' => __( 'SEO Title', 'alify' ), 'name' => 'alify_archive_' . $safe . '_seo_title', 'type' => 'text', 'default_value' => $seo['title'] ?? $page['title'] ?? '', 'instructions' => __( 'SEO plugins retain control of the document title when active.', 'alify' ) );
		$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_meta_description', 'label' => __( 'Meta Description', 'alify' ), 'name' => 'alify_archive_' . $safe . '_meta_description', 'type' => 'textarea', 'rows' => 3, 'default_value' => $seo['description'] ?? '', 'instructions' => __( 'Used before general archive-description/source fallbacks.', 'alify' ) );
		foreach ( array( 'title', 'eyebrow', 'description' ) as $hero_key ) {
			$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_hero_' . $hero_key, 'label' => sprintf( __( 'Archive Hero %s', 'alify' ), ucfirst( $hero_key ) ), 'name' => 'alify_archive_' . $safe . '_hero_' . ( 'title' === $hero_key ? 'title' : $hero_key ) . '_html', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 1, 'default_value' => $hero[ $hero_key ] ?? '' );
		}
		$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_hero_background', 'label' => __( 'Archive Hero Background', 'alify' ), 'name' => 'alify_archive_' . $safe . '_hero_background', 'type' => 'select', 'choices' => array_combine( array_map( function ( $n ) { return sprintf( 'neon-lines-%02d.webp', $n ); }, range( 1, 14 ) ), array_map( function ( $n ) { return sprintf( __( 'Neon %02d', 'alify' ), $n ); }, range( 1, 14 ) ) ), 'default_value' => wp_basename( $hero['background'] ?? 'neon-lines-01.webp' ) );
		$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_hero_variant', 'label' => __( 'Archive Hero Layout Variant', 'alify' ), 'name' => 'alify_archive_' . $safe . '_hero_variant', 'type' => 'select', 'choices' => array( '' => __( 'Default', 'alify' ), 'mirror-right' => __( 'Mirror Right', 'alify' ), 'close-up' => __( 'Close Up', 'alify' ), 'soft-focus' => __( 'Soft Focus', 'alify' ) ), 'default_value' => $hero['variant'] ?? '' );
		foreach ( $page['sections'] ?? array() as $section ) {
			$number = absint( $section['index'] );
			$suffix = sprintf( '%02d', $number );
			$label  = sanitize_text_field( $section['label'] ?? sprintf( __( 'Section %d', 'alify' ), $number ) );
			$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_section_' . $suffix . '_tab', 'label' => sprintf( __( '%02d. %s', 'alify' ), $number, $label ), 'name' => 'alify_archive_' . $safe . '_section_' . $suffix . '_tab', 'type' => 'tab', 'placement' => 'top' );
			$archive_fields = array_merge( $archive_fields, alify_build_structured_section_fields( $section, 'alify_archive_' . $safe . '_section_' . $suffix . '_', 'field_alify_archive_' . $safe . '_section_' . $suffix, false ) );
			foreach ( $section['list_groups'] ?? array() as $list_group ) {
				$archive_fields = array_merge( $archive_fields, alify_build_structured_list_fields( $list_group, 'alify_archive_' . $safe . '_section_' . $suffix . '_', 'field_alify_archive_' . $safe . '_section_' . $suffix ) );
			}
			foreach ( $section['forms'] ?? array() as $form ) {
				$fi = sprintf( '%02d', absint( $form['index'] ) );
				$form_prefix = 'alify_archive_' . $safe . '_section_' . $suffix . '_form_' . $fi . '_';
				$archive_fields = array_merge( $archive_fields, alify_build_structured_section_fields( array( 'elements' => $form['elements'] ?? array() ), $form_prefix, 'field_alify_archive_' . $safe . '_section_' . $suffix . '_form_' . $fi ) );
			}
			foreach ( $section['links'] ?? array() as $link ) {
				$li = sprintf( '%02d', absint( $link['index'] ) );
				$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_section_' . $suffix . '_link_' . $li, 'label' => sprintf( __( 'Link %s URL — %s', 'alify' ), $li, sanitize_text_field( $link['label'] ?? __( 'Link', 'alify' ) ) ), 'name' => 'alify_archive_' . $safe . '_section_' . $suffix . '_link_' . $li . '_url', 'type' => 'text', 'default_value' => $link['href'] ?? '' );
			}
			foreach ( $section['images'] ?? array() as $image ) {
				$ii = sprintf( '%02d', absint( $image['index'] ) );
				$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_section_' . $suffix . '_image_' . $ii, 'label' => sprintf( __( 'Image %s replacement', 'alify' ), $ii ), 'name' => 'alify_archive_' . $safe . '_section_' . $suffix . '_image_' . $ii, 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'library' => 'all' );
				$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_section_' . $suffix . '_image_' . $ii . '_alt', 'label' => sprintf( __( 'Image %s alternative text', 'alify' ), $ii ), 'name' => 'alify_archive_' . $safe . '_section_' . $suffix . '_image_' . $ii . '_alt', 'type' => 'text', 'default_value' => $image['alt'] ?? '' );
			}
		}
	}
	if ( $archive_fields ) {
		acf_add_local_field_group( array( 'key' => 'group_alify_archive_page_fields', 'title' => __( 'Alify Archive Page Fields', 'alify' ), 'fields' => $archive_fields, 'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-archive-pages' ) ) ), 'menu_order' => 1, 'position' => 'normal', 'style' => 'default', 'label_placement' => 'top', 'instruction_placement' => 'field', 'active' => true ) );
	}
}
add_action( 'acf/init', 'alify_register_source_page_acf_fields', 20 );

/** Return the inner byte range of a top-level section under the page's main landmark. */
function alify_get_source_section_range( $markup, $wanted_index ) {
	$main_start = stripos( $markup, '<main' );
	if ( false === $main_start ) {
		return false;
	}
	$main_open_end = strpos( $markup, '>', $main_start );
	$main_close    = stripos( $markup, '</main', false === $main_open_end ? $main_start : $main_open_end );
	if ( false === $main_open_end || false === $main_close ) {
		return false;
	}
	$inner_start = $main_open_end + 1;
	$main_html   = substr( $markup, $inner_start, $main_close - $inner_start );
	preg_match_all( '~</?section\b[^>]*>~i', $main_html, $tokens, PREG_OFFSET_CAPTURE );
	$depth = 0;
	$index = 0;
	$start = null;
	foreach ( $tokens[0] as $token ) {
		$tag    = $token[0];
		$offset = $inner_start + $token[1];
		if ( 0 === strpos( $tag, '</' ) ) {
			if ( $depth > 0 ) {
				--$depth;
			}
			if ( 0 === $depth && null !== $start ) {
				return array( 'start' => $start, 'length' => $offset - $start );
			}
			continue;
		}
		if ( 0 === $depth ) {
			++$index;
			if ( absint( $wanted_index ) === $index ) {
				$start = $offset + strlen( $tag );
			}
		}
		if ( ! preg_match( '~/>$~', $tag ) ) {
			++$depth;
		} elseif ( $index === absint( $wanted_index ) && 0 === $depth ) {
			return array( 'start' => $offset + strlen( $tag ), 'length' => 0 );
		}
	}
	return false;
}

/** Safely set or remove an attribute in a trusted start tag. */
function alify_set_html_attribute( $tag_markup, $attribute, $value ) {
	$attribute = preg_quote( $attribute, '~' );
	$pattern   = '~\s+' . $attribute . '(?:\s*=\s*(?:"[^"]*"|\x27[^\x27]*\x27|[^\s>]+))?~i';
	$exists    = preg_match( $pattern, $tag_markup );
	if ( null === $value ) {
		return $exists ? preg_replace( $pattern, '', $tag_markup, 1 ) : $tag_markup;
	}
	$replacement = ' ' . $attribute . '="' . esc_attr( $value ) . '"';
	if ( $exists ) {
		return preg_replace( $pattern, $replacement, $tag_markup, 1 );
	}
	return preg_replace( '~\s*/?>$~', $replacement . '>', $tag_markup, 1 );
}

/** Restore server-owned form fields from stable placeholders in the copy editor. */
function alify_restore_source_form_controls( $edited_html, $source_form ) {
	$source_html = $source_form['html'] ?? '';
	if ( preg_match( '~<form\b[^>]*>~i', $source_html, $opening ) ) {
		if ( preg_match( '~<form\b[^>]*>~i', $edited_html ) ) {
			$edited_html = preg_replace( '~<form\b[^>]*>~i', $opening[0], $edited_html, 1 );
		} else {
			$edited_html = $opening[0] . $edited_html . '</form>';
		}
		if ( ! preg_match( '~</form\s*>~i', $edited_html ) ) {
			$edited_html .= '</form>';
		}
	}
	foreach ( $source_form['controls'] ?? array() as $control ) {
		$number      = absint( $control['index'] );
		$placeholder = 'ALIFY_CONTROL_' . sprintf( '%02d', $number );
		$control_html = $control['html'] ?? '';
		if ( false !== strpos( $edited_html, $placeholder ) ) {
			$edited_html = str_replace( $placeholder, $control_html, $edited_html );
		} else {
			$edited_html = preg_replace( '~</form\s*>~i', $control_html . '</form>', $edited_html, 1 );
		}
	}
	return $edited_html;
}

/** Preserve protected control and form attributes when the editable copy is saved. */
function alify_preserve_source_form_controls( $edited_html, $source_html ) {
	$protected = array( 'type', 'name', 'value', 'required', 'autocomplete', 'min', 'max', 'minlength', 'maxlength', 'pattern', 'id', 'multiple', 'accept', 'checked', 'disabled', 'readonly', 'form' );
	if ( preg_match( '~<form\b[^>]*>~i', $source_html, $form ) ) {
		$edited_html = preg_match( '~<form\b[^>]*>~i', $edited_html ) ? preg_replace( '~<form\b[^>]*>~i', $form[0], $edited_html, 1 ) : $form[0] . $edited_html . '</form>';
	}
	preg_match_all( '~<(?:input|select|textarea|button)\b[^>]*>~i', $source_html, $source_controls );
	$index = 0;
	$edited_html = preg_replace_callback( '~<(?:input|select|textarea|button)\b[^>]*>~i', function ( $matches ) use ( &$index, $source_controls, $protected ) {
		if ( ! isset( $source_controls[0][ $index ] ) ) {
			++$index;
			return $matches[0];
		}
		$source_tag = $source_controls[0][ $index++ ];
		foreach ( $protected as $attribute ) {
			$pattern = '~\s+' . preg_quote( $attribute, '~' ) . '(?:\s*=\s*(?:"([^"]*)"|\x27([^\x27]*)\x27|([^\s>]+)))?~i';
			if ( preg_match( $pattern, $source_tag, $found ) ) {
				$value = $found[1] ?? ( $found[2] ?? ( $found[3] ?? '' ) );
				$matches[0] = alify_set_html_attribute( $matches[0], $attribute, $value );
			} else {
				$matches[0] = alify_set_html_attribute( $matches[0], $attribute, null );
			}
		}
		return $matches[0];
	}, $edited_html );
	preg_match_all( '~<option\b[^>]*>~i', $source_html, $source_options );
	if ( ! empty( $source_options[0] ) ) {
		$option_index = 0;
		$edited_html = preg_replace_callback( '~<option\b[^>]*>~i', function ( $matches ) use ( &$option_index, $source_options ) {
			if ( ! isset( $source_options[0][ $option_index ] ) ) {
				++$option_index;
				return $matches[0];
			}
			$source_tag = $source_options[0][ $option_index++ ];
			foreach ( array( 'value', 'selected', 'disabled' ) as $attribute ) {
				$pattern = '~\s+' . preg_quote( $attribute, '~' ) . '(?:\s*=\s*(?:"([^"]*)"|\x27([^\x27]*)\x27|([^\s>]+)))?~i';
				if ( preg_match( $pattern, $source_tag, $found ) ) {
					$value = $found[1] ?? ( $found[2] ?? ( $found[3] ?? '' ) );
					$matches[0] = alify_set_html_attribute( $matches[0], $attribute, $value );
				} else {
					$matches[0] = alify_set_html_attribute( $matches[0], $attribute, null );
				}
			}
			return $matches[0];
		}, $edited_html );
	}
	return $edited_html;
}

/** Replace an archive/page form placeholder with the separately edited form. */
function alify_replace_section_form_markup( $section_html, $index, $form_html ) {
	$placeholder = 'ALIFY_FORM_' . sprintf( '%02d', absint( $index ) );
	if ( false !== strpos( $section_html, $placeholder ) ) {
		return str_replace( $placeholder, $form_html, $section_html );
	}
	$ranges = alify_get_html_tag_ranges( $section_html, 'form' );
	$position = absint( $index ) - 1;
	if ( ! isset( $ranges[ $position ] ) ) {
		return $section_html;
	}
	$range = $ranges[ $position ];
	return substr_replace( $section_html, $form_html, $range['start'], $range['end'] - $range['start'] );
}

/** Override one indexed tag attribute. */
function alify_override_section_tag_attribute( $html, $tag, $index, $attribute, $value, $excluded = array( 'article', 'form' ) ) {
	$count = 0;
	$parents = array();
	foreach ( $excluded as $excluded_tag ) {
		$parents = array_merge( $parents, alify_get_html_tag_ranges( $html, $excluded_tag ) );
	}
	preg_match_all( '~<' . preg_quote( $tag, '~' ) . '\\b[^>]*>~i', $html, $matches, PREG_OFFSET_CAPTURE );
	foreach ( $matches[0] as $match ) {
		$offset = $match[1];
		$inside = false;
		foreach ( $parents as $parent ) {
			if ( $offset > $parent['start'] && $offset < $parent['end'] ) {
				$inside = true;
				break;
			}
		}
		if ( $inside ) {
			continue;
		}
		++$count;
		if ( absint( $index ) === $count ) {
			return substr_replace( $html, alify_set_html_attribute( $match[0], $attribute, $value ), $offset, strlen( $match[0] ) );
		}
	}
	return $html;
}


/** Override a source-section attribute while excluding grouped repeaters and protected wrappers. */
function alify_override_template_section_attribute( $html, $tag, $index, $attribute, $value, $section ) {
	$excluded_ranges = array_merge( alify_get_html_tag_ranges( $html, 'article' ), alify_get_html_tag_ranges( $html, 'form' ) );
	foreach ( $section['list_groups'] ?? array() as $group ) {
		if ( empty( $group['repeatable'] ) ) {
			continue;
		}
		if ( ! empty( $group['container_class'] ) ) {
			$ranges = alify_get_html_tag_ranges_by_class( $html, $group['container_tag'] ?? $group['tag'], $group['container_class'] );
			$position = absint( $group['container_index'] ) - 1;
		} else {
			$ranges = alify_get_html_tag_ranges_excluding( $html, $group['container_tag'] ?? $group['tag'], array( 'article', 'form', 'li' ) );
			$position = absint( $group['container_index'] ?? $group['tag_index'] ) - 1;
		}
		if ( isset( $ranges[ $position ] ) ) {
			$excluded_ranges[] = $ranges[ $position ];
		}
	}
	preg_match_all( '~<' . preg_quote( $tag, '~' ) . '\\b[^>]*>~i', $html, $matches, PREG_OFFSET_CAPTURE );
	$count = 0;
	foreach ( $matches[0] as $match ) {
		$offset = $match[1];
		$inside = false;
		foreach ( $excluded_ranges as $range ) {
			if ( $offset > $range['start'] && $offset < $range['end'] ) {
				$inside = true;
				break;
			}
		}
		if ( $inside ) {
			continue;
		}
		++$count;
		if ( absint( $index ) === $count ) {
			return substr_replace( $html, alify_set_html_attribute( $match[0], $attribute, $value ), $offset, strlen( $match[0] ) );
		}
	}
	return $html;
}

/** Apply page-specific link and image overrides before repeater rows alter tag order. */
function alify_apply_template_section_attributes( $html, $section, $section_name_prefix, $post_id ) {
	foreach ( $section['links'] ?? array() as $link ) {
		$field_name = $section_name_prefix . 'link_' . sprintf( '%02d', absint( $link['index'] ) ) . '_url';
		$url = get_field( $field_name, $post_id );
		if ( is_string( $url ) && '' !== trim( $url ) ) {
			$html = alify_override_template_section_attribute( $html, 'a', $link['index'], 'href', esc_url_raw( $url, array( 'http', 'https', 'mailto', 'tel' ) ), $section );
		}
	}
	foreach ( $section['images'] ?? array() as $image ) {
		$number = absint( $image['index'] );
		$image_name = $section_name_prefix . 'image_' . sprintf( '%02d', $number );
		$url = get_field( $image_name, $post_id );
		$alt = get_field( $image_name . '_alt', $post_id );
		if ( is_string( $url ) && '' !== trim( $url ) ) {
			$html = alify_override_template_section_attribute( $html, 'img', $number, 'src', esc_url_raw( $url, array( 'http', 'https' ) ), $section );
		}
		if ( is_string( $alt ) && ( '' !== trim( $alt ) || alify_acf_value_is_saved( $image_name . '_alt', $post_id ) ) ) {
			$html = alify_override_template_section_attribute( $html, 'img', $number, 'alt', $alt, $section );
		}
	}
	return $html;
}

/** Sanitize the short inline hero values. */
function alify_sanitize_page_inline_html( $html ) {
	$allowed = array( 'a' => array( 'href' => true, 'title' => true, 'target' => true, 'rel' => true, 'class' => true, 'aria-label' => true ), 'b' => array( 'class' => true ), 'br' => array(), 'code' => array( 'class' => true ), 'em' => array( 'class' => true ), 'i' => array( 'class' => true, 'aria-hidden' => true ), 'mark' => array( 'class' => true ), 's' => array( 'class' => true ), 'small' => array( 'class' => true ), 'span' => array( 'class' => true, 'aria-hidden' => true ), 'strong' => array( 'class' => true ), 'sub' => array(), 'sup' => array() );
	return wp_kses( $html, $allowed );
}

/** Allow source section markup and the theme-managed controls, but no scripts. */
function alify_sanitize_page_section_html( $html ) {
	$allowed = wp_kses_allowed_html( 'post' );
	$common  = array( 'id' => true, 'class' => true, 'title' => true, 'role' => true, 'tabindex' => true, 'aria-*' => true, 'data-*' => true );
	$allowed['form'] = $common + array( 'action' => true, 'method' => true, 'name' => true, 'enctype' => true, 'novalidate' => true );
	$allowed['input'] = $common + array( 'type' => true, 'name' => true, 'value' => true, 'required' => true, 'autocomplete' => true, 'placeholder' => true, 'min' => true, 'max' => true, 'minlength' => true, 'maxlength' => true, 'pattern' => true, 'checked' => true, 'disabled' => true, 'readonly' => true, 'multiple' => true, 'accept' => true, 'form' => true );
	$allowed['select'] = $common + array( 'name' => true, 'required' => true, 'autocomplete' => true, 'disabled' => true, 'multiple' => true, 'form' => true );
	$allowed['option'] = $common + array( 'value' => true, 'selected' => true, 'disabled' => true, 'label' => true );
	$allowed['textarea'] = $common + array( 'name' => true, 'required' => true, 'autocomplete' => true, 'placeholder' => true, 'minlength' => true, 'maxlength' => true, 'rows' => true, 'cols' => true, 'disabled' => true, 'readonly' => true );
	$allowed['button'] = ( $allowed['button'] ?? array() ) + $common + array( 'type' => true, 'name' => true, 'value' => true, 'disabled' => true );
	$allowed['fieldset'] = $common + array( 'disabled' => true, 'form' => true, 'name' => true );
	$allowed['label'] = ( $allowed['label'] ?? array() ) + array( 'for' => true, 'form' => true );
	$allowed['a'] = ( $allowed['a'] ?? array() ) + array( 'aria-label' => true, 'target' => true, 'rel' => true );
	$allowed['img'] = ( $allowed['img'] ?? array() ) + array( 'src' => true, 'alt' => true, 'width' => true, 'height' => true, 'loading' => true, 'decoding' => true, 'fetchpriority' => true, 'srcset' => true, 'sizes' => true );
	return wp_kses( $html, $allowed );
}

/** Get balanced byte ranges for all matching non-void HTML elements. */
function alify_get_html_tag_ranges( $html, $tag ) {
	$pattern = '~</?' . preg_quote( $tag, '~' ) . '\\b[^>]*>~i';
	preg_match_all( $pattern, $html, $tokens, PREG_OFFSET_CAPTURE );
	$ranges = array();
	$depth = 0;
	$start = 0;
	$inner_start = 0;
	foreach ( $tokens[0] as $token ) {
		$markup = $token[0];
		$offset = $token[1];
		if ( 0 === strpos( $markup, '</' ) ) {
			if ( $depth > 0 ) {
				--$depth;
			}
			if ( 0 === $depth && $inner_start > 0 ) {
				$ranges[] = array( 'start' => $start, 'end' => $offset + strlen( $markup ), 'inner_start' => $inner_start, 'inner_length' => $offset - $inner_start );
				$inner_start = 0;
			}
		} elseif ( preg_match( '~/>$~', $markup ) ) {
			continue;
		} else {
			if ( 0 === $depth ) {
				$start = $offset;
				$inner_start = $offset + strlen( $markup );
			}
			++$depth;
		}
	}
	return $ranges;
}



/** Return balanced tag ranges outside explicitly protected wrapper types. */
function alify_get_html_tag_ranges_excluding( $html, $tag, $excluded ) {
	$ranges = alify_get_html_tag_ranges( $html, $tag );
	$parents = array();
	foreach ( $excluded as $excluded_tag ) {
		$parents = array_merge( $parents, alify_get_html_tag_ranges( $html, $excluded_tag ) );
	}
	return array_values( array_filter( $ranges, function ( $range ) use ( $parents ) {
		foreach ( $parents as $parent ) {
			if ( $range['start'] > $parent['start'] && $range['start'] < $parent['end'] ) {
				return false;
			}
		}
		return true;
	} ) );
}

/** Find balanced ranges for a tag carrying a specific CSS class token. */
function alify_get_html_tag_ranges_by_class( $html, $tag, $class_token, $excluded = array( 'article', 'form' ) ) {
	$ranges = alify_get_html_tag_ranges( $html, $tag );
	$excluded_ranges = array();
	foreach ( $excluded as $excluded_tag ) {
		$excluded_ranges = array_merge( $excluded_ranges, alify_get_html_tag_ranges( $html, $excluded_tag ) );
	}
	$matches = array();
	foreach ( $ranges as $range ) {
		$opening = substr( $html, $range['start'], $range['inner_start'] - $range['start'] );
		if ( ! preg_match( '~\\bclass\\s*=\\s*(["\\x27])([^"\\x27]*)\\1~i', $opening, $class_match ) || ! in_array( $class_token, preg_split( '/\\s+/', trim( $class_match[2] ) ), true ) ) {
			continue;
		}
		$inside = false;
		foreach ( $excluded_ranges as $excluded_range ) {
			if ( $range['start'] > $excluded_range['start'] && $range['start'] < $excluded_range['end'] ) {
				$inside = true;
				break;
			}
		}
		if ( ! $inside ) {
			$matches[] = $range;
		}
	}
	return $matches;
}

/** Return matching element ranges outside excluded wrapper tags. */
function alify_get_filtered_html_tag_ranges( $html, $tag, $excluded = array() ) {
	$ranges = alify_get_html_tag_ranges( $html, $tag );
	$text_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'blockquote', 'label', 'legend', 'button', 'a', 'li', 'summary', 'dt', 'dd', 'figcaption', 'th', 'td', 'span', 'strong', 'em', 'small', 'time', 'abbr', 'code', 'mark' );
	$excluded = array_values( array_unique( array_merge( $excluded, $text_tags ) ) );
	if ( ! $excluded || 'article' === $tag || 'form' === $tag ) {
		return $ranges;
	}
	$parents = array();
	foreach ( $excluded as $excluded_tag ) {
		$parents = array_merge( $parents, alify_get_html_tag_ranges( $html, $excluded_tag ) );
	}
	return array_values( array_filter( $ranges, function ( $range ) use ( $parents ) {
		foreach ( $parents as $parent ) {
			if ( $range['start'] > $parent['start'] && $range['start'] < $parent['end'] ) {
				return false;
			}
		}
		return true;
	} ) );
}


/** Return decorative icon markup kept inside source-owned action labels. */
function alify_get_source_decorative_icons( $inner_html ) {
	$icons = array();
	foreach ( array( 'i', 'svg' ) as $tag ) {
		foreach ( alify_get_html_tag_ranges( $inner_html, $tag ) as $range ) {
			$opening = substr( $inner_html, $range['start'], $range['inner_start'] - $range['start'] );
			if ( preg_match( '~\\baria-hidden\\s*=\\s*(["\\x27])true\\1~i', $opening ) || preg_match( '~\\bclass\\s*=\\s*(["\\x27])[^"\\x27]*(?:fa-|icon-)[^"\\x27]*\\1~i', $opening ) ) {
				$icons[] = substr( $inner_html, $range['start'], $range['end'] - $range['start'] );
			}
		}
	}
	return array_values( array_unique( $icons ) );
}

/** Replace a field's inner markup at its source tag index. */
function alify_replace_html_element_inner( $html, $tag, $index, $replacement, $excluded = array() ) {
	$ranges = alify_get_filtered_html_tag_ranges( $html, $tag, $excluded );
	$position = absint( $index ) - 1;
	if ( ! isset( $ranges[ $position ] ) ) {
		return $html;
	}
	$range = $ranges[ $position ];
	if ( in_array( strtolower( $tag ), array( 'a', 'button' ), true ) ) {
		$source_inner = substr( $html, $range['inner_start'], $range['inner_length'] );
		foreach ( alify_get_source_decorative_icons( $source_inner ) as $icon_html ) {
			if ( false === strpos( $replacement, $icon_html ) ) {
				$replacement .= $icon_html;
			}
		}
	}
	return substr_replace( $html, $replacement, $range['inner_start'], $range['inner_length'] );
}

/** Format a saved structured content value according to its field type. */
function alify_format_structured_value( $value, $type ) {
	if ( 'wysiwyg' === $type ) {
		return alify_sanitize_page_section_html( (string) $value );
	}
	if ( 'textarea' === $type ) {
		return nl2br( esc_html( (string) $value ) );
	}
	return esc_html( sanitize_text_field( (string) $value ) );
}

/** Test whether an ACF value was explicitly saved, preserving intentionally blank values. */
function alify_acf_value_is_saved( $field_name, $post_id ) {
	if ( 'option' === $post_id ) {
		return null !== get_option( 'options_' . $field_name, null );
	}
	return function_exists( 'metadata_exists' ) && metadata_exists( 'post', $post_id, $field_name );
}

/** Apply one set of direct element fields to source markup. */
function alify_apply_structured_elements( $html, $elements, $name_prefix, $post_id, $excluded = array( 'article', 'form' ) ) {
	foreach ( $elements as $element ) {
		$field_name = $name_prefix . 'element_' . sprintf( '%02d', absint( $element['index'] ) );
		if ( ! alify_acf_value_is_saved( $field_name, $post_id ) ) {
			continue;
		}
		$value = get_field( $field_name, $post_id, false );
		if ( is_string( $value ) ) {
			$html = alify_replace_html_element_inner( $html, $element['tag'], $element['tag_index'], alify_format_structured_value( $value, $element['type'] ), $excluded );
		}
	}
	return $html;
}

/** Apply repeater row data to one source article template. */
function alify_apply_card_row( $html, $card, $row, $excluded = array( 'form' ) ) {
	foreach ( $card['elements'] ?? array() as $element ) {
		$key = 'element_' . sprintf( '%02d', absint( $element['index'] ) );
		if ( array_key_exists( $key, $row ) && is_scalar( $row[ $key ] ) ) {
			$html = alify_replace_html_element_inner( $html, $element['tag'], $element['tag_index'], alify_format_structured_value( $row[ $key ], $element['type'] ), $excluded );
		}
	}
	foreach ( $card['links'] ?? array() as $link ) {
		$key = 'link_' . sprintf( '%02d', absint( $link['index'] ) ) . '_url';
		if ( ! empty( $row[ $key ] ) ) {
			$html = alify_override_section_tag_attribute( $html, 'a', $link['index'], 'href', esc_url_raw( $row[ $key ], array( 'http', 'https', 'mailto', 'tel' ) ), $excluded );
		}
	}
	foreach ( $card['images'] ?? array() as $image ) {
		$number = absint( $image['index'] );
		$image_key = 'image_' . sprintf( '%02d', $number );
		if ( ! empty( $row[ $image_key ] ) ) {
			$image_url = is_array( $row[ $image_key ] ) ? ( $row[ $image_key ]['url'] ?? '' ) : $row[ $image_key ];
			$html = alify_override_section_tag_attribute( $html, 'img', $number, 'src', esc_url_raw( $image_url, array( 'http', 'https' ) ), $excluded );
		}
		$alt_key = $image_key . '_alt';
		if ( array_key_exists( $alt_key, $row ) ) {
			$html = alify_override_section_tag_attribute( $html, 'img', $number, 'alt', $row[ $alt_key ], $excluded );
		}
	}
	return $html;
}

/** Replace source article cards with saved repeater rows, keeping their original layout template. */
function alify_replace_source_articles( $html, $cards_html ) {
	$ranges = alify_get_html_tag_ranges( $html, 'article' );
	$top_level = array();
	foreach ( $ranges as $range ) {
		$nested = false;
		foreach ( $top_level as $parent ) {
			if ( $range['start'] > $parent['start'] && $range['start'] < $parent['end'] ) {
				$nested = true;
				break;
			}
		}
		if ( ! $nested ) {
			$top_level[] = $range;
		}
	}
	if ( ! $top_level ) {
		return $html . implode( '', $cards_html );
	}
	$output = '';
	$cursor = 0;
	$inserted = false;
	foreach ( $top_level as $range ) {
		$output .= substr( $html, $cursor, $range['start'] - $cursor );
		if ( ! $inserted ) {
			$output .= implode( '', $cards_html );
			$inserted = true;
		}
		$cursor = $range['end'];
	}
	return $output . substr( $html, $cursor );
}

/** Apply a section's fixed-card fields or editable card repeater. */
function alify_apply_structured_cards( $html, $section, $section_name_prefix, $post_id ) {
	$cards = $section['cards'] ?? array();
	if ( ! $cards ) {
		return $html;
	}
	if ( ! empty( $section['cards_repeatable'] ) ) {
		$repeater_name = $section_name_prefix . 'cards';
		if ( ! alify_acf_value_is_saved( $repeater_name, $post_id ) ) {
			return $html;
		}
		$rows = get_field( $repeater_name, $post_id );
		$rows = is_array( $rows ) ? $rows : array();
		$rendered = array();
		foreach ( $rows as $row_index => $row ) {
			$template = $cards[ min( $row_index, count( $cards ) - 1 ) ];
			$item_html = alify_apply_card_row( $template['html'], $template, is_array( $row ) ? $row : array() );
			$rendered[] = alify_make_repeater_item_ids_unique( $item_html, $section_name_prefix . 'cards', $row_index + 1 );
		}
		return alify_replace_source_articles( $html, $rendered );
	}
	$ranges = alify_get_html_tag_ranges( $html, 'article' );
	$top_level = array();
	foreach ( $ranges as $range ) {
		$nested = false;
		foreach ( $top_level as $parent ) {
			if ( $range['start'] > $parent['start'] && $range['start'] < $parent['end'] ) {
				$nested = true;
				break;
			}
		}
		if ( ! $nested ) {
			$top_level[] = $range;
		}
	}
	for ( $card_position = count( $cards ) - 1; $card_position >= 0; --$card_position ) {
		$card = $cards[ $card_position ];
		$card_number = sprintf( '%02d', absint( $card['index'] ) );
		if ( ! isset( $top_level[ absint( $card['index'] ) - 1 ] ) ) {
			continue;
		}
		$range = $top_level[ absint( $card['index'] ) - 1 ];
		$card_html = substr( $html, $range['start'], $range['end'] - $range['start'] );
		$card_prefix = $section_name_prefix . 'card_' . $card_number . '_';
		foreach ( $card['elements'] ?? array() as $element ) {
			$field = $card_prefix . 'element_' . sprintf( '%02d', absint( $element['index'] ) );
			if ( alify_acf_value_is_saved( $field, $post_id ) ) {
				$value = get_field( $field, $post_id, false );
				if ( is_string( $value ) ) {
					$card_html = alify_replace_html_element_inner( $card_html, $element['tag'], $element['tag_index'], alify_format_structured_value( $value, $element['type'] ), array( 'form' ) );
				}
			}
		}
		foreach ( $card['links'] ?? array() as $link ) {
			$field = $card_prefix . 'link_' . sprintf( '%02d', absint( $link['index'] ) ) . '_url';
			$url = get_field( $field, $post_id );
			if ( is_string( $url ) && '' !== trim( $url ) ) {
				$card_html = alify_override_section_tag_attribute( $card_html, 'a', $link['index'], 'href', esc_url_raw( $url, array( 'http', 'https', 'mailto', 'tel' ) ), array( 'form' ) );
			}
		}
		foreach ( $card['images'] ?? array() as $image ) {
			$image_number = absint( $image['index'] );
			$image_name = $card_prefix . 'image_' . sprintf( '%02d', $image_number );
			$image_url = get_field( $image_name, $post_id );
			$image_alt = get_field( $image_name . '_alt', $post_id );
			if ( is_string( $image_url ) && '' !== trim( $image_url ) ) {
				$card_html = alify_override_section_tag_attribute( $card_html, 'img', $image_number, 'src', esc_url_raw( $image_url, array( 'http', 'https' ) ), array( 'form' ) );
			}
			if ( is_string( $image_alt ) && ( '' !== $image_alt || alify_acf_value_is_saved( $image_name . '_alt', $post_id ) ) ) {
				$card_html = alify_override_section_tag_attribute( $card_html, 'img', $image_number, 'alt', $image_alt, array( 'form' ) );
			}
		}
		$html = substr_replace( $html, $card_html, $range['start'], $range['end'] - $range['start'] );
	}
	return $html;
}


/** Keep repeated item filter attributes editable without exposing arbitrary markup. */
function alify_apply_repeater_item_attributes( $html, $group, $template, $row ) {
	$item_tag = $group['item_tag'] ?? 'li';
	$item_class = $group['item_class'] ?? '';
	foreach ( $template['attributes'] ?? array() as $attribute => $default_value ) {
		$field_name = 'attribute_' . str_replace( '-', '_', sanitize_key( $attribute ) );
		if ( ! array_key_exists( $field_name, $row ) || ! in_array( $attribute, array( 'data-category', 'data-filter' ), true ) ) {
			continue;
		}
		$ranges = $item_class ? alify_get_html_tag_ranges_by_class( $html, $item_tag, $item_class, array() ) : alify_get_html_tag_ranges( $html, $item_tag );
		if ( empty( $ranges[0] ) ) {
			continue;
		}
		$range = $ranges[0];
		$opening = substr( $html, $range['start'], $range['inner_start'] - $range['start'] );
		$value = sanitize_text_field( (string) $row[ $field_name ] );
		$opening = alify_set_html_attribute( $opening, $attribute, '' === $value ? null : $value );
		$html = substr_replace( $html, $opening, $range['start'], $range['inner_start'] - $range['start'] );
	}
	return $html;
}

/** Make IDs and their in-item references unique after cloning a repeated template. */
function alify_make_repeater_item_ids_unique( $html, $field_name, $row_number ) {
	preg_match_all( '~\\bid\\s*=\\s*(["\\x27])([^"\\x27]+)\\1~i', $html, $matches );
	if ( empty( $matches[2] ) ) {
		return $html;
	}
	$suffix = substr( md5( $field_name . ':' . absint( $row_number ) ), 0, 8 );
	$id_map = array();
	foreach ( array_unique( $matches[2] ) as $id ) {
		$id_map[ $id ] = sanitize_html_class( $id . '-' . $suffix );
	}
	return preg_replace_callback( '~\\b(id|for|aria-controls|aria-labelledby|aria-describedby|aria-owns|href)\\s*=\\s*(["\\x27])(.*?)\\2~i', function ( $match ) use ( $id_map ) {
		$attribute = strtolower( $match[1] );
		$value = $match[3];
		if ( 'id' === $attribute ) {
			$value = $id_map[ $value ] ?? $value;
		} elseif ( 'href' === $attribute && isset( $id_map[ ltrim( $value, '#' ) ] ) && 0 === strpos( $value, '#' ) ) {
			$value = '#' . $id_map[ ltrim( $value, '#' ) ];
		} elseif ( in_array( $attribute, array( 'for', 'aria-controls', 'aria-labelledby', 'aria-describedby', 'aria-owns' ), true ) ) {
			$tokens = preg_split( '/\\s+/', trim( $value ) );
			$tokens = array_map( function ( $token ) use ( $id_map ) { return $id_map[ $token ] ?? $token; }, $tokens );
			$value = implode( ' ', $tokens );
		}
		return $match[1] . '=' . $match[2] . esc_attr( $value ) . $match[2];
	}, $html );
}

function alify_get_repeater_group_container_range( $html, $group ) {
	$container_tag = $group['container_tag'] ?? $group['tag'];
	if ( ! empty( $group['container_class'] ) ) {
		$ranges = alify_get_html_tag_ranges_by_class( $html, $container_tag, $group['container_class'] );
		$position = absint( $group['container_index'] ) - 1;
	} else {
		$ranges = alify_get_html_tag_ranges_excluding( $html, $container_tag, array( 'article', 'form', 'li' ) );
		$position = absint( $group['container_index'] ?? $group['tag_index'] ) - 1;
	}
	return $ranges[ $position ] ?? false;
}

/** Replace the source container's repeated children with rendered repeater rows. */
function alify_replace_repeater_group_items( $container_html, $group, $rendered_items ) {
	$container_tag = $group['container_tag'] ?? $group['tag'];
	$opening_end = strpos( $container_html, '>' );
	$closing_start = strripos( $container_html, '</' . $container_tag );
	if ( false === $opening_end || false === $closing_start || $closing_start < $opening_end ) {
		return $container_html;
	}
	$inner_start = $opening_end + 1;
	$inner = substr( $container_html, $inner_start, $closing_start - $inner_start );
	$item_tag = $group['item_tag'] ?? 'li';
	$item_class = $group['item_class'] ?? '';
	$ranges = $item_class ? alify_get_html_tag_ranges_by_class( $inner, $item_tag, $item_class, array() ) : alify_get_html_tag_ranges( $inner, $item_tag );
	$top_level = array();
	foreach ( $ranges as $range ) {
		$nested = false;
		foreach ( $top_level as $parent ) {
			if ( $range['start'] > $parent['start'] && $range['start'] < $parent['end'] ) {
				$nested = true;
				break;
			}
		}
		if ( ! $nested ) {
			$top_level[] = $range;
		}
	}
	if ( ! $top_level ) {
		$new_inner = $inner . implode( '', $rendered_items );
	} else {
		$new_inner = '';
		$cursor = 0;
		$inserted = false;
		foreach ( $top_level as $range ) {
			$new_inner .= substr( $inner, $cursor, $range['start'] - $cursor );
			if ( ! $inserted ) {
				$new_inner .= implode( '', $rendered_items );
				$inserted = true;
			}
			$cursor = $range['end'];
		}
		$new_inner .= substr( $inner, $cursor );
	}
	return substr_replace( $container_html, $new_inner, $inner_start, $closing_start - $inner_start );
}

/** Apply saved repeater rows to the source-matched list, FAQ, or card-like item group. */
function alify_apply_structured_list_groups( $html, $section, $section_name_prefix, $post_id ) {
	$groups = array();
	foreach ( $section['list_groups'] ?? array() as $group ) {
		if ( empty( $group['repeatable'] ) || empty( $group['items'] ) ) {
			continue;
		}
		$field_suffix = sanitize_key( $group['field_name'] ?? ( 'list_' . sprintf( '%02d', absint( $group['index'] ) ) . '_items' ) );
		$repeater_name = $section_name_prefix . $field_suffix;
		if ( ! alify_acf_value_is_saved( $repeater_name, $post_id ) ) {
			continue;
		}
		$range = alify_get_repeater_group_container_range( $html, $group );
		if ( $range ) {
			$group['_render_range'] = $range;
			$groups[] = $group;
		}
	}
	usort( $groups, function ( $left, $right ) { return $right['_render_range']['start'] <=> $left['_render_range']['start']; } );
	foreach ( $groups as $group ) {
		$range = alify_get_repeater_group_container_range( $html, $group );
		if ( ! $range ) {
			continue;
		}
		$field_suffix = sanitize_key( $group['field_name'] ?? ( 'list_' . sprintf( '%02d', absint( $group['index'] ) ) . '_items' ) );
		$repeater_name = $section_name_prefix . $field_suffix;
		$rows = get_field( $repeater_name, $post_id );
		$rows = is_array( $rows ) ? $rows : array();
		$rendered_items = array();
		foreach ( $rows as $row_index => $row ) {
			$template = $group['items'][ min( $row_index, count( $group['items'] ) - 1 ) ];
			$row = is_array( $row ) ? $row : array();
			$item_html = alify_apply_card_row( $template['html'], $template, $row );
			$item_html = alify_apply_repeater_item_attributes( $item_html, $group, $template, $row );
			$item_html = alify_make_repeater_item_ids_unique( $item_html, $section_name_prefix . $field_suffix, $row_index + 1 );
			$rendered_items[] = $item_html;
		}
		$container_html = substr( $html, $range['start'], $range['end'] - $range['start'] );
		$container_html = alify_replace_repeater_group_items( $container_html, $group, $rendered_items );
		$html = substr_replace( $html, $container_html, $range['start'], $range['end'] - $range['start'] );
	}
	return $html;
}

/** Resolve the field-name prefix for a source page or a type-wide single template. */
function alify_get_source_acf_field_prefix( $slug, $post_id, $is_singular_context ) {
	if ( ! $is_singular_context ) {
		return 'alify_archive_' . sanitize_key( $slug ) . '_';
	}
	$source_slug = sanitize_title( (string) get_post_meta( $post_id, '_alify_source_slug', true ) );
	if ( ! $source_slug ) {
		$source_slug = sanitize_title( (string) get_post_field( 'post_name', $post_id ) );
	}
	$data = alify_get_acf_page_field_data();
	$template_types = array_flip( alify_get_acf_single_template_types() );
	$post_type = get_post_type( $post_id );
	if ( isset( $template_types[ $post_type ] ) && $slug === $template_types[ $post_type ] && $source_slug === $slug ) {
		return 'alify_single_' . sanitize_key( $post_type ) . '_';
	}
	if ( isset( $data[ $source_slug ] ) && ! in_array( $source_slug, alify_get_acf_archive_page_slugs(), true ) ) {
		return 'alify_';
	}
	if ( isset( $template_types[ $post_type ] ) && $slug === $template_types[ $post_type ] ) {
		return 'alify_single_' . sanitize_key( $post_type ) . '_';
	}
	return 'alify_';
}

/** Apply saved structured fields to top-level sections. */
function alify_apply_source_page_acf_fields( $markup, $slug ) {
	$is_singular_context = is_singular();
	$is_archive_context  = ! $is_singular_context && ( is_home() || is_post_type_archive() );
	if ( ! function_exists( 'get_field' ) || ( ! $is_singular_context && ! $is_archive_context ) ) {
		return $markup;
	}
	$data = alify_get_acf_page_field_data();
	if ( empty( $data[ $slug ]['sections'] ) ) {
		return $markup;
	}
	$post_id = $is_singular_context ? get_queried_object_id() : 'option';
	$prefix  = alify_get_source_acf_field_prefix( $slug, $post_id, $is_singular_context );
	$sections = $data[ $slug ]['sections'];
	for ( $i = count( $sections ) - 1; $i >= 0; --$i ) {
		$section = $sections[ $i ];
		$index   = absint( $section['index'] );
		$range   = alify_get_source_section_range( $markup, $index );
		if ( ! $range ) {
			continue;
		}
		$source_html = substr( $markup, $range['start'], $range['length'] );
		$section_html = $source_html;
		$section_name_prefix = $prefix . 'section_' . sprintf( '%02d', $index ) . '_';
		$section_html = alify_apply_structured_elements( $section_html, $section['elements'] ?? array(), $section_name_prefix, $post_id );
		$section_html = alify_apply_template_section_attributes( $section_html, $section, $section_name_prefix, $post_id );
		$section_html = alify_apply_structured_cards( $section_html, $section, $section_name_prefix, $post_id );
		$section_html = alify_apply_structured_list_groups( $section_html, $section, $section_name_prefix, $post_id );
		foreach ( $section['forms'] ?? array() as $form ) {
			$form_index = absint( $form['index'] );
			$form_html = alify_sanitize_page_section_html( $form['html'] ?? '' );
			$form_prefix = $prefix . 'section_' . sprintf( '%02d', $index ) . '_form_' . sprintf( '%02d', $form_index ) . '_';
			$form_html = alify_apply_structured_elements( $form_html, $form['elements'] ?? array(), $form_prefix, $post_id, array() );
			$form_html = alify_restore_source_form_controls( $form_html, $form );
			$form_html = alify_sanitize_page_section_html( $form_html );
			$section_html = alify_replace_section_form_markup( $section_html, $form_index, $form_html );
		}
		$markup = substr_replace( $markup, $section_html, $range['start'], $range['length'] );
	}
	return $markup;
}

/** Remove repeated demo article cards from supplemental populated-archive content. */
function alify_strip_archive_source_articles( $html ) {
	preg_match_all( '~</?article\b[^>]*>~i', $html, $tokens, PREG_OFFSET_CAPTURE );
	$depth = 0;
	$start = null;
	$ranges = array();
	foreach ( $tokens[0] as $token ) {
		$tag = $token[0];
		if ( 0 === strpos( $tag, '</' ) ) {
			if ( $depth > 0 ) {
				--$depth;
			}
			if ( 0 === $depth && null !== $start ) {
				$ranges[] = array( $start, $token[1] + strlen( $tag ) - $start );
				$start = null;
			}
		} else {
			if ( 0 === $depth ) {
				$start = $token[1];
			}
			++$depth;
		}
	}
	for ( $i = count( $ranges ) - 1; $i >= 0; --$i ) {
		$html = substr_replace( $html, '', $ranges[ $i ][0], $ranges[ $i ][1] );
	}
	return $html;
}

/** Render explicitly saved archive section fields after live WordPress results. */
function alify_render_archive_editorial_sections( $slug ) {
	if ( ! function_exists( 'get_field' ) || ! in_array( $slug, alify_get_acf_archive_page_slugs(), true ) ) {
		return;
	}
	$data = alify_get_acf_page_field_data();
	if ( empty( $data[ $slug ]['sections'] ) ) {
		return;
	}
	$prefix = 'alify_archive_' . sanitize_key( $slug ) . '_';
	foreach ( $data[ $slug ]['sections'] as $section ) {
		$index = absint( $section['index'] );
		$section_name_prefix = $prefix . 'section_' . sprintf( '%02d', $index ) . '_';
		$has_edit = false;
		foreach ( $section['elements'] ?? array() as $element ) {
			$has_edit = $has_edit || alify_acf_value_is_saved( $section_name_prefix . 'element_' . sprintf( '%02d', absint( $element['index'] ) ), 'option' );
		}
		foreach ( $section['links'] ?? array() as $link ) {
			$has_edit = $has_edit || alify_acf_value_is_saved( $section_name_prefix . 'link_' . sprintf( '%02d', absint( $link['index'] ) ) . '_url', 'option' );
		}
		foreach ( $section['images'] ?? array() as $image ) {
			$image_name = $section_name_prefix . 'image_' . sprintf( '%02d', absint( $image['index'] ) );
			$has_edit = $has_edit || alify_acf_value_is_saved( $image_name, 'option' ) || alify_acf_value_is_saved( $image_name . '_alt', 'option' );
		}
		foreach ( $section['list_groups'] ?? array() as $group ) {
			$group_name = sanitize_key( $group['field_name'] ?? ( 'list_' . sprintf( '%02d', absint( $group['index'] ) ) . '_items' ) );
			$has_edit = $has_edit || alify_acf_value_is_saved( $section_name_prefix . $group_name, 'option' );
		}
		foreach ( $section['forms'] ?? array() as $form ) {
			$form_prefix = $section_name_prefix . 'form_' . sprintf( '%02d', absint( $form['index'] ) ) . '_';
			foreach ( $form['elements'] ?? array() as $element ) {
				$has_edit = $has_edit || alify_acf_value_is_saved( $form_prefix . 'element_' . sprintf( '%02d', absint( $element['index'] ) ), 'option' );
			}
		}
		if ( ! $has_edit ) {
			continue;
		}
		$html = $section['html'] ?? '';
		if ( ! is_string( $html ) || '' === trim( $html ) ) {
			continue;
		}
		$html = alify_sanitize_page_section_html( $html );
		$html = alify_apply_structured_elements( $html, $section['elements'] ?? array(), $section_name_prefix, 'option' );
		$html = alify_apply_template_section_attributes( $html, $section, $section_name_prefix, 'option' );
		$html = alify_apply_structured_list_groups( $html, $section, $section_name_prefix, 'option' );
		foreach ( $section['forms'] ?? array() as $form ) {
			$form_index = absint( $form['index'] );
			$form_html = alify_sanitize_page_section_html( $form['html'] ?? '' );
			$form_prefix = $section_name_prefix . 'form_' . sprintf( '%02d', $form_index ) . '_';
			$form_html = alify_apply_structured_elements( $form_html, $form['elements'] ?? array(), $form_prefix, 'option', array() );
			$form_html = alify_restore_source_form_controls( $form_html, $form );
			$form_html = alify_sanitize_page_section_html( $form_html );
			$html = alify_replace_section_form_markup( $html, $form_index, $form_html );
		}
		$html = alify_strip_archive_source_articles( $html );
		if ( function_exists( 'alify_source_assets_uri' ) ) {
			$html = str_replace( 'assets/', esc_url( alify_source_assets_uri() ) . '/', $html );
		}
		if ( function_exists( 'alify_source_url' ) ) {
			$html = preg_replace_callback( '/(\\bhref\\s*=\\s*)(["\\x27])([^"\\x27]+\\.html(?:[?#][^"\\x27]*)?)(\\2)/i', function ( $matches ) {
				if ( preg_match( '~^(?:[a-z][a-z0-9+.-]*:)?//~i', $matches[3] ) ) {
					return $matches[0];
				}
				$parts = wp_parse_url( $matches[3] );
				$path = isset( $parts['path'] ) ? $parts['path'] : $matches[3];
				$url = alify_source_url( sanitize_title( basename( $path, '.html' ) ) );
				if ( ! empty( $parts['query'] ) ) {
					$url = add_query_arg( wp_parse_args( $parts['query'] ), $url );
				}
				if ( ! empty( $parts['fragment'] ) ) {
					$url .= '#' . rawurlencode( $parts['fragment'] );
				}
				return $matches[1] . $matches[2] . esc_url( $url ) . $matches[4];
			}, $html );
		}
		if ( '' === trim( wp_strip_all_tags( $html ) ) ) {
			continue;
		}
		$classes = array_values( array_unique( array_filter( array_map( 'sanitize_html_class', preg_split( '/\\s+/', $section['class'] ?? '' ) ) ) ) );
		$classes[] = 'alify-archive-editorial';
		$label = ! empty( $section['aria_label'] ) ? ' aria-label="' . esc_attr( $section['aria_label'] ) . '"' : '';
		echo '<section class="page-section ' . esc_attr( implode( ' ', $classes ) ) . '"' . $label . '>' . $html . '</section>';
	}
}
