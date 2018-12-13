<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework\Model;

class Page_Header_Image_Url {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get() {
		if ( is_singular( 'post' ) ) {
			return static::_get_post_page_header_image_url();
		} elseif ( is_page() && ! is_front_page() ) {
			return static::_get_page_page_header_image_url();
		} elseif ( is_category() ) {
			return static::_get_category_page_header_image_url();
		} elseif ( is_home() || ( is_archive() && ! is_post_type_archive() ) ) {
			return static::_get_home_page_header_image_url();
		}
	}

	/**
	 * Return page header image url for post
	 *
	 * @return string
	 */
	protected static function _get_post_page_header_image_url() {
		$valid_choices = [ 'page-header', 'title-on-page-header' ];
		if ( ! is_singular( 'post' ) || ! in_array( get_theme_mod( 'post-eyecatch' ), $valid_choices ) ) {
			return;
		}

		return static::_get_singlular_page_header_image_url();
	}

	/**
	 * Return page header image url for page
	 *
	 * @return string
	 */
	protected static function _get_page_page_header_image_url() {
		$valid_choices = [ 'page-header', 'title-on-page-header' ];
		if ( ! is_page() || is_front_page() || ! in_array( get_theme_mod( 'page-eyecatch' ), $valid_choices ) ) {
			return;
		}

		return static::_get_singlular_page_header_image_url();
	}

	/**
	 * Return page header image url for singular post
	 *
	 * @return string
	 */
	protected static function _get_singlular_page_header_image_url() {
		if ( has_post_thumbnail() ) {
			$thumbnail_id = get_post_thumbnail_id();
			if ( $thumbnail_id ) {
				return wp_get_attachment_image_url( $thumbnail_id, static::_get_thumbnail_size() );
			}
		}

		return static::_get_default_page_header_image_url();
	}

	/**
	 * Return page header image url for blog archive
	 *
	 * @return string
	 */
	protected static function _get_home_page_header_image_url() {
		if ( 'page' === get_option( 'show_on_front' ) ) {
			$thumbnail_id = get_post_thumbnail_id( get_option( 'page_for_posts' ) );
			if ( $thumbnail_id ) {
				return wp_get_attachment_image_url( $thumbnail_id, static::_get_thumbnail_size() );
			}
		}

		return static::_get_default_page_header_image_url();
	}

	/**
	 * Return page header image url for category archive
	 *
	 * @return string
	 */
	protected static function _get_category_page_header_image_url() {
		$term = get_queried_object();
		$header_image = get_theme_mod( 'category-' . $term->term_id . '-header-image' );

		if ( $header_image ) {
			return $header_image;
		}

		$ancestors = get_ancestors( $term->term_id, 'category' );
		foreach ( $ancestors as $ancestor ) {
			$header_image = get_theme_mod( 'category-' . $ancestor . '-header-image' );
			if ( $header_image ) {
				return $header_image;
			}
		}

		return static::_get_default_page_header_image_url();
	}

	/**
	 * Return thumbnail size of page header image
	 *
	 * @return string
	 */
	protected static function _get_thumbnail_size() {
		return apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' );
	}

	/**
	 * Return default page header image url
	 *
	 * @return string
	 */
	protected static function _get_default_page_header_image_url() {
		return get_theme_mod( 'default-page-header-image' );
	}
}
