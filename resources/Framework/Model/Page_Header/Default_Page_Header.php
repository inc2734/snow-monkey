<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework\Model\Page_Header;

use Framework\Contract\Model\Page_Header as Base;

class Default_Page_Header extends Base {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get_image_url() {
		return static::_get_default_image_url();
	}
}
