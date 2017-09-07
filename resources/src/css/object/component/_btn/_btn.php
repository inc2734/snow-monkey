<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$cfs = Customizer_Framework::styles();

$accent_color = get_theme_mod( 'accent-color' );

$cfs->register(
	'.c-btn',
	"background-color: " . $accent_color
);

$cfs->register(
	[
		'.c-btn:hover',
		'.c-btn:active',
		'.c-btn:focus',
	],
	"background-color: " . $cfs->darken( $accent_color, 0.05 )
);
