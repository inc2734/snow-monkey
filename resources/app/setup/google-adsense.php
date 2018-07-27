<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Enqueue script for Google Adsense
 */
add_action( 'wp_enqueue_scripts', function() {
	if ( ! get_option( 'mwt-google-adsense' ) && ! get_option( 'mwt-google-infeed-ads' ) && ! get_option( 'mwt-google-matched-content' ) ) {
		return;
	}

	wp_enqueue_script(
		'google-adsense',
		'//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js',
		[],
		1,
		true
	);
}, 1 );

/**
 * Set async
 *
 * @param string $tag
 * @param string handle
 * @param string src
 * @return string
 */
add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
	if ( 'google-adsense' !== $handle ) {
		return $tag;
	}

	return str_replace( ' src', ' async src', $tag );
}, 10, 3 );
