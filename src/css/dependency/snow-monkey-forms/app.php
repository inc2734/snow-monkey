<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;
use Framework\Helper;

if ( ! Helper::is_ie() ) {
	return;
}

foreach ( [ 'entry-content', 'entry-content-theme' ] as $placeholder ) {
	Style::extend(
		$placeholder,
		[
			'.smf-complete-content',
			'.smf-system-error-content',
			'.smf-item__controls',
		]
	);
}

$accent_color = get_theme_mod( 'accent-color' );
if ( $accent_color ) {
	$styles = [
		[
			'selectors'  => [ '.snow-monkey-form--button-has-accent-color .smf-button-control__control' ],
			'properties' => [ 'background-color: ' . $accent_color ],
		],
	];

	Style::attach(
		Helper::get_main_style_handle() . '-snow-monkey-forms-app',
		$styles
	);
}
