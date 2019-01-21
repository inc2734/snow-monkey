<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework\Model\Page_Header;

use Framework\Contract\Model\Page_Header as Base;

class Page_Page_Header extends Base {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get_image_url() {
		$valid_choices = [ 'page-header', 'title-on-page-header' ];
		if ( ! is_page() || is_front_page() || ! in_array( get_theme_mod( 'page-eyecatch' ), $valid_choices ) ) {
			return;
		}

		return static::_get_singlular_image_url();
	}
}
