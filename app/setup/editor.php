<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.11
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
				'html :where(.editor-styles-wrapper) :where(',
			),
			':where(',
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
 * Determine wrapper/body layout classes for a given post.
 *
 * This function resolves the layout class based on:
 * - Assigned page template (`_wp_page_template`)
 * - Whether the post is the front page
 * - Theme layout settings per post type or fallback layout
 *
 * It is intentionally designed to return **only the classes to be added**,
 * without handling or mutating any existing body class string.
 *
 * The returned value is shared by:
 * - admin_body_class (non-iframe admin screens)
 * - block editor iframe (editor-canvas)
 *
 * @param int $post_id Post ID.
 * @return string[] List of wrapper/body classes to add. Empty array if none.
 */
function snow_monkey_get_wrapper_layout_classes_for_post( $post_id ) {
	$post_id = (int) $post_id;
	if ( ! $post_id ) {
		return array();
	}

	$wp_page_template = (string) get_post_meta( $post_id, '_wp_page_template', true );
	$wp_page_template = pathinfo( basename( $wp_page_template ), PATHINFO_FILENAME );

	$page_on_front = (int) get_option( 'page_on_front' );
	$is_home_page  = $page_on_front === $post_id;

	$class = '';

	if ( $wp_page_template && 'default' !== $wp_page_template ) {
		if ( $is_home_page && 'one-column-full' === $wp_page_template ) {
			$class = 'l-body--one-column';
		} else {
			$class = 'l-body--' . $wp_page_template;
		}
	} elseif ( $is_home_page ) {
		$class = get_theme_mod( 'home-page-container' )
			? 'l-body--one-column'
			: 'l-body--one-column-full';
	} else {
		$_post_type = get_post_type( $post_id );

		$layout = get_theme_mod( $_post_type . '-layout' );
		$layout = $layout ? $layout : get_theme_mod( 'post-layout' );

		$class = 'l-body--' . $layout;
	}

	$class = $class ? sanitize_html_class( $class ) : '';

	return $class ? array( $class ) : array();
}

/**
 * Append wrapper layout classes to the admin (non-iframe) <body> element.
 *
 * Uses the admin_body_class filter to **extend** existing admin body classes
 * without overwriting core or plugin-provided classes.
 *
 * If the current screen does not have a valid post context,
 * the original class list is returned unchanged.
 *
 * @param string $classes Existing admin body class string.
 * @return string Modified body class string.
 */
add_filter(
	'admin_body_class',
	function ( $classes ) {
		$post_id = isset( $GLOBALS['post']->ID ) ? (int) $GLOBALS['post']->ID : 0;
		$to_add  = snow_monkey_get_wrapper_layout_classes_for_post( $post_id );

		if ( ! $to_add ) {
			return $classes;
		}

		return trim( $classes . ' ' . implode( ' ', $to_add ) );
	}
);

/**
 * Inject and persist wrapper layout classes inside the block editor iframe.
 *
 * The Gutenberg editor may recreate or replace the iframe <body> element
 * during state updates, which can remove previously added classes.
 *
 * This function:
 * - Targets the block editor only (editor-canvas iframe)
 * - Injects a MutationObserver into the iframe document
 * - Reapplies layout classes whenever the body element or its class list changes
 *
 * This ensures layout-dependent CSS (e.g. content width variables)
 * remains consistent while editing.
 *
 * @return void
 */
function snow_monkey_add_wrapper_layout_class_for_iframe_editor() {
	if ( ! is_admin() || ! function_exists( 'get_current_screen' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( ! $screen || empty( $screen->is_block_editor ) || ! $screen->is_block_editor() ) {
		return;
	}

	$post_id = isset( $GLOBALS['post']->ID ) ? (int) $GLOBALS['post']->ID : 0;
	$classes = snow_monkey_get_wrapper_layout_classes_for_post( $post_id );
	if ( ! $classes ) {
		return;
	}

	$version = wp_get_theme()->get( 'Version' );
	wp_register_script( 'snow-monkey-iframe-editor-class', false, array(), $version, true );
	wp_enqueue_script( 'snow-monkey-iframe-editor-class' );

	wp_add_inline_script(
		'snow-monkey-iframe-editor-class',
		'(function() {
			// Prevent multiple observers from being attached.
			if (window.__smIframeBodyClassObserverAttached) return;
			window.__smIframeBodyClassObserverAttached = true;

			const classesToAdd = ' . wp_json_encode( array_values( $classes ) ) . ';

			function addClasses(body) {
				let changed = false;
				for (const c of classesToAdd) {
					if (!c) continue;
					if (!body.classList.contains(c)) {
						body.classList.add(c);
						changed = true;
					}
				}
				return changed;
			}

			function attachObservers(iframe) {
				if (!iframe || !iframe.contentDocument) return;

				const doc = iframe.contentDocument;

				let rafScheduled = false;
				const scheduleApply = () => {
					if (rafScheduled) return;
					rafScheduled = true;
					requestAnimationFrame(() => {
						rafScheduled = false;
						if (doc.body) addClasses(doc.body);
					});
				};

				// Apply once when possible.
				if (doc.body) addClasses(doc.body);

				// 1) Observe body class only (low frequency compared to subtree-wide).
				let bodyObserver = null;
				const observeBody = () => {
					if (!doc.body) return;

					if (bodyObserver) {
						bodyObserver.disconnect();
					}

					bodyObserver = new MutationObserver(() => {
						// If classes were removed/replaced, reapply (debounced).
						scheduleApply();
					});

					bodyObserver.observe(doc.body, {
						attributes: true,
						attributeFilter: ["class"],
					});
				};

				observeBody();

				// 2) Detect body replacement (do NOT observe attributes on the whole subtree).
				const structureObserver = new MutationObserver(() => {
					// Body may have been replaced; rebind body observer and reapply.
					observeBody();
					scheduleApply();
				});

				structureObserver.observe(doc.documentElement, {
					childList: true,
					subtree: false, // only direct children of <html>
				});

				// 3) Handle iframe reloads.
				iframe.addEventListener("load", () => {
					// Re-attach after reload.
					try {
						attachObservers(iframe);
					} catch (e) {}
				}, { passive: true });
			}

			let rafCount = 0;
			function waitForIframe() {
				const iframe = document.querySelector(\'iframe[name="editor-canvas"]\');
				if (iframe && iframe.contentDocument) {
					attachObservers(iframe);
					return;
				}

				// Fail-safe: stop after ~10 seconds.
				rafCount++;
				if (rafCount > 600) return;

				requestAnimationFrame(waitForIframe);
			}

			waitForIframe();
		})();',
		'after'
	);
}
add_action( 'enqueue_block_editor_assets', 'snow_monkey_add_wrapper_layout_class_for_iframe_editor' );
