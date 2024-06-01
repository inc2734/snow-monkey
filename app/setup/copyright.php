<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

add_filter(
	'snow_monkey_copyright',
	function () {
		return get_option( 'mwt-copyright' );
	}
);
