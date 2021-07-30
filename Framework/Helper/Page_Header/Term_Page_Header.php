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

class Term_Page_Header extends Base {

	/**
	 * Return page header image html.
	 *
	 * @param WP_Term $wp_term WP_Term object.
	 * @param string  $size    The image size.
	 * @return string|false
	 */
	protected static function _get_image( $wp_term, $size = 'large' ) {
		if ( ! is_a( $wp_term, '\WP_Term' ) ) {
			return false;
		}

		$taxonomy  = get_taxonomy( $wp_term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		if ( Helper::has_term_thumbnail( $wp_term ) ) {
			return Helper::get_the_term_thumbnail( $wp_term, $size );
		}

		if ( ! in_array( $taxonomy->name, [ 'category', 'post_tag' ], true ) ) {
			return Helper::has_post_type_archive_thumbnail( $post_type )
				? Helper::get_the_post_type_archive_thumbnail( $post_type, $size )
				: static::_get_default_image( $size );
		}

		return Helper::has_homepage_thumbnail()
			? Helper::get_the_homepage_thumbnail( $size )
			: static::_get_default_image( $size );
	}

	/**
	 * Return page header image url.
	 *
	 * @param WP_Term $wp_term WP_Term object.
	 * @param string  $size    The image size.
	 * @return string|false
	 */
	protected static function _get_image_url( $wp_term, $size = 'large' ) {
		if ( ! is_a( $wp_term, '\WP_Term' ) ) {
			return false;
		}

		$taxonomy  = get_taxonomy( $wp_term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		if ( Helper::has_term_thumbnail( $wp_term ) ) {
			return Helper::get_the_term_thumbnail_url( $wp_term, $size );
		}

		if ( ! in_array( $taxonomy->name, [ 'category', 'post_tag' ], true ) ) {
			return Helper::has_post_type_archive_thumbnail( $post_type )
				? Helper::get_the_post_type_archive_thumbnail_url( $post_type, $size )
				: static::_get_default_image_url( $size );
		}

		return Helper::has_homepage_thumbnail()
			? Helper::get_the_homepage_thumbnail_url( $size )
			: static::_get_default_image_url( $size );
	}

	/**
	 * Return page header title.
	 *
	 * @param WP_Term $wp_term WP_Term object.
	 * @return string|false
	 */
	protected static function _get_title( $wp_term ) {
		if ( ! is_a( $wp_term, '\WP_Term' ) ) {
			return false;
		}

		return Helper::get_page_title_from_breadcrumbs();
	}

	/**
	 * Return page header alignment.
	 *
	 * @param WP_Term $wp_term WP_Term object.
	 * @return string|false
	 */
	protected static function _get_align( $wp_term ) {
		if ( ! is_a( $wp_term, '\WP_Term' ) ) {
			return false;
		}

		$taxonomy  = get_taxonomy( $wp_term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		return ! in_array( $taxonomy->name, [ 'category', 'post_tag' ], true )
			? get_theme_mod( 'archive-' . $post_type . '-page-header-align' )
			: get_theme_mod( 'archive-page-header-align' );
	}

	/**
	 * Return page header image caption.
	 *
	 * @param WP_Term $wp_term WP_Term object.
	 * @return string|false
	 */
	protected static function _get_image_caption( $wp_term ) {
		if ( ! is_a( $wp_term, '\WP_Term' ) ) {
			return false;
		}

		$taxonomy  = get_taxonomy( $wp_term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		if ( Helper::has_term_thumbnail( $wp_term ) ) {
			return Helper::get_the_term_thumbnail_caption( $wp_term );
		}

		if ( ! in_array( $taxonomy->name, [ 'category', 'post_tag' ], true ) ) {
			return Helper::has_post_type_archive_thumbnail( $post_type )
				? Helper::get_the_post_type_archive_thumbnail_caption( $post_type )
				: static::_get_default_image_caption();
		}

		return Helper::has_homepage_thumbnail()
			? Helper::get_the_homepage_thumbnail_caption()
			: static::_get_default_image_caption();
	}
}
