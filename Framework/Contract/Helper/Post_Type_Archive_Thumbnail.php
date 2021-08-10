<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
 */

namespace Framework\Contract\Helper;

use Framework\Contract\Helper\Trait_Helper;

trait Post_Type_Archive_Thumbnail {

	/**
	 * Return true when have post type archive thumbanil.
	 *
	 * @param string|null $post_type The post type name.
	 * @return boolean
	 */
	public static function has_post_type_archive_thumbnail( $post_type = null ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;
		return get_theme_mod( $post_type . '-header-image' ) ? true : false;
	}

	/**
	 * Return post type archive thumbnail url.
	 *
	 * @param string|null $post_type The post type name.
	 * @param string      $size      The image size.
	 * @return string
	 */
	public static function get_the_post_type_archive_thumbnail_url( $post_type = null, $size = 'large' ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;

		if ( ! static::has_post_type_archive_thumbnail( $post_type ) ) {
			return '';
		}

		$header_image = get_theme_mod( $post_type . '-header-image' );
		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_image_url( $header_image, $size )
			: $header_image;
	}

	/**
	 * Return post type archive header image.
	 *
	 * @param string|null $post_type The post type name.
	 * @param string      $size      The image size.
	 * @return string
	 */
	public static function get_the_post_type_archive_thumbnail( $post_type = null, $size = 'large' ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;

		if ( ! static::has_post_type_archive_thumbnail( $post_type ) ) {
			return '';
		}

		$header_image = get_theme_mod( $post_type . '-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_image( $header_image, $size )
			: sprintf( '<img src="%1$s" alt="">', esc_url( $header_image ) );
	}

	/**
	 * Display post type archive thumbnail.
	 *
	 * @param string|null $post_type The post type name.
	 * @param string      $size      The image size.
	 * @return void
	 */
	public static function the_post_type_archive_thumbnail( $post_type = null, $size = 'large' ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;

		echo wp_kses(
			static::get_the_post_type_archive_thumbnail( $post_type, $size ),
			[
				'img' => static::img_allowed_attributes(),
			]
		);
	}

	/**
	 * Display post type archive thumbnail caption.
	 *
	 * @param string|null $post_type The post type name.
	 * @return string|false
	 */
	public static function get_the_post_type_archive_thumbnail_caption( $post_type = null ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;

		if ( ! static::has_post_type_archive_thumbnail( $post_type ) ) {
			return '';
		}

		$header_image = get_theme_mod( $post_type . '-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_caption( $header_image )
			: wp_get_attachment_caption( Trait_Helper::attachment_url_to_postid( $header_image ) );
	}

	/**
	 * Return allowd attributes of img
	 *
	 * @return array
	 */
	abstract public static function img_allowed_attributes();
}
