<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_action( 'amp_post_template_css', function() {
	$relative_path = '/assets/css/amp.min.css';
	$src  = get_theme_file_uri( $relative_path );
	$path = get_theme_file_path( $relative_path );

	if ( ! file_exists( $path ) ) {
		return;
	}

	$css = file_get_contents( $path );
	$css = str_replace( '!important', '', $css );
	// @codingStandardsIgnoreStart
	echo $css;
	// @codingStandardsIgnoreEnd
} );
