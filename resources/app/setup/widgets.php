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

/**
 * Customize the pickup slider widget html
 *
 * @param string $content
 * @param array $args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $args ) {
		if ( false === strpos( $args['widget_id'], 'inc2734_wp_awesome_widgets_pickup_slider' ) ) {
			return $content;
		}

		return str_replace(
			'wpaw-pickup-slider__item-more',
			'wpaw-pickup-slider__item-more c-btn',
			$content
		);
	},
	10,
	2
);

/**
 * Customize the pickup slider widget html
 *
 * @param string $content
 * @param array $args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $args, $instance ) {
		if ( false === strpos( $args['widget_id'], 'inc2734_wp_awesome_widgets_pr_box' ) ) {
			return $content;
		}

		$content = str_replace(
			'wpaw-pr-box__inner',
			'wpaw-pr-box__inner c-container',
			$content
		);

		if ( ! empty( $instance['title'] ) ) {
			$content_widget_areas = [
				'front-page-top-widget-area',
				'front-page-bottom-widget-area',
				'posts-page-top-widget-area',
				'posts-page-bottom-widget-area',
				'archive-top-widget-area',
			];
			if ( ! in_array( $args['id'], $content_widget_areas ) ) {
				$content = str_replace( 'wpaw-pr-box__title', 'c-widget__title', $content );
			}
		}

		$content = str_replace(
			'wpaw-pr-box__row',
			'wpaw-pr-box__row c-row c-row--margin',
			$content
		);

		$content = str_replace(
			'"wpaw-pr-box__item"',
			'"wpaw-pr-box__item c-row__col c-row__col--1-' . esc_attr( $instance['sm-columns'] ) . ' c-row__col--md-1-' . esc_attr( $instance['md-columns'] ) . ' c-row__col--lg-1-' . esc_attr( $instance['lg-columns'] ) . '"',
			$content
		);

		$content = str_replace(
			'wpaw-pr-box__item-more',
			'wpaw-pr-box__item-more c-btn',
			$content
		);

		$content = str_replace(
			'wpaw-pr-box__more',
			'wpaw-pr-box__more c-btn',
			$content
		);

		return $content;
	},
	10,
	3
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

		$content = str_replace(
			'wpaw-showcase ',
			'js-bg-parallax wpaw-showcase ',
			$content
		);

		$content = str_replace(
			'wpaw-showcase__bgimage',
			'wpaw-showcase__bgimage js-bg-parallax__bgimage',
			$content
		);

		$content = str_replace(
			'wpaw-showcase__more',
			'wpaw-showcase__more c-btn',
			$content
		);

		$content = str_replace(
			'<div class="wpaw-showcase__inner">',
			'<div class="c-container js-bg-parallax__content wpaw-showcase__inner">',
			$content
		);

		return $content;
	},
	10,
	2
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
		if ( false === strpos( $args['widget_id'], 'inc2734_wp_awesome_widgets_slider' ) ) {
			return $content;
		}

		return str_replace(
			'wpaw-slider__item-more',
			'c-btn wpaw-slider__item-more',
			$content
		);
	},
	10,
	2
);
