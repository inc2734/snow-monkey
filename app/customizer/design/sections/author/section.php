<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$users = Helper::get_users();

foreach ( $users as $user ) {
	Framework::section(
		'design-author-' . $user->ID,
		array(
			'title'           => sprintf(
				/* translators: 1: User name */
				__( '[ %1$s ] author page settings', 'snow-monkey' ),
				get_the_author_meta( 'display_name', $user->ID )
			),
			'priority'        => 140,
			'active_callback' => function () use ( $user ) {
				return is_author( $user->ID );
			},
		)
	);
}
