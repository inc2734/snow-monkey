<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Framework\Helper;

global $wp_query;

if ( post_password_required() ) {
	return;
}

if ( comments_open() || ! empty( $wp_query->comments_by_type['comment'] ) ) {
	Helper::get_template_part( 'template-parts/discussion/comments' );
}

if ( pings_open() || ! empty( $wp_query->comments_by_type['pings'] ) ) {
	Helper::get_template_part( 'template-parts/discussion/pings' );
}
