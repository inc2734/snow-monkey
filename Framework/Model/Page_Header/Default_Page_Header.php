<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.1.0
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

	/**
	 * Return true when should display page header image
	 *
	 * @return boolean
	 */
	public static function is_display_image() {
		return static::get_the_image() ? true : false;
	}

	/**
	 * Return true when should display page header title
	 *
	 * @return boolean
	 */
	public static function is_display_title() {
		return false;
	}
}
