<?php
/** Native form and form-template editor, available with or without ACF Pro. */

defined( 'ABSPATH' ) || exit;

/** Register a purpose-built field builder instead of exposing a blank editor. */
function alify_register_form_definition_meta_boxes() {
	foreach ( array( 'alify_form', 'alify_form_template' ) as $post_type ) {
		add_meta_box(
			'alify-form-builder',
			__( 'Form fields', 'alify' ),
			'alify_render_form_builder_meta_box',
			$post_type,
			'normal',
			'high'
		);
	}
	add_meta_box(
		'alify-form-options',
		__( 'Delivery and confirmation', 'alify' ),
		'alify_render_form_options_meta_box',
		'alify_form',
		'normal',
		'default'
	);
	add_meta_box(
		'alify-form-shortcode',
		__( 'Add this form to a page', 'alify' ),
		'alify_render_form_shortcode_meta_box',
		'alify_form',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'alify_register_form_definition_meta_boxes' );

function alify_form_builder_field_types() {
	return array(
		'text'     => __( 'Single-line text', 'alify' ),
		'email'    => __( 'Email address', 'alify' ),
		'tel'      => __( 'Phone number', 'alify' ),
		'url'      => __( 'Website URL', 'alify' ),
		'textarea' => __( 'Long answer', 'alify' ),
		'select'   => __( 'Dropdown', 'alify' ),
		'radio'    => __( 'Choose one (radio)', 'alify' ),
		'checkbox' => __( 'Choose any (checkboxes)', 'alify' ),
	);
}

function alify_render_form_builder_meta_box( $post ) {
	wp_nonce_field( 'alify_save_form_definition', 'alify_form_definition_nonce' );
	$fields = alify_get_stored_form_fields( $post->ID );
	?>
	<div class="alify-form-builder" data-alify-form-builder>
		<p class="description"><?php esc_html_e( 'Add the questions visitors should answer. Labels are shown to visitors; field names are internal keys and must be unique. Do not use reserved names such as action, form_id, privacyConsent, or alify_nonce. Choice fields need one option per line.', 'alify' ); ?></p>
		<div class="alify-form-builder__fields" data-alify-fields>
			<?php foreach ( $fields as $index => $field ) :
				alify_render_form_builder_field( $index, $field );
			endforeach; ?>
		</div>
		<template data-alify-field-template>
			<?php alify_render_form_builder_field( '__INDEX__', array() ); ?>
		</template>
		<div class="alify-form-builder__footer">
			<button type="button" class="button button-secondary" data-alify-add-field><?php esc_html_e( 'Add a field', 'alify' ); ?></button>
			<span class="description"><?php esc_html_e( 'Up to 40 fields. Email, URL, required-field, and allowed-choice validation is applied when a visitor submits.', 'alify' ); ?></span>
			<p class="notice notice-info inline" data-alify-limit hidden><?php esc_html_e( 'This form has reached the 40-field limit.', 'alify' ); ?></p>
		</div>
	</div>
	<?php
}

function alify_render_form_builder_field( $index, $field ) {
	$field = is_array( $field ) ? $field : array();
	$label = isset( $field['label'] ) && is_scalar( $field['label'] ) ? (string) $field['label'] : '';
	$name  = isset( $field['field_name'] ) && is_scalar( $field['field_name'] ) ? (string) $field['field_name'] : '';
	$type  = isset( $field['field_type'] ) && is_scalar( $field['field_type'] ) ? (string) $field['field_type'] : 'text';
	$required = ! empty( $field['required'] );
	$options  = isset( $field['options'] ) && is_scalar( $field['options'] ) ? (string) $field['options'] : '';
	$types    = alify_form_builder_field_types();
	if ( ! isset( $types[ $type ] ) ) {
		$type = 'text';
	}
	?>
	<section class="alify-form-builder__field" data-alify-field>
		<header class="alify-form-builder__field-head">
			<strong data-alify-field-title><?php echo esc_html( $label ? $label : __( 'New field', 'alify' ) ); ?></strong>
			<div class="alify-form-builder__field-actions">
				<button type="button" class="button-link" data-alify-move-up aria-label="<?php esc_attr_e( 'Move field up', 'alify' ); ?>">↑</button>
				<button type="button" class="button-link" data-alify-move-down aria-label="<?php esc_attr_e( 'Move field down', 'alify' ); ?>">↓</button>
				<button type="button" class="button-link-delete" data-alify-remove-field><?php esc_html_e( 'Remove', 'alify' ); ?></button>
			</div>
		</header>
		<div class="alify-form-builder__field-grid">
			<label><?php esc_html_e( 'Visitor-facing label', 'alify' ); ?>
				<input type="text" class="regular-text" data-alify-label name="alify_form_fields[<?php echo esc_attr( $index ); ?>][label]" value="<?php echo esc_attr( $label ); ?>" required>
			</label>
			<label><?php esc_html_e( 'Field name (letters, numbers, underscore, hyphen)', 'alify' ); ?>
				<input type="text" class="regular-text" data-alify-name name="alify_form_fields[<?php echo esc_attr( $index ); ?>][field_name]" value="<?php echo esc_attr( $name ); ?>" pattern="[A-Za-z][A-Za-z0-9_-]*" required>
			</label>
			<label><?php esc_html_e( 'Field type', 'alify' ); ?>
				<select data-alify-type name="alify_form_fields[<?php echo esc_attr( $index ); ?>][field_type]">
					<?php foreach ( $types as $value => $caption ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $type, $value ); ?>><?php echo esc_html( $caption ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<label class="alify-form-builder__required"><input type="checkbox" data-alify-required name="alify_form_fields[<?php echo esc_attr( $index ); ?>][required]" value="1" <?php checked( $required ); ?>> <?php esc_html_e( 'Required', 'alify' ); ?></label>
			<label class="alify-form-builder__choices" data-alify-choices><?php esc_html_e( 'Choices (one per line; optional Label|value format)', 'alify' ); ?>
				<textarea data-alify-options name="alify_form_fields[<?php echo esc_attr( $index ); ?>][options]" rows="4" <?php echo in_array( $type, array( 'select', 'radio', 'checkbox' ), true ) ? 'required' : ''; ?>><?php echo esc_textarea( $options ); ?></textarea>
			</label>
		</div>
	</section>
	<?php
}

function alify_render_form_options_meta_box( $post ) {
	wp_nonce_field( 'alify_save_form_options', 'alify_form_options_nonce' );
	$recipient = get_post_meta( $post->ID, 'notification_recipient', true );
	$message   = get_post_meta( $post->ID, 'success_message', true );
	$template  = absint( get_post_meta( $post->ID, 'form_template', true ) );
	$templates = get_posts(
		array(
			'post_type'      => 'alify_form_template',
			'post_status'    => array( 'publish', 'draft', 'private' ),
			'posts_per_page' => 200,
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);
	?>
	<div class="alify-form-builder__settings">
		<label><?php esc_html_e( 'Reusable template', 'alify' ); ?>
			<select name="alify_form_template">
				<option value="0"><?php esc_html_e( 'No template', 'alify' ); ?></option>
				<?php foreach ( $templates as $item ) : ?>
					<option value="<?php echo esc_attr( $item->ID ); ?>" <?php selected( $template, $item->ID ); ?>><?php echo esc_html( $item->post_title ); ?></option>
				<?php endforeach; ?>
			</select>
			<span class="description"><?php esc_html_e( 'The selected template is used only when this form has no fields of its own.', 'alify' ); ?></span>
		</label>
		<label><?php esc_html_e( 'Notification recipient', 'alify' ); ?>
			<input type="email" class="regular-text" name="alify_form_recipient" value="<?php echo esc_attr( $recipient ); ?>" placeholder="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>">
			<span class="description"><?php esc_html_e( 'Leave blank to use the site-wide form notification address, then the WordPress admin email.', 'alify' ); ?></span>
		</label>
		<label><?php esc_html_e( 'Success message', 'alify' ); ?>
			<textarea class="large-text" name="alify_form_success_message" rows="3"><?php echo esc_textarea( $message ); ?></textarea>
		</label>
	</div>
	<?php
}

function alify_render_form_shortcode_meta_box( $post ) {
	printf( '<p>%s</p><code>[alify_form id="%d"]</code><p class="description">%s</p>', esc_html__( 'Copy this shortcode into any page or post:', 'alify' ), absint( $post->ID ), esc_html__( 'Publish the form first. Its fields inherit the site-wide styling and work at mobile widths.', 'alify' ) );
}

function alify_save_form_definition( $post_id ) {
	if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( ! isset( $_POST['alify_form_definition_nonce'] ) || ! is_scalar( $_POST['alify_form_definition_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['alify_form_definition_nonce'] ) ), 'alify_save_form_definition' ) ) {
		return;
	}
	$raw_fields = isset( $_POST['alify_form_fields'] ) && is_array( $_POST['alify_form_fields'] ) ? wp_unslash( $_POST['alify_form_fields'] ) : array();
	$clean      = array();
	$seen       = array();
	$types      = alify_form_builder_field_types();
	foreach ( array_slice( $raw_fields, 0, 40 ) as $field ) {
		if ( ! is_array( $field ) ) {
			continue;
		}
		$name  = isset( $field['field_name'] ) && is_scalar( $field['field_name'] ) ? sanitize_key( $field['field_name'] ) : '';
		$label = isset( $field['label'] ) && is_scalar( $field['label'] ) ? sanitize_text_field( $field['label'] ) : '';
		$type  = isset( $field['field_type'] ) && is_scalar( $field['field_type'] ) ? sanitize_key( $field['field_type'] ) : 'text';
		if ( ! $name || ! $label || ! isset( $types[ $type ] ) || isset( $seen[ $name ] ) || in_array( $name, array( 'action', 'form_id', 'form_source', 'alify_nonce', '_alify_return_to', 'alify_company_website', 'privacyconsent', '_wpnonce', '_wp_http_referer' ), true ) ) {
			continue;
		}
		$options = isset( $field['options'] ) && is_scalar( $field['options'] ) ? sanitize_textarea_field( $field['options'] ) : '';
		if ( in_array( $type, array( 'select', 'radio', 'checkbox' ), true ) && empty( alify_parse_form_options( $options ) ) ) {
			continue;
		}
		$seen[ $name ] = true;
		$clean[]       = array(
			'label'      => $label,
			'field_name' => $name,
			'field_type' => $type,
			'required'   => isset( $field['required'] ) && '1' === (string) $field['required'],
			'options'    => $options,
		);
	}
	update_post_meta( $post_id, 'form_fields', $clean );
}
add_action( 'save_post_alify_form', 'alify_save_form_definition' );
add_action( 'save_post_alify_form_template', 'alify_save_form_definition' );

function alify_save_form_options( $post_id ) {
	if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( ! isset( $_POST['alify_form_options_nonce'] ) || ! is_scalar( $_POST['alify_form_options_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['alify_form_options_nonce'] ) ), 'alify_save_form_options' ) ) {
		return;
	}
	$template = isset( $_POST['alify_form_template'] ) && is_scalar( $_POST['alify_form_template'] ) ? absint( wp_unslash( $_POST['alify_form_template'] ) ) : 0;
	if ( $template && 'alify_form_template' === get_post_type( $template ) ) {
		update_post_meta( $post_id, 'form_template', $template );
	} else {
		delete_post_meta( $post_id, 'form_template' );
	}
	$recipient = isset( $_POST['alify_form_recipient'] ) && is_scalar( $_POST['alify_form_recipient'] ) ? sanitize_email( wp_unslash( $_POST['alify_form_recipient'] ) ) : '';
	if ( $recipient && is_email( $recipient ) ) {
		update_post_meta( $post_id, 'notification_recipient', $recipient );
	} else {
		delete_post_meta( $post_id, 'notification_recipient' );
	}
	$message = isset( $_POST['alify_form_success_message'] ) && is_scalar( $_POST['alify_form_success_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['alify_form_success_message'] ) ) : '';
	if ( $message ) {
		update_post_meta( $post_id, 'success_message', $message );
	} else {
		delete_post_meta( $post_id, 'success_message' );
	}
}
add_action( 'save_post_alify_form', 'alify_save_form_options' );

/** Add native shared form defaults when ACF Pro options pages are unavailable. */
function alify_register_native_forms_settings_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		return;
	}
	add_submenu_page(
		'edit.php?post_type=alify_form',
		__( 'Forms Settings', 'alify' ),
		__( 'Forms Settings', 'alify' ),
		'manage_options',
		'alify-forms-settings',
		'alify_render_native_forms_settings_page'
	);
}
add_action( 'admin_menu', 'alify_register_native_forms_settings_page', 20 );

function alify_get_native_forms_settings() {
	$settings = get_option( 'alify_forms_settings', array() );
	return is_array( $settings ) ? $settings : array();
}

function alify_get_forms_setting( $key ) {
	$native_keys = array(
		'forms_notification_email' => 'notification_email',
		'forms_success_message'    => 'success_message',
		'forms_privacy_page'       => 'privacy_page_id',
	);
	$native_key = isset( $native_keys[ $key ] ) ? $native_keys[ $key ] : $key;
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $key, 'option' );
		if ( 'forms_privacy_page' === $key ) {
			if ( absint( $value ) ) {
				return absint( $value );
			}
		} elseif ( null !== $value && false !== $value && '' !== $value ) {
			return $value;
		}
	}
	$settings = alify_get_native_forms_settings();
	$value    = isset( $settings[ $native_key ] ) ? $settings[ $native_key ] : '';
	if ( 'forms_privacy_page' === $key && ! absint( $value ) ) {
		return absint( get_option( 'wp_page_for_privacy_policy' ) );
	}
	return $value;
}

function alify_render_native_forms_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$settings = alify_get_native_forms_settings();
	$updated  = isset( $_GET['updated'] ) && '1' === sanitize_text_field( wp_unslash( $_GET['updated'] ) );
	$pages    = get_pages( array( 'post_status' => 'publish', 'sort_column' => 'post_title', 'sort_order' => 'ASC' ) );
	?>
	<div class="wrap alify-forms-settings">
		<h1><?php esc_html_e( 'Forms Settings', 'alify' ); ?></h1>
		<p><?php esc_html_e( 'Set the defaults used by Alify forms. Individual forms can override the recipient and success message.', 'alify' ); ?></p>
		<?php if ( $updated ) : ?><div class="notice notice-success is-dismissible"><p><?php esc_html_e( 'Form settings saved.', 'alify' ); ?></p></div><?php endif; ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="alify_save_forms_settings">
			<?php wp_nonce_field( 'alify_save_forms_settings', 'alify_forms_settings_nonce' ); ?>
			<table class="form-table" role="presentation"><tbody>
				<tr><th scope="row"><label for="alify-forms-recipient"><?php esc_html_e( 'Notification recipient', 'alify' ); ?></label></th><td><input id="alify-forms-recipient" class="regular-text" type="email" name="alify_forms_settings[notification_email]" value="<?php echo esc_attr( $settings['notification_email'] ?? '' ); ?>" placeholder="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>"><p class="description"><?php esc_html_e( 'Leave blank to send form notifications to the WordPress admin email.', 'alify' ); ?></p></td></tr>
				<tr><th scope="row"><label for="alify-forms-success"><?php esc_html_e( 'Default success message', 'alify' ); ?></label></th><td><textarea id="alify-forms-success" class="large-text" rows="3" name="alify_forms_settings[success_message]"><?php echo esc_textarea( $settings['success_message'] ?? '' ); ?></textarea></td></tr>
				<tr><th scope="row"><label for="alify-forms-privacy"><?php esc_html_e( 'Privacy Policy page', 'alify' ); ?></label></th><td><select id="alify-forms-privacy" name="alify_forms_settings[privacy_page_id]"><option value="0"><?php esc_html_e( 'Use the site Privacy Policy setting', 'alify' ); ?></option><?php foreach ( $pages as $page ) : ?><option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( absint( $settings['privacy_page_id'] ?? 0 ), $page->ID ); ?>><?php echo esc_html( $page->post_title ); ?></option><?php endforeach; ?></select></td></tr>
			</tbody></table>
			<?php submit_button( __( 'Save form settings', 'alify' ) ); ?>
		</form>
	</div>
	<?php
}

function alify_save_native_forms_settings() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You are not allowed to change form settings.', 'alify' ), '', array( 'response' => 403 ) );
	}
	$nonce = isset( $_POST['alify_forms_settings_nonce'] ) && is_scalar( $_POST['alify_forms_settings_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['alify_forms_settings_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'alify_save_forms_settings' ) ) {
		wp_die( esc_html__( 'This settings form has expired. Please reload and try again.', 'alify' ), '', array( 'response' => 403 ) );
	}
	$raw       = isset( $_POST['alify_forms_settings'] ) && is_array( $_POST['alify_forms_settings'] ) ? wp_unslash( $_POST['alify_forms_settings'] ) : array();
	$recipient = isset( $raw['notification_email'] ) && is_scalar( $raw['notification_email'] ) ? sanitize_email( $raw['notification_email'] ) : '';
	$message   = isset( $raw['success_message'] ) && is_scalar( $raw['success_message'] ) ? sanitize_textarea_field( $raw['success_message'] ) : '';
	$page_id   = isset( $raw['privacy_page_id'] ) && is_scalar( $raw['privacy_page_id'] ) ? absint( $raw['privacy_page_id'] ) : 0;
	if ( $recipient && ! is_email( $recipient ) ) {
		$recipient = '';
	}
	if ( $page_id && ( 'page' !== get_post_type( $page_id ) || 'publish' !== get_post_status( $page_id ) ) ) {
		$page_id = 0;
	}
	update_option(
		'alify_forms_settings',
		array(
			'notification_email' => $recipient,
			'success_message'    => $message,
			'privacy_page_id'    => $page_id,
		),
		false
	);
	wp_safe_redirect( add_query_arg( 'updated', '1', menu_page_url( 'alify-forms-settings', false ) ) );
	exit;
}
add_action( 'admin_post_alify_save_forms_settings', 'alify_save_native_forms_settings' );

function alify_enqueue_form_admin_assets( $hook_suffix ) {
	$screen = get_current_screen();
	$is_forms_settings = false !== strpos( $hook_suffix, 'alify-forms-settings' );
	if ( ! $is_forms_settings && ( ! $screen || ! in_array( $screen->post_type, array( 'alify_form', 'alify_form_template' ), true ) ) ) {
		return;
	}
	$css = ALIFY_THEME_DIR . '/theme-assets/css/forms-admin.css';
	$js  = ALIFY_THEME_DIR . '/theme-assets/js/forms-admin.js';
	wp_enqueue_style( 'alify-forms-admin', ALIFY_THEME_URI . '/theme-assets/css/forms-admin.css', array(), file_exists( $css ) ? (string) filemtime( $css ) : ALIFY_THEME_VERSION );
	if ( ! $is_forms_settings ) {
		wp_enqueue_script( 'alify-forms-admin', ALIFY_THEME_URI . '/theme-assets/js/forms-admin.js', array(), file_exists( $js ) ? (string) filemtime( $js ) : ALIFY_THEME_VERSION, true );
	}
}
add_action( 'admin_enqueue_scripts', 'alify_enqueue_form_admin_assets' );
