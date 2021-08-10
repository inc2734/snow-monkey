<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
 */

add_filter(
	'post_thumbnail_html',
	function( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		if ( '' !== $html ) {
			return $html;
		}

		$cache_key   = 'default-thumbnail';
		$cache_key   = crc32( $size . json_encode( $attr ) );
		$cache_group = 'snow-monkey/thumbnail';
		$cache       = wp_cache_get( $cache_key, $cache_group );
		if ( false !== $cache ) {
			return $cache;
		}

		$default_thumbnail = get_theme_mod( 'default-thumbnail' );
		if ( ! $default_thumbnail ) {
			return $html;
		}

		$image_id = $default_thumbnail && preg_match( '|^\d+$|', $default_thumbnail )
			? $default_thumbnail
			: attachment_url_to_postid( $default_thumbnail );

		if ( ! $image_id ) {
			return $html;
		}

		$image = wp_get_attachment_image( $image_id, $size, false, $attr );
		wp_cache_set( $cache_key, $image, $cache_group );
		return $image;
	},
	9,
	5
);
