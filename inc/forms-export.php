<?php
/** Administrator-only CSV export for private form entries. */

defined( 'ABSPATH' ) || exit;

function alify_register_form_export_page() {
	add_submenu_page(
		'edit.php?post_type=alify_form_entry',
		__( 'Export Form Entries', 'alify' ),
		__( 'Export CSV', 'alify' ),
		'manage_options',
		'alify-export-form-entries',
		'alify_render_form_export_page'
	);
}
add_action( 'admin_menu', 'alify_register_form_export_page' );

function alify_render_form_export_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Export Form Entries', 'alify' ); ?></h1>
		<p><?php esc_html_e( 'Download all private form submissions as a CSV file. The export contains personal information; store and share it securely.', 'alify' ); ?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="alify_export_form_entries">
			<?php wp_nonce_field( 'alify_export_form_entries_action', 'alify_export_form_entries_nonce' ); ?>
			<?php submit_button( __( 'Download CSV', 'alify' ), 'primary' ); ?>
		</form>
	</div>
	<?php
}

function alify_csv_safe_cell( $value ) {
	$value = (string) $value;
	if ( preg_match( '/^[\s]*[=+\-@]/', $value ) ) {
		$value = "'" . $value;
	}
	return $value;
}

function alify_export_form_entries_csv() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to export form entries.', 'alify' ), '', array( 'response' => 403 ) );
	}
	$nonce = isset( $_POST['alify_export_form_entries_nonce'] ) && is_scalar( $_POST['alify_export_form_entries_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['alify_export_form_entries_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'alify_export_form_entries_action' ) ) {
		wp_die( esc_html__( 'This export request has expired. Please reload the page and try again.', 'alify' ), '', array( 'response' => 403 ) );
	}

	$batch_size = 500;
	$page       = 1;
	nocache_headers();
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=alify-form-entries-' . gmdate( 'Y-m-d' ) . '.csv' );
	$output = fopen( 'php://output', 'w' );
	fputcsv( $output, array( 'Entry ID', 'Submitted at', 'Source form', 'Field', 'Value' ) );
	do {
		$query = new WP_Query(
			array(
				'post_type'      => 'alify_form_entry',
				'post_status'    => array( 'private', 'publish' ),
				'posts_per_page' => $batch_size,
				'paged'          => $page,
				'orderby'        => 'ID',
				'order'          => 'ASC',
				'fields'         => 'ids',
				'no_found_rows'  => true,
			)
		);
		foreach ( $query->posts as $entry_id ) {
			$data = get_post_meta( $entry_id, '_alify_form_data', true );
			$data = is_array( $data ) ? $data : array();
			$form_id = absint( get_post_meta( $entry_id, '_alify_form_id', true ) );
			$form_name = $form_id && get_post( $form_id ) ? get_the_title( $form_id ) : get_post_meta( $entry_id, '_alify_form_source', true );
			if ( empty( $data ) ) {
				fputcsv( $output, array_map( 'alify_csv_safe_cell', array( $entry_id, get_post_field( 'post_date', $entry_id ), $form_name, '', '' ) ) );
				continue;
			}
			foreach ( $data as $label => $value ) {
				if ( is_array( $value ) ) {
					$value = implode( ', ', array_map( 'sanitize_text_field', $value ) );
				}
				fputcsv( $output, array_map( 'alify_csv_safe_cell', array( $entry_id, get_post_field( 'post_date', $entry_id ), $form_name, $label, $value ) ) );
			}
		}
		$has_more = count( $query->posts ) === $batch_size;
		++$page;
	} while ( $has_more );
	fclose( $output );
	exit;
}
add_action( 'admin_post_alify_export_form_entries', 'alify_export_form_entries_csv' );
