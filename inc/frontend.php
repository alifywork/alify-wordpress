<?php
/** Front-end integration for the imported Alify static design. */

defined( 'ABSPATH' ) || exit;

/** Directory that contains the original CSS, JavaScript, fonts, and media. */
function alify_source_assets_uri() {
	return trailingslashit( ALIFY_THEME_URI ) . 'frontend-source/assets';
}

/** Normalize social profile rows before passing them to browser-facing code. */
function alify_normalize_social_link( $row ) {
	if ( ! is_array( $row ) || ! isset( $row['label'], $row['url'] ) || ! is_scalar( $row['label'] ) || ! is_scalar( $row['url'] ) || '' === $row['label'] || '' === $row['url'] ) {
		return false;
	}
	$url    = esc_url_raw( $row['url'], array( 'http', 'https' ) );
	$scheme = wp_parse_url( $url, PHP_URL_SCHEME );
	if ( ! $url || ! in_array( strtolower( (string) $scheme ), array( 'http', 'https' ), true ) ) {
		return false;
	}
	return array(
		'label' => sanitize_text_field( $row['label'] ),
		'url'   => $url,
	);
}

/** Enqueue the locally bundled design system; no external asset CDN is used. */
function alify_enqueue_frontend_assets() {
	$base = alify_source_assets_uri();
	$css_files = array(
		'variables'     => 'css/variables.css',
		'fonts'         => 'css/fonts.css',
		'bootstrap-grid'=> 'bootstrap/css/bootstrap-grid.min.css',
		'fontawesome'   => 'icon/css/all.min.css',
		'base'          => 'css/style.css',
		'page-hero'     => 'css/page-hero.css',
		'pages'         => 'css/pages.css',
		'detail-pages'  => 'css/detail-pages.css',
		'blog'          => 'css/blog.css',
		'home'          => 'css/home.css',
		'header'        => 'css/header.css',
		'footer'        => 'css/footer.css',
		'utility'       => 'css/utility.css',
		'acf-content'   => 'theme-assets/css/acf-content.css',
	);

	foreach ( $css_files as $handle => $relative_path ) {
		$is_theme_style = 'acf-content' === $handle;
		$file           = $is_theme_style ? ALIFY_THEME_DIR . '/' . $relative_path : ALIFY_THEME_DIR . '/frontend-source/assets/' . $relative_path;
		$style_uri      = $is_theme_style ? ALIFY_THEME_URI . '/' . $relative_path : $base . '/' . $relative_path;
		wp_enqueue_style(
			'alify-' . $handle,
			$style_uri,
			array(),
			file_exists( $file ) ? (string) filemtime( $file ) : ALIFY_THEME_VERSION
		);
	}

	$js_files = array(
		'gsap'          => array( 'gsap/gsap.min.js', array() ),
		'scrolltrigger' => array( 'gsap/ScrollTrigger.min.js', array( 'alify-gsap' ) ),
		'wp-integration'=> array( 'theme-assets/js/wp-integration.js', array() ),
		'header'        => array( 'theme-assets/js/header-wordpress.js', array( 'alify-wp-integration' ) ),
		'footer'        => array( 'theme-assets/js/footer-wordpress.js', array( 'alify-wp-integration' ) ),
		'page-hero'     => array( 'theme-assets/js/page-hero-wordpress.js', array( 'alify-gsap', 'alify-scrolltrigger' ) ),
		'pages'         => array( 'theme-assets/js/pages-wordpress.js', array( 'alify-gsap', 'alify-scrolltrigger', 'alify-wp-integration' ) ),
		'main'          => array( 'js/main.js', array( 'alify-gsap', 'alify-scrolltrigger' ) ),
		'home'          => array( 'js/home.js', array( 'alify-gsap' ) ),
	);

	foreach ( $js_files as $handle => $details ) {
		$relative_path = $details[0];
		$is_theme_script = in_array( $handle, array( 'wp-integration', 'header', 'footer', 'page-hero', 'pages' ), true );
		$file           = $is_theme_script ? ALIFY_THEME_DIR . '/' . $relative_path : ALIFY_THEME_DIR . '/frontend-source/assets/' . $relative_path;
		$script_uri     = $is_theme_script ? ALIFY_THEME_URI . '/' . $relative_path : $base . '/' . $relative_path;
		wp_enqueue_script(
			'alify-' . $handle,
			$script_uri,
			$details[1],
			file_exists( $file ) ? (string) filemtime( $file ) : ALIFY_THEME_VERSION,
			array( 'in_footer' => true, 'strategy' => 'defer' )
		);
	}

	$logo = function_exists( 'get_field' ) ? get_field( 'site_logo', 'option' ) : false;
	if ( is_array( $logo ) && ! empty( $logo['url'] ) ) {
		$logo_url = $logo['url'];
	} elseif ( is_numeric( $logo ) ) {
		$logo_url = wp_get_attachment_image_url( absint( $logo ), 'full' );
	} else {
		$logo_url = '';
	}

	$primary_menu = wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'header__nav-list', 'depth' => 1, 'echo' => false, 'fallback_cb' => false ) );
	$footer_menu  = wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'footer__menu-list', 'depth' => 1, 'echo' => false, 'fallback_cb' => false ) );
	$social_links = function_exists( 'get_field' ) ? get_field( 'social_links', 'option' ) : array();
	$social_links = is_array( $social_links ) ? array_values( array_filter( array_map( 'alify_normalize_social_link', $social_links ) ) ) : array();

	wp_localize_script(
		'alify-wp-integration',
		'AlifyTheme',
		array(
			'homeUrl'          => home_url( '/' ),
			'assetsBase'       => $base,
			'routes'           => alify_build_source_routes(),
			'logoUrl'          => $logo_url,
			'headerCtaLabel'   => function_exists( 'get_field' ) ? (string) get_field( 'header_cta_label', 'option' ) : '',
			'headerCtaUrl'     => function_exists( 'get_field' ) ? (string) get_field( 'header_cta_url', 'option' ) : '',
			'footerCopyright'  => function_exists( 'get_field' ) ? (string) get_field( 'footer_copyright', 'option' ) : '',
			'contactEmail'     => function_exists( 'get_field' ) ? (string) get_field( 'contact_email', 'option' ) : '',
			'contactPhone'     => function_exists( 'get_field' ) ? (string) get_field( 'contact_phone', 'option' ) : '',
			'businessAddress'  => function_exists( 'get_field' ) ? (string) get_field( 'business_address', 'option' ) : '',
			'socialLinks'      => $social_links,
			'primaryMenuHtml'  => $primary_menu ? wp_kses_post( $primary_menu ) : '',
			'footerMenuHtml'   => $footer_menu ? wp_kses_post( $footer_menu ) : '',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'alify_enqueue_frontend_assets' );

/** Resolve the original static filename to the matching WordPress URL. */
function alify_source_url( $slug ) {
	$slug = sanitize_title( $slug );
	$archives = array(
		'services'    => 'service',
		'projects'    => 'work',
		'case-studies'=> 'case_study',
		'industries'  => 'industry',
		'faqs'        => 'faq',
		'pricing'     => 'pricing',
		'testimonials'=> 'testimonial',
	);

	if ( 'index' === $slug ) {
		return home_url( '/' );
	}
	if ( 'blog' === $slug ) {
		$posts_page = absint( get_option( 'page_for_posts' ) );
		return $posts_page ? get_permalink( $posts_page ) : home_url( '/blog/' );
	}
	if ( 'service-single' === $slug ) {
		$slug = 'web-development';
	}
	if ( isset( $archives[ $slug ] ) ) {
		$link = get_post_type_archive_link( $archives[ $slug ] );
		if ( $link ) {
			return $link;
		}
	}

	$post_types = array( 'page', 'post', 'service', 'work', 'case_study', 'industry', 'faq', 'pricing', 'testimonial' );
	$object     = get_page_by_path( $slug, OBJECT, $post_types );
	if ( $object ) {
		return get_permalink( $object );
	}

	$source_type = array(
		'ai-automation'              => 'service',
		'digital-marketing'           => 'service',
		'logo-design'                 => 'service',
		'seo'                         => 'service',
		'ui-ux-design'                => 'service',
		'web-development'             => 'service',
		'ecommerce'                   => 'industry',
		'healthcare'                  => 'industry',
		'industry-single'             => 'industry',
		'real-estate'                 => 'industry',
		'startups'                    => 'industry',
		'case-study-single'           => 'case_study',
		'campaign-next-decision'      => 'post',
		'commerce-project'            => 'work',
		'identity-project'            => 'work',
		'identity-that-works'         => 'post',
		'planning-scalable-website'   => 'post',
		'project-single'              => 'work',
		'property-project'            => 'work',
		'technical-seo-experience'    => 'post',
		'useful-automation'           => 'post',
		'wellness-project'            => 'work',
		'blog-single'                 => 'post',
	);
	if ( isset( $source_type[ $slug ] ) ) {
		$object = get_page_by_path( $slug, OBJECT, $source_type[ $slug ] );
		if ( $object ) {
			return get_permalink( $object );
		}
		$prefix = 'service' === $source_type[ $slug ] ? 'services/' : ( 'industry' === $source_type[ $slug ] ? 'industries/' : ( 'post' === $source_type[ $slug ] ? '' : ( 'case_study' === $source_type[ $slug ] ? 'case-studies/' : 'work/' ) ) );
		return home_url( '/' . $prefix . $slug . '/' );
	}

	return home_url( '/' . $slug . '/' );
}

/** Render editable ACF flexible sections instead of the imported static body. */
function alify_render_acf_page_builder() {
	if ( ! function_exists( 'have_rows' ) || ! have_rows( 'page_sections' ) ) {
		return false;
	}

	$eyebrow     = get_field( 'hero_eyebrow' );
	$hero_title  = get_field( 'hero_title' );
	$description = get_field( 'hero_description' );
	$background  = get_field( 'hero_background' );
	if ( ! $hero_title ) {
		$hero_title = get_the_title();
	}
	if ( ! $eyebrow ) {
		$eyebrow = 'Alify';
	}
	if ( ! $background || ! preg_match( '/^neon-lines-(?:0[1-9]|1[0-4])\\.webp$/', $background ) ) {
		$background = 'neon-lines-01.webp';
	}
	?>
	<page-hero eyebrow="<?php echo esc_attr( $eyebrow ); ?>" title="<?php echo esc_attr( $hero_title ); ?>" description="<?php echo esc_attr( $description ); ?>" background="<?php echo esc_attr( $background ); ?>"></page-hero>
	<main class="inner-page" id="main-content">
	<?php
	while ( have_rows( 'page_sections' ) ) :
		the_row();
		$layout = get_row_layout();
		if ( 'text_section' === $layout ) :
			?>
			<section class="page-section"><div class="container"><div class="row"><div class="col-12"><div class="detail-heading">
				<?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="page-eyebrow"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></p><?php endif; ?>
				<?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="page-title"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
				<div class="page-lead"><?php echo do_shortcode( wp_kses_post( get_sub_field( 'body' ) ) ); ?></div>
			</div></div></div></div></section>
			<?php
		elseif ( 'image_text' === $layout ) :
			$image = get_sub_field( 'image' );
			?>
			<section class="page-section"><div class="container"><div class="row"><div class="col-12"><div class="story-editorial">
				<?php if ( is_array( $image ) && ! empty( $image['ID'] ) ) : ?><div class="story-editorial__image"><?php echo wp_get_attachment_image( $image['ID'], 'large', false, array( 'alt' => esc_attr( get_sub_field( 'image_alt' ) ) ) ); ?></div><?php endif; ?>
				<div class="story-editorial__copy"><?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="page-eyebrow"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></p><?php endif; ?>
					<?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?><div><?php echo do_shortcode( wp_kses_post( get_sub_field( 'body' ) ) ); ?></div></div>
			</div></div></div></div></section>
			<?php
		elseif ( 'card_grid' === $layout ) :
			?>
			<section class="page-section"><div class="container"><div class="row"><div class="col-12">
				<div class="detail-heading"><?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="page-eyebrow"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></p><?php endif; ?><?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="page-title"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?></div>
				<div class="alify-content-cards">
				<?php if ( have_rows( 'cards' ) ) : while ( have_rows( 'cards' ) ) : the_row(); $card_image = get_sub_field( 'image' ); $card_url = get_sub_field( 'url' ); ?>
					<article class="alify-content-card"><?php if ( is_array( $card_image ) && ! empty( $card_image['ID'] ) ) : ?><?php echo wp_get_attachment_image( $card_image['ID'], 'medium_large' ); ?><?php endif; ?><div class="alify-content-card__copy"><h3><?php if ( $card_url ) : ?><a href="<?php echo esc_url( $card_url ); ?>"><?php echo esc_html( get_sub_field( 'title' ) ); ?></a><?php else : ?><?php echo esc_html( get_sub_field( 'title' ) ); ?><?php endif; ?></h3><p><?php echo esc_html( get_sub_field( 'copy' ) ); ?></p></div></article>
				<?php endwhile; endif; ?>
				</div>
			</div></div></div></section>
			<?php
		elseif ( 'faq_group' === $layout ) :
			?>
			<section class="page-section"><div class="container"><div class="row"><div class="col-12"><div class="detail-heading"><h2 class="page-title"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2></div><div class="alify-faq-list">
			<?php if ( have_rows( 'questions' ) ) : while ( have_rows( 'questions' ) ) : the_row(); ?>
				<details class="alify-faq-item"><summary><?php echo esc_html( get_sub_field( 'question' ) ); ?></summary><div><?php echo wp_kses_post( get_sub_field( 'answer' ) ); ?></div></details>
			<?php endwhile; endif; ?>
			</div></div></div></div></section>
			<?php
		elseif ( 'call_to_action' === $layout ) :
			?>
			<section class="page-section alify-content-cta"><div class="container"><div class="row"><div class="col-12"><div class="alify-content-cta__inner"><h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><p><?php echo esc_html( get_sub_field( 'copy' ) ); ?></p><?php if ( get_sub_field( 'button_url' ) ) : ?><a class="button button--primary" href="<?php echo esc_url( get_sub_field( 'button_url' ) ); ?>"><?php echo esc_html( get_sub_field( 'button_label' ) ); ?> <i class="fa-solid fa-arrow-right icon-arrow-up-right" aria-hidden="true"></i></a><?php endif; ?></div></div></div></div></section>
			<?php
		endif;
	endwhile;
	?>
	</main>
	<?php
	return true;
}

/** Build route map consumed by the shared JavaScript header and footer. */
function alify_build_source_routes() {
	$routes = array();
	$files  = glob( ALIFY_THEME_DIR . '/template-parts/source-pages/*.php' );
	foreach ( $files as $file ) {
		$slug = basename( $file, '.php' );
		$routes[ $slug . '.html' ] = alify_source_url( $slug );
	}
	return $routes;
}

/** Rewrite source-relative URLs and make imported inquiry markup use the server handler. */
function alify_prepare_editable_source_content( $content, $slug ) {
	$content = preg_replace_callback(
		'~\\b(src|poster)=("|\\x27)assets/([^"\\x27]+)\\2~i',
		function ( $matches ) {
			return $matches[1] . '=' . $matches[2] . esc_url( trailingslashit( alify_source_assets_uri() ) . $matches[3] ) . $matches[2];
		},
		$content
	);
	$content = preg_replace_callback(
		'~\\bhref=("|\\x27)([^"\\x27]+\\.html(?:[?#][^"\\x27]*)?)\\1~i',
		function ( $matches ) {
			$link = $matches[2];
			if ( preg_match( '~^(?:[a-z][a-z0-9+.-]*:)?//~i', $link ) || ! preg_match( '~^([^?#]+\\.html)([?#].*)?$~i', $link, $parts ) ) {
				return $matches[0];
			}
			$slug = sanitize_title( basename( $parts[1], '.html' ) );
			return 'href=' . $matches[1] . esc_url( alify_source_url( $slug ) . ( isset( $parts[2] ) ? $parts[2] : '' ) ) . $matches[1];
		},
		$content
	);
	if ( function_exists( 'alify_prepare_source_inquiry' ) ) {
		$content = alify_prepare_source_inquiry( $content, $slug );
	}
	return $content;
}

/** Render imported/editor-authored content when the editor selects that mode. */
function alify_render_editable_source_content( $slug ) {
	$content = get_post_field( 'post_content', get_queried_object_id() );
	if ( ! is_string( $content ) || '' === trim( $content ) ) {
		return false;
	}
	$content = alify_prepare_editable_source_content( $content, $slug );
	if ( get_post_meta( get_queried_object_id(), '_alify_source_content_imported', true ) ) {
		$content = do_blocks( $content );
		$content = do_shortcode( $content );
		echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted editor/source markup rendered as saved HTML.
	} else {
		echo apply_filters( 'the_content', $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted editor content filtered by WordPress.
	}
	return true;
}

/**
 * Include a converted source view and translate relative asset and .html links
 * into theme-asset and WordPress URLs.
 */
function alify_render_source_view( $slug ) {
	$slug = sanitize_file_name( $slug );
	$file = ALIFY_THEME_DIR . '/template-parts/source-pages/' . $slug . '.php';
	if ( ! is_readable( $file ) ) {
		return false;
	}
	// Source templates may be called before the main query loop; initialize post
	// context so ACF fields, shortcodes, and template tags resolve the right record.
	if ( is_singular() && ! in_the_loop() && have_posts() ) {
		the_post();
	}

	if ( is_singular() ) {
		$post_id = get_queried_object_id();
		$mode    = get_post_meta( $post_id, '_alify_content_mode', true );
		if ( 'content' === $mode && alify_render_editable_source_content( $slug ) ) {
			return true;
		}
	}
	if ( is_singular() && alify_render_acf_page_builder() ) {
		return true;
	}
	if ( is_singular() ) {
		$post_id      = get_queried_object_id();
		$post_content = trim( (string) get_post_field( 'post_content', $post_id ) );
		$mode         = get_post_meta( $post_id, '_alify_content_mode', true );
		$imported     = get_post_meta( $post_id, '_alify_source_content_imported', true );
		if ( ! $imported && 'source' !== $mode && '' !== $post_content && alify_render_editable_source_content( $slug ) ) {
			return true;
		}
	}

	ob_start();
	include $file;
	$markup = ob_get_clean();
	if ( is_singular() && function_exists( 'get_field' ) ) {
		$hero_fields = array(
			'eyebrow'     => get_field( 'hero_eyebrow' ),
			'title'       => get_field( 'hero_title' ),
			'description' => get_field( 'hero_description' ),
			'background'  => get_field( 'hero_background' ),
		);
		foreach ( $hero_fields as $attribute => $value ) {
			if ( ! $value ) {
				continue;
			}
			$pattern = '/(<page-hero\\b[^>]*\\b' . preg_quote( $attribute, '/' ) . '=)(["\']).*?\\2/i';
			$markup  = preg_replace_callback(
				$pattern,
				function ( $matches ) use ( $value ) {
					return $matches[1] . $matches[2] . esc_attr( $value ) . $matches[2];
				},
				$markup
			);
		}
		if ( 'index' === $slug ) {
			$home_fields = array(
				'hero_eyebrow'     => '~(<p class="intro__eyebrow">).*?(</p>)~is',
				'hero_title'       => '~(<h1 class="intro__title"[^>]*>).*?(</h1>)~is',
				'hero_description' => '~(<p class="intro__text">).*?(</p>)~is',
			);
			foreach ( $home_fields as $field_name => $home_pattern ) {
				$value = get_field( $field_name );
				if ( $value ) {
					$markup = preg_replace_callback( $home_pattern, function ( $matches ) use ( $value ) { return $matches[1] . esc_html( $value ) . $matches[2]; }, $markup, 1 );
				}
			}
			$background = get_field( 'hero_background' );
			if ( $background && preg_match( '/^neon-lines-(?:0[1-9]|1[0-4])\\.webp$/', $background ) ) {
				$markup = preg_replace( '~(assets/images/background/)neon-lines-(?:0[1-9]|1[0-4])\\.webp~', '$1' . $background, $markup, 1 );
			}
		}
	}
	if ( in_array( $slug, array( 'contact', 'start-project' ), true ) && function_exists( 'alify_prepare_source_inquiry' ) ) {
		$markup = alify_prepare_source_inquiry( $markup, $slug );
	}
	$markup = str_replace( 'assets/', esc_url( alify_source_assets_uri() ) . '/', $markup );
	$markup = preg_replace_callback(
		'/(\bhref\s*=\s*)(["\'])([^"\']+\.html(?:[?#][^"\']*)?)(\2)/i',
		function ( $matches ) {
			$target = $matches[3];
			if ( preg_match( '~^(?:https?:)?//~i', $target ) ) {
				return $matches[0];
			}
			$parts  = wp_parse_url( $target );
			$path   = isset( $parts['path'] ) ? $parts['path'] : $target;
			$slug   = sanitize_title( basename( $path, '.html' ) );
			$url    = alify_source_url( $slug );
			if ( ! empty( $parts['query'] ) ) {
				$url = add_query_arg( wp_parse_args( $parts['query'] ), $url );
			}
			if ( ! empty( $parts['fragment'] ) ) {
				$url .= '#' . rawurlencode( $parts['fragment'] );
			}
			return $matches[1] . $matches[2] . esc_url( $url ) . $matches[4];
		},
		$markup
	);
	echo $markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted, bundled theme markup; attributes are normalized above.
	return true;
}

/** Add the original view-specific classes needed by the bundled stylesheets. */
function alify_source_body_classes( $classes ) {
	$map = include ALIFY_THEME_DIR . '/inc/source-body-classes.php';
	$slug = '';
	if ( is_front_page() ) {
		$slug = 'index';
	} elseif ( is_home() ) {
		$slug = 'blog';
	} elseif ( is_post_type_archive() ) {
		$archive_map = array( 'service' => 'services', 'work' => 'projects', 'case_study' => 'case-studies', 'industry' => 'industries', 'faq' => 'faqs', 'pricing' => 'pricing', 'testimonial' => 'testimonials' );
		$type = get_query_var( 'post_type' );
		$type = is_array( $type ) ? reset( $type ) : $type;
		$slug = isset( $archive_map[ $type ] ) ? $archive_map[ $type ] : '';
	} else {
		$object = get_queried_object();
		if ( $object instanceof WP_Post ) {
			$slug = $object->post_name;
		}
	}
	if ( isset( $map[ $slug ] ) ) {
		$classes = array_merge( $classes, $map[ $slug ] );
	}
	return array_unique( $classes );
}
add_filter( 'body_class', 'alify_source_body_classes' );

/** Select the closest matching source view for a queried WordPress object. */
function alify_current_source_view( $fallback = '' ) {
	if ( is_front_page() ) {
		return 'index';
	}
	if ( is_home() || is_search() || is_category() || is_tag() ) {
		return 'blog';
	}
	if ( is_post_type_archive() ) {
		$type = get_query_var( 'post_type' );
		$type = is_array( $type ) ? reset( $type ) : $type;
		$views = array( 'service' => 'services', 'work' => 'projects', 'case_study' => 'case-studies', 'industry' => 'industries', 'faq' => 'faqs', 'pricing' => 'pricing', 'testimonial' => 'testimonials' );
		return isset( $views[ $type ] ) ? $views[ $type ] : $fallback;
	}
	$object = get_queried_object();
	if ( $object instanceof WP_Post ) {
		$slug = sanitize_file_name( $object->post_name );
		if ( is_page() && 'home' === $slug ) {
			return 'index';
		}
		if ( is_page() && 'legal' === $slug ) {
			$legal_slugs = array( 'privacy-policy', 'terms-and-conditions', 'cookie-policy' );
			$child = get_page_uri( $object );
			foreach ( $legal_slugs as $legal_slug ) {
				if ( $legal_slug === $child || $legal_slug === $slug ) {
					return $legal_slug;
				}
			}
		}
		if ( is_readable( ALIFY_THEME_DIR . '/template-parts/source-pages/' . $slug . '.php' ) ) {
			return $slug;
		}
	}
	return $fallback;
}
