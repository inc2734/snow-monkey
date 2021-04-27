<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 */

use Inc2734\WP_Custom_CSS_To_Editor;
use Framework\Helper;

/**
 * Custom CSS apply to editor
 */
new WP_Custom_CSS_To_Editor\Bootstrap();

/**
 * Support editor styles
 *
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'editor-styles' );
		$stylesheet = [ 'assets/css/editor-style.min.css' ];
		add_editor_style( $stylesheet );
	}
);

/**
 * Support align-wide
 *
 * @var void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'align-wide' );
	}
);

/**
 * Deregister wp-block-library-theme
 *
 * @var void
 */
add_action(
	'enqueue_block_editor_assets',
	function() {
		wp_deregister_style( 'wp-block-library-theme' );
		wp_register_style( 'wp-block-library-theme', null, [], 1 );
	}
);

/**
 * Color palette
 *
 * @var void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support(
			'editor-color-palette',
			Helper::get_color_palette()
		);
	}
);

/**
 * Add class by template
 *
 * @param string $classes
 * @return string
 */
add_filter(
	'admin_body_class',
	function( $classes ) {
		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return $classes;
		}

		$wp_page_template = get_post_meta( $post_id, '_wp_page_template', true );
		$wp_page_template = basename( $wp_page_template );
		$wp_page_template = pathinfo( $wp_page_template, PATHINFO_FILENAME );
		$page_on_front    = get_option( 'page_on_front' );
		$is_home_page     = (int) $page_on_front === (int) $post_id;

		if ( $wp_page_template && 'default' !== $wp_page_template ) {
			if ( $is_home_page && 'one-column-full' === $wp_page_template ) {
				return $classes . ' l-body--one-column';
			}

			return $classes . ' l-body--' . $wp_page_template;
		}

		if ( $is_home_page ) {
			return get_theme_mod( 'home-page-container' )
				? $classes . ' l-body--one-column'
				: $classes . ' l-body--one-column-full';
		}

		$_post_type = get_post_type( $post_id );

		$layout = get_theme_mod( $_post_type . '-layout' );
		$layout = $layout ? $layout : get_theme_mod( 'post-layout' );

		return $classes . ' l-body--' . $layout;

		return $classes;
	}
);
