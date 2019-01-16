<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;
use Framework\Model\Styles;

$cfs = Customizer_Framework::styles();

$accent_color = get_theme_mod( 'accent-color' );

$cfs->register(
	'.smb-section__title::after',
	'background-color: ' . $accent_color
);

Styles::extend( 'entry-content', [ '.smb-section__body' ] );
