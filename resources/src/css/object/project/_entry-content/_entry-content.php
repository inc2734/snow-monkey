<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\app\Helper;

if ( is_admin() ) {
	add_action(
		'admin_enqueue_scripts',
		function( $hook_suffix ) {
			if ( ! in_array( $hook_suffix, [ 'post.php', 'post-new.php' ] ) ) {
				return;
			}

			if ( Helper::is_block_editor() ) {
				Helper::entry_content_styles(
					[
						'',
						'[data-type="core/paragraph"] .components-autocomplete',
						'[data-type="core/heading"] .components-autocomplete',
						'.wp-block-freeform',
					]
				);
			} else {
				Helper::entry_content_styles( [ '' ] );
			}
		}
	);
} else {
	Helper::entry_content_styles( [ '.p-entry-content' ] );
}
