<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_image_size( 'xlarge', 1920, 1920 );

/**
 * Maximum image width to be included in a 'srcset' attribute.
 *
 * @return int
 */
add_filter(
	'max_srcset_image_width',
	function( $width ) {
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

/**
 * Update showcase widget background image size
 */
add_filter(
	'inc2734_wp_awesome_widgets_showcase_backgroud_image_size',
	function( $thumbnail_size ) {
		return 'xlarge';
	}
);

/**
 * Update showcase widget thumbnail image size
 */
add_filter(
	'inc2734_wp_awesome_widgets_showcase_image_size',
	function( $thumbnail_size ) {
		return 'xlarge';
	}
);
