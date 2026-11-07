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
		<?php
		wp_nav_menu(
			array(
				'theme_location'      => 'primary',
				'container'           => 'nav',
				'container_aria_label' => __( 'Primary navigation', 'alify' ),
				'menu_class'          => 'alify-nojs-header__menu',
				'depth'               => 1,
				'fallback_cb'         => 'alify_nojs_primary_menu_fallback',
			)
		);
		?>
	</header>
</site-header>
