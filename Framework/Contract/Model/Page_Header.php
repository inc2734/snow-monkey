<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
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
	 * Page header image ID
	 *
	 * @var int|null
	 */
	protected static $image_id = null;

	/**
	 * Return page header image url.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	abstract protected static function _get_image_url( $size = 'large' );

	/**
	 * Return page header image url.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	public static function get_image_url( $size = 'large' ) {
		return static::_get_image_url( $size );
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
		return static::_get_title();
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
		return static::_get_align();
	}

	/**
	 * Return page header image html.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	abstract protected static function _get_image( $size = 'large' );

	/**
	 * Return page header image html.
	 *
	 * @param string $size The image size.
	 * @return string|false
	 */
	public static function get_image( $size = 'large' ) {
		return static::_get_image( $size );
	}

	/**
	 * Return page header image caption.
	 *
	 * @return string|false
	 */
	abstract protected static function _get_image_caption();

	/**
	 * Return page header image caption.
	 *
	 * @return string
	 */
	public static function get_image_caption() {
		return static::_get_image_caption();
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
			'\Framework\Contract\Model\Page_Header::get_the_image()',
			'Snow Monkey 15.0.0'
		);

		return apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' );
	}

	/**
	 * Return default page header image url.
	 *
	 * @param string $size The image size.
	 * @return string
	 */
	protected static function _get_default_image_url( $size = 'large' ) {
		$default_header_image = get_theme_mod( 'default-page-header-image' );
		return $default_header_image && preg_match( '|^\d+$|', $default_header_image )
			? wp_get_attachment_image( $default_header_image, $size )
			: sprintf( '<img src="%1$s" alt="">', esc_url( $default_header_image ) );
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
			'\Framework\Contract\Model\Page_Header::get_the_image()',
			'Snow Monkey 11.5.0',
			'\Framework\Contract\Model\Page_Header::get_image()'
		);

		return static::get_image();
	}

	/**
	 * Display page header image
	 *
	 * @deprecated
	 */
	public static function the_image() {
		_deprecated_function(
			'\Framework\Contract\Model\Page_Header::the_image()',
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
