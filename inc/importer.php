<?php
/** Idempotent setup utility to create the WordPress records needed by the views. */

defined( 'ABSPATH' ) || exit;

function alify_starter_content_manifest() {
	return array(
		'home'                       => array( 'page', 'Home' ),
		'about'                      => array( 'page', 'About Us' ),
		'contact'                    => array( 'page', 'Contact Us' ),
		'start-project'              => array( 'page', 'Start a Project' ),
		'privacy-policy'             => array( 'page', 'Privacy Policy' ),
		'terms-and-conditions'       => array( 'page', 'Terms & Conditions' ),
		'cookie-policy'              => array( 'page', 'Cookie Policy' ),
		'blog'                       => array( 'page', 'Blog' ),
		'ai-automation'              => array( 'service', 'AI Automation' ),
		'digital-marketing'          => array( 'service', 'Digital Marketing' ),
		'logo-design'                => array( 'service', 'Logo Design' ),
		'seo'                        => array( 'service', 'Search Engine Optimization' ),
		'ui-ux-design'               => array( 'service', 'UI UX Design' ),
		'web-development'            => array( 'service', 'Web Development' ),
		'ecommerce'                  => array( 'industry', 'Ecommerce' ),
		'healthcare'                 => array( 'industry', 'Healthcare' ),
		'industry-single'            => array( 'industry', 'Technology & SaaS' ),
		'real-estate'                => array( 'industry', 'Real Estate' ),
		'startups'                   => array( 'industry', 'Startups & Ventures' ),
		'case-study-single'          => array( 'case_study', 'Operational Automation Case Study' ),
		'commerce-project'           => array( 'work', 'Commerce Project' ),
		'identity-project'           => array( 'work', 'Identity Project' ),
		'project-single'              => array( 'work', 'Fintech Project' ),
		'property-project'           => array( 'work', 'Property Project' ),
		'wellness-project'           => array( 'work', 'Wellness Project' ),
		'blog-single'                => array( 'post', 'A Practical Guide to Better Digital Work' ),
		'campaign-next-decision'     => array( 'post', 'The Next Decision: A Campaign Framework' ),
		'identity-that-works'        => array( 'post', 'Identity That Works' ),
		'planning-scalable-website'  => array( 'post', 'Planning a Scalable Website' ),
		'technical-seo-experience'   => array( 'post', 'Technical SEO & Experience' ),
		'useful-automation'          => array( 'post', 'Useful Automation for Growing Teams' ),
	);
}

/** Resolve the static source file used by a starter record. */
function alify_get_source_page_file( $slug ) {
	$source_slug = 'home' === $slug ? 'index' : sanitize_file_name( $slug );
	return ALIFY_THEME_DIR . '/frontend-source/' . $source_slug . '.html';
}

/** Extract the unique hero and main body as editable WordPress post content. */
function alify_get_source_editable_content( $slug ) {
	$file = alify_get_source_page_file( $slug );
	if ( ! is_readable( $file ) ) {
		return '';
	}
	$markup = file_get_contents( $file );
	$parts  = array();
	if ( preg_match( '~<page-hero\b[^>]*>.*?</page-hero\s*>~is', $markup, $hero ) ) {
		$parts[] = trim( $hero[0] );
	}
	if ( preg_match( '~<main\b[^>]*>.*?</main\s*>~is', $markup, $main ) ) {
		$parts[] = trim( $main[0] );
	}
	return implode( "\n\n", $parts );
}

