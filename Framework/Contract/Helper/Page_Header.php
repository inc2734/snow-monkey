<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
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
				'WooCommerce_Term'    => class_exists( '\woocommerce' ) && ( is_product_category() || is_product_tag() ),
				'WooCommerce_Archive' => class_exists( '\woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() ),
				'Singular'            => is_singular( array_merge( [ 'post' ], $custom_post_types ) ) || is_page() && ! is_front_page(),
				'Term'                => is_category() || is_tag() || is_tax(),
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
}
