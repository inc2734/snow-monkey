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

$root_variables      = [];
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
	$root_variables[] = '--dark-accent-color: ' . Color::dark( $accent_color );
	$root_variables[] = '--light-accent-color: ' . Color::light( $accent_color );
	$root_variables[] = '--lighter-accent-color: ' . Color::lighter( $accent_color );
	$root_variables[] = '--lightest-accent-color: ' . Color::lightest( $accent_color );
}

$sub_accent_color = get_theme_mod( 'sub-accent-color' );
if ( $accent_color ) {
	$root_variables[] = '--sub-accent-color: ' . $sub_accent_color;
	$root_variables[] = '--dark-sub-accent-color: ' . Color::dark( $sub_accent_color );
	$root_variables[] = '--light-sub-accent-color: ' . Color::light( $sub_accent_color );
	$root_variables[] = '--lighter-sub-accent-color: ' . Color::lighter( $sub_accent_color );
	$root_variables[] = '--lightest-sub-accent-color: ' . Color::lightest( $sub_accent_color );
}

$header_text_color = get_theme_mod( 'header-text-color' );
if ( $header_text_color ) {
	$root_variables[] = '--header-text-color: ' . $header_text_color;
	$root_variables[] = '--overlay-header-text-color: ' . $header_text_color;
	$root_variables[] = '--drop-nav-text-color: ' . $header_text_color;
}

$h2_style = get_theme_mod( 'h2-style' );
if ( $h2_style ) {
	if ( 'standard' === $h2_style ) {
		$root_variables[] = '--entry-content-h2-border-left: 1px solid var(--accent-color, #cd162c)';
		$root_variables[] = '--entry-content-h2-background-color: #f7f7f7';
		$root_variables[] = '--entry-content-h2-padding: calc(var(--_space, 1.76923rem) * 0.25) calc(var(--_space, 1.76923rem) * 0.25) calc(var(--_space, 1.76923rem) * 0.25) calc(var(--_space, 1.76923rem) * 0.5)';
	}
}

$h3_style = get_theme_mod( 'h3-style' );
if ( $h3_style ) {
	if ( 'standard' === $h3_style ) {
		$root_variables[] = '--entry-content-h3-border-bottom: 1px solid #eee';
		$root_variables[] = '--entry-content-h3-padding: 0 0 calc(var(--_space, 1.76923rem) * 0.25)';
	}
}

$widget_title_style = get_theme_mod( 'widget-title-style' );
if ( $widget_title_style ) {
	if ( 'standard' === $widget_title_style ) {
		$root_variables[] = '--widget-title-display: flex';
		$root_variables[] = '--widget-title-flex-direction: row';
		$root_variables[] = '--widget-title-align-items: center';
		$root_variables[] = '--widget-title-justify-content: center';
		$root_variables[] = '--widget-title-pseudo-display: block';
		$root_variables[] = '--widget-title-pseudo-content: ""';
		$root_variables[] = '--widget-title-pseudo-height: 1px';
		$root_variables[] = '--widget-title-pseudo-background-color: #111';
		$root_variables[] = '--widget-title-pseudo-flex: 1 0 0%';
		$root_variables[] = '--widget-title-pseudo-min-width: 20px';
		$root_variables[] = '--widget-title-before-margin-right: .5em';
		$root_variables[] = '--widget-title-after-margin-left: .5em';
	}
}

$base_line_height = get_theme_mod( 'base-line-height' );
if ( $base_line_height ) {
	$root_variables[] = '--_half-leading: ' . ( $base_line_height - 1 ) / 2;
}

$styles = [];

if ( $root_variables ) {
	$styles[] = [
		'selectors'  => [ ':root' ],
		'properties' => $root_variables,
	];
}

$styles[] = [
	'selectors'  => [ 'html' ],
	'properties' => [
		'font-size: ' . get_theme_mod( 'base-font-size' ) . 'px',
		'letter-spacing: ' . get_theme_mod( 'base-letter-spacing' ) . 'rem',
	],
];

if ( 16 !== get_theme_mod( 'base-font-size' ) ) {
	$styles[] = [
		'selectors'  => [
			'.has-regular-font-size',
			'.has-normal-font-size',
		],
		'properties' => [
			'font-size: 16px',
		],
	];
}

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

$styles[] = [
	'selectors'  => [
		'.l-body',
		'.block-editor-block-list__block',
	],
	'properties' => [
		'font-family: ' . implode( ',', $font_family ),
	],
];

Style::attach(
	\Framework\Helper::get_main_style_handle(),
	$styles
);
