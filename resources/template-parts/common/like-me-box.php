<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/like-me-box.php
 */

use Framework\Helper;

$facebook_page_name = Helper::get_var( $_facebook_page_name, get_option( 'mwt-facebook-page-name' ) );

if ( ! $facebook_page_name ) {
	return;
}

echo do_shortcode(
	sprintf(
		'[wp_like_me_box facebook_page_name="%1$s"]',
		esc_attr( $facebook_page_name )
	)
);
