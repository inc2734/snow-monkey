<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( is_admin() ) {
	Style::extend(
		'theme-entry-content',
		[
			'',
			'[data-type="core/heading"]',
			'.wp-block-freeform',
		]
	);
} else {
	Style::extend( 'theme-entry-content', [ '.p-entry-content' ] );
}
