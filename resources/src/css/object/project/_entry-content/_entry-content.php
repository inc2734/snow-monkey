<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Framework\Model\Styles;

if ( is_admin() ) {
	add_action(
		'admin_enqueue_scripts',
		function( $hook_suffix ) {
			if ( ! in_array( $hook_suffix, [ 'post.php', 'post-new.php' ] ) ) {
				return;
			}

			if ( Helper::is_block_editor() ) {
				Styles::extend(
					'entry-content',
					[
						'',
						'[data-type="core/paragraph"] .components-autocomplete',
						'[data-type="core/heading"] .components-autocomplete',
						'.wp-block-freeform',
					]
				);
			} else {
				Styles::extend( 'entry-content', [ '' ] );
			}
		}
	);
} else {
	Styles::extend( 'entry-content', [ '.p-entry-content' ] );
}
