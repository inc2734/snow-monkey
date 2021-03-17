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

class WooCommerce_Taxonomy_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	protected static function _get_image_url( $queried_object ) {
		if ( is_a( $queried_object, '\WP_Term' ) ) {
			$taxonomy = get_taxonomy( $queried_object->taxonomy );

			if ( in_array( $taxonomy->name, [ 'product_cat', 'product_tag' ], true ) ) {
				$eyecatch_position = get_theme_mod( 'woocommerce-archive-eyecatch' );

				if ( in_array( $eyecatch_position, static::$image_mods, true ) ) {
					if ( Helper::has_term_thumbnail( $queried_object ) ) {
						return Helper::get_the_term_thumbnail_url( $queried_object );
					} elseif ( Helper::has_woocommerce_archive_thumbnail() ) {
						return Helper::get_the_woocommerce_archive_thumbnail_url();
					}
					return static::_get_default_image_url();
				}
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
			$taxonomy = get_taxonomy( $queried_object->taxonomy );

			if ( in_array( $taxonomy->name, [ 'product_cat', 'product_tag' ], true ) ) {
				$eyecatch_position = get_theme_mod( 'woocommerce-archive-eyecatch' );

				if ( in_array( $eyecatch_position, static::$title_mods, true ) ) {
					return Helper::get_page_title_from_breadcrumbs();
				}
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
			$taxonomy = get_taxonomy( $queried_object->taxonomy );

			if ( in_array( $taxonomy->name, [ 'product_cat', 'product_tag' ], true ) ) {
				$eyecatch_position = get_theme_mod( 'woocommerce-archive-eyecatch' );

				if ( in_array( $eyecatch_position, static::$title_mods, true ) ) {
					return get_theme_mod( 'woocommerce-archive-page-header-align' );
				}
			}
		}

		return false;
	}
}
