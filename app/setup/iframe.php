<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.4.0
 */

/**
 * If the Google Maps embed tag is used in a custom HTML block, wrap it in div tag.
 */
add_filter(
	'render_block',
	function( $block_content, $block ) {
		if ( 'core/html' === $block['blockName'] ) {
			if ( preg_match( '|^<iframe src="https://www.google.com/maps/embed?.+</iframe>$|ms', $block_content ) ) {
				return '<div>' . $block_content . '</div>';
			}
		}

		return $block_content;
	},
	10,
	2
);
