<?php
/**
 * Template Name: Legal Page
 * Converted Alify source design, rendered as a WordPress page template.
 */
get_header();
$alify_view = alify_current_source_view( 'privacy-policy' );
if ( ! $alify_view || ! alify_render_source_view( $alify_view ) ) {
	while ( have_posts() ) : the_post();
		?><main class="inner-page" id="main-content"><div class="container"><h1><?php the_title(); ?></h1><?php the_content(); ?></div></main><?php
	endwhile;
}
get_footer();
