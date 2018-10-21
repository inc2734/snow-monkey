<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Awesome_Widgets\Awesome_Widgets;

new Awesome_Widgets();

add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
);

/**
 * Customize the carousel widget html
 *
 * @param string $content
 * @param array $args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $args ) {
		if ( false === strpos( $args['widget_id'], 'inc2734_wp_awesome_widgets_showcase' ) ) {
			return $content;
		}

		return str_replace( 'wpaw-carousel__inner', 'wpaw-carousel__inner c-container', $content );
	},
	10,
	2
);

/**
 * Customize the local nav widget html
 *
 * @param string $content
 * @param array $args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $args ) {
		if ( false === strpos( $args['widget_id'], 'inc2734_wp_awesome_widgets_local_nav' ) ) {
			return $content;
		}

		return str_replace(
			'<li class="wpaw-local-nav__subitem">',
			'<li class="wpaw-local-nav__subitem"><span class="wpaw-local-nav__subitem__icon"><i class="fas fa-angle-right"></i></span>',
			$content
		);
	},
	10,
	2
);
