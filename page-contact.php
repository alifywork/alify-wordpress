<?php
/**
 * Template Name: Contact Us
 * Converted Alify source design, rendered as a WordPress page template.
 */
get_header();
$alify_view = 'contact';
if ( ! $alify_view || ! alify_render_source_view( $alify_view ) ) {
	while ( have_posts() ) : the_post();
		?><main class="inner-page" id="main-content"><div class="container"><h1><?php the_title(); ?></h1><?php the_content(); ?></div></main><?php
	endwhile;
}
get_footer();
