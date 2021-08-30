<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.6.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'snow-monkey-forms',
	[
		'title'           => __( 'Snow Monkey Forms', 'snow-monkey' ),
		'priority'        => 1080,
		'active_callback' => function() {
			return defined( 'SNOW_MONKEY_FORMS_PATH' );
		},
	]
);
