<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

namespace Framework\Model\Page_Header;

use Framework\Helper;
use Framework\Contract\Model\Page_Header as Base;

class WooCommerce_Product_Category_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	protected static function _get_image_url() {
		if ( is_product_category() ) {
			if ( in_array( get_theme_mod( 'woocommerce-archive-eyecatch' ), static::$image_mods, true ) ) {
				if ( Helper::has_term_thumbnail() ) {
					return Helper::get_the_term_thumbnail_url();
				} elseif ( Helper::has_woocommerce_archive_thumbnail() ) {
					return Helper::get_the_woocommerce_archive_thumbnail_url();
				}
				return static::_get_default_image_url();
			}
		}

		return false;
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		if ( is_product_category() ) {
			return in_array( get_theme_mod( 'woocommerce-archive-eyecatch' ), static::$title_mods, true )
				? \Framework\Helper::get_page_title_from_breadcrumbs()
				: false;
		}

		return false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	protected static function _get_align() {
		if ( is_product_category() ) {
			return in_array( get_theme_mod( 'woocommerce-archive-eyecatch' ), static::$title_mods, true )
				? get_theme_mod( 'archive-' . get_post_type() . '-page-header-align' )
				: false;
		}

		return false;
	}
}
