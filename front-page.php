<?php
/** Converted Alify homepage. */
get_header();
if ( is_home() ) {
	get_template_part( 'template-parts/archive', 'loop' );
} else {
	alify_render_source_view( 'index' );
}
get_footer();
