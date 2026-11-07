<?php
/** Frontend form rendering, secure submissions, notifications, and entry admin UI. */

defined( 'ABSPATH' ) || exit;

/** Keep the entry list useful for admins and editors. */
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
			echo esc_html( get_post_meta( $post_id, '_alify_form_source', true ) ?: __( 'Website inquiry', 'alify' ) );
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
	$data    = get_post_meta( $post->ID, '_alify_form_data', true );
	$form_id = absint( get_post_meta( $post->ID, '_alify_form_id', true ) );
	if ( $form_id && get_post( $form_id ) ) {
		echo '<p><strong>' . esc_html__( 'Source form:', 'alify' ) . '</strong> ' . esc_html( get_the_title( $form_id ) ) . '</p>';
	}
	$mail_status = get_post_meta( $post->ID, '_alify_email_status', true );
	if ( $mail_status ) {
		$status_label = 'sent' === $mail_status ? __( 'Notification email sent', 'alify' ) : __( 'Notification email failed — check SMTP/mail configuration', 'alify' );
		echo '<p><strong>' . esc_html__( 'Email status:', 'alify' ) . '</strong> ' . esc_html( $status_label ) . '</p>';
	}
	if ( ! is_array( $data ) || empty( $data ) ) {
		echo '<p>' . esc_html__( 'No submitted field data is stored on this entry.', 'alify' ) . '</p>';
		return;
	}
	echo '<dl class="alify-entry-data">';
	foreach ( $data as $label => $value ) {
		if ( is_array( $value ) ) {
			$value = implode( ', ', array_map( 'sanitize_text_field', $value ) );
		}
		echo '<dt><strong>' . esc_html( $label ) . '</strong></dt><dd>' . esc_html( (string) $value ) . '</dd>';
	}
	echo '</dl>';
}

/** Private form entries must never appear in public REST responses. */
function alify_private_form_entry_rest( $args, $post_type ) {
	if ( 'alify_form_entry' === $post_type ) {
		$args['show_in_rest'] = false;
	}
	return $args;
}
add_filter( 'register_post_type_args', 'alify_private_form_entry_rest', 10, 2 );

/** Field definitions on a form take priority; otherwise use its chosen template. */
function alify_get_form_option( $form_id, $field_name ) {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}
	$value = get_field( $field_name, $form_id );
	if ( $value ) {
		return $value;
	}
	$template_id = absint( get_field( 'form_template', $form_id ) );
	return $template_id ? get_field( $field_name, $template_id ) : '';
}

function alify_get_form_fields( $form_id ) {
	if ( ! function_exists( 'get_field' ) ) {
		return array();
	}
	$fields = get_field( 'form_fields', $form_id );
	if ( is_array( $fields ) && ! empty( $fields ) ) {
		return $fields;
	}
	$template_id = absint( get_field( 'form_template', $form_id ) );
	if ( $template_id && 'alify_form_template' === get_post_type( $template_id ) ) {
		$fields = get_field( 'form_fields', $template_id );
	}
	return is_array( $fields ) ? $fields : array();
}

/** Parse newline choices; each line may be a label, or Label|stored-value. */
function alify_parse_form_options( $raw_options ) {
	$options = array();
	$lines   = preg_split( '/\r\n|\r|\n/', (string) $raw_options );
	foreach ( $lines as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		$label = sanitize_text_field( $parts[0] );
		$value = isset( $parts[1] ) ? sanitize_text_field( $parts[1] ) : $label;
		if ( '' !== $label && '' !== $value ) {
			$options[ $value ] = $label;
		}
	}
	return $options;
}

