<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.4.2
 *
 * renamed: template-parts/contents-outline.php
 */

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_title' => __( 'Contents outline', 'snow-monkey' ),
	)
);

echo do_shortcode(
	sprintf(
		'[wp_contents_outline post_id="%1$d" selector=".c-entry__content,.c-entry__content .wp-block-group,.c-entry__content .wp-block-group__inner-container" move_to_before_1st_heading="true" title="%2$s" move_to=".c-entry__content"]',
		esc_attr( get_the_ID() ),
		$args['_title']
	)
);
