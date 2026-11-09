<?php
/** Shared footer component and document close. */

defined( 'ABSPATH' ) || exit;
?>
<site-footer>
	<footer class="alify-nojs-footer">
		<p><?php echo esc_html( sprintf( __( '© %1$s Alify. All rights reserved.', 'alify' ), date_i18n( 'Y' ) ) ); ?></p>
		<?php
		wp_nav_menu(
			array(
				'theme_location'      => 'footer',
				'container'           => 'nav',
				'container_aria_label' => __( 'Footer navigation', 'alify' ),
				'menu_class'          => 'alify-nojs-footer__menu',
				'depth'               => 1,
				'fallback_cb'         => 'alify_nojs_footer_menu_fallback',
			)
		);
		?>
		<?php
		$nojs_contact_email_value = function_exists( 'get_field' ) ? get_field( 'contact_email', 'option' ) : '';
		$nojs_contact_email = is_scalar( $nojs_contact_email_value ) ? sanitize_email( (string) $nojs_contact_email_value ) : '';
		if ( is_email( $nojs_contact_email ) ) :
			?>
			<a href="mailto:<?php echo esc_attr( $nojs_contact_email ); ?>"><?php echo esc_html( $nojs_contact_email ); ?></a>
		<?php endif; ?>
	</footer>
</site-footer>
<?php wp_footer(); ?>
</body>
</html>
