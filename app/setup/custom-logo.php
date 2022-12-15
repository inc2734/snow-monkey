<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
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

		$styles_for_main           = array();
		$styles_for_custom_widgets = array();

		$custom_logo_id  = get_theme_mod( 'custom_logo' );
		$custom_logo_src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		// wp_get_attachment_image_src() returns 1 if the image width could not be obtained.
		if ( ! empty( $custom_logo_src ) && 1 !== $custom_logo_src[1] ) {
			$custom_logo_width    = $custom_logo_src[1] * $lg_logo_scale;
			$sm_custom_logo_width = $custom_logo_src[1] * $sm_logo_scale;
		}

		$sm_custom_logo_id  = get_theme_mod( 'sm-custom-logo' );
		$sm_custom_logo_src = wp_get_attachment_image_src( $sm_custom_logo_id, 'full' );
		// wp_get_attachment_image_src() returns 1 if the image width could not be obtained.
		if ( ! empty( $sm_custom_logo_src ) && 1 !== $sm_custom_logo_src[1] ) {
			$sm_custom_logo_width = $sm_custom_logo_src[1] * $sm_logo_scale;
		}

		if ( ! empty( $custom_logo_width ) || ! empty( $sm_custom_logo_width ) ) {
			if ( ! empty( $sm_custom_logo_width ) ) {
				$styles_for_main[]           = sprintf(
					'.c-site-branding__title .custom-logo { width: %1$spx; }',
					esc_html( absint( $sm_custom_logo_width ) )
				);
				$styles_for_custom_widgets[] = sprintf(
					'.wpaw-site-branding__logo .custom-logo { width: %1$spx; }',
					esc_html( absint( $sm_custom_logo_width ) )
				);
			}
			if ( ! empty( $custom_logo_width ) ) {
				$styles_for_main[]           = sprintf(
					'@media (min-width: 64em) { .c-site-branding__title .custom-logo { width: %1$spx; } }',
					esc_html( absint( $custom_logo_width ) )
				);
				$styles_for_custom_widgets[] = sprintf(
					'@media (min-width: 64em) { .wpaw-site-branding__logo .custom-logo { width: %1$spx; } }',
					esc_html( absint( $custom_logo_width ) )
				);
			}
			wp_add_inline_style( Helper::get_main_style_handle(), implode( '', $styles_for_main ) );
			wp_add_inline_style( Helper::get_main_style_handle() . '-custom-widgets', implode( '', $styles_for_custom_widgets ) );
		}
	},
	11
);

/**
 * Delete if width and height are 1.
 * wp_get_attachment_image_src() returns 1 if the image width could not be obtained.
 *
 * @param string $html Custom logo html.
 * @return string
 */
add_filter(
	'snow_monkey_template_part_render_template-parts/header/site-branding',
	function( $html ) {
		return str_replace( array( 'width="1"', 'height="1"' ), array(), $html );
	}
);

/**
 * The alt of custom logo uses blog title.
 *
 * @param array $custom_logo_attr Custom logo image attributes.
 * @param int   $custom_logo_id   Custom logo attachment ID.
 * @param int   $blog_id          ID of the blog to get the custom logo for.
 */
add_filter(
	'get_custom_logo_image_attributes',
	function( $custom_logo_attr, $custom_logo_id, $blog_id ) {
		$switched_blog = false;

		if ( is_multisite() && ! empty( $blog_id ) && get_current_blog_id() !== (int) $blog_id ) {
			switch_to_blog( $blog_id );
			$switched_blog = true;
		}

		$custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );

		if ( $switched_blog ) {
			restore_current_blog();
		}

		return $custom_logo_attr;
	},
	10,
	3
);

/**
 * Add mobile custom logo.
 *
 * @param string $html Custom logo html.
 * @return string
 */
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
