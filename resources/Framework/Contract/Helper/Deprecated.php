<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
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
		return static::get_default_header_position();
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
		return in_array( get_theme_mod( 'header-position' ), [ 'overlay', 'sticky-overlay' ] );
	}
}
