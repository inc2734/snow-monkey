<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;
use Framework\Helper;

$color_palette = Helper::get_color_palette();

foreach ( $color_palette as $color ) {
	if ( empty( $color['slug'] ) || empty( $color['color'] ) || ! empty( $color['_builtin'] ) ) {
		continue;
	}

	$styles = [
		[
			'selectors'  => [ '.has-' . $color['slug'] . '-background-color' ],
			'properties' => [ 'background-color: ' . $color['color'] . '!important' ],
		],
		[
			'selectors'  => [
				'.has-' . $color['slug'] . '-color',
				'.wp-block-button__link.has-' . $color['slug'] . '-color',
			],
			'properties' => [ 'color: ' . $color['color'] . '!important' ],
		],
	];

	Style::attach(
		Helper::get_main_style_handle(),
		$styles
	);
}