/** Normalize administrator-defined fields and reject reserved/duplicate input names. */
function alify_normalize_form_fields( $fields ) {
	$allowed_types = array( 'text', 'email', 'tel', 'url', 'textarea', 'select', 'checkbox', 'radio' );
	$reserved      = array( 'action', 'form_id', 'form_source', 'alify_nonce', '_alify_return_to', 'alify_company_website', 'privacyconsent', '_wpnonce', '_wp_http_referer' );
	$used_names    = array();
	$label_counts  = array();
	$normalized    = array();
	if ( ! is_array( $fields ) ) {
		return $normalized;
	}
	foreach ( $fields as $field ) {
		if ( ! is_array( $field ) || ! isset( $field['field_name'], $field['label'] ) || ! is_scalar( $field['field_name'] ) || ! is_scalar( $field['label'] ) ) {
			continue;
		}
		$name  = sanitize_key( $field['field_name'] );
		$type  = isset( $field['field_type'] ) && is_scalar( $field['field_type'] ) ? sanitize_key( $field['field_type'] ) : 'text';
		$label = sanitize_text_field( $field['label'] );
		if ( '' === $name || '' === $label || in_array( $name, $reserved, true ) || isset( $used_names[ $name ] ) || ! in_array( $type, $allowed_types, true ) ) {
			continue;
		}
		$options = alify_parse_form_options( isset( $field['options'] ) && is_scalar( $field['options'] ) ? $field['options'] : '' );
		if ( in_array( $type, array( 'select', 'checkbox', 'radio' ), true ) && empty( $options ) ) {
			continue;
		}
		$used_names[ $name ] = true;
		$label_counts[ $label ] = isset( $label_counts[ $label ] ) ? $label_counts[ $label ] + 1 : 1;
		if ( $label_counts[ $label ] > 1 ) {
			$label .= ' (' . $label_counts[ $label ] . ')';
		}
		$normalized[] = array(
			'field_name' => $name,
			'field_type' => $type,
			'label'      => $label,
			'required'   => ! empty( $field['required'] ),
			'options'    => $options,
		);
	}
	return $normalized;
}

/** Print a reusable ACF-configured form. Usage: [alify_form id="123"]. */
function alify_form_shortcode( $attributes ) {
	$attributes = shortcode_atts( array( 'id' => 0, 'submit_label' => __( 'Send message', 'alify' ) ), $attributes, 'alify_form' );
	$form_id    = absint( $attributes['id'] );
	$form       = get_post( $form_id );
	if ( ! $form || 'alify_form' !== $form->post_type || 'publish' !== $form->post_status ) {
		return current_user_can( 'edit_posts' ) ? '<p class="alify-form-error">' . esc_html__( 'Choose a published Alify Form to display.', 'alify' ) . '</p>' : '';
	}
	$raw_fields = alify_get_form_fields( $form_id );
	$fields     = alify_normalize_form_fields( $raw_fields );
	if ( empty( $fields ) ) {
		return current_user_can( 'edit_posts' ) ? '<p class="alify-form-error">' . esc_html__( 'Add fields to this form or choose a Form Template.', 'alify' ) . '</p>' : '';
	}

	ob_start();
	$form_instance = function_exists( 'wp_unique_id' ) ? wp_unique_id( 'alify-form-' . $form_id . '-' ) : 'alify-form-' . $form_id . '-' . wp_rand( 1000, 999999 );
	if ( current_user_can( 'edit_posts' ) && is_array( $raw_fields ) && count( $fields ) < count( $raw_fields ) ) {
		echo '<p class="alify-form-error">' . esc_html__( 'Some configured fields were skipped because their names are reserved, duplicated, or incomplete. Review the field definitions in ACF.', 'alify' ) . '</p>';
	}
	$status_key = 'form-' . $form_id;
	if ( isset( $_GET['form_status'], $_GET['form_key'] ) && $status_key === sanitize_key( wp_unslash( $_GET['form_key'] ) ) ) {
		$status  = sanitize_key( wp_unslash( $_GET['form_status'] ) );
		$message = 'success' === $status ? alify_get_form_option( $form_id, 'success_message' ) : '';
		if ( ! $message && 'success' === $status && function_exists( 'get_field' ) ) {
			$message = get_field( 'forms_success_message', 'option' );
		}
		if ( ! $message ) {
			$message = 'success' === $status ? __( 'Thanks, your message has been received.', 'alify' ) : __( 'There was a problem submitting your message. Please check the form and try again.', 'alify' );
		}
		echo '<p class="alify-form-notice alify-form-notice--' . esc_attr( $status ) . '" role="status">' . esc_html( $message ) . '</p>';
	}
	?>
	<form class="form-grid alify-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="alify_submit_form">
		<input type="hidden" name="form_id" value="<?php echo esc_attr( $form_id ); ?>">
		<input type="hidden" name="alify_nonce" value="<?php echo esc_attr( wp_create_nonce( 'alify_public_form' ) ); ?>">
		<input type="hidden" name="_alify_return_to" value="<?php echo esc_url( get_permalink() ); ?>">
		<?php foreach ( $fields as $field ) :
			$name     = $field['field_name'];
			$label    = $field['label'];
			$type     = $field['field_type'];
			$required = $field['required'];
			$options  = $field['options'];
			$id       = $form_instance . $name;
			?>
			<div class="form-field">
				<?php if ( in_array( $type, array( 'checkbox', 'radio' ), true ) ) : ?>
					<fieldset class="alify-form-options" <?php echo $required && 'checkbox' === $type ? 'data-alify-required-group aria-required="true"' : ''; ?>><legend><?php echo esc_html( $label ); ?><?php echo $required ? ' <span aria-hidden="true">*</span>' : ''; ?></legend><?php $option_index = 0; foreach ( $options as $value => $option_label ) : $option_id = $id . '-option-' . $option_index; ++$option_index; ?><label for="<?php echo esc_attr( $option_id ); ?>"><input id="<?php echo esc_attr( $option_id ); ?>" type="<?php echo esc_attr( $type ); ?>" name="<?php echo esc_attr( $name . ( 'checkbox' === $type ? '[]' : '' ) ); ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo $required && 'radio' === $type ? 'required' : ''; ?>> <?php echo esc_html( $option_label ); ?></label><?php endforeach; ?></fieldset>
				<?php else : ?>
					<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?><?php echo $required ? ' <span aria-hidden="true">*</span>' : ''; ?></label>
					<?php if ( 'textarea' === $type ) : ?>
						<textarea id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo $required ? 'required' : ''; ?>></textarea>
					<?php elseif ( 'select' === $type ) : ?>
						<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo $required ? 'required' : ''; ?>><option value=""><?php esc_html_e( 'Please select', 'alify' ); ?></option><?php foreach ( $options as $value => $option_label ) : ?><option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $option_label ); ?></option><?php endforeach; ?></select>
					<?php else : ?>
						<input id="<?php echo esc_attr( $id ); ?>" type="<?php echo esc_attr( $type ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo $required ? 'required' : ''; ?>>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
		<?php $privacy_page = function_exists( 'get_field' ) ? absint( get_field( 'forms_privacy_page', 'option' ) ) : 0; ?>
		<div class="form-field alify-form-consent"><label><input type="checkbox" name="privacyConsent" value="Accepted" required> <?php esc_html_e( 'I agree to the use of my information to respond to this inquiry.', 'alify' ); ?><?php if ( $privacy_page ) : ?> <a href="<?php echo esc_url( get_permalink( $privacy_page ) ); ?>"><?php esc_html_e( 'Read our Privacy Policy.', 'alify' ); ?></a><?php endif; ?></label></div>
		<div class="alify-honeypot" aria-hidden="true"><label for="alify-company-website-<?php echo esc_attr( $form_instance ); ?>"><?php esc_html_e( 'Leave this field empty', 'alify' ); ?><input id="alify-company-website-<?php echo esc_attr( $form_instance ); ?>" name="alify_company_website" type="text" tabindex="-1" autocomplete="off"></label></div>
		<button class="button button--primary" type="submit"><?php echo esc_html( $attributes['submit_label'] ); ?> <i class="fa-solid fa-arrow-right icon-arrow-up-right" aria-hidden="true"></i></button>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'alify_form', 'alify_form_shortcode' );

