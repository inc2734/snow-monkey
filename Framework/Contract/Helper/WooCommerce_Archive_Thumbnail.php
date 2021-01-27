<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

namespace Framework\Contract\Helper;

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
	 * @return string
	 */
	public static function get_the_woocommerce_archive_thumbnail_url() {
		if ( ! static::has_woocommerce_archive_thumbnail() ) {
			return '';
		}

		return get_theme_mod( 'woocommerce-archive-header-image' );
	}

	/**
	 * Return WooCommerce archive header image.
	 *
	 * @return string
	 */
	public static function get_the_woocommerce_archive_thumbnail() {
		if ( ! static::has_woocommerce_archive_thumbnail() ) {
			return '';
		}

		$header_image = get_theme_mod( 'woocommerce-archive-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return sprintf(
			'<img src="%1$s" alt="">',
			esc_url( $header_image )
		);
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
	 * Return allowd attributes of img
	 *
	 * @return array
	 */
	abstract public static function img_allowed_attributes();
}
