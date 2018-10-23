<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
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

		$attr_html = '';
		$attr = wp_parse_args( $attr, [] );
		foreach ( $attr as $name => $value ) {
			$attr_html .= sprintf( ' %1$s="%2$s"', $name, $value );
		}

		return sprintf(
			'<img src="%1$s" class="attachment-%2$s size-%2$s wp-post-image" %3$s alt="">',
			esc_url( $default_thumbnail ),
			esc_attr( $size ),
			esc_attr( $attr_html )
		);
	},
	10,
	5
);
