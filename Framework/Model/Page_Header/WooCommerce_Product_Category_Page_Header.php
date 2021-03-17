<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

namespace Framework\Model\Page_Header;

use Framework\Helper;
use Framework\Helper\Page_Header\WooCommerce_Taxonomy_Page_Header as Page_Header_Helper;
use Framework\Contract\Model\Page_Header as Base;

class WooCommerce_Product_Category_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	protected static function _get_image_url() {
		return Page_Header_Helper::get_image_url( get_queried_object() );
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		return Page_Header_Helper::get_title( get_queried_object() );
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	protected static function _get_align() {
		return Page_Header_Helper::get_align( get_queried_object() );
	}
}
