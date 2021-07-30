<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

namespace Framework\Model\Page_Header;

use Framework\Helper;
use Framework\Helper\Page_Header\WooCommerce_Term_Page_Header as Page_Header_Helper;
use Framework\Contract\Model\Page_Header as Base;

class WooCommerce_Term_Page_Header extends Base {

	/**
	 * Return page header image html.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	protected static function _get_image( $size = 'large' ) {
		$_term             = get_queried_object();
		$eyecatch_position = get_theme_mod( 'woocommerce-archive-eyecatch' );

		return in_array( $eyecatch_position, static::$image_mods, true )
			? Page_Header_Helper::get_image( $_term, $size )
			: false;
	}

	/**
	 * Return page header image url.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	protected static function _get_image_url( $size = 'large' ) {
		$_term             = get_queried_object();
		$eyecatch_position = get_theme_mod( 'woocommerce-archive-eyecatch' );

		return in_array( $eyecatch_position, static::$image_mods, true )
			? Page_Header_Helper::get_image_url( $_term, $size )
			: false;
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		$_term             = get_queried_object();
		$eyecatch_position = get_theme_mod( 'woocommerce-archive-eyecatch' );

		return in_array( $eyecatch_position, static::$title_mods, true )
			? Page_Header_Helper::get_title( $_term )
			: false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	protected static function _get_align() {
		$_term             = get_queried_object();
		$eyecatch_position = get_theme_mod( 'woocommerce-archive-eyecatch' );

		return in_array( $eyecatch_position, static::$title_mods, true )
			? Page_Header_Helper::get_align( $_term )
			: false;
	}

	/**
	 * Return page header image caption.
	 *
	 * @return string|false
	 */
	protected static function _get_image_caption() {
		$_term             = get_queried_object();
		$eyecatch_position = get_theme_mod( 'woocommerce-archive-eyecatch' );

		return in_array( $eyecatch_position, static::$image_mods, true )
			? Page_Header_Helper::get_image_caption( $_term )
			: false;
	}
}
