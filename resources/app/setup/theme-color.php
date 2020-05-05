<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.4
 */

/**
 * Sets up theme-color
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		$accent_color = get_theme_mod( 'accent-color' );
		if ( ! $accent_color ) {
			return;
		}
		?>
		<meta name="theme-color" content="<?php echo esc_attr( $accent_color ); ?>">
		<?php
	}
);
