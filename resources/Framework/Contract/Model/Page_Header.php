<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.13.0
 */

namespace Framework\Contract\Model;

abstract class Page_Header {

	/**
	 * Return page header image url
	 *
	 * @return string
	 */
	abstract public static function get_image_url();

	/**
	 * Display page header image
	 *
	 * @return void
	 */
	public static function the_image() {
		$image_url = static::get_image_url();
		if ( ! $image_url ) {
			return;
		}

		$image_id = attachment_url_to_postid( $image_url );
		$post     = get_post( $image_id );
		$alt      = $post->post_excerpt;

		if ( ! $image_id ) {
			$image = sprintf(
				'<img src="%1$s" alt="%2$s">',
				esc_url( $image_url ),
				esc_attr( $alt )
			);
		} else {
			$image = wp_get_attachment_image( $image_id, static::_get_thumbnail_size() );
		}

		echo wp_kses_post( $image );
	}

	/**
	 * Return thumbnail size of page header image
	 *
	 * @return string
	 */
	protected static function _get_thumbnail_size() {
		return apply_filters( 'snow_monkey_page_header_thumbnail_size', 'xlarge' );
	}

	/**
	 * Return default page header image url
	 *
	 * @return string
	 */
	protected static function _get_default_image_url() {
		return get_theme_mod( 'default-page-header-image' );
	}
}
