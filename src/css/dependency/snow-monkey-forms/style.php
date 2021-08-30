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

Style::extend(
	'entry-content',
	[
		'.smf-complete-content',
		'.smf-system-error-content',
		'.smf-item__controls',
	]
);

$accent_color = get_theme_mod( 'accent-color' );
if ( $accent_color ) {
	$styles = [
		[
			'selectors'  => [ '.smf-action .smf-button-control__control--accent-color' ],
			'properties' => [ 'background-color: ' . $accent_color ],
		],
	];

	Style::attach(
		Helper::get_main_style_handle() . '-snow-monkey-forms',
		$styles
	);
}