/** Add nonce, source key, redirect, consent, and honeypot to supplied inquiry designs. */
function alify_prepare_source_inquiry( $markup, $source ) {
	$source = in_array( $source, array( 'index', 'contact', 'start-project' ), true ) ? $source : '';
	if ( ! $source ) {
		return $markup;
	}
	$source_key = 'index' === $source ? 'homepage' : $source;
	$action     = esc_url( admin_url( 'admin-post.php' ) );
	$return_to  = 'index' === $source ? home_url( '/' ) : get_permalink();
	$honeypot_id = 'alify-company-website-' . sanitize_html_class( $source_key );
	$hidden      = '<input type="hidden" name="action" value="alify_submit_inquiry">'
		. '<input type="hidden" name="form_source" value="' . esc_attr( $source_key ) . '">'
		. '<input type="hidden" name="alify_nonce" value="' . esc_attr( wp_create_nonce( 'alify_public_form' ) ) . '">'
		. '<input type="hidden" name="_alify_return_to" value="' . esc_url( $return_to ) . '">'
		. '<div class="alify-honeypot" aria-hidden="true"><label for="' . esc_attr( $honeypot_id ) . '">' . esc_html__( 'Leave this field empty', 'alify' ) . '<input id="' . esc_attr( $honeypot_id ) . '" name="alify_company_website" type="text" tabindex="-1" autocomplete="off"></label></div>';

	if ( isset( $_GET['form_status'], $_GET['form_key'] ) && $source_key === sanitize_key( wp_unslash( $_GET['form_key'] ) ) ) {
		$status  = sanitize_key( wp_unslash( $_GET['form_status'] ) );
		$message = 'success' === $status && function_exists( 'get_field' ) ? get_field( 'forms_success_message', 'option' ) : '';
		if ( ! $message ) {
			$message = 'success' === $status ? __( 'Thanks, your inquiry has been received by the site.', 'alify' ) : __( 'There was a problem submitting your inquiry. Please check the form and try again.', 'alify' );
		}
		$hidden = '<p class="alify-form-notice alify-form-notice--' . esc_attr( $status ) . '" role="status">' . esc_html( $message ) . '</p>' . $hidden;
	}

	// The homepage source form predates the privacy field used on the dedicated forms.
	if ( 'index' === $source && ! preg_match( '~\bname=("|\x27)privacyConsent\1~i', $markup ) ) {
		$privacy_page = function_exists( 'get_field' ) ? absint( get_field( 'forms_privacy_page', 'option' ) ) : 0;
		$privacy_url  = $privacy_page ? get_permalink( $privacy_page ) : alify_source_url( 'privacy-policy' );
		$consent      = '<div class="form-consent form-field--full"><label><input type="checkbox" name="privacyConsent" value="Accepted" required><span>'
			. esc_html__( 'I agree that these details may be used to respond to my inquiry.', 'alify' ) . ' <a href="' . esc_url( $privacy_url ) . '">' . esc_html__( 'Read our Privacy Policy.', 'alify' ) . '</a></span></label></div>';
		$markup = preg_replace_callback(
			'~</form>~i',
			function ( $matches ) use ( $consent ) {
				return $consent . $matches[0];
			},
			$markup,
			1
		);
		// This mailto-only result panel is superseded by the server response notice.
		$markup = preg_replace( '~<div\s+class="inquiry-form__result"[^>]*data-inquiry-result[^>]*>.*?</div>~is', '', $markup, 1 );
	}

	$markup = str_replace(
		array(
			'Prepare project email',
			'Prepare email',
			'Prepare my inquiry',
			'This opens your email app with the inquiry pre-filled. Attach any private brief files there.',
			'Submitting opens your email app with these details pre-filled.',
			'No data is sent or stored until you continue in your email app.',
			'Nothing has been sent yet. Continue to open your email app with these details pre-filled.',
			'Continue to email',
			'Your brief is ready. ',
			'Continue in your email app',
			' to send it to ALIFY.',
			'Prepare your brief below, then send it directly through your email app.',
		),
		array(
			'Send project brief',
			'Send inquiry',
			'Send inquiry',
			'Your inquiry will be saved as a private Form Entry for the site team.',
			'Your inquiry will be saved as a private Form Entry for the site team.',
			'Your inquiry will be saved as a private Form Entry for the site team.',
			'Review the details below, then continue to submit your inquiry to the website.',
			'Send inquiry',
			'Your inquiry has been submitted. ',
			'Continue',
			'.',
			'Share a few details and the team can review your inquiry.',
		),
		$markup
	);

	return preg_replace_callback(
		'~<form\b([^>]*\bdata-inquiry-form[^>]*)>(.*?)</form>~is',
		function ( $matches ) use ( $action, $hidden ) {
			$attributes = preg_replace( '~\s+(?:action|method|data-server-submit)\s*=\s*(?:"[^"]*"|\x27[^\x27]*\x27|[^\s>]+)~i', '', $matches[1] );
			return '<form' . $attributes . ' action="' . $action . '" method="post" data-server-submit="true">' . $hidden . $matches[2] . '</form>';
		},
		$markup,
		1
	);
}

