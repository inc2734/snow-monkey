<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( is_admin() ) {
	if ( function_exists( 'is_gutenberg_page' ) ) {
		snow_monkey_entry_content_styles( [
			'',
			'> div > div > .editor-block-list__layout > [data-type^="core/"] .components-autocomplete',
			'.wp-block-freeform',
		] );
	} else {
		snow_monkey_entry_content_styles( [] );
	}
} else {
	snow_monkey_entry_content_styles( [ '.c-entry__content' ] );
}
