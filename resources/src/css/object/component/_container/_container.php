<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$cfs = Customizer_Framework::styles();

$container_max_width = get_theme_mod( 'container-max-width' );

$cfs->register(
	'.l-contents .c-container',
	'max-width: ' . $container_max_width . 'px',
	'@media (min-width: 64em)'
);
