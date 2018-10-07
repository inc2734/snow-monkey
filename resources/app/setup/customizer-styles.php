<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

add_action(
	'wp_loaded',
	function() {
		$includes = [
			'/../../assets/css/dependency',
			'/../../assets/css/foundation',
			'/../../assets/css/object/component',
			'/../../assets/css/object/project',
		];
		foreach ( $includes as $include ) {
			Helper\include_files( __DIR__ . $include );
		}
	}
);
