<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

namespace Framework\Contract\Helper;

trait Deprecated {

	/**
	 * Return default header position
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_default_header_position() {
		return get_theme_mod( 'header-position' );
	}

	/**
	 * Return header position
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_header_position() {
		if ( ! wp_is_mobile() && get_theme_mod( 'header-position-only-mobile' ) ) {
			return;
		}
		return \Framework\Helper::get_default_header_position();
	}

	/**
	 * Return header-position-fixed
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_header_position_fixed() {
		$fixed           = get_theme_mod( 'header-position-fixed' );
		$header_position = get_theme_mod( 'header-position' );

		if ( 'overlay' !== $header_position ) {
			return null;
		}

		return $fixed ? 'true' : 'false';
	}

	/**
	 * Return scrolling-header-colored
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_scrolling_header_colored() {
		$scrolling_colored  = get_theme_mod( 'scrolling-header-colored' );
		$header_position    = get_theme_mod( 'header-position' );
		$header_position_lg = get_theme_mod( 'header-position-lg' );

		if ( 'overlay' !== $header_position && 'overlay' !== $header_position_lg ) {
			return null;
		}

		return $scrolling_colored ? 'true' : 'false';
	}

	/**
	 * The overlay header and the ticky overlay has infobar in the header.
	 *
	 * @deprecated
	 *
	 * @return boolean
	 */
	public static function should_infobar_in_header() {
		return in_array( get_theme_mod( 'header-position' ), [ 'overlay', 'sticky-overlay' ], true );
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

		return \Framework\Helper::display_page_header();
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

		$class = \Framework\Helper::get_page_header_class();
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

		$image = \Framework\Helper::get_page_header_image();
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

		echo wp_kses_post( \Framework\Helper::get_page_header_image() );
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

		$class = \Framework\Helper::_get_page_header_class();
		if ( $class && $class::get_title() ) {
			$return = true;
		}

		return apply_filters_deprecated(
			'snow_monkey_is_output_page_header_title',
			[ $return ],
			'Snow Monkey 11.5.0'
		);
	}

	/**
	 * Return true when have category thumbanil.
	 *
	 * @deprecated
	 *
	 * @param array|null $term Array of the term data.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return boolean
	 */
	public static function has_category_thumbnail( $term = null ) {
		_deprecated_function(
			__FUNCTION__,
			'Snow Monkey 14.0.0',
			'\Framework\Helper::has_term_thumbnail()'
		);

		return \Framework\Helper::has_term_thumbnail( $term );
	}

	/**
	 * Return term data for category thumbnail.
	 *
	 * @deprecated
	 *
	 * @param array|null $term Array of the term data.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return array|false
	 *    @var int term_id
	 *    @var string taxonomy
	 */
	public static function get_category_thumbnail_term( $term = null ) {
		_deprecated_function(
			__FUNCTION__,
			'Snow Monkey 14.0.0',
			'\Framework\Helper::get_term_thumbnail_term()'
		);

		return \Framework\Helper::get_term_thumbnail_term( $term );
	}

	/**
	 * Return category thumbnail url.
	 *
	 * @deprecated
	 *
	 * @param array|null $term Array of the term data.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return string
	 */
	public static function get_the_category_thumbnail_url( $term = null ) {
		_deprecated_function(
			__FUNCTION__,
			'Snow Monkey 14.0.0',
			'\Framework\Helper::get_the_category_thumbnail_url()'
		);

		return \Framework\Helper::get_the_term_thumbnail_url( $term );
	}

	/**
	 * Return category header image.
	 *
	 * @deprecated
	 *
	 * @param array|null $term Array of the term data.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return string
	 */
	public static function get_the_category_thumbnail( $term = null ) {
		_deprecated_function(
			__FUNCTION__,
			'Snow Monkey 14.0.0',
			'\Framework\Helper::get_the_term_thumbnail()'
		);

		return \Framework\Helper::get_the_term_thumbnail( $term );
	}

	/**
	 * Display category thumbnail.
	 *
	 * @deprecated
	 *
	 * @param array|null $term Array of the term data.
	 *    @var int term_id
	 *    @var string taxonomy
	 * @return void
	 */
	public static function the_category_thumbnail( $term = null ) {
		_deprecated_function(
			__FUNCTION__,
			'Snow Monkey 14.0.0',
			'\Framework\Helper::the_term_thumbnail()'
		);

		\Framework\Helper::the_term_thumbnail( $term );
	}
}
