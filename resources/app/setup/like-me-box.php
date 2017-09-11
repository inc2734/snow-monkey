<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Like_Me_Box\Like_Me_Box;

new Like_Me_Box();

add_filter( 'inc2734_wp_like_me_box_thumbnail', function( $thumbnail ) {
	if ( $thumbnail ) {
		return $thumbnail;
	}

	if ( get_site_icon_url() ) {
		return get_site_icon_url();
	}

	if ( get_option( 'mwt-default-og-image' ) ) {
		return get_option( 'mwt-default-og-image' );
	}

	return $thumbnail;
} );
