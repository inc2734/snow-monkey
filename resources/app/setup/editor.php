<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.3.4
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
		if ( $wp_page_template ) {
			return $classes . ' l-body--' . $wp_page_template;
		}

		$_post_type_object = get_post_type_object( get_post_type( $post_id ) );

		if ( ! empty( $_post_type_object->hierarchical ) ) {
			$layout = get_theme_mod( 'page-layout' );
		}

		if ( empty( $layout ) ) {
			$layout = get_theme_mod( 'singular-post-layout' );
		}

		return $classes . ' l-body--' . $layout;

		return $classes;
	}
);

/**
 * Set editor width by using template
 */
add_action(
	'admin_head',
	function() {
		?>
		<style>
		.l-body--one-column-slim .editor-styles-wrapper .wp-block,
		.l-body--blank-slim .editor-styles-wrapper .wp-block {
			--wp-bock-width: 46em;
		}

		.l-body--right-sidebar .editor-styles-wrapper .wp-block,
		.l-body--left-sidebar .editor-styles-wrapper .wp-block {
			max-width: calc(var(--wp-bock-width) - 336px);
		}
		</style>
		<?php
	}
);
