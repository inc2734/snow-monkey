<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.2.0
 */

add_filter(
	'the_password_form',
	function( $output ) {
		global $post;

		if ( ! get_option( 'mwt-protected-more' ) ) {
			return $output;
		}

		$extended             = get_extended( $post->post_content );
		$support_inner_blocks = apply_filters( 'snow_monkey_protected_more_support_inner_blocks', false ); // @todo Experimental.

		if ( empty( $extended['extended'] ) ) {
			return $output;
		} elseif ( $support_inner_blocks ) {
			$extended_extended = trim( str_replace( '<!-- /wp:more -->', '', $extended['extended'] ) );
			$parsed_extended   = parse_blocks( $extended_extended );
			if ( 0 < count( $parsed_extended ) ) {
				$last_extended           = end( $parsed_extended );
				$last_extended_innerhtml = trim( $last_extended['innerHTML'] );
				if ( 0 === strpos( $last_extended_innerhtml, '</' ) ) {
					$output = $output . $last_extended['innerHTML'];
				}
			}
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
