<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return whether to display the page header
 *
 * @return boolean
 */
function snow_monkey_is_output_page_header() {
	$return = false;

	if ( is_front_page() ) {
		$return = false;
	} elseif ( is_page() && 'page-header' === get_theme_mod( 'page-eyecatch' ) ) {
		$return = true;
	} elseif ( is_singular( 'post' ) && 'page-header' === get_theme_mod( 'post-eyecatch' ) ) {
		$return = true;
	} elseif ( snow_monkey_is_output_page_header_title() ) {
		$return = true;
	} elseif ( ! is_singular() ) {
		$return = true;
	}

	return apply_filters( 'snow_monkey_is_output_page_header', $return );
}
