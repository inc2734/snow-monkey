<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
 */

use Inc2734\WP_Like_Me_Box\Bootstrap;

new Bootstrap();

add_filter(
	'inc2734_wp_like_me_box_thumbnail',
	function( $thumbnail ) {
		if ( $thumbnail ) {
			return $thumbnail;
		}

		$default_thumbnail = get_theme_mod( 'default-thumbnail' );
		if ( $default_thumbnail ) {
			return $default_thumbnail && preg_match( '|^\d+$|', $default_thumbnail )
				? wp_get_attachment_image_url( $default_thumbnail, 'large' )
				: $default_thumbnail;
		}

		$default_og_image = get_option( 'mwt-default-og-image' );
		if ( $default_og_image ) {
			return $default_og_image && preg_match( '|^\d+$|', $default_og_image )
				? wp_get_attachment_image_url( $default_og_image, 'large' )
				: $default_og_image;
		}

		if ( get_site_icon_url() ) {
			return get_site_icon_url();
		}

		return $thumbnail;
	}
);
