<?php
/** WordPress fallback template. */
get_header();
if ( is_front_page() ) {
	alify_render_source_view( 'index' );
} else {
	get_template_part( 'template-parts/content', 'fallback' );
}
get_footer();
