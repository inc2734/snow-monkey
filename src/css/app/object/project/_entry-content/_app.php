<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( is_admin() ) {
	foreach ( [ 'entry-content', 'entry-content-theme' ] as $placeholder ) {
		Style::extend(
			$placeholder,
			[
				'',
				'[data-type="core/heading"]',
				'.wp-block-freeform',
			]
		);
	}
} elseif ( Helper::is_ie() ) {
	foreach ( [ 'entry-content', 'entry-content-theme' ] as $placeholder ) {
		Style::extend( $placeholder, [ '.p-entry-content' ] );
	}
}
