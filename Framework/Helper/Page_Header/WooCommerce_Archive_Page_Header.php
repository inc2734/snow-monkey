<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

namespace Framework\Helper\Page_Header;

use Framework\Helper;
use Framework\Contract\Helper\Page_Header\Page_Header as Base;

class WooCommerce_Archive_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @param WP_Post_Type $wp_post_type WP_Post_Type object.
	 * @return string|false
	 */
	protected static function _get_image_url( $wp_post_type ) {
		if ( ! is_a( $wp_post_type, '\WP_Post_Type' ) ) {
			return false;
		}

		if ( 'product' !== $wp_post_type->name ) {
			return false;
		}

		return Helper::has_woocommerce_archive_thumbnail()
			? Helper::get_the_woocommerce_archive_thumbnail_url()
			: static::_get_default_image_url();
	}

	/**
	 * Return page header title.
	 *
	 * @param WP_Post_Type $wp_post_type WP_Post_Type object.
	 * @return string|false
	 */
	protected static function _get_title( $wp_post_type ) {
		if ( ! is_a( $wp_post_type, '\WP_Post_Type' ) ) {
			return false;
		}

		if ( 'product' !== $wp_post_type->name ) {
			return false;
		}

		return Helper::get_page_title_from_breadcrumbs();
	}

	/**
	 * Return page header alignment.
	 *
	 * @param WP_Post_Type $wp_post_type WP_Post_Type object.
	 * @return string|false
	 */
	protected static function _get_align( $wp_post_type ) {
		if ( ! is_a( $wp_post_type, '\WP_Post_Type' ) ) {
			return false;
		}

		if ( 'product' !== $wp_post_type->name ) {
			return false;
		}

		return get_theme_mod( 'woocommerce-archive-page-header-align' );
	}
}
