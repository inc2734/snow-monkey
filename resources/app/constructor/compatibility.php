<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

if ( ! function_exists( 'wp_body_open' ) ) {
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
	'inc2734_view_controller_template_part_render',
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

		Helper::get_template_part( 'template-parts/content/contents-outline' );
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

		Helper::get_template_part( 'template-parts/content/child-pages' );
	}
);

/**
 * Backward compatibility for archive-layout
 */
add_filter(
	'theme_mod_post-entries-layout',
	function( $mod ) {
		if ( ! $mod || ! is_string( $mod ) ) {
			return get_theme_mod( 'archive-layout' );
		}
		return $mod;
	},
	9
);
