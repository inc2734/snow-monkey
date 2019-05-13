<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

Helper::get_template_part(
	'template-parts/loop/entry-summary',
	null,
	[
		'_name'         => 'post',
		'_terms'        => get_the_terms( get_the_ID(), 'category' ),
		'_display_meta' => true,
	]
);
