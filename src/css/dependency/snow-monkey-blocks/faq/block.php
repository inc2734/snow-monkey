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
	[
		'.smb-faq__item__question__label',
		'.smb-faq__item__answer__label',
	],
	'color: ' . $accent_color
);

Style::extend(
	'entry-content',
	[
		'.smb-faq__item__question__body',
		'.smb-faq__item__answer__body',
	]
);
