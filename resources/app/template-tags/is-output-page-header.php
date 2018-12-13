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

	if ( snow_monkey_is_output_page_header_title() ) {
		$return = true;
	} elseif ( snow_monkey_get_page_header_image_url() ) {
		$return = true;
	}

	return apply_filters( 'snow_monkey_is_output_page_header', $return );
}
