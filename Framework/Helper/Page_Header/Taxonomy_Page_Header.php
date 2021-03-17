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

class Taxonomy_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	protected static function _get_image_url( $queried_object ) {
		if ( is_a( $queried_object, '\WP_Term' ) ) {
			$taxonomy  = get_taxonomy( $queried_object->taxonomy );
			$post_type = $taxonomy->object_type[0];

			$eyecatch_position = ! $taxonomy->_builtin
				? get_theme_mod( 'archive-' . $post_type . '-eyecatch' )
				: get_theme_mod( 'archive-eyecatch' );

			if ( in_array( $eyecatch_position, static::$image_mods, true ) ) {
				if ( Helper::has_term_thumbnail( $queried_object ) ) {
					return Helper::get_the_term_thumbnail_url( $queried_object );
				}

				if ( ! $taxonomy->_builtin && Helper::has_post_type_archive_thumbnail( $post_type ) ) {
					return Helper::get_the_post_type_archive_thumbnail_url( $post_type );
				} elseif ( $taxonomy->_builtin && Helper::has_homepage_thumbnail() ) {
					return Helper::get_the_homepage_thumbnail_url( static::_get_thumbnail_size() );
				}

				return static::_get_default_image_url();
			}
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
		if ( is_a( $queried_object, '\WP_Term' ) ) {
			$taxonomy  = get_taxonomy( $queried_object->taxonomy );
			$post_type = $taxonomy->object_type[0];

			$eyecatch_position = ! $taxonomy->_builtin
				? get_theme_mod( 'archive-' . $post_type . '-eyecatch' )
				: get_theme_mod( 'archive-eyecatch' );

			if ( in_array( $eyecatch_position, static::$title_mods, true ) ) {
				return Helper::get_page_title_from_breadcrumbs();
			}
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
		if ( is_a( $queried_object, '\WP_Term' ) ) {
			$taxonomy  = get_taxonomy( $queried_object->taxonomy );
			$post_type = $taxonomy->object_type[0];

			$eyecatch_position = ! $taxonomy->_builtin
				? get_theme_mod( 'archive-' . $post_type . '-eyecatch' )
				: get_theme_mod( 'archive-eyecatch' );

			if ( in_array( $eyecatch_position, static::$title_mods, true ) ) {
				if ( ! $taxonomy->_builtin ) {
					return get_theme_mod( 'archive-' . get_post_type() . '-page-header-align' );
				} else {
					return get_theme_mod( 'archive-page-header-align' );
				}
			}
		}

		return false;
	}
}
