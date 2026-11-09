<?php
/** Helpful, branded not-found page. */
get_header();
?>
<?php echo alify_page_hero_fallback_markup( __( '404 / Not found', 'alify' ), __( 'This page took a different route.', 'alify' ), __( 'The page may have moved or the link may be out of date. Search the site or choose a place to continue.', 'alify' ), 'neon-lines-04.webp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- helper escapes all dynamic content. ?>
<main class="inner-page" id="main-content">
	<section class="page-section alify-not-found"><div class="container"><div class="row"><div class="col-12">
		<div class="detail-heading"><p class="page-eyebrow"><?php esc_html_e( 'Let’s get you back on track', 'alify' ); ?></p><h2 class="page-title"><?php esc_html_e( 'Nothing here, but a useful next step.', 'alify' ); ?></h2><p class="page-lead"><?php esc_html_e( 'Try a search, explore our services, or return to the home page.', 'alify' ); ?></p></div>
		<form class="alify-archive-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"><label for="alify-404-search"><?php esc_html_e( 'Search this site', 'alify' ); ?></label><div><input id="alify-404-search" type="search" name="s" placeholder="<?php esc_attr_e( 'Search…', 'alify' ); ?>"><button type="submit"><?php esc_html_e( 'Search', 'alify' ); ?></button></div></form>
		<p class="alify-not-found__links"><a class="button button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to homepage', 'alify' ); ?></a> <a class="detail-link" href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>"><?php esc_html_e( 'Explore services', 'alify' ); ?> <i class="fa-solid fa-arrow-right icon-arrow-up-right" aria-hidden="true"></i></a></p>
	</div></div></div></section>
</main>
<?php get_footer(); ?>
