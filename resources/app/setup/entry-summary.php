<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'excerpt_length', function( $length ) {
	if ( 'rich-media' !== get_theme_mod( 'archive-layout' ) ) {
		return $length;
	}

	if ( class_exists( 'multibyte_patch' ) ) {
		return 50;
	}

	return 25;
}, 99 );
