<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

if ( ! class_exists( 'CheckCopyContents' ) ) {
	return;
}

/**
 * Add .p-entry-content to .theContentWrap-ccc
 *
 * @param string $content
 * @param string $slug
 * @return string
 */
add_filter(
	'inc2734_view_controller_template_part_render',
	function( $content, $slug ) {
		if ( 'templates/view/content' === $slug ) {
			$content = str_replace( 'class="theContentWrap-ccc"', 'class="theContentWrap-ccc p-entry-content"', $content );
		}
		return $content;
	},
	10,
	2
);
