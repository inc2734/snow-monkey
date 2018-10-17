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

$base_font   = get_theme_mod( 'base-font' );
$font_family = [];
if ( 'sans-serif' === $base_font ) {
	$font_family = [ 'sans-serif' ];
} elseif ( 'serif' === $base_font ) {
	$font_family = [ 'serif' ];
} elseif ( 'noto-sans-jp' === $base_font ) {
	$font_family = [ '"Noto Sans JP"', 'sans-serif' ];
	add_action( 'wp_enqueue_scripts', function() use ( $base_font ) {
		wp_enqueue_style(
			$base_font,
			'https://fonts.googleapis.com/css?family=Noto+Sans+JP'
		);
	}, 9 );
} elseif ( 'noto-serif-jp' === $base_font ) {
	$font_family = [ '"Noto Serif JP"', 'serif' ];
	add_action( 'wp_enqueue_scripts', function() use ( $base_font ) {
		wp_enqueue_style(
			$base_font,
			'https://fonts.googleapis.com/css?family=Noto+Serif+JP'
		);
	}, 9 );
}

$cfs->register(
	'body',
	'font-family: ' . implode( ',', $font_family )
);
