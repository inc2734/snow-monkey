<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( ! Helper::is_ie() ) {
	return;
}

$styles = [];

$accent_color = get_theme_mod( 'accent-color' );
if ( $accent_color ) {
	$styles[] = [
		'selectors'  => [ '.smb-tabs.is-style-line > .smb-tabs__tabs .smb-tabs__tab::after' ],
		'properties' => [ 'color: ' . $accent_color ],
	];
}

$font_family = Helper::get_font_family();
if ( $font_family ) {
	$styles[] = [
		'selectors'  => [ '.smb-tabs__tab' ],
		'properties' => [ 'font-family: ' . Helper::get_font_family() ],
	];
}

if ( $styles ) {
	Style::attach(
		Helper::get_main_style_handle() . '-snow-monkey-blocks-app',
		$styles
	);
}

foreach ( [ 'entry-content', 'entry-content-theme' ] as $placeholder ) {
	Style::extend( $placeholder, [ '.smb-tab-panel__summary' ] );
}
