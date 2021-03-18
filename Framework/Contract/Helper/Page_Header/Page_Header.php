<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

namespace Framework\Contract\Helper\Page_Header;

abstract class Page_Header {

	/**
	 * Mods to display page header image.
	 *
	 * @var array
	 */
	protected static $image_mods = [
		'page-header',
		'title-on-page-header',
	];

	/**
	 * Mods to display page header image title.
	 *
	 * @var array
	 */
	protected static $title_mods = [
		'title-on-page-header',
	];

	/**
	 * Return page header image url.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	abstract protected static function _get_image_url( $queried_object );

	/**
	 * Return page header image url.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	public static function get_image_url( $queried_object ) {
		$url = apply_filters( 'snow_monkey_pre_page_header_image_url', null, $queried_object );
		if ( null !== $url ) {
			return $url;
		}

		// @deprecated
		$url = apply_filters_deprecated(
			'snow_monkey_page_header_image_url',
			[ $url ],
			'Snow Monkey 5.1.0',
			'snow_monkey_pre_page_header_image_url'
		);

		return static::_get_image_url( $queried_object );
	}

	/**
	 * Return page header title.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	abstract protected static function _get_title( $queried_object );

	/**
	 * Return page header title.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	public static function get_title( $queried_object ) {
		return apply_filters( 'snow_monkey_page_header_title', static::_get_title( $queried_object ), $queried_object );
	}

	/**
	 * Return page header alignment.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	abstract protected static function _get_align( $queried_object );

	/**
	 * Return page header alignment.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	public static function get_align( $queried_object ) {
		return apply_filters( 'snow_monkey_page_header_align', static::_get_align( $queried_object ), $queried_object );
	}

	/**
	 * Return thumbnail size of page header image.
	 *
	 * @return string
	 */
	protected static function _get_thumbnail_size() {
		return apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' );
	}

	/**
	 * Return default page header image url.
	 *
	 * @return string
	 */
	protected static function _get_default_image_url() {
		return get_theme_mod( 'default-page-header-image' );
	}
}
