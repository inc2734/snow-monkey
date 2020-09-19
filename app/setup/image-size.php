<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

add_image_size( 'xlarge', 1920, 1920 );

/**
 * Maximum image width to be included in a 'srcset' attribute.
 *
 * @return int
 */
add_filter(
	'max_srcset_image_width',
	function() {
		return 1920;
	}
);

/**
 * Add xlarge on media uploader and wp.media.sizes
 *
 * @param array $sizes
 * @return array
 */
add_filter(
	'image_size_names_choose',
	function( $sizes ) {
		return array_merge(
			$sizes,
			[
				'xlarge' => __( 'xLarge', 'snow-monkey' ),
			]
		);
	}
);
