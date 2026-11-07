<?php
/** Dynamic WordPress archive grid used once the corresponding content exists. */
$term_object = get_queried_object();
if ( is_tax() || is_category() || is_tag() ) {
	$heading = single_term_title( '', false );
	$copy    = term_description();
	$eyebrow = __( 'Explore', 'alify' );
} elseif ( is_post_type_archive() ) {
	$object  = get_queried_object();
	$heading = post_type_archive_title( '', false );
	$copy    = function_exists( 'get_field' ) ? (string) get_field( 'archive_description', 'option' ) : '';
	$eyebrow = __( 'What we do', 'alify' );
} else {
	$heading = is_home() ? __( 'Ideas & perspectives', 'alify' ) : __( 'Latest articles', 'alify' );
	$copy    = '';
	$eyebrow = __( 'The Alify Journal', 'alify' );
}
?>
<page-hero eyebrow="<?php echo esc_attr( $eyebrow ); ?>" title="<?php echo esc_attr( $heading ); ?>" description="<?php echo esc_attr( wp_strip_all_tags( $copy ) ); ?>" background="neon-lines-01.webp"></page-hero>
<main class="inner-page" id="main-content">
	<section class="page-section alify-dynamic-archive"><div class="container"><div class="row"><div class="col-12">
		<?php if ( $copy ) : ?><div class="alify-archive-intro"><?php echo wp_kses_post( $copy ); ?></div><?php endif; ?>
		<?php if ( have_posts() ) : ?>
			<div class="alify-archive-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'alify-archive-card' ); ?>>
					<a class="alify-archive-card__media" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?><?php else : ?><span class="alify-archive-card__placeholder" aria-hidden="true"></span><?php endif; ?>
					</a>
					<div class="alify-archive-card__copy">
						<?php $first_term = false; foreach ( get_object_taxonomies( get_post_type() ) as $taxonomy_name ) { $post_terms = get_the_terms( get_the_ID(), $taxonomy_name ); if ( ! is_wp_error( $post_terms ) && ! empty( $post_terms ) ) { $first_term = $post_terms[0]; break; } } if ( $first_term ) : ?><p class="page-eyebrow"><?php echo esc_html( $first_term->name ); ?></p><?php endif; ?>
						<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<?php if ( has_excerpt() || get_the_content() ) : ?><p><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: wp_strip_all_tags( get_the_content() ), 28 ) ); ?></p><?php endif; ?>
						<a class="detail-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Explore', 'alify' ); ?> <i class="fa-solid fa-arrow-right icon-arrow-up-right" aria-hidden="true"></i></a>
					</div>
				</article>
			<?php endwhile; ?>
			</div>
			<div class="alify-archive-pagination"><?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => __( 'Previous', 'alify' ), 'next_text' => __( 'Next', 'alify' ) ) ); ?></div>
		<?php else : ?>
			<p><?php esc_html_e( 'No content has been published here yet.', 'alify' ); ?></p>
		<?php endif; ?>
	</div></div></div></section>
</main>
