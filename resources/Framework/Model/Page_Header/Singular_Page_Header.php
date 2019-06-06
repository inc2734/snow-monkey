<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.3.4
 */

namespace Framework\Model\Page_Header;

use Framework\Contract\Model\Page_Header as Base;

class Singular_Page_Header extends Base {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get_image_url() {
		if ( has_post_thumbnail() ) {
			$thumbnail_id = get_post_thumbnail_id();
			if ( $thumbnail_id ) {
				return wp_get_attachment_image_url( $thumbnail_id, static::_get_thumbnail_size() );
			}
		}

		return static::_get_default_image_url();
	}
}
