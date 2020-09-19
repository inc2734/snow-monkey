<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Inc2734\WP_Share_Buttons\Bootstrap;

new Bootstrap();

/**
 * Set Facebook App token
 *
 * @return string
 */
add_filter(
	'inc2734_wp_share_buttons_facebook_app_token',
	function() {
		return get_theme_mod( 'facebook-app-token' );
	}
);

/**
 * Set count cache time
 *
 * @param int $seconds
 * @return int
 */
add_filter(
	'inc2734_wp_share_buttons_count_cache_seconds',
	function( $seconds ) {
		$new_seconds = get_option( 'mwt-share-buttons-cache-seconds' );
		if ( preg_match( '/^\d+$/', $new_seconds ) ) {
			return $new_seconds;
		}
		return $seconds;
	}
);

/**
 * Count both http and https
 *
 * @return boolean
 */
add_filter(
	'inc2734_wp_share_buttons_apply_https_total_count',
	function() {
		return get_option( 'mwt-share-buttons-count-both' );
	}
);
