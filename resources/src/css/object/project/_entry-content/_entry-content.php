<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( is_admin() ) {
	add_action(
		'admin_enqueue_scripts',
		function( $hook_suffix ) {
			if ( ! in_array( $hook_suffix, [ 'post.php', 'post-new.php' ] ) ) {
				return;
			}

			if ( Helper::is_block_editor() ) {
				Style::extend(
					'entry-content',
					[
						'',
						'[data-type="core/paragraph"] .components-autocomplete',
						'[data-type="core/heading"] .components-autocomplete',
						'.wp-block-freeform',
					]
				);
			} else {
				Style::extend( 'entry-content', [ '' ] );
			}
		}
	);
} else {
	Style::extend( 'entry-content', [ '.p-entry-content' ] );
}
