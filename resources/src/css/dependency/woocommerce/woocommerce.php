<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

if ( ! class_exists( '\woocommerce' ) ) {
	return;
}

snow_monkey_entry_content_styles( [ '.woocommerce-Tabs-panel' ] );
snow_monkey_entry_content_styles( [ '.related.products' ] );

$cfs = Customizer_Framework::styles();

$accent_color = get_theme_mod( 'accent-color' );

$cfs->register(
	[
		'.l-container .l-contents .store-notice',
		'.l-container .l-contents .demo_store',
	],
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.l-container .l-contents #respond #submit.alt',
		'.l-container .l-contents .button.alt',
		'.l-container .l-contents #respond #submit.alt.disabled',
		'.l-container .l-contents #respond #submit.alt.disabled:hover',
		'.l-container .l-contents #respond #submit.alt.disabled:active',
		'.l-container .l-contents #respond #submit.alt.disabled:focus',
		'.l-container .l-contents #respond #submit.alt:disabled',
		'.l-container .l-contents #respond #submit.alt:disabled:hover',
		'.l-container .l-contents #respond #submit.alt:disabled:active',
		'.l-container .l-contents #respond #submit.alt:disabled:focus',
		'.l-container .l-contents #respond #submit.alt:disabled[disabled]',
		'.l-container .l-contents #respond #submit.alt:disabled[disabled]:hover',
		'.l-container .l-contents #respond #submit.alt:disabled[disabled]:active',
		'.l-container .l-contents #respond #submit.alt:disabled[disabled]:focus',
		'.l-container .l-contents .button.alt.disabled',
		'.l-container .l-contents .button.alt.disabled:hover',
		'.l-container .l-contents .button.alt.disabled:active',
		'.l-container .l-contents .button.alt.disabled:focus',
		'.l-container .l-contents .button.alt:disabled',
		'.l-container .l-contents .button.alt:disabled:hover',
		'.l-container .l-contents .button.alt:disabled:active',
		'.l-container .l-contents .button.alt:disabled:focus',
		'.l-container .l-contents .button.alt:disabled[disabled]',
		'.l-container .l-contents .button.alt:disabled[disabled]:hover',
		'.l-container .l-contents .button.alt:disabled[disabled]:active',
		'.l-container .l-contents .button.alt:disabled[disabled]:focus',
	],
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.l-container .l-contents #respond #submit.alt:hover',
		'.l-container .l-contents .button.alt:hover',
		'.l-container .l-contents #respond #submit.alt:active',
		'.l-container .l-contents .button.alt:active',
		'.l-container .l-contents #respond #submit.alt:focus',
		'.l-container .l-contents .button.alt:focus',
	],
	'background-color: ' . $cfs->darken( $accent_color, 0.05 )
);

$cfs->register(
	[
		'.l-container .l-contents .widget_price_filter .ui-slider .ui-slider-handle',
		'.l-container .l-contents .widget_price_filter .ui-slider .ui-slider-range',
	],
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.woocommerce-error',
		'.woocommerce-info',
		'.woocommerce-message',
	],
	'border-top-color: ' . $accent_color
);
