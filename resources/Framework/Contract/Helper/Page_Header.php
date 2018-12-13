<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework\Contract\Helper;

use Framework\Model\Page_Header_Image_Url;

trait Page_Header {

	/**
	 * Returns page header image url
	 *
	 * @return string
	 */
	public static function get_page_header_image_url() {
		$url = apply_filters( 'snow_monkey_pre_page_header_image_url', null );
		if ( $url ) {
			return $url;
		}

		$url = Page_Header_Image_Url::get();

		return apply_filters( 'snow_monkey_page_header_image_url', $url );
	}

	/**
	 * Return whether to display the page header title
	 *
	 * @return boolean
	 */
	public static function is_output_page_header_title() {
		$return = false;

		if ( is_page() && ! is_front_page() && 'title-on-page-header' === get_theme_mod( 'page-eyecatch' ) ) {
			$return = true;
		} elseif ( is_singular( 'post' ) && 'title-on-page-header' === get_theme_mod( 'post-eyecatch' ) ) {
			$return = true;
		}

		return apply_filters( 'snow_monkey_is_output_page_header_title', $return );
	}

	/**
	 * Return whether to display the page header
	 *
	 * @return boolean
	 */
	public static function is_output_page_header() {
		$return = false;

		if ( static::is_output_page_header_title() ) {
			$return = true;
		} elseif ( static::get_page_header_image_url() ) {
			$return = true;
		}

		return apply_filters( 'snow_monkey_is_output_page_header', $return );
	}
}
