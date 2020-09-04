<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 4.4.0-beta
 */

add_filter(
	'the_password_form',
	function( $output ) {
		global $post;

		if ( ! get_option( 'mwt-protected-more' ) ) {
			return $output;
		}

		$extended = get_extended( $post->post_content );
		if ( empty( $extended['extended'] ) ) {
			return $output;
		}

		return $extended['main'] . $output;
	},
	11
);

add_filter(
	'protected_title_format',
	function( $title ) {
		global $post;

		if ( ! get_option( 'mwt-protected-more' ) ) {
			return $title;
		}

		if ( ! strpos( $post->post_content, '<!--more-->' ) ) {
			return $title;
		}

		return '%s';
	}
);
