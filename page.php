<?php
/** Render a converted source view by page slug, with editable WordPress content as fallback. */
get_header();
$alify_view = alify_current_source_view();
if ( $alify_view && alify_render_source_view( $alify_view ) ) {
	// The source view is the visual template; page title and body remain CMS-managed in WordPress.
} else {
	while ( have_posts() ) :
		the_post();
		?>
		<main class="inner-page" id="main-content">
			<div class="container"><div class="row"><div class="col-12">
				<h1><?php the_title(); ?></h1>
				<div class="entry-content"><?php the_content(); ?></div>
			</div></div></div>
		</main>
		<?php
	endwhile;
}
get_footer();
