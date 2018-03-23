<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Returns PHP file list
 *
 * @param string Directory path
 * @return array PHP file list
 */
function snow_monkey_glob_recursive( $path ) {
	$files = [];
	if ( preg_match( '/\\' . DIRECTORY_SEPARATOR . 'vendor$/', $path ) ) {
		return $files;
	}

	foreach ( glob( $path . '/*' ) as $file ) {
		if ( is_dir( $file ) ) {
			$files = array_merge( $files, snow_monkey_glob_recursive( $file ) );
		} elseif ( preg_match( '/\.php$/', $file ) ) {
			$files[] = $file;
		}
	}

	return $files;
}
