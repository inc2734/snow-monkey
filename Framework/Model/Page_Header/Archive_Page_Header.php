<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

namespace Framework\Model\Page_Header;

use Framework\Helper;
use Framework\Contract\Model\Page_Header as Base;

class Archive_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	protected static function _get_image_url() {
		if ( ! in_array( get_theme_mod( 'archive-eyecatch' ), static::$image_mods, true ) ) {
			return false;
		}

		return Helper::has_homepage_thumbnail()
			? Helper::get_the_homepage_thumbnail_url( static::_get_thumbnail_size() )
			: static::_get_default_image_url();
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		return in_array( get_theme_mod( 'archive-eyecatch' ), static::$title_mods, true )
			? \Framework\Helper::get_page_title_from_breadcrumbs()
			: false;
	}
}
