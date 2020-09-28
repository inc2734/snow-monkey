<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

namespace Framework\Contract\Model;

abstract class Page_Header {

	/**
	 * Mods to display page header image
	 *
	 * @var array
	 */
	protected static $image_mods = [
		'page-header',
		'title-on-page-header',
	];

	/**
	 * Mods to display page header image title
	 *
	 * @var array
	 */
	protected static $title_mods = [
		'title-on-page-header',
	];

	/**
	 * Page header image
	 *
	 * @var string|false
	 */
	protected static $image = false;

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	abstract public static function get_image_url();

	/**
	 * Return true when should display page header image
	 *
	 * @return boolean
	 */
	abstract public static function is_display_image();

	/**
	 * Return true when should display page header title
	 *
	 * @return boolean
	 */
	abstract public static function is_display_title();

	/**
	 * Return page header image caption
	 *
	 * @return string
	 */
	public static function get_image_caption() {
		$image_url = static::get_image_url();
		if ( ! $image_url ) {
			return;
		}

		$image_id = attachment_url_to_postid( $image_url );
		if ( ! $image_id ) {
			return;
		}

		return wp_get_attachment_caption( $image_id );
	}

	/**
	 * Return page header image html
	 *
	 * @return string The img tag.
	 */
	public static function get_the_image() {
		if ( false !== static::$image ) {
			return static::$image;
		}

		$image = null;

		$image_url = static::get_image_url();
		if ( $image_url ) {
			$image_id = attachment_url_to_postid( $image_url );
			if ( ! $image_id ) {
				$image = sprintf(
					'<img src="%1$s" alt="">',
					esc_url( $image_url )
				);
			} else {
				$image = wp_get_attachment_image( $image_id, static::_get_thumbnail_size() );
			}
		}

		static::$image = $image;
		return $image;
	}

	/**
	 * Display page header image
	 *
	 * @return void
	 */
	public static function the_image() {
		echo wp_kses(
			static::get_the_image(),
			[
				'img' => Helper::img_allowed_attributes(),
			]
		);
	}

	/**
	 * Return thumbnail size of page header image
	 *
	 * @return string
	 */
	protected static function _get_thumbnail_size() {
		return apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' );
	}

	/**
	 * Return default page header image url
	 *
	 * @return string
	 */
	protected static function _get_default_image_url() {
		return get_theme_mod( 'default-page-header-image' );
	}
}
