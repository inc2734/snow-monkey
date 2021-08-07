<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.2
 */

add_filter(
	'render_block',
	function( $block_content, $block ) {
		if (
			! empty( $block['attrs']['align'] )
			&& in_array( $block['attrs']['align'], [ 'left', 'center', 'right' ], true )
		) {
			$block_content = str_replace( ' align' . $block['attrs']['align'], '', $block_content );
			$block_content = str_replace( 'align' . $block['attrs']['align'] . ' ', '', $block_content );
			$block_content = '<div class="u-align' . $block['attrs']['align'] . '-wrapper">' . $block_content . '</div>';
		}

		return $block_content;
	},
	10,
	2
);
