<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

if ( post_password_required() ) {
	return;
}

Helper\get_template_part( 'template-parts/comments' );
Helper\get_template_part( 'template-parts/pings' );
