<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.4.0
 */

/**
 * Sets up theme-color
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		$theme_color = apply_filters( 'snow_monkey_theme_color', get_theme_mod( 'accent-color' ) );
		if ( ! $theme_color ) {
			return;
		}
		?>
		<meta name="theme-color" content="<?php echo esc_attr( $theme_color ); ?>">
		<?php
	}
);