/** Count user-facing text consistently when the optional mbstring extension is unavailable. */
function alify_form_text_length( $value ) {
	$value = (string) $value;
	return function_exists( 'mb_strlen' ) ? mb_strlen( $value, 'UTF-8' ) : strlen( $value );
}

/** Validate field data from a configured reusable form. */
function alify_validate_configured_form( $form_id, $raw_data ) {
	$definitions = alify_normalize_form_fields( alify_get_form_fields( $form_id ) );
	if ( empty( $definitions ) ) {
		return new WP_Error( 'missing_fields', __( 'This form is not configured.', 'alify' ) );
	}
	$clean             = array();
	$total_text_length = 0;
	foreach ( $definitions as $field ) {
		$name = sanitize_key( $field['field_name'] ?? '' );
		if ( '' === $name ) {
			continue;
		}
		$type     = sanitize_key( $field['field_type'] ?? 'text' );
		$label    = sanitize_text_field( $field['label'] ?? $name );
		$required = ! empty( $field['required'] );
		$value    = isset( $raw_data[ $name ] ) ? $raw_data[ $name ] : '';
		$options  = $field['options'];
		if ( is_array( $value ) ) {
			if ( 'checkbox' !== $type ) {
				return new WP_Error( 'invalid_value', sprintf( __( 'Invalid value for %s.', 'alify' ), $label ) );
			}
			$value = wp_unslash( $value );
			foreach ( $value as $selected_value ) {
				if ( ! is_scalar( $selected_value ) ) {
					return new WP_Error( 'invalid_value', sprintf( __( 'Invalid value for %s.', 'alify' ), $label ) );
				}
			}
			$value = array_map( 'sanitize_text_field', $value );
		} else {
			if ( ! is_scalar( $value ) ) {
				return new WP_Error( 'invalid_value', sprintf( __( 'Invalid value for %s.', 'alify' ), $label ) );
			}
			$value = trim( (string) wp_unslash( $value ) );
			if ( 'textarea' === $type ) {
				$value = sanitize_textarea_field( $value );
			} elseif ( 'email' === $type ) {
				if ( '' !== $value && ! is_email( $value ) ) {
					return new WP_Error( 'invalid_email', sprintf( __( 'Please enter a valid %s.', 'alify' ), $label ) );
				}
				$value = sanitize_email( $value );
			} elseif ( 'url' === $type ) {
				$value = esc_url_raw( $value );
			} else {
				$value = sanitize_text_field( $value );
			}
		}
		$field_text_length = 0;
		if ( is_array( $value ) ) {
			if ( count( $value ) > 50 ) {
				return new WP_Error( 'too_many_choices', sprintf( __( 'Too many choices were submitted for %s.', 'alify' ), $label ) );
			}
			foreach ( $value as $selected_value ) {
				$field_text_length += alify_form_text_length( $selected_value );
			}
		} else {
			$field_text_length = alify_form_text_length( $value );
		}
		$total_text_length += $field_text_length;
		if ( $field_text_length > 5000 || $total_text_length > 20000 ) {
			return new WP_Error( 'too_long', __( 'Some submitted values are too long. Please shorten them and try again.', 'alify' ) );
		}
		if ( $required && ( '' === $value || array() === $value ) ) {
			return new WP_Error( 'required', sprintf( __( 'Please complete the %s field.', 'alify' ), $label ) );
		}
		if ( 'email' === $type && '' !== $value && ! is_email( $value ) ) {
			return new WP_Error( 'invalid_email', sprintf( __( 'Please enter a valid %s.', 'alify' ), $label ) );
		}
		if ( 'url' === $type && '' !== $value && ! wp_http_validate_url( $value ) ) {
			return new WP_Error( 'invalid_url', sprintf( __( 'Please enter a valid %s.', 'alify' ), $label ) );
		}
		if ( in_array( $type, array( 'select', 'radio', 'checkbox' ), true ) ) {
			$values = is_array( $value ) ? $value : ( '' === $value ? array() : array( $value ) );
			foreach ( $values as $selected ) {
				if ( ! isset( $options[ $selected ] ) ) {
					return new WP_Error( 'invalid_choice', sprintf( __( 'Please choose a valid option for %s.', 'alify' ), $label ) );
				}
			}
		}
		if ( 'checkbox' === $type && is_array( $value ) ) {
			$clean[ $label ] = $value;
		} else {
			$clean[ $label ] = $value;
		}
	}
	$consent = isset( $raw_data['privacyConsent'] ) && is_scalar( $raw_data['privacyConsent'] ) ? sanitize_text_field( wp_unslash( $raw_data['privacyConsent'] ) ) : '';
	if ( 'Accepted' !== $consent ) {
		return new WP_Error( 'privacy', __( 'Please accept the privacy notice before submitting.', 'alify' ) );
	}
	$consent_label = __( 'Privacy consent', 'alify' );
	while ( isset( $clean[ $consent_label ] ) ) {
		$consent_label .= ' (consent)';
	}
	$clean[ $consent_label ] = __( 'Accepted', 'alify' );
	return $clean;
}

