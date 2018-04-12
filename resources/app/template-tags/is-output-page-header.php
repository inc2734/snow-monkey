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
	$return    = false;
	$image_url = \Snow_Monkey\app\model\Page_Header_Image_Url::get();
	$valid_choices = [ 'page-header', 'title-on-page-header' ];

	if ( is_front_page() ) {
		$return = false;
	} elseif ( is_singular( 'post' ) && in_array( get_theme_mod( 'post-eyecatch' ), $valid_choices ) && $image_url ) {
		$return = true;
	} elseif ( is_page() && in_array( get_theme_mod( 'page-eyecatch' ), $valid_choices ) && $image_url ) {
		$return = true;
	} elseif ( ! is_singular() && $image_url ) {
		$return = true;
	} elseif ( snow_monkey_is_output_page_header_title() ) {
		$return = true;
	}

	return apply_filters( 'snow_monkey_is_output_page_header', $return );
}
