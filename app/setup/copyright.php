<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 4.2.13
 */

add_filter(
	'snow_monkey_copyright',
	function( $copyright ) {
		return get_option( 'mwt-copyright' );
	}
);
