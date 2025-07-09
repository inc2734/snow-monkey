<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.1
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
	function ( $mce_init ) {
		if ( ! empty( $mce_init['classic_block_editor'] ) ) {
			return $mce_init;
		}

		if ( ! isset( $mce_init['content_style'] ) ) {
			$mce_init['content_style'] = '';
		}

		$response  = file_get_contents( get_template_directory() . '/assets/css/classic-editor/app.css' );
		$response .= file_get_contents( get_template_directory() . '/assets/css/classic-editor/app-theme.css' );
		if ( $response ) {
			$response = str_replace( array( "\n", "\r" ), '', $response );
			$response = str_replace( '"', '\\"', $response );

			$mce_init['content_style'] .= $response;
		}

		return $mce_init;
	}
);

add_action(
	'enqueue_block_assets',
	function () {
		if ( ! is_admin() ) {
			return;
		}

		$dependencies = Helper::generate_style_dependencies(
			array(
				'wp-block-library',
				'wp-share-buttons',
				'wp-like-me-box',
				'wp-oembed-blog-card',
				'wp-pure-css-gallery',
				'wp-awesome-widgets',
			)
		);
		$dependencies = array( 'wp-block-library' );

		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style(
			Helper::get_main_style_handle(),
			false,
			array(
				Helper::get_main_style_handle() . '-app',
				Helper::get_main_style_handle() . '-theme',
			)
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-app',
			get_theme_file_uri( '/assets/css/block-editor/blank.css' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/css/block-editor/blank.css' ) )
		);
		$css = file_get_contents( get_theme_file_path( '/assets/css/block-editor/app.css' ) );
		$css = str_replace(
			array(
				'html :where(.editor-styles-wrapper) :root',
			),
			':root',
			$css
		);
		$css = str_replace(
			array(
				'html :where(.editor-styles-wrapper) *',
			),
			'*',
			$css
		);
		$css = str_replace(
			array(
				'html :where(.editor-styles-wrapper) html',
			),
			'html',
			$css
		);
		$css = str_replace(
			array(
				'html :where(.editor-styles-wrapper) body',
				'html :where(.editor-styles-wrapper) :where(body)',
			),
			'html :where(.editor-styles-wrapper)',
			$css
		);
		$css = str_replace(
			array(
				'url(../../fonts/',
			),
			'url(' . get_theme_file_uri( '/assets/fonts/' ),
			$css
		);
		wp_add_inline_style(
			Helper::get_main_style_handle() . '-app',
			$css
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-theme',
			get_theme_file_uri( '/assets/css/block-editor/app-theme.css' ),
			array( Helper::get_main_style_handle() . '-app' ),
			filemtime( get_theme_file_path( '/assets/css/block-editor/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() );

		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style(
			Helper::get_main_style_handle() . '-block-library',
			false,
			array(
				Helper::get_main_style_handle() . '-block-library-app',
				Helper::get_main_style_handle() . '-block-library-theme',
			)
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-block-library-app',
			get_theme_file_uri( '/assets/css/block-library/editor.css' ),
			array( 'wp-block-library' ),
			filemtime( get_theme_file_path( '/assets/css/block-library/editor.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-block-library-theme',
			get_theme_file_uri( '/assets/css/block-library/editor-theme.css' ),
			array( Helper::get_main_style_handle() . '-block-library-app' ),
			filemtime( get_theme_file_path( '/assets/css/block-library/editor-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-block-library' );

		// @todo WordPress 5.9 iframed content hack.
		// https://github.com/WordPress/gutenberg/blob/f2161e246b9fdd9a2a56e7552b0b28050f1a5302/packages/block-editor/src/components/iframe/index.js#L70-L74
		if ( ! wp_style_is( 'spider', 'registered' ) ) {
			wp_enqueue_style(
				'spider',
				get_theme_file_uri( '/assets/css/block-editor/spider.css' ),
				array(),
				filemtime( get_theme_file_path( '/assets/css/block-editor/spider.css' ) )
			);
		}

		$asset = include get_theme_file_path( '/assets/js/editor.asset.php' );
		wp_enqueue_script(
			Helper::get_main_style_handle() . '-block-editor',
			get_theme_file_uri( '/assets/js/editor.js' ),
			$asset['dependencies'],
			filemtime( get_theme_file_path( '/assets/js/editor.js' ) ),
			array(
				'strategy'  => 'defer',
				'in_footer' => false,
			)
		);
	}
);

/**
 * Override global styles.
 */
add_filter(
	'block_editor_settings_all',
	function ( $editor_settings ) {
		if ( ! isset( $editor_settings['styles'] ) || ! is_array( $editor_settings['styles'] ) ) {
			$editor_settings['styles'] = array();
		}

		$editor_settings['styles'][] = array(
			'css'            => file_get_contents( get_theme_file_path( 'assets/css/global-styles/app.css' ) ), // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			'__unstableType' => 'theme',
			'isGlobalStyles' => false,
		);

		$editor_settings['styles'][] = array(
			'css'            => file_get_contents( get_theme_file_path( 'assets/css/global-styles/app-theme.css' ) ), // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			'__unstableType' => 'theme',
			'isGlobalStyles' => false,
		);

		return $editor_settings;
	}
);

/**
 * Support align-wide
 */
add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'align-wide' );
	}
);

/**
 * Deregister wp-block-library-theme
 */
add_action(
	'enqueue_block_assets',
	function () {
		if ( ! is_admin() ) {
			return;
		}

		wp_deregister_style( 'wp-block-library-theme' );
		wp_register_style( 'wp-block-library-theme', null, array(), 1 );
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
	function ( $classes ) {
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
	}
);
