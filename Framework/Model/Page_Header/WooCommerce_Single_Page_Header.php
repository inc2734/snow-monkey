<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

namespace Framework\Model\Page_Header;

use Framework\Contract\Model\Page_Header as Base;

class WooCommerce_Single_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	protected static function _get_image_url() {
		if ( ! in_array( get_theme_mod( 'woocommerce-single-eyecatch' ), static::$image_mods, true ) ) {
			return false;
		}

		if ( null === static::$image_id ) {
			static::$image_id = get_post_thumbnail_id();
		}

		if ( static::$image_id ) {
			return wp_get_attachment_image_url( static::$image_id, static::_get_thumbnail_size() );
		}

		return static::_get_default_image_url();
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		return in_array( get_theme_mod( 'woocommerce-single-eyecatch' ), static::$title_mods, true )
			? \Framework\Helper::get_page_title_from_breadcrumbs()
			: false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	protected static function _get_align() {
		return in_array( get_theme_mod( 'woocommerce-single-eyecatch' ), static::$title_mods, true )
			? get_theme_mod( 'woocommerce-single-page-header-align' )
			: false;
	}
}
