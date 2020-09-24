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

$accent_color = get_theme_mod( 'accent-color' );
if ( ! $accent_color ) {
	return;
}

Style::register(
	'.c-drawer',
	'background-color: ' . $accent_color
);

$sub_accent_color = get_theme_mod( 'sub-accent-color' );
if ( ! $sub_accent_color ) {
	return;
}

Style::register(
	[
		'.c-drawer__item.sm-nav-menu-item-highlight',
		'.c-drawer__subitem.sm-nav-menu-item-highlight',
	],
	'background-color: ' . $sub_accent_color
);
