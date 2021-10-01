<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( ! Helper::is_ie() ) {
	return;
}

foreach ( [ 'entry-content', 'entry-content-theme' ] as $placeholder ) {
	Style::extend( $placeholder, [ '.wp-block-media-text__content' ] );
}
