<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

/**
 * Returns PHP file list
 *
 * @deprecated
 *
 * @param string Directory path
 * @return array PHP file list
 */
function snow_monkey_glob_recursive( $path ) {
	return Helper\glob_recursive( $path );
}
