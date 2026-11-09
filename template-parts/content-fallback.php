<?php
/** Generic WordPress content fallback. */
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<main class="inner-page" id="main-content">
			<div class="container"><div class="row"><div class="col-12">
				<article <?php post_class(); ?>><h1><?php the_title(); ?></h1><div class="entry-content"><?php the_content(); ?></div></article>
			</div></div></div>
		</main>
		<?php
	endwhile;
endif;