/** Validate the fixed fields and enumerated choices from imported inquiry views. */
function alify_validate_source_inquiry( $source, $raw_data ) {
	$field_sets = array(
		'contact' => array( 'name' => 'Name', 'email' => 'Email', 'company' => 'Company', 'service' => 'Service', 'message' => 'Message' ),
		'start-project' => array( 'name' => 'Name', 'email' => 'Email', 'company' => 'Company', 'websiteOrBrief' => 'Website or brief', 'web' => 'Web Development', 'seo' => 'SEO', 'marketing' => 'Marketing', 'automation' => 'Automation', 'uiux' => 'UI UX', 'logo' => 'Logo Design', 'budget' => 'Budget', 'timeline' => 'Timeline', 'goals' => 'Goals', 'additionalContext' => 'Additional context' ),
		'homepage' => array( 'name' => 'Name', 'email' => 'Email', 'service' => 'Service', 'brief' => 'Project brief' ),
	);
	if ( ! isset( $field_sets[ $source ] ) || ! is_array( $raw_data ) ) {
		return new WP_Error( 'invalid_source', __( 'This form is not configured.', 'alify' ) );
	}
	$required = array(
		'contact' => array( 'name', 'email', 'service', 'message' ),
		'start-project' => array( 'name', 'email', 'company', 'budget', 'timeline', 'goals' ),
		'homepage' => array( 'name', 'email', 'service', 'brief' ),
	);
	$allowed_values = array(
		'service' => array( 'Web Development', 'SEO', 'Digital Marketing', 'AI Automation', 'UI UX Design', 'Logo Design', 'Not sure yet' ),
		'web' => array( 'Web Development' ),
		'seo' => array( 'SEO' ),
		'marketing' => array( 'Digital Marketing' ),
		'automation' => array( 'AI Automation' ),
		'uiux' => array( 'UI UX Design' ),
		'logo' => array( 'Logo Design' ),
		'budget' => array( 'Under $3,000', '$3,000–$7,500', '$7,500–$15,000', '$15,000+', 'Not defined yet' ),
		'timeline' => array( 'As soon as practical', 'Within 1–3 months', 'Within 3–6 months', 'Exploring for later' ),
	);
	$clean             = array();
	$total_text_length = 0;
	foreach ( $field_sets[ $source ] as $key => $label ) {
		if ( ! array_key_exists( $key, $raw_data ) ) {
			if ( in_array( $key, $required[ $source ], true ) ) {
				return new WP_Error( 'required', sprintf( __( 'Please complete the %s field.', 'alify' ), $label ) );
			}
			continue;
		}
		if ( ! is_scalar( $raw_data[ $key ] ) ) {
			return new WP_Error( 'invalid_value', __( 'Invalid form values were submitted.', 'alify' ) );
		}
		$raw_value = trim( (string) wp_unslash( $raw_data[ $key ] ) );
		if ( 'email' === $key && ! is_email( $raw_value ) ) {
			return new WP_Error( 'invalid_email', __( 'Please enter a valid email address.', 'alify' ) );
		}
		$value = 'email' === $key
			? sanitize_email( $raw_value )
			: ( in_array( $key, array( 'message', 'goals', 'additionalContext', 'brief' ), true ) ? sanitize_textarea_field( $raw_value ) : sanitize_text_field( $raw_value ) );
		$field_text_length = alify_form_text_length( $value );
		$total_text_length += $field_text_length;
		if ( $field_text_length > 5000 || $total_text_length > 20000 ) {
			return new WP_Error( 'too_long', __( 'Some submitted values are too long. Please shorten them and try again.', 'alify' ) );
		}
		if ( in_array( $key, $required[ $source ], true ) && '' === trim( $value ) ) {
			return new WP_Error( 'required', sprintf( __( 'Please complete the %s field.', 'alify' ), $label ) );
		}
		if ( isset( $allowed_values[ $key ] ) && '' !== $value && ! in_array( $value, $allowed_values[ $key ], true ) ) {
			return new WP_Error( 'invalid_value', sprintf( __( 'Choose a valid option for %s.', 'alify' ), $label ) );
		}
		if ( 'email' === $key && ! is_email( $value ) ) {
			return new WP_Error( 'invalid_email', __( 'Please enter a valid email address.', 'alify' ) );
		}
		if ( 'websiteOrBrief' === $key && '' !== $value && ! wp_http_validate_url( $value ) ) {
			return new WP_Error( 'invalid_url', __( 'Please enter a valid website URL.', 'alify' ) );
		}
		if ( 'brief' === $key ) {
			$length = function_exists( 'mb_strlen' ) ? mb_strlen( trim( $value ) ) : strlen( trim( $value ) );
			if ( $length < 10 ) {
				return new WP_Error( 'brief_too_short', __( 'Please add at least 10 characters to your project brief.', 'alify' ) );
			}
		}
		$clean[ $label ] = $value;
	}
	$consent = isset( $raw_data['privacyConsent'] ) && is_scalar( $raw_data['privacyConsent'] ) ? sanitize_text_field( wp_unslash( $raw_data['privacyConsent'] ) ) : '';
	if ( 'Accepted' !== $consent ) {
		return new WP_Error( 'privacy', __( 'Please accept the privacy notice before submitting.', 'alify' ) );
	}
	$consent_label = __( 'Privacy consent', 'alify' );
	while ( isset( $clean[ $consent_label ] ) ) {
		$consent_label .= ' (consent)';
	}
	$clean[ $consent_label ] = __( 'Accepted', 'alify' );
	return $clean;
}

