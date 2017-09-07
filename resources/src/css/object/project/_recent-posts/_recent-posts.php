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
	'.p-recent-posts__more-btn',
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.p-recent-posts__more-btn:hover',
		'.p-recent-posts__more-btn:active',
		'.p-recent-posts__more-btn:focus',
	],
	'background-color: ' . $cfs->darken( $accent_color, 0.05 )
);
