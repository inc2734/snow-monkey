<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Share_Buttons\Share_Buttons;

new Share_Buttons();

/**
 * Set count cache time
 *
 * @param  {int} $seconds
 * @return {int}
 */
add_filter( 'inc2734_wp_share_buttons_count_cache_seconds', function( $seconds ) {
	$new_seconds = get_option( 'inc2734-theme-option-share-buttons-cache-seconds' );
	if ( preg_match( '/^\d+$/', $new_seconds ) ) {
		return $new_seconds;
	}
	return $seconds;
} );
