<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.2.4
 */

/**
 * If the Google Maps embed tag is used in a custom HTML block, wrap it in div tag.
 */
add_filter(
	'render_block',
	function ( $block_content, $block ) {
		if ( 'core/html' === $block['blockName'] ) {
			if (
				preg_match( '|^<iframe src="https://www.google.com/maps/embed?.+</iframe>$|ms', $block_content )
				|| preg_match( '|^<iframe ?.*? src="https://www.youtube.com/embed?.+</iframe>$|ms', $block_content )
				|| preg_match( '|^<blockquote ?.*? data-instgrm-permalink="https://www.instagram.com/p?.+</script>$|ms', $block_content )
			) {
				return '<div>' . $block_content . '</div>';
			}
		}

		return $block_content;
	},
	10,
	2
);
