<?php
/** Dynamic WordPress archive grid used once the corresponding content exists. */
$term_object        = get_queried_object();
$search_post_types = array();
if ( is_search() || is_post_type_archive() ) {
	$query_types       = get_query_var( 'post_type' );
	$search_post_types = is_array( $query_types ) ? $query_types : array( $query_types );
} elseif ( is_tax() && $term_object instanceof WP_Term ) {
	$taxonomy_object = get_taxonomy( $term_object->taxonomy );
	if ( $taxonomy_object ) {
		$search_post_types = $taxonomy_object->object_type;
	}
} elseif ( is_category() || is_tag() || is_home() ) {
	$search_post_types = array( 'post' );
}
$search_post_types = array_values( array_filter( array_unique( array_map( 'sanitize_key', $search_post_types ) ), 'post_type_exists' ) );
if ( is_search() ) {
	$search_term = get_search_query( false );
	$heading     = $search_term ? sprintf( __( 'Search results for “%s”', 'alify' ), $search_term ) : __( 'Search results', 'alify' );
	$copy        = '';
	$eyebrow     = __( 'Search', 'alify' );
} elseif ( is_tax() || is_category() || is_tag() ) {
	$heading = single_term_title( '', false );
	$copy    = term_description();
	$eyebrow = __( 'Explore', 'alify' );
} elseif ( is_post_type_archive() ) {
	$heading = post_type_archive_title( '', false );
	$copy    = function_exists( 'get_field' ) ? (string) get_field( 'archive_description', 'option' ) : '';
	$eyebrow = __( 'What we do', 'alify' );
} else {
	$heading = is_home() ? __( 'Ideas & perspectives', 'alify' ) : __( 'Latest articles', 'alify' );
	$copy    = '';
	$eyebrow = __( 'The Alify Journal', 'alify' );
}
?>
<?php echo alify_page_hero_fallback_markup( $eyebrow, $heading, wp_strip_all_tags( $copy ), 'neon-lines-01.webp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- helper escapes all dynamic content. ?>
<main class="inner-page" id="main-content">
	<section class="page-section alify-dynamic-archive"><div class="container"><div class="row"><div class="col-12">
		<?php if ( $copy ) : ?><div class="alify-archive-intro"><?php echo wp_kses_post( $copy ); ?></div><?php endif; ?>
		<form class="alify-archive-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="alify-archive-search-input"><?php esc_html_e( 'Search this site', 'alify' ); ?></label>
			<div><input id="alify-archive-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query( false ) ); ?>" placeholder="<?php esc_attr_e( 'Search…', 'alify' ); ?>"><?php foreach ( $search_post_types as $search_post_type ) : ?><input type="hidden" name="post_type[]" value="<?php echo esc_attr( $search_post_type ); ?>"><?php endforeach; ?><button type="submit"><?php esc_html_e( 'Search', 'alify' ); ?></button></div>
		</form>
		<?php if ( have_posts() ) : ?>
			<div class="alify-archive-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'alify-archive-card' ); ?>>
					<a class="alify-archive-card__media" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); else : $source_image = get_post_meta( get_the_ID(), '_alify_source_image', true ); if ( $source_image && preg_match( '~^assets/images/[A-Za-z0-9/_ .-]+$~', $source_image ) ) : ?><img src="<?php echo esc_url( trailingslashit( ALIFY_THEME_URI ) . 'frontend-source/' . $source_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy"><?php else : ?><span class="alify-archive-card__placeholder" aria-hidden="true"></span><?php endif; endif; ?>
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
			<p><?php echo esc_html( is_search() ? __( 'No results matched your search. Try another term.', 'alify' ) : __( 'No content has been published here yet.', 'alify' ) ); ?></p>
		<?php endif; ?>
	</div></div></div></section>
</main>
