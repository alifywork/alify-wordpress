<?php
/** Admin-side form entry metadata and relationship columns. */

defined( 'ABSPATH' ) || exit;

function alify_form_entry_columns( $columns ) {
	$columns['form_source'] = __( 'Form', 'alify' );
	$columns['entry_date']  = __( 'Submitted', 'alify' );
	return $columns;
}
add_filter( 'manage_alify_form_entry_posts_columns', 'alify_form_entry_columns' );

function alify_form_entry_column_content( $column, $post_id ) {
	if ( 'form_source' === $column ) {
		$form_id = absint( get_post_meta( $post_id, '_alify_form_id', true ) );
		if ( $form_id && get_post( $form_id ) ) {
			echo esc_html( get_the_title( $form_id ) );
		} else {
			echo '&mdash;';
		}
	} elseif ( 'entry_date' === $column ) {
		echo esc_html( get_the_date( get_option( 'date_format' ), $post_id ) );
	}
}
add_action( 'manage_alify_form_entry_posts_custom_column', 'alify_form_entry_column_content', 10, 2 );

function alify_form_entry_meta_box() {
	add_meta_box( 'alify-form-entry-data', __( 'Submitted Data', 'alify' ), 'alify_render_form_entry_meta_box', 'alify_form_entry', 'normal', 'high' );
}
add_action( 'add_meta_boxes_alify_form_entry', 'alify_form_entry_meta_box' );

function alify_render_form_entry_meta_box( $post ) {
	$data = get_post_meta( $post->ID, '_alify_form_data', true );
	$form_id = absint( get_post_meta( $post->ID, '_alify_form_id', true ) );
	if ( $form_id && get_post( $form_id ) ) {
		echo '<p><strong>' . esc_html__( 'Source form:', 'alify' ) . '</strong> ' . esc_html( get_the_title( $form_id ) ) . '</p>';
	}
	if ( ! is_array( $data ) || empty( $data ) ) {
		echo '<p>' . esc_html__( 'No submitted field data is stored on this entry.', 'alify' ) . '</p>';
		return;
	}
	echo '<dl>';
	foreach ( $data as $label => $value ) {
		if ( is_array( $value ) ) {
			$value = implode( ', ', array_map( 'sanitize_text_field', $value ) );
		}
		echo '<dt><strong>' . esc_html( $label ) . '</strong></dt><dd>' . esc_html( (string) $value ) . '</dd>';
	}
	echo '</dl>';
}

// Form entries are private records; prevent them being exposed through public REST routes.
add_filter( 'register_post_type_args', 'alify_private_form_entry_rest', 10, 2 );
function alify_private_form_entry_rest( $args, $post_type ) {
	if ( 'alify_form_entry' === $post_type ) {
		$args['show_in_rest'] = false;
	}
	return $args;
}
