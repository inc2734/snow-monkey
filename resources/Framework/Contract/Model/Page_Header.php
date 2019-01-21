<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework\Contract\Model;

abstract class Page_Header {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	abstract public static function get_image_url();

	/**
	 * Return thumbnail size of page header image
	 *
	 * @return string
	 */
	protected static function _get_thumbnail_size() {
		return apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' );
	}

	/**
	 * Return page header image url for singular post
	 *
	 * @return string
	 */
	protected static function _get_singlular_image_url() {
		if ( has_post_thumbnail() ) {
			$thumbnail_id = get_post_thumbnail_id();
			if ( $thumbnail_id ) {
				return wp_get_attachment_image_url( $thumbnail_id, static::_get_thumbnail_size() );
			}
		}

		return static::_get_default_image_url();
	}

	/**
	 * Return default page header image url
	 *
	 * @return string
	 */
	protected static function _get_default_image_url() {
		return get_theme_mod( 'default-page-header-image' );
	}
}
