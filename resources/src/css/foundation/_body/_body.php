<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$cfs = Customizer_Framework::styles();

$cfs->register(
	'html',
	'font-size: ' . get_theme_mod( 'base-font-size' ) . 'px'
);
