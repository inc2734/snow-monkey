<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.0
 */

use Inc2734\WP_Like_Me_Box\Bootstrap;

new Bootstrap();

add_filter(
	'inc2734_wp_like_me_box_thumbnail',
	function( $thumbnail ) {
		if ( $thumbnail ) {
			return $thumbnail;
		}

		if ( get_theme_mod( 'default-thumbnail' ) ) {
			return get_theme_mod( 'default-thumbnail' );
		}

		if ( get_option( 'mwt-default-og-image' ) ) {
			return get_option( 'mwt-default-og-image' );
		}

		if ( get_site_icon_url() ) {
			return get_site_icon_url();
		}

		return $thumbnail;
	}
);
