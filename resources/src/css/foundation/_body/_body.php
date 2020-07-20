<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Color;
use Inc2734\WP_Customizer_Framework\Style;

$get_container_margin_var = function( $container_margin ) {
	if ( 'm' === $container_margin ) {
		return '1.76923rem';
	} elseif ( 'l' === $container_margin ) {
		return '2.65386rem';
	}
};

$get_margin_scale_var = function( $margin_scale ) {
	if ( 'l' === $margin_scale ) {
		return 1.5;
	}
};

$root_variables = [];
$container_margin_sm = $get_container_margin_var( get_theme_mod( 'sm-container-margin' ) );
if ( $container_margin_sm ) {
	$root_variables[] = '--_container-margin-sm: ' . $container_margin_sm;
}
$container_margin = $get_container_margin_var( get_theme_mod( 'lg-container-margin' ) );
if ( $container_margin ) {
	$root_variables[] = '--_container-margin: ' . $container_margin;
}

$container_max_width = get_theme_mod( 'container-max-width' );
if ( $container_max_width ) {
	$root_variables[] = '--_container-max-width: ' . $container_max_width . 'px';
}

$margin_scale = $get_margin_scale_var( get_theme_mod( 'margin-scale' ) );
if ( $margin_scale ) {
	$root_variables[] = '--_margin-scale: ' . $margin_scale;
}

$space = $get_container_margin_var( get_theme_mod( 'space' ) );
if ( $space ) {
	$root_variables[] = '--_space: ' . $space;
}

$accent_color = get_theme_mod( 'accent-color' );
if ( $accent_color ) {
	$root_variables[] = '--accent-color: ' . $accent_color;
	$root_variables[] = '--light-accent-color: ' . Color::light( $accent_color );
	$root_variables[] = '--lighter-accent-color: ' . Color::lighter( $accent_color );
	$root_variables[] = '--lightest-accent-color: ' . Color::lightest( $accent_color );
}

if ( $root_variables ) {
	Style::register(
		':root',
		$root_variables
	);
}

Style::register(
	'html',
	'font-size: ' . get_theme_mod( 'base-font-size' ) . 'px'
);

$base_font   = get_theme_mod( 'base-font' );
$font_family = [];
if ( 'sans-serif' === $base_font ) {
	$font_family = [ 'system-ui', '-apple-system', 'BlinkMacSystemFont', '"ヒラギノ角ゴ W3"', 'sans-serif' ];
} elseif ( 'serif' === $base_font ) {
	$font_family = [ 'serif' ];
} elseif ( 'noto-sans-jp' === $base_font ) {
	$font_family = [ '"Noto Sans JP"', 'sans-serif' ];
	add_action( 'wp_enqueue_scripts', [ '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_noto_sans_jp' ], 5 );
	add_action( 'enqueue_block_editor_assets', [ '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_noto_sans_jp' ] );
} elseif ( 'noto-serif-jp' === $base_font ) {
	$font_family = [ '"Noto Serif JP"', 'serif' ];
	add_action( 'wp_enqueue_scripts', [ '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_noto_serif_jp' ], 5 );
	add_action( 'enqueue_block_editor_assets', [ '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_noto_serif_jp' ] );
} elseif ( 'm-plus-1p' === $base_font ) {
	$font_family = [ '"M PLUS 1p"', 'sans-serif' ];
	add_action( 'wp_enqueue_scripts', [ '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_m_plus_1p' ], 5 );
	add_action( 'enqueue_block_editor_assets', [ '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_m_plus_1p' ] );
} elseif ( 'm-plus-rounded-1c' === $base_font ) {
	$font_family = [ '"M PLUS Rounded 1c"', 'sans-serif' ];
	add_action( 'wp_enqueue_scripts', [ '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_m_plus_rounded_1c' ], 5 );
	add_action( 'enqueue_block_editor_assets', [ '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_m_plus_rounded_1c' ] );
}

Style::register(
	[ '.l-body', '.block-editor-block-list__block' ],
	'font-family: ' . implode( ',', $font_family )
);
