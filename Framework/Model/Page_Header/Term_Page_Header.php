<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

namespace Framework\Model\Page_Header;

use Framework\Helper;
use Framework\Helper\Page_Header\Term_Page_Header as Page_Header_Helper;
use Framework\Contract\Model\Page_Header as Base;

class Term_Page_Header extends Base {

	/**
	 * Return page header image html.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	protected static function _get_image( $size = 'large' ) {
		$term      = get_queried_object();
		$taxonomy  = get_taxonomy( $term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		$eyecatch_position = is_tax()
			? get_theme_mod( 'archive-' . $post_type . '-eyecatch' )
			: get_theme_mod( 'archive-eyecatch' );

		return in_array( $eyecatch_position, static::$image_mods, true )
			? Page_Header_Helper::get_image( $term, $size )
			: false;
	}

	/**
	 * Return page header image url.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	protected static function _get_image_url( $size = 'large' ) {
		$term      = get_queried_object();
		$taxonomy  = get_taxonomy( $term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		$eyecatch_position = is_tax()
			? get_theme_mod( 'archive-' . $post_type . '-eyecatch' )
			: get_theme_mod( 'archive-eyecatch' );

		return in_array( $eyecatch_position, static::$image_mods, true )
			? Page_Header_Helper::get_image_url( $term, $size )
			: false;
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		$term      = get_queried_object();
		$taxonomy  = get_taxonomy( $term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		$eyecatch_position = is_tax()
			? get_theme_mod( 'archive-' . $post_type . '-eyecatch' )
			: get_theme_mod( 'archive-eyecatch' );

		return in_array( $eyecatch_position, static::$title_mods, true )
			? Page_Header_Helper::get_title( $term )
			: false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	protected static function _get_align() {
		$term      = get_queried_object();
		$taxonomy  = get_taxonomy( $term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		$eyecatch_position = is_tax()
			? get_theme_mod( 'archive-' . $post_type . '-eyecatch' )
			: get_theme_mod( 'archive-eyecatch' );

		return in_array( $eyecatch_position, static::$title_mods, true )
			? Page_Header_Helper::get_align( $term )
			: false;
	}

	/**
	 * Return page header image caption.
	 *
	 * @return string|false
	 */
	protected static function _get_image_caption() {
		$term      = get_queried_object();
		$taxonomy  = get_taxonomy( $term->taxonomy );
		$post_type = $taxonomy->object_type[0];

		$eyecatch_position = is_tax()
			? get_theme_mod( 'archive-' . $post_type . '-eyecatch' )
			: get_theme_mod( 'archive-eyecatch' );

		return in_array( $eyecatch_position, static::$image_mods, true )
			? Page_Header_Helper::get_image_caption( $term )
			: false;
	}
}