/** Return a plain-text archive summary from the source page metadata when available. */
function alify_get_source_excerpt( $slug ) {
	$file = alify_get_source_page_file( $slug );
	if ( ! is_readable( $file ) ) {
		return '';
	}
	$markup = file_get_contents( $file );
	if ( preg_match( '~<meta\s+name="description"\s+content="(.*?)"~i', $markup, $match ) ) {
		$description = html_entity_decode( $match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8' );
		$description = sanitize_text_field( $description );
		if ( $description ) {
			return wp_trim_words( $description, 32, '' );
		}
	}
	return '';
}

function alify_import_source_image( $post_id, $slug ) {
	if ( get_post_meta( $post_id, '_alify_source_image_checked', true ) ) {
		return;
	}
	$file = alify_get_source_page_file( $slug );
	if ( is_readable( $file ) ) {
		$markup = file_get_contents( $file );
		if ( preg_match( '~<img[^>]+src="(assets/images/[^"]+)"~i', $markup, $match ) ) {
			$relative = sanitize_text_field( $match[1] );
			$asset    = ALIFY_THEME_DIR . '/frontend-source/' . $relative;
			if ( is_file( $asset ) && ! get_post_meta( $post_id, '_alify_source_image', true ) ) {
				update_post_meta( $post_id, '_alify_source_image', $relative );
			}
		}
	}
	update_post_meta( $post_id, '_alify_source_image_checked', '1' );
}

function alify_import_starter_content() {
	$created = 0;
	$skipped = 0;
	$errors  = array();
	foreach ( alify_starter_content_manifest() as $slug => $details ) {
		list( $post_type, $title ) = $details;
		$excerpt = alify_get_source_excerpt( $slug );
		$existing = get_page_by_path( $slug, OBJECT, $post_type );
		if ( $existing ) {
			$id = $existing->ID;
			++$skipped;
		} else {
			$id = wp_insert_post(
				array(
					'post_type'   => $post_type,
					'post_status' => 'publish',
					'post_title'  => $title,
					'post_name'   => $slug,
					'post_content' => '',
					'post_excerpt' => $excerpt,
			),
				true
			);
			if ( is_wp_error( $id ) ) {
				$errors[] = sprintf( '%s: %s', $slug, $id->get_error_message() );
				continue;
			}
			++$created;
		}

		// Seed complete editable source markup once, without overwriting existing body content.
		if ( ! get_post_meta( $id, '_alify_source_content_checked', true ) ) {
			$source_content  = alify_get_source_editable_content( $slug );
			$content_checked = true;
			if ( $source_content && '' === trim( (string) get_post_field( 'post_content', $id ) ) ) {
				$content_update = wp_update_post( array( 'ID' => $id, 'post_content' => $source_content ), true );
				if ( is_wp_error( $content_update ) ) {
					$errors[]        = sprintf( '%s: %s', $slug, $content_update->get_error_message() );
					$content_checked = false;
				} else {
					update_post_meta( $id, '_alify_source_content_imported', '1' );
					update_post_meta( $id, '_alify_content_mode', 'source' );
				}
			}
			if ( $content_checked ) {
				update_post_meta( $id, '_alify_source_content_checked', '1' );
			}
		}

		// Fill an excerpt once; an editor can later remove it without reruns restoring it.
		if ( ! get_post_meta( $id, '_alify_source_excerpt_imported', true ) ) {
			$excerpt_imported = true;
			if ( $excerpt && ! get_post_field( 'post_excerpt', $id ) ) {
				$excerpt_update = wp_update_post( array( 'ID' => $id, 'post_excerpt' => $excerpt ), true );
				if ( is_wp_error( $excerpt_update ) ) {
					$errors[]         = sprintf( '%s: %s', $slug, $excerpt_update->get_error_message() );
					$excerpt_imported = false;
				}
			}
			if ( $excerpt_imported ) {
				update_post_meta( $id, '_alify_source_excerpt_imported', '1' );
			}
		}

		alify_import_source_image( $id, $slug );

		if ( 'home' === $slug && 'publish' === get_post_status( $id ) && ! absint( get_option( 'page_on_front' ) ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $id );
		}
		if ( 'blog' === $slug && 'publish' === get_post_status( $id ) && ! absint( get_option( 'page_for_posts' ) ) ) {
			update_option( 'page_for_posts', $id );
		}
	}
	return array( 'created' => $created, 'skipped' => $skipped, 'errors' => $errors );
}

function alify_content_setup_page() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$result = null;
	if ( isset( $_POST['alify_import_starter_content'] ) ) {
		check_admin_referer( 'alify_import_starter_content_action', 'alify_import_starter_content_nonce' );
		$result = alify_import_starter_content();
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Alify Theme Setup', 'alify' ); ?></h1>
		<p><?php esc_html_e( 'Create the starter Pages and published CPT/Blog records that connect the converted PHP designs and navigation. Existing matching slugs are preserved; this can safely be run more than once.', 'alify' ); ?></p>
		<?php if ( is_array( $result ) ) : ?>
			<div class="notice notice-success"><p><?php echo esc_html( sprintf( __( 'Setup complete: %1$d records created, %2$d already existed.', 'alify' ), $result['created'], $result['skipped'] ) ); ?></p></div>
			<?php if ( ! empty( $result['errors'] ) ) : ?><div class="notice notice-error"><p><?php echo esc_html( implode( ' | ', $result['errors'] ) ); ?></p></div><?php endif; ?>
		<?php endif; ?>
		<p><?php esc_html_e( 'This adds starter titles, slugs, editable source page markup, excerpts, and image references. Existing body content and editor-authored excerpts are preserved when rerun. New records display the original design by default; choose WordPress Content in the page presentation box to use the editable body.', 'alify' ); ?></p>
		<form method="post">
			<?php wp_nonce_field( 'alify_import_starter_content_action', 'alify_import_starter_content_nonce' ); ?>
			<?php submit_button( __( 'Create / Repair Starter Pages & Content', 'alify' ), 'primary', 'alify_import_starter_content' ); ?>
		</form>
	</div>
	<?php
}
add_action(
	'admin_menu',
	function () {
		add_theme_page( __( 'Alify Theme Setup', 'alify' ), __( 'Alify Setup', 'alify' ), 'edit_theme_options', 'alify-theme-setup', 'alify_content_setup_page' );
	}
);
