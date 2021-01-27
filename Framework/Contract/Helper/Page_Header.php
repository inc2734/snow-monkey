<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

namespace Framework\Contract\Helper;

trait Page_Header {

	/**
	 * The page header class.
	 *
	 * @var string
	 */
	protected static $page_header_class = null;

	/**
	 * Return page header class.
	 *
	 * @return string|false|null
	 */
	public static function get_page_header_class() {
		if ( null !== static::$page_header_class ) {
			return static::$page_header_class;
		}

		$class = static::_get_page_header_class();
		if ( $class && class_exists( $class ) ) {
			static::$page_header_class = $class;
		}

		return static::$page_header_class;
	}

	/**
	 * Return page header class.
	 *
	 * @return string|false
	 */
	protected static function _get_page_header_class() {
		$custom_post_types = \Framework\Helper::get_custom_post_types();

		$types = array_filter(
			[
				'Default'             => is_search() || is_404(),
				'WooCommerce_Single'  => class_exists( '\woocommerce' ) && is_product(),
				'WooCommerce_Archive' => class_exists( '\woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() ),
				'Singular'            => is_singular( array_merge( [ 'post' ], $custom_post_types ) ) || is_page() && ! is_front_page(),
				'Category'            => is_category() || ( is_tax() && is_taxonomy_hierarchical( get_queried_object()->taxonomy ) ),
				'Tag'                 => is_tag() || ( is_tax() && ! is_taxonomy_hierarchical( get_queried_object()->taxonomy ) ),
				'Archive'             => is_home() || ( is_archive() && ! is_category() && ! is_tag() && ! is_tax() ),
				'Front'               => is_front_page() && ! is_home(),
			]
		);

		if ( ! $types ) {
			return false;
		}

		$class = '\Framework\Model\Page_Header\\' . key( $types ) . '_Page_Header';
		if ( ! class_exists( $class ) ) {
			return false;
		}

		return $class;
	}

	/**
	 * Return whether to display the page header.
	 *
	 * @return boolean
	 */
	public static function display_page_header() {
		$class = static::get_page_header_class();

		$return = false;

		if ( $class ) {
			if ( $class::get_title() ) {
				$return = true;
			} elseif ( $class::get_image() ) {
				$return = true;
			}
		}

		return apply_filters( 'snow_monkey_is_output_page_header', $return );
	}

	/**
	 * Return whether to display the page header.
	 *
	 * @deprecated
	 *
	 * @return boolean
	 */
	public static function is_output_page_header() {
		_deprecated_function(
			'\Framework\Helper::is_output_page_header()',
			'Snow Monkey 11.5.0',
			'\Framework\Helper::display_page_header()'
		);

		return static::display_page_header();
	}

	/**
	 * Returns page header image.
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_page_header_image() {
		_deprecated_function(
			'\Framework\Helper::get_page_header_image()',
			'Snow Monkey 11.5.0',
			'\Framework\Helper::get_page_header_class()::get_image()'
		);

		$class = static::get_page_header_class();
		return $class::get_image();
	}

	/**
	 * Returns page header image url.
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_page_header_image_url() {
		_deprecated_function(
			'\Framework\Helper::get_page_header_image_url()',
			'Snow Monkey 5.1.0',
			'\Framework\Helper::get_page_header_class()::get_image_url()'
		);

		$image = static::get_page_header_image();
		if ( ! $image ) {
			return;
		}

		if ( preg_match( '@ data-src="([^"]*?)"@', $image, $matches ) ) {
			return $matches[1];
		}

		if ( preg_match( '@ src="([^"]*?)"@', $image, $matches ) ) {
			return $matches[1];
		}

		return false;
	}

	/**
	 * Display page header image.
	 *
	 * @deprecated

	 * @return void
	 */
	public static function the_page_header_image() {
		_deprecated_function(
			'\Framework\Helper::the_page_header_image()',
			'Snow Monkey 5.1.0'
		);

		echo wp_kses_post( static::get_page_header_image() );
	}

	/**
	 * Return whether to display the page header title.
	 *
	 * @deprecated
	 *
	 * @return boolean
	 */
	public static function is_output_page_header_title() {
		_deprecated_function(
			'\Framework\Helper::is_output_page_header_title()',
			'Snow Monkey 11.5.0'
		);

		$return = false;

		$class = static::_get_page_header_class();
		if ( $class && $class::get_title() ) {
			$return = true;
		}

		return apply_filters_deprecated(
			'snow_monkey_is_output_page_header_title',
			[ $return ],
			'Snow Monkey 11.5.0'
		);
	}
}
