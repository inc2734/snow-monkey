<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

namespace Framework\Model\Page_Header;

use Framework\Helper;
use Framework\Contract\Model\Page_Header as Base;

class Archive_Page_Header extends Base {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get_image_url() {
		if ( Helper::has_homepage_thumbnail() ) {
			return Helper::get_the_homepage_thumbnail_url( static::_get_thumbnail_size() );
		}

		return static::_get_default_image_url();
	}

	/**
	 * Return true when should display page header image
	 *
	 * @return boolean
	 */
	public static function is_display_image() {
		$should_display = in_array( get_theme_mod( 'archive-eyecatch' ), static::$image_mods, true );
		return $should_display && static::get_the_image() ? true : false;
	}

	/**
	 * Return true when should display page header title
	 *
	 * @return boolean
	 */
	public static function is_display_title() {
		return in_array( get_theme_mod( 'archive-eyecatch' ), static::$title_mods, true );
	}
}
