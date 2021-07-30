<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

namespace Framework\Model\Page_Header;

use Framework\Helper\Page_Header\Singular_Page_Header as Page_Header_Helper;
use Framework\Contract\Model\Page_Header as Base;

class Front_Page_Header extends Base {

	/**
	 * Return page header image html.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	protected static function _get_image( $size = 'large' ) {
		return get_theme_mod( 'home-page-display-page-header' )
			? Page_Header_Helper::get_image( get_post(), $size )
			: false;
	}

	/**
	 * Return page header image url.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	protected static function _get_image_url( $size = 'large' ) {
		return get_theme_mod( 'home-page-display-page-header' )
			? Page_Header_Helper::get_image_url( get_post(), $size )
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

	/**
	 * Return page header image caption.
	 *
	 * @return string|false
	 */
	protected static function _get_image_caption() {
		return get_theme_mod( 'home-page-display-page-header' )
			? Page_Header_Helper::get_image_caption( get_post() )
			: false;
	}
}
