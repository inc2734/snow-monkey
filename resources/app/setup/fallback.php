<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter(
	'inc2734_view_controller_template_part_render',
	function( $content, $slug ) {
		if ( 'templates/view/content' === $slug ) {
			$content = str_replace( 'class="c-entry__content"', 'class="c-entry__content p-entry-content"', $content );
		}
		return $content;
	},
	10,
	2
);

add_filter(
	'the_content',
	function( $content ) {
		return str_replace( 'wpac-section__body', 'wpac-section__body p-*.scss', $content );
	}
);

add_filter(
	'the_content',
	function( $content ) {
		return str_replace( 'wpac-columns__col-inner', 'wpac-columns__col-inner p-entry-content', $content );
	}
);

add_filter(
	'the_content',
	function( $content ) {
		return str_replace( 'wpac-section__container', 'c-container', $content );
	}
);
