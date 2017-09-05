<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Like_Me_Box\Like_Me_Box;

new Like_Me_Box();

$facebook_page_name = get_option( 'mwt-facebook-page-name' );

if ( ! $facebook_page_name ) {
	return;
}

echo do_shortcode( '[wp_like_me_box facebook_page_name="' . $facebook_page_name . '"]' );
