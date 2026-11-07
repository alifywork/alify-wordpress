<?php
/** Converted Alify single template with an editable WordPress-content fallback. */
get_header();
$alify_view = alify_current_source_view();
if ( ! $alify_view || ! alify_render_source_view( $alify_view ) ) {
	get_template_part( 'template-parts/content', 'fallback' );
}
get_footer();
