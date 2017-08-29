<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'inc2734_wp_like_me_box_thumbnail', function( $thumbnail ) {
	if ( $thumbnail ) {
		return $thumbnail;
	}

	if ( get_site_icon_url() ) {
		return get_site_icon_url();
	}

	if ( get_option( 'inc2734-theme-option-default-og-image' ) ) {
		return get_option( 'inc2734-theme-option-default-og-image' );
	}

	return $thumbnail;
} );
