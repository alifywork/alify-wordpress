<?php
/** Converted Alify archive with a live WordPress loop and source-design fallback. */
get_header();
if ( have_posts() ) {
	get_template_part( 'template-parts/archive', 'loop' );
} else {
	alify_render_source_view( 'case-studies' );
}
get_footer();
