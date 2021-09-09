<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.7.0
 */

namespace Framework\Contract\Helper;

use Framework\Contract\Helper\Trait_Helper;

trait BbPress_Archive_Thumbnail {

	/**
	 * Return true when have bbPress archive thumbanil.
	 *
	 * @return boolean
	 */
	public static function has_bbpress_archive_thumbnail() {
		return get_theme_mod( 'bbpress-archive-header-image' ) ? true : false;
	}

	/**
	 * Return bbPress archive thumbnail url.
	 *
	 * @param string $size The image size.
	 * @return string
	 */
	public static function get_the_bbpress_archive_thumbnail_url( $size = 'large' ) {
		if ( ! static::has_bbpress_archive_thumbnail() ) {
			return '';
		}

		$header_image = get_theme_mod( 'bbpress-archive-header-image' );
		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_image_url( $header_image, $size )
			: $header_image;
	}

	/**
	 * Return bbPress archive header image.
	 *
	 * @param string $size The image size.
	 * @return string
	 */
	public static function get_the_bbpress_archive_thumbnail( $size = 'large' ) {
		if ( ! static::has_bbpress_archive_thumbnail() ) {
			return '';
		}

		$header_image = get_theme_mod( 'bbpress-archive-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_image( $header_image, $size )
			: sprintf( '<img src="%1$s" alt="">', esc_url( $header_image ) );
	}

	/**
	 * Display bbPress archive thumbnail.
	 *
	 * @return void
	 */
	public static function the_bbpress_archive_thumbnail() {
		echo wp_kses(
			static::get_the_bbpress_archive_thumbnail(),
			[
				'img' => static::img_allowed_attributes(),
			]
		);
	}

	/**
	 * Return bbPress archive header image caption.
	 *
	 * @return string
	 */
	public static function get_the_bbpress_archive_thumbnail_caption() {
		if ( ! static::has_bbpress_archive_thumbnail() ) {
			return '';
		}

		$header_image = get_theme_mod( 'bbpress-archive-header-image' );
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
