<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

add_filter(
	'snow_monkey_copyright',
	function() {
		return get_option( 'mwt-copyright' );
	}
);