/** Handle all public submissions without exposing entries to anonymous queries. */
function alify_handle_public_form_submission() {
	$request_method = isset( $_SERVER['REQUEST_METHOD'] ) && is_scalar( $_SERVER['REQUEST_METHOD'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) : '';
	if ( 'POST' !== strtoupper( $request_method ) ) {
		wp_die( esc_html__( 'Invalid form request.', 'alify' ), '', array( 'response' => 405 ) );
	}
	$nonce = isset( $_POST['alify_nonce'] ) && is_scalar( $_POST['alify_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['alify_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'alify_public_form' ) ) {
		wp_die( esc_html__( 'This form has expired. Please return to the site and try again.', 'alify' ), '', array( 'response' => 403 ) );
	}

	$action  = isset( $_POST['action'] ) && is_scalar( $_POST['action'] ) ? sanitize_key( wp_unslash( $_POST['action'] ) ) : '';
	$form_id = isset( $_POST['form_id'] ) && is_scalar( $_POST['form_id'] ) ? absint( wp_unslash( $_POST['form_id'] ) ) : 0;
	$source  = isset( $_POST['form_source'] ) && is_scalar( $_POST['form_source'] ) ? sanitize_key( wp_unslash( $_POST['form_source'] ) ) : '';
	$form_key = $form_id ? 'form-' . $form_id : $source;
	$return_to = isset( $_POST['_alify_return_to'] ) && is_scalar( $_POST['_alify_return_to'] ) ? esc_url_raw( wp_unslash( $_POST['_alify_return_to'] ) ) : '';
	$return_to = wp_validate_redirect( $return_to, home_url( '/' ) );
	if ( ! in_array( $action, array( 'alify_submit_form', 'alify_submit_inquiry' ), true ) || ( 'alify_submit_form' === $action && ( ! $form_id || $source ) ) || ( 'alify_submit_inquiry' === $action && ( $form_id || ! in_array( $source, array( 'contact', 'start-project', 'homepage' ), true ) ) ) ) {
		wp_die( esc_html__( 'Invalid form configuration.', 'alify' ), '', array( 'response' => 400 ) );
	}

	// Honeypot submissions are silently accepted but never stored or emailed.
	$honeypot = isset( $_POST['alify_company_website'] ) && is_scalar( $_POST['alify_company_website'] ) ? trim( (string) wp_unslash( $_POST['alify_company_website'] ) ) : ( isset( $_POST['alify_company_website'] ) ? 'invalid' : '' );
	if ( '' !== $honeypot ) {
		wp_safe_redirect( add_query_arg( array( 'form_status' => 'success', 'form_key' => $form_key ), $return_to ) );
		exit;
	}

	if ( $form_id ) {
		$form_post = get_post( $form_id );
		if ( ! $form_post || 'alify_form' !== $form_post->post_type || 'publish' !== $form_post->post_status ) {
			wp_die( esc_html__( 'This form is not available.', 'alify' ), '', array( 'response' => 404 ) );
		}
		$clean_data = alify_validate_configured_form( $form_id, $_POST );
	} else {
		$form_post = false;
		$clean_data = alify_validate_source_inquiry( $source, $_POST );
	}
	if ( is_wp_error( $clean_data ) ) {
		wp_safe_redirect( add_query_arg( array( 'form_status' => 'error', 'form_key' => $form_key ), $return_to ) );
		exit;
	}

	$ip       = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$rate_key = 'alify_form_rate_' . md5( wp_salt( 'auth' ) . $ip . $form_key );
	$count    = absint( get_transient( $rate_key ) );
	if ( $count >= 5 ) {
		wp_safe_redirect( add_query_arg( array( 'form_status' => 'error', 'form_key' => $form_key ), $return_to ) );
		exit;
	}
	set_transient( $rate_key, $count + 1, 15 * MINUTE_IN_SECONDS );

	$name = isset( $clean_data['Name'] ) && ! is_array( $clean_data['Name'] ) ? sanitize_text_field( $clean_data['Name'] ) : __( 'Website visitor', 'alify' );
	if ( $form_post ) {
		foreach ( alify_normalize_form_fields( alify_get_form_fields( $form_id ) ) as $configured_field ) {
			if ( 'name' === $configured_field['field_name'] && isset( $clean_data[ $configured_field['label'] ] ) && ! is_array( $clean_data[ $configured_field['label'] ] ) ) {
				$name = sanitize_text_field( $clean_data[ $configured_field['label'] ] );
				break;
			}
		}
	}
	$title = sprintf( __( '%1$s inquiry — %2$s — %3$s', 'alify' ), $form_post ? get_the_title( $form_post ) : ( 'contact' === $source ? __( 'Contact', 'alify' ) : __( 'Project', 'alify' ) ), $name, current_time( 'mysql' ) );
	$entry_id = wp_insert_post(
		array(
			'post_type'   => 'alify_form_entry',
			'post_status' => 'private',
			'post_title'  => sanitize_text_field( $title ),
		),
		true
	);
	if ( is_wp_error( $entry_id ) ) {
		wp_safe_redirect( add_query_arg( array( 'form_status' => 'error', 'form_key' => $form_key ), $return_to ) );
		exit;
	}
	update_post_meta( $entry_id, '_alify_form_id', $form_id );
	update_post_meta( $entry_id, '_alify_form_source', $form_post ? get_the_title( $form_post ) : $source );
	update_post_meta( $entry_id, '_alify_form_data', $clean_data );

	$recipient = $form_post ? alify_get_form_option( $form_id, 'notification_recipient' ) : '';
	if ( ! $recipient && function_exists( 'get_field' ) ) {
		$recipient = get_field( 'forms_notification_email', 'option' );
	}
	if ( ! $recipient && function_exists( 'get_field' ) ) {
		$recipient = get_field( 'contact_email', 'option' );
	}
	if ( ! $recipient || ! is_email( $recipient ) ) {
		$recipient = get_option( 'admin_email' );
	}
	$reply_email = isset( $clean_data['Email'] ) && ! is_array( $clean_data['Email'] ) ? sanitize_email( $clean_data['Email'] ) : '';
	if ( $form_post ) {
		foreach ( alify_normalize_form_fields( alify_get_form_fields( $form_id ) ) as $configured_field ) {
			if ( 'email' === $configured_field['field_name'] && isset( $clean_data[ $configured_field['label'] ] ) && ! is_array( $clean_data[ $configured_field['label'] ] ) ) {
				$reply_email = sanitize_email( $clean_data[ $configured_field['label'] ] );
				break;
			}
		}
	}
	$subject     = sprintf( __( 'New website inquiry: %s', 'alify' ), $name );
	$body        = array( __( 'A new website form was submitted.', 'alify' ), '' );
	foreach ( $clean_data as $label => $value ) {
		$body[] = sanitize_text_field( $label ) . ': ' . ( is_array( $value ) ? implode( ', ', array_map( 'sanitize_text_field', $value ) ) : sanitize_textarea_field( $value ) );
	}
	$headers   = $reply_email ? array( 'Reply-To: ' . $reply_email ) : array();
	$mail_sent = wp_mail( $recipient, $subject, implode( "\n", $body ), $headers );
	update_post_meta( $entry_id, '_alify_email_status', $mail_sent ? 'sent' : 'failed' );

	wp_safe_redirect( add_query_arg( array( 'form_status' => 'success', 'form_key' => $form_key ), $return_to ) );
	exit;
}
add_action( 'admin_post_nopriv_alify_submit_form', 'alify_handle_public_form_submission' );
add_action( 'admin_post_alify_submit_form', 'alify_handle_public_form_submission' );
add_action( 'admin_post_nopriv_alify_submit_inquiry', 'alify_handle_public_form_submission' );
add_action( 'admin_post_alify_submit_inquiry', 'alify_handle_public_form_submission' );
