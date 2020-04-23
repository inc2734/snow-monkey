<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.0
 */

namespace Framework\Contract\Helper;

trait Category_Thumbnail {

	/**
	 * Return term data for category thumbnail
	 *
	 * @param array|null $term
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return array|false
	 *    @var int term_id
	 *    @var string taxonomy
	 */
	public static function get_category_thumbnail_term( $term = null ) {
		if ( is_null( $term ) ) {
			$term = get_queried_object();
		}

		$cache_key   = md5( json_encode( $term ) );
		$cache_group = 'snow-monkey/category-thumbnail-id';
		$cache       = wp_cache_get( $cache_key, $cache_group );
		if ( false !== $cache ) {
			return $cache;
		}

		$header_image = get_theme_mod( $term->taxonomy . '-' . $term->term_id . '-header-image' );
		if ( $header_image ) {
			wp_cache_set( $cache_key, $term, $cache_group );
			return $term;
		}

		$ancestors = get_ancestors( $term->term_id, $term->taxonomy );
		foreach ( $ancestors as $ancestor ) {
			$header_image = get_theme_mod( $term->taxonomy . '-' . $ancestor . '-header-image' );
			if ( $header_image ) {
				wp_cache_set( $cache_key, $ancestor, $cache_group );
				return array_merge( $term, [ 'term_id' => $ancestor ] );
			}
		}

		return false;
	}

	/**
	 * Return true when have category thumbanil
	 *
	 * @param array|null $term
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return boolean
	 */
	public static function has_category_thumbnail( $term = null ) {
		$term = static::get_category_thumbnail_term( $term );
		return $term ? true : false;
	}

	/**
	 * Return category thumbnail url
	 *
	 * @param array|null $term
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return string
	 */
	public static function get_the_category_thumbnail_url( $term = null ) {
		if ( ! static::has_category_thumbnail( $term ) ) {
			return '';
		}

		$term = static::get_category_thumbnail_term( $term );
		if ( ! $term ) {
			return '';
		}

		return get_theme_mod( $term->taxonomy . '-' . $term->term_id . '-header-image' );
	}

	/**
	 * Return category header image
	 *
	 * @param array|null $term
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return string
	 */
	public static function get_the_category_thumbnail( $term = null ) {
		if ( ! static::has_category_thumbnail( $term ) ) {
			return '';
		}

		$term = static::get_category_thumbnail_term( $term );
		if ( ! $term ) {
			return '';
		}

		$header_image = get_theme_mod( $term->taxonomy . '-' . $term->term_id . '-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return sprintf(
			'<img src="%1$s" alt="">',
			esc_url( $header_image )
		);
	}

	/**
	 * Display category thumbnail
	 *
	 * @param array|null $term
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return void
	 */
	public static function the_category_thumbnail( $term = null ) {
		echo wp_kses(
			static::get_the_category_thumbnail( $term ),
			[
				'img' => static::img_allowed_attributes(),
			]
		);
	}

	abstract public static function img_allowed_attributes();
}
