<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
 */

namespace Framework\Contract\Helper;

use Framework\Contract\Helper\Trait_Helper;

trait Term_Thumbnail {

	/**
	 * Return term data for term thumbnail.
	 *
	 * @param WP_Term|null $term WP_Term object.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return array|false
	 *    @var int term_id
	 *    @var string taxonomy
	 */
	public static function get_term_thumbnail_term( $term = null ) {
		if ( is_null( $term ) ) {
			$term = get_queried_object();
		}

		$cache_key   = crc32( json_encode( $term ) );
		$cache_group = 'snow-monkey/term-thumbnail-id';
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
				$term->term_id = $ancestor;
				return $term;
			}
		}

		return false;
	}

	/**
	 * Return true when have term thumbanil.
	 *
	 * @param WP_Term|null $term WP_Term object.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return boolean
	 */
	public static function has_term_thumbnail( $term = null ) {
		$term = static::get_term_thumbnail_term( $term );
		return $term ? true : false;
	}

	/**
	 * Return term thumbnail url.
	 *
	 * @param WP_Term|null $term WP_Term object.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @param string       $size The image size.
	 * @return string
	 */
	public static function get_the_term_thumbnail_url( $term = null, $size = 'large' ) {
		if ( ! static::has_term_thumbnail( $term ) ) {
			return '';
		}

		$term = static::get_term_thumbnail_term( $term );
		if ( ! $term ) {
			return '';
		}

		$header_image = get_theme_mod( $term->taxonomy . '-' . $term->term_id . '-header-image' );
		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_image_url( $header_image, $size )
			: $header_image;
	}

	/**
	 * Return term header image.
	 *
	 * @param WP_Term|null $term WP_Term object.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @param string       $size The image size.
	 * @return string
	 */
	public static function get_the_term_thumbnail( $term = null, $size = 'large' ) {
		if ( ! static::has_term_thumbnail( $term ) ) {
			return '';
		}

		$term = static::get_term_thumbnail_term( $term );
		if ( ! $term ) {
			return '';
		}

		$header_image = get_theme_mod( $term->taxonomy . '-' . $term->term_id . '-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_image( $header_image, $size )
			: sprintf( '<img src="%1$s" alt="">', esc_url( $header_image ) );
	}

	/**
	 * Display term thumbnail.
	 *
	 * @param WP_Term|null $term WP_Term object.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return void
	 */
	public static function the_term_thumbnail( $term = null ) {
		echo wp_kses(
			static::get_the_term_thumbnail( $term ),
			[
				'img' => static::img_allowed_attributes(),
			]
		);
	}

	/**
	 * Return term header image caption.
	 *
	 * @param WP_Term|null $term WP_Term object.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return string
	 */
	public static function get_the_term_thumbnail_caption( $term ) {
		if ( ! static::has_term_thumbnail( $term ) ) {
			return '';
		}

		$term = static::get_term_thumbnail_term( $term );
		if ( ! $term ) {
			return '';
		}

		$header_image = get_theme_mod( $term->taxonomy . '-' . $term->term_id . '-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_caption( $header_image )
			: wp_get_attachment_caption( Trait_Helper::attachment_url_to_postid( $header_image ) );
	}

	/**
	 * Return allowd attributes of img.
	 *
	 * @return array
	 */
	abstract public static function img_allowed_attributes();
}
