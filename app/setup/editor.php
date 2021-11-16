<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.15.0
 */

use Inc2734\WP_Custom_CSS_To_Editor;
use Framework\Helper;

/**
 * Custom CSS apply to editor
 */
new WP_Custom_CSS_To_Editor\Bootstrap();

/**
 * Support editor styles
 */
add_filter(
	'tiny_mce_before_init',
	function( $mce_init ) {
		if ( ! empty( $mce_init['classic_block_editor'] ) ) {
			return $mce_init;
		}

		if ( ! isset( $mce_init['content_style'] ) ) {
			$mce_init['content_style'] = '';
		}

		$response  = file_get_contents( get_template_directory() . '/assets/css/classic-editor/app.css' );
		$response .= file_get_contents( get_template_directory() . '/assets/css/classic-editor/app-theme.css' );
		if ( $response ) {
			$response = str_replace( [ "\n", "\r" ], '', $response );
			$response = str_replace( '"', '\\"', $response );

			$mce_init['content_style'] .= $response;
		}

		return $mce_init;
	}
);

add_action(
	'enqueue_block_editor_assets',
	function() {
		$dependencies = Helper::generate_style_dependencies(
			[
				'wp-block-library',
				'wp-share-buttons',
				'wp-like-me-box',
				'wp-oembed-blog-card',
				'wp-pure-css-gallery',
				'wp-awesome-widgets',
			]
		);

		wp_register_style(
			Helper::get_main_style_handle(),
			false,
			[
				Helper::get_main_style_handle() . '-app',
				Helper::get_main_style_handle() . '-theme',
			]
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-app',
			get_theme_file_uri( '/assets/css/block-editor/app.css' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/css/block-editor/app.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-theme',
			get_theme_file_uri( '/assets/css/block-editor/app-theme.css' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/css/block-editor/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() );

		wp_register_style(
			Helper::get_main_style_handle() . '-block-library',
			false,
			[
				Helper::get_main_style_handle() . '-block-library-app',
				Helper::get_main_style_handle() . '-block-library-theme',
			]
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-block-library-app',
			get_theme_file_uri( '/assets/css/block-library/editor.css' ),
			[ 'wp-block-library' ],
			filemtime( get_theme_file_path( '/assets/css/block-library/editor.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-block-library-theme',
			get_theme_file_uri( '/assets/css/block-library/editor-theme.css' ),
			[ Helper::get_main_style_handle() . '-block-library-app' ],
			filemtime( get_theme_file_path( '/assets/css/block-library/editor-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-block-library' );
	}
);

/**
 * Support align-wide
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'align-wide' );
	}
);

/**
 * Deregister wp-block-library-theme
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
 * Font sizes
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support(
			'editor-font-sizes',
			Helper::get_font_sizes()
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
