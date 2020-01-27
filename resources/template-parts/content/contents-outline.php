<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/contents-outline.php
 */

echo do_shortcode(
	sprintf(
		'[wp_contents_outline post_id="%1$d" selector=".c-entry__content, .c-entry__content .wp-block-group__inner-container" move_to_before_1st_heading="true"]',
		esc_attr( get_the_ID() )
	)
);
