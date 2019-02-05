<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework\Contract\Helper;

trait Page_Header {

	/**
	 * Return page header class
	 *
	 * @return string
	 */
	protected static function _get_class() {
		$types = array_filter(
			[
				'Default'  => is_search() || is_404(),
				'Post'     => is_singular( 'post' ),
				'Page'     => is_page() && ! is_front_page(),
				'Category' => is_category(),
				'Home'     => is_home() || ( is_archive() && ! is_post_type_archive() ),
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
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_page_header_image_url() {
		$image = static::get_page_header_image();
		if ( ! $image ) {
			return;
		}

		if ( ! preg_match( '@ data-src="([^"]*?)"@', $image, $matches ) ) {
			if ( ! preg_match( '@ src="([^"]*?)"@', $image, $matches ) ) {
				return false;
			}
		}

		return $matches[1];
	}

	/**
	 * Returns page header image
	 *
	 * @return string
	 */
	public static function get_page_header_image() {
		$url = apply_filters( 'snow_monkey_pre_page_header_image_url', null );
		if ( ! $url ) {
			// @deprecated filter
			$url = apply_filters( 'snow_monkey_page_header_image_url', $url );
		}

		if ( $url ) {
			return sprintf(
				'<img src="%1$s" alt="">',
				esc_url( $url )
			);
		}

		$class = static::_get_class();
		if ( $class ) {
			ob_start();
			$class::the_image();
			return ob_get_clean();
		}
	}

	/**
	 * Display page header image
	 *
	 * @return void
	 */
	public static function the_page_header_image() {
		echo wp_kses_post( static::get_page_header_image() );
	}

	/**
	 * Return whether to display the page header title
	 *
	 * @return boolean
	 */
	public static function is_output_page_header_title() {
		$return = false;

		if ( is_page() && ! is_front_page() && 'title-on-page-header' === get_theme_mod( 'page-eyecatch' ) ) {
			$return = true;
		} elseif ( is_singular( 'post' ) && 'title-on-page-header' === get_theme_mod( 'post-eyecatch' ) ) {
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
