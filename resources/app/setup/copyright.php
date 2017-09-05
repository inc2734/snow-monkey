<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'snow_monkey_copyright', function( $copyright ) {
	return get_option( 'mwt-copyright' );
} );
