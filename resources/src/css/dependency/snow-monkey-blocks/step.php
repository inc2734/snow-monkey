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
	[
		'.smb-step__item__link__label',
		'.smb-step__item__link .fa-arrow-circle-right',
	],
	'color: ' . $accent_color
);
