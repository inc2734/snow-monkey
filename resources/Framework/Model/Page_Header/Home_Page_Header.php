<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.2
 */

namespace Framework\Model\Page_Header;

use Framework\Contract\Model\Page_Header as Base;

class Home_Page_Header extends Base {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get_image_url() {
		if ( 'page' === get_option( 'show_on_front' ) ) {
			$thumbnail_id = get_post_thumbnail_id( get_option( 'page_for_posts' ) );
			if ( $thumbnail_id ) {
				return wp_get_attachment_image_url( $thumbnail_id, static::_get_thumbnail_size() );
			}
		}

		return static::_get_default_image_url();
	}
}
