<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

add_filter(
	'post_thumbnail_html',
	function( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		if ( '' !== $html ) {
			return $html;
		}

		$default_thumbnail = get_theme_mod( 'default-thumbnail' );
		if ( ! $default_thumbnail ) {
			return $html;
		}

		$cache_group = 'snow-monkey/thumbnail';

		// ID
		$cache_key = 'default-thumbnail-id';
		$image_id  = wp_cache_get( $cache_key, $cache_group );
		if ( false === $image_id ) {
			$image_id = attachment_url_to_postid( $default_thumbnail );
			wp_cache_set( $cache_key, $image_id, $cache_group );
		}

		if ( ! $image_id ) {
			return $html;
		}

		// alt
		$cache_key  = 'default-thumbnail-alt';
		$alt        = wp_cache_get( $cache_key, $cache_group );
		if ( false === $alt ) {
			$post = get_post( $image_id );
			$alt  = $post ? $post->post_excerpt : '';
			wp_cache_set( $cache_key, $alt, $cache_group );
		}

		// img
		$cache_key  = md5( $size . json_encode( $attr ) );
		$image      = wp_cache_get( $cache_key, $cache_group );
		if ( false !== $image ) {
			return $image;
		}

		$attr_html = '';
		$attr = wp_parse_args( $attr, [] );

		if ( empty( $attr['width'] ) || empty( $attr['height'] ) ) {
			$meta         = wp_get_attachment_metadata( $image_id );
			$intermediate = image_get_intermediate_size( $image_id, $size );

			if ( empty( $attr['width'] ) ) {
				$width = $intermediate ? $intermediate['width'] : null;
				$width = ! $width && ! empty( $meta['width'] ) ? $meta['width'] : $width;
				if ( $width ) {
					$attr['width'] = $width;
				}
			}

			if ( empty( $attr['height'] ) ) {
				$height = $intermediate ? $intermediate['height'] : null;
				$height = ! $height && ! empty( $meta['height'] ) ? $meta['height'] : $height;
				if ( ! empty( $height ) ) {
					$attr['height'] = $height;
				}
			}
		}

		foreach ( $attr as $name => $value ) {
			$attr_html .= sprintf( ' %1$s="%2$s"', esc_html( $name ), esc_attr( $value ) );
		}

		$image = sprintf(
			'<img src="%1$s" class="attachment-%2$s size-%2$s wp-post-image" %3$s alt="%4$s">',
			esc_url( $default_thumbnail ),
			esc_attr( $size ),
			$attr_html,
			esc_attr( $alt )
		);

		wp_cache_set( $cache_key, $image, $cache_group );
		return $image;
	},
	9,
	5
);
