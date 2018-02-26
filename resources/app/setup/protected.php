<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'the_password_form', function( $output ) {
	global $post;

	if ( ! get_option( 'mwt-protected-more' ) ) {
		return $output;
	}

	if ( ! strpos( $post->post_content, '<!--more-->' ) ) {
		return $output;
	}

	$content = explode( '<!--more-->', $post->post_content );
	$before_content = $content[0];

	return $before_content . $output;
} );

add_filter( 'protected_title_format', function( $title ) {
	global $post;

	if ( ! get_option( 'mwt-protected-more' ) ) {
		return $title;
	}

	if ( ! strpos( $post->post_content, '<!--more-->' ) ) {
		return $title;
	}

	return '%s';
} );
