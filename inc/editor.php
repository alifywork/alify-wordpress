<?php
/** Editor controls for choosing source designs or editable WordPress content. */

defined( 'ABSPATH' ) || exit;

function alify_add_content_mode_metaboxes( $post_type, $post ) {
	if ( ! $post instanceof WP_Post ) {
		return;
	}
	$source_slug = 'home' === $post->post_name ? 'index' : sanitize_file_name( $post->post_name );
	$source_file = ALIFY_THEME_DIR . '/template-parts/source-pages/' . $source_slug . '.php';
	$has_source  = is_readable( $source_file ) || get_post_meta( $post->ID, '_alify_source_content_imported', true );
	if ( ! $has_source ) {
		return;
	}
	add_meta_box( 'alify_content_mode', __( 'Alify Page Presentation', 'alify' ), 'alify_render_content_mode_metabox', $post_type, 'side', 'default' );
}
add_action( 'add_meta_boxes', 'alify_add_content_mode_metaboxes', 10, 2 );

function alify_render_content_mode_metabox( $post ) {
	$mode = get_post_meta( $post->ID, '_alify_content_mode', true );
	if ( ! in_array( $mode, array( 'source', 'content' ), true ) ) {
		$has_content = '' !== trim( (string) get_post_field( 'post_content', $post->ID ) );
		$imported    = get_post_meta( $post->ID, '_alify_source_content_imported', true );
		$mode        = $has_content && ! $imported ? 'content' : 'source';
	}
	wp_nonce_field( 'alify_save_content_mode', 'alify_content_mode_nonce' );
	?>
	<p><label for="alify-content-mode"><strong><?php esc_html_e( 'Display on the site', 'alify' ); ?></strong></label></p>
	<select id="alify-content-mode" name="alify_content_mode" class="widefat">
		<option value="source" <?php selected( $mode, 'source' ); ?>><?php esc_html_e( 'Original Alify design', 'alify' ); ?></option>
		<option value="content" <?php selected( $mode, 'content' ); ?>><?php esc_html_e( 'WordPress editor content', 'alify' ); ?></option>
	</select>
	<p class="description"><?php esc_html_e( 'The imported page body is editable in the WordPress editor. Keep the original design selected until you are ready to publish your edited body.', 'alify' ); ?></p>
	<?php
}

function alify_save_content_mode( $post_id ) {
	if ( ! isset( $_POST['alify_content_mode_nonce'] ) || ! is_scalar( $_POST['alify_content_mode_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['alify_content_mode_nonce'] ) ), 'alify_save_content_mode' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( ! isset( $_POST['alify_content_mode'] ) || ! is_scalar( $_POST['alify_content_mode'] ) ) {
		return;
	}
	$mode = sanitize_key( wp_unslash( $_POST['alify_content_mode'] ) );
	if ( in_array( $mode, array( 'source', 'content' ), true ) ) {
		update_post_meta( $post_id, '_alify_content_mode', $mode );
	}
}
add_action( 'save_post', 'alify_save_content_mode' );
