<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

if ( is_admin() ) {
	add_action(
		'admin_enqueue_scripts',
		function( $hook_suffix ) {
			if ( ! in_array( $hook_suffix, [ 'post.php', 'post-new.php' ] ) ) {
				return;
			}

			if ( Helper\is_block_editor() ) {
				snow_monkey_entry_content_styles(
					[
						'',
						'[data-type="core/paragraph"] .components-autocomplete',
						'[data-type="core/heading"] .components-autocomplete',
						'.wp-block-freeform',
					]
				);
			} else {
				snow_monkey_entry_content_styles( [ '' ] );
			}
		}
	);
} else {
	snow_monkey_entry_content_styles( [ '.p-entry-content' ] );
}
