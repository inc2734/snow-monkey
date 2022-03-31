<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.4.3
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
	'wp_enqueue_scripts',
	function() {
		if ( ! Helper::use_auto_custom_logo_size() ) {
			return;
		}

		$custom_logo = get_custom_logo();
		if ( ! $custom_logo ) {
			return;
		}

		$sm_logo_scale = get_theme_mod( 'sm-logo-scale' );
		$sm_logo_scale = $sm_logo_scale / 100;
		$lg_logo_scale = get_theme_mod( 'lg-logo-scale' );
		$lg_logo_scale = $lg_logo_scale / 100;

		$custom_logo_id    = get_theme_mod( 'custom_logo' );
		$custom_logo_src   = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		$custom_logo_width = $custom_logo_src[1] * $lg_logo_scale;

		$sm_custom_logo_id    = get_theme_mod( 'sm-custom-logo' );
		$sm_custom_logo_src   = wp_get_attachment_image_src( $sm_custom_logo_id, 'full' );
		$sm_custom_logo_width = $sm_custom_logo_src
			? $sm_custom_logo_src[1] * $sm_logo_scale
			: $custom_logo_src[1] * $sm_logo_scale;

		$data = sprintf(
			'.c-site-branding__title .custom-logo, .wpaw-site-branding__logo .custom-logo { width: %1$spx; }
@media (min-width: 64em) { .c-site-branding__title .custom-logo, .wpaw-site-branding__logo .custom-logo { width: %2$spx; }',
			esc_html( absint( $sm_custom_logo_width ) ),
			esc_html( absint( $custom_logo_width ) )
		);
		wp_add_inline_style( Helper::get_main_style_handle(), $data );
	},
	11
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

add_filter(
	'get_custom_logo',
	function( $html ) {
		$sm_custom_logo = get_theme_mod( 'sm-custom-logo' );
		if ( ! $sm_custom_logo ) {
			return $html;
		}

		if ( preg_match( '|^(<a [^>]+?>)(.+?)(</a>)$|', $html, $match ) ) {
			$src  = wp_get_attachment_image_src( $sm_custom_logo, 'full' );
			$html = sprintf(
				'%1$s<picture><source media="(max-width: 1023px)" srcset="%2$s" width="%3$s" height="%4$s">%5$s</picture>%6$s',
				$match[1],
				esc_url( $src[0] ),
				esc_attr( $src[1] ),
				esc_attr( $src[2] ),
				$match[2],
				$match[3]
			);
		}

		return $html;
	}
);
