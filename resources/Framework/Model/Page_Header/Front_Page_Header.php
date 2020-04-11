<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.1.0
 */

namespace Framework\Model\Page_Header;

use Framework\Contract\Model\Page_Header as Base;

class Front_Page_Header extends Base {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get_image_url() {
		if ( get_theme_mod( 'home-page-display-page-header' ) ) {
			return Singular_Page_Header::get_image_url();
		}
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
