<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_action( 'wp', function() {
	$includes = array(
		'/../../assets/css/foundation/*',
		'/../../assets/css/layout/*',
		'/../../assets/css/object/component/*',
		'/../../assets/css/object/project/*',
	);
	foreach ( $includes as $include ) {
		foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
			include_once( $file );
		}
	}
} );
