<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

namespace Framework\Contract\Helper;

trait Homepage_Thumbnail {

	/**
	 * Return true when has homepage thumbnail
	 *
	 * @return boolean
	 */
	public static function has_homepage_thumbnail() {
		if ( 'page' !== get_option( 'show_on_front' ) || ! get_option( 'page_for_posts' ) ) {
			return false;
		}

		$thumbnail_id = get_post_thumbnail_id( get_option( 'page_for_posts' ) );
		if ( ! $thumbnail_id ) {
			return false;
		}

		return true;
	}

	/**
	 * Return homepage thumbnail url
	 *
	 * @param string $size The thumbnail size slug.
	 * @return string
	 */
	public static function get_the_homepage_thumbnail_url( $size = 'large' ) {
		if ( ! static::has_homepage_thumbnail() ) {
			return '';
		}

		return get_the_post_thumbnail_url( get_option( 'page_for_posts' ), $size );
	}

	/**
	 * Return homepage thumbnail
	 *
	 * @param string $size The thumbnail size slug.
	 * @return string
	 */
	public static function get_the_homepage_thumbnail( $size = 'large' ) {
		if ( ! static::has_homepage_thumbnail() ) {
			return '';
		}

		return get_the_post_thumbnail( get_option( 'page_for_posts' ), $size );
	}

	/**
	 * Display homepage thumbnail
	 *
	 * @param string $size The thumbnail size slug.
	 * @return void
	 */
	public static function the_homepage_thumbnail( $size = 'large' ) {
		echo wp_kses(
			static::get_the_homepage_thumbnail( $size ),
			[
				'img' => static::img_allowed_attributes(),
			]
		);
	}

	/**
	 * Return homepage thumbnail caption.
	 *
	 * @return string
	 */
	public static function get_the_homepage_thumbnail_caption() {
		if ( ! static::has_homepage_thumbnail() ) {
			return '';
		}

		return wp_get_attachment_caption( get_post_thumbnail_id( get_option( 'page_for_posts' ) ) );
	}

	/**
	 * Return allowed attributes of img.
	 *
	 * @return array
	 */
	abstract public static function img_allowed_attributes();
}
