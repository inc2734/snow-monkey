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

$drawer_nav_highlight_type = get_theme_mod( 'drawer-nav-highlight-type' );
if ( 'background-color' !== $drawer_nav_highlight_type ) {
	return;
}

Style::register(
	[
		'.c-drawer--highlight-type-background-color .c-drawer__item.sm-nav-menu-item-highlight',
		'.c-drawer--highlight-type-background-color .c-drawer__subitem.sm-nav-menu-item-highlight',
	],
	'background-color: ' . $sub_accent_color
);
