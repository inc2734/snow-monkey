<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

namespace Framework\Model\Page_Header;

use Framework\Helper;
use Framework\Contract\Model\Page_Header as Base;

class WooCommerce_Archive_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	protected static function _get_image_url() {
		return in_array( get_theme_mod( 'woocommerce-archive-eyecatch' ), static::$image_mods, true )
			? Helper::has_woocommerce_archive_thumbnail()
				? Helper::get_the_woocommerce_archive_thumbnail_url()
				: static::_get_default_image_url()
			: false;
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		return in_array( get_theme_mod( 'woocommerce-archive-eyecatch' ), static::$title_mods, true )
			? \Framework\Helper::get_page_title_from_breadcrumbs()
			: false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	protected static function _get_align() {
		return in_array( get_theme_mod( 'woocommerce-archive-eyecatch' ), static::$title_mods, true )
			? get_theme_mod( 'woocommerce-archive-page-header-align' )
			: false;
	}
}
