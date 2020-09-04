<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.1.0
 */

namespace Framework\Model\Page_Header;

use Framework\Contract\Model\Page_Header as Base;

class WooCommerce_Single_Page_Header extends Base {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get_image_url() {
		if ( has_post_thumbnail() ) {
			$thumbnail_id = get_post_thumbnail_id();
			if ( $thumbnail_id ) {
				return wp_get_attachment_image_url( $thumbnail_id, static::_get_thumbnail_size() );
			}
		}

		return static::_get_default_image_url();
	}

	/**
	 * Return true when should display page header image
	 *
	 * @return boolean
	 */
	public static function is_display_image() {
		$should_display = in_array( get_theme_mod( 'woocommerce-single-eyecatch' ), static::$image_mods );
		return $should_display && static::get_the_image() ? true : false;
	}

	/**
	 * Return true when should display page header title
	 *
	 * @return boolean
	 */
	public static function is_display_title() {
		return in_array( get_theme_mod( 'woocommerce-single-eyecatch' ), static::$title_mods );
	}
}
