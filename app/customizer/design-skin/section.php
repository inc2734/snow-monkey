<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-skin',
	[
		'title'       => __( 'Design skin', 'snow-monkey' ),
		'priority'    => 1030,
		'description' => sprintf(
			/* translators: 1: <a> tag, 2: </a> tag */
			__( 'Design skins can be downloaded from the %1$sdesign skin page%2$s.', 'snow-monkey' ),
			'<a href="https://snow-monkey.2inc.org/design-skin/" target="_blank" rel="noreferrer">',
			'</a>'
		),
	]
);
