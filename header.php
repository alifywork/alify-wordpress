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
<site-header></site-header>
