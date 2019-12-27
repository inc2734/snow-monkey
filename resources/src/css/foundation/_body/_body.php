<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

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
}

Style::register(
	[ '.l-body', '.editor-block-list__block' ],
	'font-family: ' . implode( ',', $font_family )
);
