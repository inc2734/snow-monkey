<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.4.0
 */

use Framework\Helper;

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
 * Set custom logo size with ratina.
 * Output before wp_enqueue_scripts.
 */
add_action(
	'wp_head',
	function() {
		if ( ! Helper::use_auto_custom_logo_size() ) {
			return;
		}

		$custom_logo = get_custom_logo();
		if ( ! $custom_logo ) {
			return;
		}

		preg_match( '/height="([\d\.]+?)"/', $custom_logo, $reg );
		if ( ! isset( $reg[1] ) ) {
			return;
		}
		$height = $reg[1];

		preg_match( '/width="([\d\.]+?)"/', $custom_logo, $reg );
		if ( ! isset( $reg[1] ) ) {
			return;
		}
		$width = $reg[1];

		$sm_logo_scale = get_theme_mod( 'sm-logo-scale' );
		$sm_logo_scale = $sm_logo_scale / 100;

		$lg_logo_scale = get_theme_mod( 'lg-logo-scale' );
		$lg_logo_scale = $lg_logo_scale / 100;
		?>
<style id="snow-monkey-custom-logo-size">
.c-site-branding .custom-logo, .wpaw-site-branding__logo .custom-logo { height: <?php echo absint( $height * $sm_logo_scale ); ?>px; width: <?php echo absint( $width * $sm_logo_scale ); ?>px; }
@media (min-width: 64em) { .c-site-branding .custom-logo, .wpaw-site-branding__logo .custom-logo { height: <?php echo absint( $height * $lg_logo_scale ); ?>px; width: <?php echo absint( $width * $lg_logo_scale ); ?>px; } }
</style>
		<?php
	},
	7
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

/**
 * When replacing the logo with the customizer,
 * the logo part is reloaded but the style of width / height of the logo are not reloaded.
 * So, distorted the logo.
 * Take action by reloading the screen.
 *
 * @param WP_Customize_Manager $wp_customize
 * @return void
 */
add_action(
	'customize_register',
	function( $wp_customize ) {
		$wp_customize->selective_refresh->remove_partial( 'custom-logo' );
		$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
	},
	11
);
