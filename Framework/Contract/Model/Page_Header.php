<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.5
 */

namespace Framework\Contract\Model;

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
	 * Page header image tag.
	 *
	 * @var string|null
	 */
	protected static $image = null;

	/**
	 * Page header image ID
	 *
	 * @var int|null
	 */
	protected static $image_id = null;

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	abstract protected static function _get_image_url();

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	public static function get_image_url() {
		$url = apply_filters( 'snow_monkey_pre_page_header_image_url', null );
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

		return static::_get_image_url();
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	abstract protected static function _get_title();

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	public static function get_title() {
		return apply_filters( 'snow_monkey_page_header_title', static::_get_title() );
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	abstract protected static function _get_align();

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	public static function get_align() {
		return apply_filters( 'snow_monkey_page_header_align', static::_get_align() );
	}

	/**
	 * Return page header image html.
	 *
	 * @return string|false The img tag.
	 */
	public static function get_image() {
		if ( null !== static::$image ) {
			return static::$image;
		}

		if ( static::$image_id ) {
			return wp_get_attachment_image( static::$image_id, static::_get_thumbnail_size() );
		}

		$image_url = static::get_image_url();
		if ( $image_url ) {
			static::$image_id = static::_attachment_url_to_postid( $image_url );
			static::$image    = static::$image_id
				? wp_get_attachment_image( static::$image_id, static::_get_thumbnail_size() )
				: sprintf( '<img src="%1$s" alt="">', esc_url( $image_url ) );
		} else {
			static::$image_id = 0;
			static::$image    = false;
		}

		return static::$image;
	}

	/**
	 * Return page header image caption.
	 *
	 * @return string
	 */
	public static function get_image_caption() {
		$image_caption = false;

		if ( null === static::$image_id ) {
			$image_url = static::get_image_url();
			if ( $image_url ) {
				static::$image_id = static::_attachment_url_to_postid( $image_url );
			}
		}

		if ( static::$image_id ) {
			$image_caption = wp_get_attachment_caption( static::$image_id );
		}

		return apply_filters( 'snow_monkey_page_header_image_caption', $image_caption );
	}

	/**
	 * Tries to convert an attachment URL into a post ID.
	 *
	 * @param string $url The URL to resolve.
	 * @return int
	 */
	protected static function _attachment_url_to_postid( $url ) {
		if ( preg_match( '|-scaled\..+$|', $url ) ) {
			return attachment_url_to_postid( $url );
		}

		if ( preg_match( '|-\d+x\d+(\..+)$|', $url ) ) {
			$url = preg_replace( '|-\d+x\d+(\..+)$|', '$1', $url );
			$id  = attachment_url_to_postid( $url );
			if ( 0 !== $id ) {
				return $id;
			}

			$url = preg_replace( '|(\..+)$|', '-scaled$1', $url );
			return attachment_url_to_postid( $url );
		}

		return attachment_url_to_postid( $url );
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

	/**
	 * Return page header image html
	 *
	 * @deprecated
	 *
	 * @return string The img tag.
	 */
	public static function get_the_image() {
		_deprecated_function(
			'\Framework\Contract\Model\Page_Header\get_the_image()',
			'Snow Monkey 11.5.0',
			'\Framework\Contract\Model\Page_Header\get_image()'
		);

		return static::get_image();
	}

	/**
	 * Display page header image
	 *
	 * @deprecated
	 *
	 * @return void
	 */
	public static function the_image() {
		_deprecated_function(
			'\Framework\Contract\Model\Page_Header\the_image()',
			'Snow Monkey 11.5.0'
		);

		echo wp_kses(
			static::get_image(),
			[
				'img' => Helper::img_allowed_attributes(),
			]
		);
	}
}
