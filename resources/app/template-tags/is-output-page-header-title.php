<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return whether to display the page header title
 *
 * @return boolean
 */
function snow_monkey_is_output_page_header_title() {
	$return = false;

	if ( is_page() && ! is_front_page() && 'title-on-page-header' === get_theme_mod( 'page-eyecatch' ) ) {
		$return = true;
	} elseif ( is_singular( 'post' ) && 'title-on-page-header' === get_theme_mod( 'post-eyecatch' ) ) {
		$return = true;
	}

	return apply_filters( 'snow_monkey_is_output_page_header_title', $return );
}
