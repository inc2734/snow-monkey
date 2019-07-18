<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 */

add_action(
	'after_setup_theme',
	function() {
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 160,
				'width'       => 320,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
	}
);

/**
 * Set custom logo size with ratina
 */
add_action(
	'wp_head',
	function() {
		$custom_logo = get_custom_logo();
		if ( ! $custom_logo ) {
			return;
		}

		preg_match( '/height="(\d+?)"/', $custom_logo, $reg );
		if ( ! isset( $reg[1] ) ) {
			return;
		}
		$height = $reg[1];

		preg_match( '/width="(\d+?)"/', $custom_logo, $reg );
		if ( ! isset( $reg[1] ) ) {
			return;
		}
		$width = $reg[1];

		$sm_logo_scale = get_theme_mod( 'sm-logo-scale', 33 );
		$sm_logo_scale = ( $sm_logo_scale / 100 );
		?>
<style id="snow-monkey-custom-logo-size">
.c-site-branding .custom-logo, .wpaw-site-branding .custom-logo { height: <?php echo absint( $height * $sm_logo_scale ); ?>px; width: <?php echo absint( $width * $sm_logo_scale ); ?>px; }
@media (min-width: 64em) { .c-site-branding .custom-logo, .wpaw-site-branding .custom-logo { height: <?php echo absint( $height / 2 ); ?>px; width: <?php echo absint( $width / 2 ); ?>px; } }
</style>
		<?php
	}
);

/**
 * The alt of custom logo uses blog title
 *
 * @see https://developer.wordpress.org/reference/functions/get_custom_logo/
 *
 * @param string $html
 * @param int $blog_id
 * @return string
 */
add_filter(
	'get_custom_logo',
	function( $html, $blog_id ) {
		$switched_blog = false;

		if ( is_multisite() && ! empty( $blog_id ) && get_current_blog_id() !== (int) $blog_id ) {
			switch_to_blog( $blog_id );
			$switched_blog = true;
		}

		$html = preg_replace( '|alt="[^"]*?"|', 'alt="' . get_bloginfo( 'name', 'display' ) . '"', $html );

		if ( $switched_blog ) {
			restore_current_blog();
		}

		return $html;
	},
	10,
	2
);
