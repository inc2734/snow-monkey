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
		'entry-content',
		[
			'',
			'[data-type="core/paragraph"] .components-autocomplete', // < WP 5.3
			'[data-type="core/heading"] .components-autocomplete', // < WP 5.3
			'[data-type="core/heading"] .block-editor-rich-text', // >= WP 5.3
			'.wp-block-freeform',
		]
	);
} else {
	Style::extend( 'entry-content', [ '.p-entry-content' ] );
}
