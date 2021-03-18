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

class WooCommerce_Single_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @param WP_Post $wp_post WP_Post object.
	 * @return string|false
	 */
	protected static function _get_image_url( $wp_post ) {
		if ( ! is_a( $wp_post, '\WP_Post' ) ) {
			return false;
		}

		if ( 'product' !== get_post_type( $wp_post ) ) {
			return false;
		}

		return has_post_thumbnail()
			? wp_get_attachment_image_url( get_post_thumbnail_id( $wp_post ), static::_get_thumbnail_size() )
			: static::_get_default_image_url();
	}

	/**
	 * Return page header title.
	 *
	 * @param WP_Post $wp_post WP_Post object.
	 * @return string|false
	 */
	protected static function _get_title( $wp_post ) {
		if ( ! is_a( $wp_post, '\WP_Post' ) ) {
			return false;
		}

		if ( 'product' !== get_post_type( $wp_post ) ) {
			return false;
		}

		return Helper::get_page_title_from_breadcrumbs();
	}

	/**
	 * Return page header alignment.
	 *
	 * @param WP_Post $wp_post WP_Post object.
	 * @return string|false
	 */
	protected static function _get_align( $wp_post ) {
		if ( ! is_a( $wp_post, '\WP_Post' ) ) {
			return false;
		}

		if ( 'product' !== get_post_type( $wp_post ) ) {
			return false;
		}

		return get_theme_mod( 'woocommerce-single-page-header-align' );
	}
}
