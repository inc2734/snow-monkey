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
