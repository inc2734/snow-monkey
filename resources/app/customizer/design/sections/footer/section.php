<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 *
 * renamed: app/customizer/layout/sections/footer/section.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'footer',
	[
		'title'    => __( 'Footer', 'snow-monkey' ),
		'priority' => 120,
	]
);
