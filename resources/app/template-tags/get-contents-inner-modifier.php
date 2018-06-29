<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return .l-contents__inner modifier class
 *
 * @return string
 */
function snow_monkey_get_contents_inner_modifier() {
	if ( ! in_array( get_theme_mod( 'breadcrumbs-position' ), [ 'default', 'content-width' ] ) ) {
		if ( is_archive() || is_home() || is_search() ) {
			return 'l-contents__inner--no-top-margin';
		}
	}

	if ( is_front_page() && ! is_home() ) {
		$wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

		if ( false !== strpos( $wp_page_template, 'one-column' ) ) {
			return 'l-contents__inner--no-top-margin l-contents__inner--no-bottom-margin';
		}
	}
}
