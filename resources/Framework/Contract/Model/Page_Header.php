<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.1.0
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
	 * Return page header image html
	 *
	 * @return void
	 */
	public static function get_the_image() {
		$cache_key   = md5( json_encode( get_queried_object() ) );
		$cache_group = 'snow-monkey/page-header/get_the_image';
		$cache       = wp_cache_get( $cache_key, $cache_group );

		if ( false !== $cache ) {
			return $cache;
		}

		$image = null;

		$image_url = static::get_image_url();
		if ( $image_url ) {
			$image_id = attachment_url_to_postid( $image_url );
			$post     = get_post( $image_id );
			$alt      = $post->post_excerpt;

			if ( ! $image_id ) {
				$image = sprintf(
					'<img src="%1$s" alt="%2$s">',
					esc_url( $image_url ),
					esc_attr( $alt )
				);
			} else {
				$image = wp_get_attachment_image( $image_id, static::_get_thumbnail_size() );
			}
		}

		wp_cache_set( $cache_key, $image, $cache_group );
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
