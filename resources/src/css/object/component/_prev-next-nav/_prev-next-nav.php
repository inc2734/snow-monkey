<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

$accent_color = get_theme_mod( 'accent-color' );

Style::register(
	'.c-prev-next-nav__item > a::before',
	'background-image: radial-gradient(' . Style::rgba( $accent_color, 0.5 ) . ' 33%, transparent 33%)'
);
