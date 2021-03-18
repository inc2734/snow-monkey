<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

namespace Framework\Model\Page_Header;

use Framework\Helper\Page_Header\Singular_Page_Header as Page_Header_Helper;
use Framework\Contract\Model\Page_Header as Base;

class Front_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	protected static function _get_image_url() {
		return get_theme_mod( 'home-page-display-page-header' )
			? Page_Header_Helper::get_image_url( get_post() )
			: false;
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		return get_theme_mod( 'home-page-display-page-header' )
			? Page_Header_Helper::get_title( get_post() )
			: false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	protected static function _get_align() {
		return get_theme_mod( 'home-page-display-page-header' )
			? Page_Header_Helper::get_align( get_post() )
			: false;
	}
}
