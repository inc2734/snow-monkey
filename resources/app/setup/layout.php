<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'mimizuku_layout', function( $layout ) {
	if ( is_home() || is_archive() || is_search() ) {
		return 'one-column';
	}

	$_wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
	if ( $_wp_page_template && 'default' !== $_wp_page_template ) {
		return $layout;
	}

	if ( is_front_page() ) {
		return 'one-column-fluid';
	}

	$post_type = get_post_type();
	if ( ! $post_type ) {
		$post_type = 'page';
	}

	return get_theme_mod( $post_type . '-layout' );
} );
