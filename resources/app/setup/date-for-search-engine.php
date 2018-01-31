<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_action( 'snow_monkey_entry_meta_items', function() {
	if ( 'modified-date' !== get_theme_mod( 'post-date' ) ) {
		return;
	}

	ob_start();
	snow_monkey_entry_meta_items_modified();
	$modified = ob_get_clean();

	if ( $modified ) {
		remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published', 10 );
	}
}, 9 );
