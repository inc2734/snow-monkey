<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

$accent_color = get_theme_mod( 'accent-color' );

Style::register(
	'.smb-btn',
	'background-color: ' . $accent_color
);

Style::register(
	[
		'.smb-btn:hover',
		'.smb-btn:active',
		'.smb-btn:focus',
	],
	'background-color: ' . Style::darken( $accent_color, 0.05 ),
	'@media (min-width: 64em)'
);
