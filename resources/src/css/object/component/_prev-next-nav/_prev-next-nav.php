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
	'.c-prev-next-nav__item > a::before',
	'background-image: radial-gradient(' . $cfs->rgba( $accent_color, 0.5 ) . ' 33%, transparent 33%)'
);
