<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

namespace Framework\Helper\Page_Header;

use Framework\Helper;
use Framework\Contract\Helper\Page_Header\Page_Header as Base;

class Singular_Page_Header extends Base {

	/**
	 * Return page header image html.
	 *
	 * @param WP_Post $wp_post WP_Post object.
	 * @param string  $size    The image size.
	 * @return string|false
	 */
	protected static function _get_image( $wp_post, $size = 'large' ) {
		if ( ! is_a( $wp_post, '\WP_Post' ) ) {
			return false;
		}

		$thumbnail_id = get_post_thumbnail_id( $wp_post );

		return has_post_thumbnail( $wp_post )
			? wp_get_attachment_image( $thumbnail_id, $size )
			: static::_get_default_image( $size );
	}

	/**
	 * Return page header image url.
	 *
	 * @param WP_Post $wp_post WP_Post object.
	 * @param string  $size    The image size.
	 * @return string|false
	 */
	protected static function _get_image_url( $wp_post, $size = 'large' ) {
		if ( ! is_a( $wp_post, '\WP_Post' ) ) {
			return false;
		}

		$thumbnail_id = get_post_thumbnail_id( $wp_post );

		return has_post_thumbnail( $wp_post )
			? wp_get_attachment_image_url( $thumbnail_id, $size )
			: static::_get_default_image_url( $size );
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

		$post_type = get_post_type( $wp_post );
		return get_theme_mod( $post_type . '-page-header-align' );
	}

	/**
	 * Return page header image caption.
	 *
	 * @param WP_Post $wp_post WP_Post object.
	 * @return string|false
	 */
	protected static function _get_image_caption( $wp_post ) {
		if ( ! is_a( $wp_post, '\WP_Post' ) ) {
			return false;
		}

		$thumbnail_id = get_post_thumbnail_id( $wp_post );

		return has_post_thumbnail( $wp_post )
			? wp_get_attachment_caption( $thumbnail_id )
			: static::_get_default_image_caption();
	}
}
