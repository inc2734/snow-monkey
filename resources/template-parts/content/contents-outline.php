<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.6
 *
 * renamed: template-parts/contents-outline.php
 */

$args = wp_parse_args(
	$args,
	[
		'_title' => __( 'Contents outline', 'snow-monkey' ),
	]
);

echo do_shortcode(
	sprintf(
		'[wp_contents_outline post_id="%1$d" selector=".c-entry__content, .c-entry__content .wp-block-group__inner-container" move_to_before_1st_heading="true" title="%2$s"]',
		esc_attr( get_the_ID() ),
		$args['_title']
	)
);
