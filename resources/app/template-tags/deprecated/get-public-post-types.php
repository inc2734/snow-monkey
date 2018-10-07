<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

/**
 * Returns public post type objects
 *
 * @deprecated
 *
 * @return array
 */
function snow_monkey_get_public_post_types() {
	return Helper\get_public_post_types();
}
