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

class Archive_Page_Header extends Base {

	/**
	 * Return page header image html.
	 *
	 * @param WP_Post_Type|null $wp_post_type WP_Post_Type object.
	 * @param string            $size         The image size.
	 * @return string|false
	 */
	protected static function _get_image( $wp_post_type, $size = 'large' ) {
		if ( is_a( $wp_post_type, '\WP_Post_Type' ) ) {
			$post_type = $wp_post_type->name;

			return Helper::has_post_type_archive_thumbnail( $post_type )
				? Helper::get_the_post_type_archive_thumbnail( $post_type, $size )
				: static::_get_default_image( $size );
		}

		if ( is_null( $wp_post_type ) ) {
			return Helper::has_homepage_thumbnail()
				? Helper::get_the_homepage_thumbnail( $size )
				: static::_get_default_image( $size );
		}

		return false;
	}

	/**
	 * Return page header image url.
	 *
	 * @param WP_Post_Type|null $wp_post_type WP_Post_Type object.
	 * @param string            $size         The image size.
	 * @return string|false
	 */
	protected static function _get_image_url( $wp_post_type, $size = 'large' ) {
		if ( is_a( $wp_post_type, '\WP_Post_Type' ) ) {
			$post_type = $wp_post_type->name;

			return Helper::has_post_type_archive_thumbnail( $post_type )
				? Helper::get_the_post_type_archive_thumbnail_url( $post_type, $size )
				: static::_get_default_image_url( $size );
		}

		if ( is_null( $wp_post_type ) ) {
			return Helper::has_homepage_thumbnail()
				? Helper::get_the_homepage_thumbnail_url( $size )
				: static::_get_default_image_url( $size );
		}

		return false;
	}

	/**
	 * Return page header title.
	 *
	 * @param WP_Post_Type|null $wp_post_type WP_Post_Type object.
	 * @return string|false
	 */
	protected static function _get_title( $wp_post_type ) {
		if ( is_a( $wp_post_type, '\WP_Post_Type' ) ) {
			return Helper::get_page_title_from_breadcrumbs();
		}

		if ( is_null( $wp_post_type ) ) {
			return Helper::get_page_title_from_breadcrumbs();
		}

		return false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @param WP_Post_Type|null $wp_post_type WP_Post_Type object.
	 * @return string|false
	 */
	protected static function _get_align( $wp_post_type ) {
		if ( is_a( $wp_post_type, '\WP_Post_Type' ) ) {
			$post_type = $wp_post_type->name;

			return get_theme_mod( 'archive-' . $post_type . '-page-header-align' );
		}

		if ( is_null( $wp_post_type ) ) {
			return get_theme_mod( 'archive-page-header-align' );
		}

		return false;
	}

	/**
	 * Return page header image caption.
	 *
	 * @param WP_Post_Type|null $wp_post_type WP_Post_Type object.
	 * @return string|false
	 */
	protected static function _get_image_caption( $wp_post_type ) {
		if ( is_a( $wp_post_type, '\WP_Post_Type' ) ) {
			$post_type = $wp_post_type->name;

			return Helper::has_post_type_archive_thumbnail( $post_type )
				? Helper::get_the_post_type_archive_thumbnail_caption( $post_type )
				: static::_get_default_image_caption();
		}

		if ( is_null( $wp_post_type ) ) {
			return Helper::has_homepage_thumbnail()
				? Helper::get_the_homepage_thumbnail_caption()
				: static::_get_default_image_caption();
		}

		return false;
	}
}
