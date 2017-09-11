<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Contents_Outline\Contents_Outline;

new Contents_Outline();

add_filter( 'the_content', function( $content ) {
	$display_contents_outline = get_option( 'mwt-display-contents-outline' );
	if ( ! $display_contents_outline ) {
		return $content;
	}

	if ( is_single() ) {
		$content = sprintf(
			'[wp_contents_outline post_id="%1$d" selector=".c-entry__content"]',
			get_the_ID()
		) . $content;
	}

	return $content;
} );
