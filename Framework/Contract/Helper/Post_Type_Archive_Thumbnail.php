<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 */

namespace Framework\Contract\Helper;

trait Post_Type_Archive_Thumbnail {

	/**
	 * Return true when have post type archive thumbanil.
	 *
	 * @param string|null $post_type The post type name.
	 * @return boolean
	 */
	public static function has_post_type_archive_thumbnail( $post_type = null ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;
		return get_theme_mod( $post_type . '-header-image' ) ? true : false;
	}

	/**
	 * Return post type archive thumbnail url.
	 *
	 * @param string|null $post_type The post type name.
	 * @return string
	 */
	public static function get_the_post_type_archive_thumbnail_url( $post_type = null ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;

		if ( ! static::has_post_type_archive_thumbnail( $post_type ) ) {
			return '';
		}

		return get_theme_mod( $post_type . '-header-image' );
	}

	/**
	 * Return post type archive header image.
	 *
	 * @param string|null $post_type The post type name.
	 * @return string
	 */
	public static function get_the_post_type_archive_thumbnail( $post_type = null ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;

		if ( ! static::has_post_type_archive_thumbnail( $post_type ) ) {
			return '';
		}

		$header_image = get_theme_mod( $post_type . '-header-image' );
		if ( ! $header_image ) {
			return '';
		}

		return sprintf(
			'<img src="%1$s" alt="">',
			esc_url( $header_image )
		);
	}

	/**
	 * Display post type archive thumbnail.
	 *
	 * @param string|null $post_type The post type name.
	 * @return void
	 */
	public static function the_post_type_archive_thumbnail( $post_type = null ) {
		$post_type = null === $post_type ? get_post_type() : $post_type;

		echo wp_kses(
			static::get_the_post_type_archive_thumbnail( $post_type ),
			[
				'img' => static::img_allowed_attributes(),
			]
		);
	}

	/**
	 * Return allowd attributes of img
	 *
	 * @return array
	 */
	abstract public static function img_allowed_attributes();
}
