<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'mimizuku_layout', function( $layout ) {
	if ( is_home() || is_archive() || is_search() ) {
		return get_theme_mod( 'post-archive-layout' );
	}

	if ( is_front_page() ) {
		return 'one-column-fluid';
	}

	$post_type = get_post_type();
	if ( ! $post_type ) {
		$post_type = 'page';
	}

	if ( is_singular() || is_404() ) {
		$_wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
		if ( $_wp_page_template && 'default' !== $_wp_page_template ) {
			return $layout;
		}

		$post_type_layout = get_theme_mod( $post_type . '-layout' );
		if ( $post_type_layout ) {
			return $post_type_layout;
		}
	} else {
		$post_type_archive_layout = get_theme_mod( $post_type . '-archive-layout' );
		if ( $post_type_archive_layout ) {
			return $post_type_archive_layout;
		}
	}

	return $layout;
} );
