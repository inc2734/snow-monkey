<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 */

use Framework\Helper;

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Fire the wp_body_open action.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_body_open/
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Add .p-entry-content to .c-entry__content
 *
 * @param string $content
 * @param string $slug
 * @return string
 */
add_filter(
	'inc2734_wp_view_controller_template_part_render',
	function( $content, $slug ) {
		if ( 'templates/view/content' === $slug ) {
			$content = str_replace( 'class="c-entry__content"', 'class="c-entry__content p-entry-content"', $content );
		}
		return $content;
	},
	10,
	2
);

/**
 * Backward compatibility for Awesome Components
 *
 * @param string $content
 * @return string
 */
add_filter(
	'the_content',
	function( $content ) {
		$content = str_replace( 'wpac-section ', 'c-section wpac-section ', $content );
		$content = str_replace( 'wpac-section__body', 'wpac-section__body p-entry-content', $content );
		$content = str_replace( 'wpac-columns__col-inner', 'wpac-columns__col-inner p-entry-content', $content );
		$content = str_replace( 'wpac-section__container', 'c-container', $content );
		$content = str_replace( 'wpac-btn', 'wpac-btn c-btn', $content );
		return $content;
	}
);

/**
 * Backward compatibility for contents outline
 */
add_action(
	'snow_monkey_after_entry_content',
	function() {
		if ( ! apply_filters( 'snow_monkey_display_contents_outline', false ) ) {
			return;
		}

		$vars = [
			'_title' => __( 'Contents outline', 'snow-monkey' ),
		];
		Helper::get_template_part( 'template-parts/content/contents-outline', null, $vars );
	}
);

/**
 * Backward compatibility for child pages
 */
add_action(
	'snow_monkey_after_entry_content',
	function() {
		if ( ! is_singular() ) {
			return;
		}

		$pages_query = Helper::get_child_pages_query( get_the_ID() );
		if ( ! $pages_query->have_posts() ) {
			return;
		}

		if ( ! apply_filters( 'snow_monkey_display_child_pages', false ) ) {
			return;
		}

		$vars = [
			'_title' => __( 'Child pages', 'snow-monkey' ),
		];
		Helper::get_template_part( 'template-parts/content/child-pages', null, $vars );
	}
);

/**
 * Backward compatibility for archive-layout
 */
add_filter(
	'theme_mod_post-entries-layout',
	function( $mod ) {
		if ( ! $mod || ! is_string( $mod ) ) {
			$mod = get_theme_mod( 'archive-layout' );
			set_theme_mod( 'post-entries-layout', $mod );
		}
		return $mod;
	},
	9
);

/**
 * Backward compatibility for archive-post-layout
 */
add_filter(
	'theme_mod_archive-post-layout',
	function( $mod ) {
		if ( ! $mod || ! is_string( $mod ) ) {
			$mod = get_theme_mod( 'archive-page-layout' );
			set_theme_mod( 'archive-post-layout', $mod );
		}
		return $mod;
	},
	9
);

/**
 * Backward compatibility for post-layout
 */
add_filter(
	'theme_mod_post-layout',
	function( $mod ) {
		if ( ! $mod || ! is_string( $mod ) ) {
			$mod = get_theme_mod( 'singular-post-layout' );
			set_theme_mod( 'post-layout', $mod );
		}
		return $mod;
	},
	9
);

/**
 * Fallback layout template
 *
 * @param null|null $fallback_slug
 * @param array $relative_dir_paths
 * @return string
 */
add_filter(
	'inc2734_wp_view_controller_located_template_slug_fallback',
	function( $fallback_slug, $relative_dir_paths ) {
		if ( $fallback_slug ) {
			return $fallback_slug;
		}

		if ( ! in_array( 'templates/layout/wrapper', $relative_dir_paths, true ) ) {
			return $fallback_slug;
		}

		if ( is_front_page() && ! is_home() ) {
			return 'templates/layout/wrapper/one-column-full';
		}

		if ( is_singular() ) {
			return 'templates/layout/wrapper/right-sidebar';
		}

		if ( ! is_singular() ) {
			return 'templates/layout/wrapper/one-column';
		}

		return $fallback_slug;
	},
	9,
	2
);
