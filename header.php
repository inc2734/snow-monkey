<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Framework\Helper;

Helper::get_header_template(
	get_theme_mod( 'header-layout' ),
	null,
	array(
		'_title_tag' => is_front_page() ? 'h1' : 'div',
	)
);
