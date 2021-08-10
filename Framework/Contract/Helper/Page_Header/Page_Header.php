<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
 */

namespace Framework\Contract\Helper\Page_Header;

use Framework\Contract\Helper\Trait_Helper;

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
	 * Return page header image html.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @param string                                    $size           The image size.
	 * @return string|false
	 */
	abstract protected static function _get_image( $queried_object, $size = 'large' );

	/**
	 * Return page header image html.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @param string                                    $size           The image size.
	 * @return string|false
	 */
	public static function get_image( $queried_object, $size = 'large' ) {
		$url = static::_get_pre_page_header_image_url( $queried_object, $size );
		if ( null !== $url ) {
			return sprintf( '<img src="%1$s" alt="">', esc_url( $url ) );
		}

		return static::_get_image( $queried_object, $size );
	}

	/**
	 * Return page header image url.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @param string                                    $size           The image size.
	 * @return string|false
	 */
	abstract protected static function _get_image_url( $queried_object, $size = 'large' );

	/**
	 * Return page header image url.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @param string                                    $size           The image size.
	 * @return string|false
	 */
	public static function get_image_url( $queried_object, $size = 'large' ) {
		$url = static::_get_pre_page_header_image_url( $queried_object, $size );
		if ( null !== $url ) {
			return $url;
		}

		return static::_get_image_url( $queried_object, $size );
	}

	/**
	 * Return filtered page header image url.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @param string                                    $size           The image size.
	 * @return string|null
	 */
	protected static function _get_pre_page_header_image_url( $queried_object, $size = 'large' ) {
		$url = apply_filters( 'snow_monkey_pre_page_header_image_url', null, $queried_object, $size );
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

		return $url;
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
	 * Return page header image caption.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	abstract protected static function _get_image_caption( $queried_object );

	/**
	 * Return page header image caption.
	 *
	 * @param WP_Term|WP_Post_Type|WP_Post|WP_User|null $queried_object The queried object.
	 * @return string|false
	 */
	public static function get_image_caption( $queried_object ) {
		return apply_filters( 'snow_monkey_page_header_image_caption', static::_get_image_caption( $queried_object ), $queried_object );
	}

	/**
	 * Return thumbnail size of page header image.
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	protected static function _get_thumbnail_size() {
		_deprecated_function(
			'\Framework\Contract\Helper\Page_Header\Page_Header::_get_thumbnail_size()',
			'Snow Monkey 15.0.0'
		);

		return apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' );
	}

	/**
	 * Return default page header image html.
	 *
	 * @param string $size The image size.
	 * @return string
	 */
	protected static function _get_default_image( $size = 'large' ) {
		$default_header_image = get_theme_mod( 'default-page-header-image' );
		if ( ! $default_header_image ) {
			return;
		}

		return preg_match( '|^\d+$|', $default_header_image )
			? wp_get_attachment_image( $default_header_image, $size )
			: sprintf( '<img src="%1$s" alt="">', esc_url( $default_header_image ) );
	}

	/**
	 * Return default page header image url.
	 *
	 * @param string $size The image size.
	 * @return string
	 */
	protected static function _get_default_image_url( $size = 'large' ) {
		$default_header_image = get_theme_mod( 'default-page-header-image' );
		if ( ! $default_header_image ) {
			return;
		}

		return preg_match( '|^\d+$|', $default_header_image )
			? wp_get_attachment_image_url( $default_header_image, $size )
			: $default_header_image;
	}

	/**
	 * Return default page header image caption.
	 *
	 * @return string
	 */
	protected static function _get_default_image_caption() {
		$default_header_image = get_theme_mod( 'default-page-header-image' );
		if ( ! $default_header_image ) {
			return;
		}

		return preg_match( '|^\d+$|', $default_header_image )
			? wp_get_attachment_caption( $default_header_image )
			: wp_get_attachment_caption( Trait_Helper::attachment_url_to_postid( $default_header_image ) );
	}
}
