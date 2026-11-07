<?php
/** Shared footer component and document close. */

defined( 'ABSPATH' ) || exit;
?>
<site-footer>
	<footer class="alify-nojs-footer">
		<p><?php echo esc_html( sprintf( __( '© %1$s Alify. All rights reserved.', 'alify' ), date_i18n( 'Y' ) ) ); ?></p>
		<nav aria-label="<?php esc_attr_e( 'Footer navigation', 'alify' ); ?>">
			<a href="<?php echo esc_url( alify_source_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'alify' ); ?></a>
			<a href="<?php echo esc_url( alify_source_url( 'terms-and-conditions' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'alify' ); ?></a>
			<a href="<?php echo esc_url( alify_source_url( 'cookie-policy' ) ); ?>"><?php esc_html_e( 'Cookie Policy', 'alify' ); ?></a>
		</nav>
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
