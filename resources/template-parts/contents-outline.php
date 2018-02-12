<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */


echo do_shortcode( sprintf(
	'[wp_contents_outline post_id="%1$d" selector=".c-entry__content" move_to_before_1st_heading="true"]',
	get_the_ID()
) );
