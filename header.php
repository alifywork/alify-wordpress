<?php
/** Theme document head and shared navigation component. */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="alify-skip-link" href="<?php echo esc_attr( is_front_page() && ! is_home() ? '#home' : '#main-content' ); ?>"><?php esc_html_e( 'Skip to main content', 'alify' ); ?></a>
<site-header>
	<header class="alify-nojs-header">
		<a class="alify-nojs-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">ALIFY</a>
		<nav aria-label="<?php esc_attr_e( 'Primary navigation', 'alify' ); ?>">
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'alify' ); ?></a></li>
				<li><a href="<?php echo esc_url( alify_source_url( 'about' ) ); ?>"><?php esc_html_e( 'About', 'alify' ); ?></a></li>
				<li><a href="<?php echo esc_url( alify_source_url( 'services' ) ); ?>"><?php esc_html_e( 'Services', 'alify' ); ?></a></li>
				<li><a href="<?php echo esc_url( alify_source_url( 'projects' ) ); ?>"><?php esc_html_e( 'Work', 'alify' ); ?></a></li>
				<li><a href="<?php echo esc_url( alify_source_url( 'blog' ) ); ?>"><?php esc_html_e( 'Blog', 'alify' ); ?></a></li>
				<li><a href="<?php echo esc_url( alify_source_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'alify' ); ?></a></li>
			</ul>
		</nav>
	</header>
</site-header>
