<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$display_profile_box = get_option( 'mwt-display-profile-box' );
if ( ! $display_profile_box ) {
	return;
}

echo do_shortcode( '[wp_profile_box]' );
