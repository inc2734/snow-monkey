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

class Archive_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	protected static function _get_image_url( $queried_object ) {
		if ( is_a( $queried_object, '\WP_Post_Type' ) ) {
			$post_type         = $queried_object->name;
			$eyecatch_position = get_theme_mod( 'archive-' . $post_type . '-eyecatch' );

			return in_array( $eyecatch_position, static::$image_mods, true )
				? Helper::has_post_type_archive_thumbnail( $post_type )
					? Helper::get_the_post_type_archive_thumbnail_url( $post_type )
					: static::_get_default_image_url()
				: false;
		}

		if (
			is_null( $queried_object )
			|| 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' )
			|| is_a( $queried_object, '\WP_User' )
		) {
			$eyecatch_position = get_theme_mod( 'archive-eyecatch' );

			return in_array( $eyecatch_position, static::$image_mods, true )
				? Helper::has_homepage_thumbnail()
					? Helper::get_the_homepage_thumbnail_url( static::_get_thumbnail_size() )
					: static::_get_default_image_url()
				: false;
		}

		return false;
	}

	/**
	 * Return page header title.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	protected static function _get_title( $queried_object ) {
		if ( is_a( $queried_object, '\WP_Post_Type' ) ) {
			$post_type         = $queried_object->name;
			$eyecatch_position = get_theme_mod( 'archive-' . $post_type . '-eyecatch' );

			return in_array( $eyecatch_position, static::$title_mods, true )
				? Helper::get_page_title_from_breadcrumbs()
				: false;
		}

		if (
			is_null( $queried_object )
			|| 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' )
			|| is_a( $queried_object, '\WP_User' )
		) {
			$eyecatch_position = get_theme_mod( 'archive-eyecatch' );

			return in_array( $eyecatch_position, static::$title_mods, true )
				? Helper::get_page_title_from_breadcrumbs()
				: false;
		}

		return false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	protected static function _get_align( $queried_object ) {
		if ( is_a( $queried_object, '\WP_Post_Type' ) ) {
			$post_type         = $queried_object->name;
			$eyecatch_position = get_theme_mod( 'archive-' . $post_type . '-eyecatch' );

			return in_array( $eyecatch_position, static::$title_mods, true )
				? get_theme_mod( 'archive-' . get_post_type() . '-page-header-align' )
				: false;
		}

		if (
			is_null( $queried_object )
			|| 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' )
			|| is_a( $queried_object, '\WP_User' )
		) {
			$eyecatch_position = get_theme_mod( 'archive-eyecatch' );

			return in_array( $eyecatch_position, static::$title_mods, true )
				? get_theme_mod( 'archive-page-header-align' )
				: false;
		}

		return false;
	}
}
