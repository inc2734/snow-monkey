<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

/**
 * Return the child pages
 *
 * @deprecated
 *
 * @var int $post_id
 * @return array
 */
function snow_monkey_get_child_pages( $post_id ) {
	return Helper\get_child_pages_query( $post_id );
}
