<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\app\model;

class Page_Header_Image_Url {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get() {
		$url = get_theme_mod( 'default-page-header-image' );

		if ( is_singular() ) {
			$_url = self::_get_singlular_page_header_image_url();
		} elseif ( is_home() || ( is_archive() && ! is_post_type_archive() ) ) {
			if ( is_category() ) {
				$_url = self::_get_category_page_header_image_url();
			}

			if ( empty( $_url ) ) {
				$_url = self::_get_blog_page_header_image_url();
			}
		}

		if ( ! empty( $_url ) ) {
			$url = $_url;
		}

		return $url;
	}

	/**
	 * Return page header image url for singular page
	 *
	 * @return string
	 */
	protected static function _get_singlular_page_header_image_url() {
		if ( has_post_thumbnail() ) {
			$thumbnail_id = get_post_thumbnail_id();
			if ( $thumbnail_id ) {
				return wp_get_attachment_image_url( $thumbnail_id, self::_get_thumbnail_size() );
			}
		}
	}

	/**
	 * Return page header image url for blog archive
	 *
	 * @return string
	 */
	protected static function _get_blog_page_header_image_url() {
		if ( 'page' === get_option( 'show_on_front' ) ) {
			$thumbnail_id = get_post_thumbnail_id( get_option( 'page_for_posts' ) );
			if ( $thumbnail_id ) {
				return wp_get_attachment_image_url( $thumbnail_id, self::_get_thumbnail_size() );
			}
		}
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
	}

	/**
	 * Return thumbnail size of page header image
	 *
	 * @return string
	 */
	protected static function _get_thumbnail_size() {
		return apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' );
	}
}
