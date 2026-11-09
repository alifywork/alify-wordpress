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

/** Add a source-page selector for source-derived field groups. */
function alify_acf_register_source_page_location_rule( $choices ) {
	$choices['Alify']['alify_source_page'] = __( 'Alify source page', 'alify' );
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

function alify_acf_current_editor_post_id() {
	$post_id = 0;
	if ( isset( $_GET['post'] ) ) {
		$post_id = absint( wp_unslash( $_GET['post'] ) );
	} elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = absint( wp_unslash( $_POST['post_ID'] ) );
	}
	return $post_id;
}

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
		$seo       = isset( $page['seo'] ) && is_array( $page['seo'] ) ? $page['seo'] : array();
		$fields    = array(
			array( 'key' => 'field_alify_' . $safe_slug . '_seo_tab', 'label' => __( 'SEO Metadata', 'alify' ), 'name' => 'alify_' . $safe_slug . '_seo_tab', 'type' => 'tab', 'placement' => 'top' ),
			array( 'key' => 'field_alify_' . $safe_slug . '_seo_title', 'label' => __( 'SEO Title', 'alify' ), 'name' => 'alify_seo_title', 'type' => 'text', 'default_value' => isset( $seo['title'] ) ? sanitize_text_field( $seo['title'] ) : '', 'instructions' => __( 'Optional browser/search title. Leave blank to use the WordPress title.', 'alify' ) ),
			array( 'key' => 'field_alify_' . $safe_slug . '_meta_description', 'label' => __( 'Meta Description', 'alify' ), 'name' => 'alify_meta_description', 'type' => 'textarea', 'rows' => 3, 'default_value' => isset( $seo['description'] ) ? sanitize_textarea_field( $seo['description'] ) : '', 'instructions' => __( 'Plain-text summary for search/social previews.', 'alify' ) ),
			array( 'key' => 'field_alify_' . $safe_slug . '_intro', 'label' => __( 'Page Content (text + HTML)', 'alify' ), 'name' => 'alify_' . $safe_slug . '_content_tab', 'type' => 'tab', 'placement' => 'top' ),
		);
		foreach ( $page['sections'] as $section ) {
			$number = absint( $section['index'] );
			$suffix = sprintf( '%02d', $number );
			$label  = isset( $section['label'] ) ? sanitize_text_field( $section['label'] ) : sprintf( __( 'Section %d', 'alify' ), $number );
			$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_tab', 'label' => sprintf( __( '%1$02d. %2$s', 'alify' ), $number, $label ), 'name' => 'alify_section_' . $suffix . '_tab', 'type' => 'tab', 'placement' => 'top' );
			$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_html', 'label' => sprintf( __( '%1$02d. %2$s — content and HTML', 'alify' ), $number, $label ), 'name' => 'alify_section_' . $suffix . '_html', 'type' => 'wysiwyg', 'instructions' => __( 'Edit text in Visual or HTML in Text. The theme keeps the surrounding section layout and restores validated form controls.', 'alify' ), 'tabs' => 'all', 'toolbar' => 'full', 'media_upload' => 0, 'delay' => 1, 'default_value' => $section['html'] ?? '' );
			foreach ( $section['forms'] ?? array() as $form ) {
				$form_number = absint( $form['index'] );
				$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_form_' . sprintf( '%02d', $form_number ) . '_html', 'label' => sprintf( __( 'Form %d — labels and HTML', 'alify' ), $form_number ), 'name' => 'alify_section_' . $suffix . '_form_' . sprintf( '%02d', $form_number ) . '_html', 'type' => 'wysiwyg', 'instructions' => __( 'Edit labels and copy in Visual or HTML in Text. Keep every ALIFY_CONTROL placeholder; the theme restores validated inputs, required state, and choice values.', 'alify' ), 'tabs' => 'all', 'toolbar' => 'full', 'media_upload' => 0, 'delay' => 1, 'default_value' => $form['html'] ?? '' );
			}
			foreach ( $section['links'] ?? array() as $link ) {
				$link_number = absint( $link['index'] );
				$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_link_' . sprintf( '%02d', $link_number ), 'label' => sprintf( __( 'Link %1$d URL — %2$s', 'alify' ), $link_number, sanitize_text_field( $link['label'] ?? __( 'Link', 'alify' ) ) ), 'name' => 'alify_section_' . $suffix . '_link_' . sprintf( '%02d', $link_number ) . '_url', 'type' => 'text', 'default_value' => $link['href'] ?? '', 'instructions' => __( 'Optional URL override; blank retains the section HTML destination.', 'alify' ) );
			}
			foreach ( $section['images'] ?? array() as $image ) {
				$image_number = absint( $image['index'] );
				$image_suffix = sprintf( '%02d', $image_number );
				$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_image_' . $image_suffix, 'label' => sprintf( __( 'Image %1$d — %2$s', 'alify' ), $image_number, wp_basename( $image['src'] ?? '' ) ), 'name' => 'alify_section_' . $suffix . '_image_' . $image_suffix, 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'library' => 'all', 'instructions' => __( 'Optional replacement image.', 'alify' ) );
				$fields[] = array( 'key' => 'field_alify_' . $safe_slug . '_section_' . $suffix . '_image_' . $image_suffix . '_alt', 'label' => sprintf( __( 'Image %d alternative text', 'alify' ), $image_number ), 'name' => 'alify_section_' . $suffix . '_image_' . $image_suffix . '_alt', 'type' => 'text', 'default_value' => $image['alt'] ?? '', 'instructions' => __( 'Describe informative images; leave blank for decorative images.', 'alify' ) );
			}
		}
		acf_add_local_field_group( array( 'key' => 'group_alify_source_page_' . $safe_slug, 'title' => sprintf( __( 'Alify Page Fields — %s', 'alify' ), sanitize_text_field( $page['title'] ?? $slug ) ), 'fields' => $fields, 'location' => array( array( array( 'param' => 'alify_source_page', 'operator' => '==', 'value' => $slug ) ) ), 'menu_order' => 1, 'position' => 'normal', 'style' => 'default', 'label_placement' => 'top', 'instruction_placement' => 'field', 'active' => true ) );
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
			$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_hero_' . $hero_key, 'label' => sprintf( __( 'Archive Hero %s (text + HTML)', 'alify' ), ucfirst( $hero_key ) ), 'name' => 'alify_archive_' . $safe . '_hero_' . ( 'title' === $hero_key ? 'title' : $hero_key ) . '_html', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 1, 'default_value' => $hero[ $hero_key ] ?? '' );
		}
		$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_hero_background', 'label' => __( 'Archive Hero Background', 'alify' ), 'name' => 'alify_archive_' . $safe . '_hero_background', 'type' => 'select', 'choices' => array_combine( array_map( function ( $n ) { return sprintf( 'neon-lines-%02d.webp', $n ); }, range( 1, 14 ) ), array_map( function ( $n ) { return sprintf( __( 'Neon %02d', 'alify' ), $n ); }, range( 1, 14 ) ) ), 'default_value' => wp_basename( $hero['background'] ?? 'neon-lines-01.webp' ) );
		$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_hero_variant', 'label' => __( 'Archive Hero Layout Variant', 'alify' ), 'name' => 'alify_archive_' . $safe . '_hero_variant', 'type' => 'select', 'choices' => array( '' => __( 'Default', 'alify' ), 'mirror-right' => __( 'Mirror Right', 'alify' ), 'close-up' => __( 'Close Up', 'alify' ), 'soft-focus' => __( 'Soft Focus', 'alify' ) ), 'default_value' => $hero['variant'] ?? '' );
		foreach ( $page['sections'] ?? array() as $section ) {
			$number = absint( $section['index'] );
			$suffix = sprintf( '%02d', $number );
			$label  = sanitize_text_field( $section['label'] ?? sprintf( __( 'Section %d', 'alify' ), $number ) );
			$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_section_' . $suffix . '_tab', 'label' => sprintf( __( '%02d. %s', 'alify' ), $number, $label ), 'name' => 'alify_archive_' . $safe . '_section_' . $suffix . '_tab', 'type' => 'tab', 'placement' => 'top' );
			$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_section_' . $suffix . '_html', 'label' => sprintf( __( '%02d. %s — content and HTML', 'alify' ), $number, $label ), 'name' => 'alify_archive_' . $safe . '_section_' . $suffix . '_html', 'type' => 'wysiwyg', 'instructions' => __( 'Edit text in Visual or HTML in Text. On populated archives, edited static content appears after the WordPress-driven results; bundled article cards remain dynamic.', 'alify' ), 'tabs' => 'all', 'toolbar' => 'full', 'media_upload' => 0, 'delay' => 1, 'default_value' => $section['html'] ?? '' );
			foreach ( $section['forms'] ?? array() as $form ) {
				$fi = sprintf( '%02d', absint( $form['index'] ) );
				$archive_fields[] = array( 'key' => 'field_alify_archive_' . $safe . '_section_' . $suffix . '_form_' . $fi, 'label' => sprintf( __( 'Form %s — labels and HTML', 'alify' ), $fi ), 'name' => 'alify_archive_' . $safe . '_section_' . $suffix . '_form_' . $fi . '_html', 'type' => 'wysiwyg', 'instructions' => __( 'Keep ALIFY_CONTROL placeholders so validated controls are restored.', 'alify' ), 'tabs' => 'all', 'toolbar' => 'full', 'media_upload' => 0, 'delay' => 1, 'default_value' => $form['html'] ?? '' );
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
	return false !== strpos( $section_html, $placeholder ) ? str_replace( $placeholder, $form_html, $section_html ) : $section_html . $form_html;
}

/** Override one indexed tag attribute. */
function alify_override_section_tag_attribute( $html, $tag, $index, $attribute, $value ) {
	$count = 0;
	return preg_replace_callback( '~<' . preg_quote( $tag, '~' ) . '\b[^>]*>~i', function ( $matches ) use ( &$count, $index, $attribute, $value ) {
		++$count;
		return absint( $index ) === $count ? alify_set_html_attribute( $matches[0], $attribute, $value ) : $matches[0];
	}, $html );
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

/** Apply saved WYSIWYG and separate asset fields to top-level sections. */
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
	$prefix  = $is_singular_context ? '' : 'alify_archive_' . sanitize_key( $slug ) . '_';
	$sections = $data[ $slug ]['sections'];
	for ( $i = count( $sections ) - 1; $i >= 0; --$i ) {
		$section = $sections[ $i ];
		$index   = absint( $section['index'] );
		$range   = alify_get_source_section_range( $markup, $index );
		if ( ! $range ) {
			continue;
		}
		$source_html = substr( $markup, $range['start'], $range['length'] );
		$field_name = $prefix . 'section_' . sprintf( '%02d', $index ) . '_html';
		$section_html = get_field( $field_name, $post_id, false );
		$saved = 'option' === $post_id ? null !== get_option( 'options_' . $field_name, null ) : ( function_exists( 'metadata_exists' ) && metadata_exists( 'post', $post_id, $field_name ) );
		if ( ! is_string( $section_html ) || ( '' === trim( $section_html ) && ! $saved ) ) {
			$section_html = $source_html;
		} else {
			$section_html = alify_sanitize_page_section_html( $section_html );
		}
		foreach ( $section['forms'] ?? array() as $form ) {
			$form_index = absint( $form['index'] );
			$form_name  = $prefix . 'section_' . sprintf( '%02d', $index ) . '_form_' . sprintf( '%02d', $form_index ) . '_html';
			$form_html  = get_field( $form_name, $post_id, false );
			if ( ! is_string( $form_html ) || '' === trim( $form_html ) ) {
				$form_html = $form['html'] ?? '';
			}
			$form_html = alify_sanitize_page_section_html( $form_html );
			$form_html = alify_restore_source_form_controls( $form_html, $form );
			$form_html = alify_sanitize_page_section_html( $form_html );
			$form_html = alify_preserve_source_form_controls( $form_html, $form['html'] ?? '' );
			$section_html = alify_replace_section_form_markup( $section_html, $form_index, $form_html );
		}
		foreach ( $section['links'] ?? array() as $link ) {
			$url = get_field( $prefix . 'section_' . sprintf( '%02d', $index ) . '_link_' . sprintf( '%02d', absint( $link['index'] ) ) . '_url', $post_id );
			if ( is_string( $url ) && '' !== trim( $url ) ) {
				$section_html = alify_override_section_tag_attribute( $section_html, 'a', $link['index'], 'href', esc_url_raw( $url, array( 'http', 'https', 'mailto', 'tel' ) ) );
			}
		}
		foreach ( $section['images'] ?? array() as $image ) {
			$number = absint( $image['index'] );
			$image_url = get_field( $prefix . 'section_' . sprintf( '%02d', $index ) . '_image_' . sprintf( '%02d', $number ), $post_id );
			$image_alt = get_field( $prefix . 'section_' . sprintf( '%02d', $index ) . '_image_' . sprintf( '%02d', $number ) . '_alt', $post_id );
			if ( is_string( $image_url ) && '' !== trim( $image_url ) ) {
				$section_html = alify_override_section_tag_attribute( $section_html, 'img', $number, 'src', esc_url_raw( $image_url, array( 'http', 'https' ) ) );
			}
			$alt_name = $prefix . 'section_' . sprintf( '%02d', $index ) . '_image_' . sprintf( '%02d', $number ) . '_alt';
			$alt_saved = 'option' === $post_id ? null !== get_option( 'options_' . $alt_name, null ) : ( function_exists( 'metadata_exists' ) && metadata_exists( 'post', $post_id, $alt_name ) );
			if ( is_string( $image_alt ) && ( '' !== trim( $image_alt ) || $alt_saved ) ) {
				$section_html = alify_override_section_tag_attribute( $section_html, 'img', $number, 'alt', $image_alt );
			}
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

/** Render explicitly saved static archive sections after the live WordPress result grid. */
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
		$field = $prefix . 'section_' . sprintf( '%02d', $index ) . '_html';
		if ( null === get_option( 'options_' . $field, null ) ) {
			continue;
		}
		$html = get_field( $field, 'option', false );
		if ( ! is_string( $html ) || '' === trim( $html ) ) {
			continue;
		}
		$html = alify_sanitize_page_section_html( $html );
		foreach ( $section['forms'] ?? array() as $form ) {
			$form_index = absint( $form['index'] );
			$form_name  = $prefix . 'section_' . sprintf( '%02d', $index ) . '_form_' . sprintf( '%02d', $form_index ) . '_html';
			$form_html  = get_field( $form_name, 'option', false );
			if ( ! is_string( $form_html ) || '' === trim( $form_html ) ) {
				$form_html = $form['html'] ?? '';
			}
			$form_html = alify_sanitize_page_section_html( $form_html );
			$form_html = alify_restore_source_form_controls( $form_html, $form );
			$form_html = alify_sanitize_page_section_html( $form_html );
			$html = alify_replace_section_form_markup( $html, $form_index, $form_html );
		}
		foreach ( $section['links'] ?? array() as $link ) {
			$url = get_field( $prefix . 'section_' . sprintf( '%02d', $index ) . '_link_' . sprintf( '%02d', absint( $link['index'] ) ) . '_url', 'option' );
			if ( is_string( $url ) && '' !== trim( $url ) ) {
				$html = alify_override_section_tag_attribute( $html, 'a', $link['index'], 'href', esc_url_raw( $url, array( 'http', 'https', 'mailto', 'tel' ) ) );
			}
		}
		foreach ( $section['images'] ?? array() as $image ) {
			$number = absint( $image['index'] );
			$url = get_field( $prefix . 'section_' . sprintf( '%02d', $index ) . '_image_' . sprintf( '%02d', $number ), 'option' );
			$alt = get_field( $prefix . 'section_' . sprintf( '%02d', $index ) . '_image_' . sprintf( '%02d', $number ) . '_alt', 'option' );
			if ( is_string( $url ) && '' !== trim( $url ) ) {
				$html = alify_override_section_tag_attribute( $html, 'img', $number, 'src', esc_url_raw( $url, array( 'http', 'https' ) ) );
			}
			if ( is_string( $alt ) ) {
				$html = alify_override_section_tag_attribute( $html, 'img', $number, 'alt', $alt );
			}
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
		$classes = array_values( array_unique( array_filter( array_map( 'sanitize_html_class', preg_split( '/\s+/', $section['class'] ?? '' ) ) ) ) );
		$classes[] = 'alify-archive-editorial';
		$label = ! empty( $section['aria_label'] ) ? ' aria-label="' . esc_attr( $section['aria_label'] ) . '"' : '';
		echo '<section class="page-section ' . esc_attr( implode( ' ', $classes ) ) . '"' . $label . '>' . $html . '</section>';
	}
}
