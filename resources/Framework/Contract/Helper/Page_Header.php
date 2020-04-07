<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.5
 */

namespace Framework\Contract\Helper;

trait Page_Header {

	/**
	 * Return page header class
	 *
	 * @return string
	 */
	protected static function _get_page_header_class() {
		$queried_object = get_queried_object();
		$cache_key      = md5( json_encode( $queried_object ) );
		$cache          = wp_cache_get( $cache_key, 'page_header_class' );

		if ( false !== $cache ) {
			return $cache;
		}

		$class = static::_get_page_header_class_no_cache();
		wp_cache_set( $cache_key, $class, 'page_header_class' );
		return $class;
	}

	/**
	 * Return page header class
	 *
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 *
	 * @return string
	 */
	protected static function _get_page_header_class_no_cache() {
		$custom_post_types = \Framework\Helper::get_custom_post_types();
		$types = array_filter(
			[
				'Default'  => is_search() || is_404(),
				'Singular' => is_singular( array_merge( [ 'post' ], $custom_post_types ) ) || is_page() && ! is_front_page(),
				'Category' => is_category(),
				'Home'     => is_home() || ( is_archive() && ! is_post_type_archive() && ! is_tax() ),
				'Front'    => is_front_page() && ! is_home(),
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
	 * Returns page header image url
	 *
	 * @SuppressWarnings(PHPMD.UndefinedVariable)
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_page_header_image_url() {
		_deprecated_function(
			'\Framework\Contract\Helper::get_page_header_image_url()',
			'Snow Monkey 5.1.0'
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
	 * Returns page header image
	 *
	 * @return string
	 */
	public static function get_page_header_image() {
		$url = apply_filters( 'snow_monkey_pre_page_header_image_url', null );
		if ( ! $url ) {
			// @deprecated
			$url = apply_filters( 'snow_monkey_page_header_image_url', $url );
			if ( has_filter( 'snow_monkey_page_header_image_url' ) ) {
				_deprecated_hook(
					'snow_monkey_page_header_image_url',
					'Snow Monkey 5.1.0'
				);
			}
		}

		if ( $url ) {
			return sprintf(
				'<img src="%1$s" alt="">',
				esc_url( $url )
			);
		}

		$class = static::_get_page_header_class();
		if ( ! $class ) {
			return;
		}

		$is_singular        = false !== strpos( $class, '\Singular_Page_Header' );
		$is_displayed_image = in_array( get_theme_mod( get_post_type() . '-eyecatch' ), [ 'page-header', 'title-on-page-header' ] );

		if ( $is_singular && ! $is_displayed_image ) {
			return;
		}

		return $class::get_the_image();
	}

	/**
	 * Display page header image
	 *
	 * @deprecated
	 * @return void
	 */
	public static function the_page_header_image() {
		_deprecated_function(
			'\Framework\Contract\Helper::the_page_header_image()',
			'Snow Monkey 5.1.0'
		);

		echo wp_kses_post( static::get_page_header_image() );
	}

	/**
	 * Return whether to display the page header title
	 *
	 * @return boolean
	 */
	public static function is_output_page_header_title() {
		$return = false;

		$is_singular        = false !== strpos( static::_get_page_header_class(), '\Singular_Page_Header' );
		$is_displayed_title = in_array( get_theme_mod( get_post_type() . '-eyecatch' ), [ 'title-on-page-header' ] );

		if ( $is_singular && $is_displayed_title ) {
			$return = true;
		}

		return apply_filters( 'snow_monkey_is_output_page_header_title', $return );
	}

	/**
	 * Return whether to display the page header
	 *
	 * @return boolean
	 */
	public static function is_output_page_header() {
		$return = false;

		if ( static::is_output_page_header_title() ) {
			$return = true;
		} elseif ( static::get_page_header_image() ) {
			$return = true;
		}

		return apply_filters( 'snow_monkey_is_output_page_header', $return );
	}
}
