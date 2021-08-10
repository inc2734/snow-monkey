<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
 */

namespace Framework\Contract\Helper;

use Framework\Contract\Helper\Trait_Helper;

trait WooCommerce_Archive_Thumbnail {

	/**
	 * Return true when have WooCommerce archive thumbanil.
	 *
	 * @return boolean
	 */
	public static function has_woocommerce_archive_thumbnail() {
		return get_theme_mod( 'woocommerce-archive-header-image' ) ? true : false;
	}

	/**
	 * Return WooCommerce archive thumbnail url.
	 *
	 * @param string $size The image size.
	 * @return string
	 */
	public static function get_the_woocommerce_archive_thumbnail_url( $size = 'large' ) {
		if ( ! static::has_woocommerce_archive_thumbnail() ) {
			return '';
		}

		$header_image = get_theme_mod( 'woocommerce-archive-header-image' );
		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_image_url( $header_image, $size )
			: $header_image;
	}

	/**
	 * Return WooCommerce archive header image.
	 *
	 * @param string $size The image size.
	 * @return string
	 */
	public static function get_the_woocommerce_archive_thumbnail( $size = 'large' ) {
		if ( ! static::has_woocommerce_archive_thumbnail() ) {
			return '';
		}

		$header_image = get_theme_mod( 'woocommerce-archive-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return $header_image && preg_match( '|^\d+$|', $header_image )
			? wp_get_attachment_image( $header_image, $size )
			: sprintf( '<img src="%1$s" alt="">', esc_url( $header_image ) );
	}

	/**
	 * Display WooCommerce archive thumbnail.
	 *
	 * @return void
	 */
	public static function the_woocommerce_archive_thumbnail() {
		echo wp_kses(
			static::get_the_woocommerce_archive_thumbnail(),
			[
				'img' => static::img_allowed_attributes(),
			]
		);
	}

	/**
	 * Return WooCommerce archive header image caption.
	 *
	 * @return string
	 */
	public static function get_the_woocommerce_archive_thumbnail_caption() {
		if ( ! static::has_woocommerce_archive_thumbnail() ) {
			return '';
		}

		$header_image = get_theme_mod( 'woocommerce-archive-header-image' );
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
