<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework\Model\Page_Header;

use Framework\Contract\Model\Page_Header as Base;

class Category_Page_Header extends Base {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	public static function get_image_url() {
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

		return static::_get_default_image_url();
	}
}
