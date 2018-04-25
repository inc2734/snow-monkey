<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\app\model\Page_Header_Image_Url;

/**
 * Returns page header image url
 *
 * @return string
 */
function snow_monkey_get_page_header_image_url() {
	$url = apply_filters( 'snow_monkey_pre_page_header_image_url', null );
	if ( $url ) {
		return $url;
	}

	$url = Page_Header_Image_Url::get();

	return apply_filters( 'snow_monkey_page_header_image_url', $url );
}
