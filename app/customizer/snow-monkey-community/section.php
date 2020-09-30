<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'snow-monkey-community',
	[
		'title'    => sprintf(
			/* translators: 1: Monkey icon */
			__( '%1$s Snow Monkey Community %1$s', 'snow-monkey' ),
			'🐒'
		),
		'priority' => 10,
	]
);

Framework::control(
	'content',
	'official-website',
	[
		'label'       => __( 'Official Web Site', 'snow-monkey' ),
		'description' => __( 'Informations, manuals, etc.', 'snow-monkey' ),
		'content'     => sprintf(
			/* translators: 1: <a> tag, 2: </a> tag */
			__( '%1$sOfficial Web Site%2$s', 'snow-monkey' ),
			'<a class="button" href="https://snow-monkey.2inc.org" target="_blank" rel="noreferrer">',
			'</a>'
		),
	]
);

Framework::control(
	'content',
	'online-community',
	[
		'label'       => __( 'Online Community', 'snow-monkey' ),
		'description' => __( 'It is a place to share information and discuss about future function development etc. Please feel free to join us!', 'snow-monkey' ),
		'content'     => sprintf(
			/* translators: 1: <a> tag, 2: </a> tag */
			__( '%1$sOnline Community%2$s', 'snow-monkey' ),
			'<a class="button" href="https://snow-monkey.2inc.org/community/online-community/" target="_blank" rel="noreferrer">',
			'</a>'
		),
	]
);

Framework::control(
	'content',
	'support-forum',
	[
		'label'       => __( 'Support Forum', 'snow-monkey' ),
		'description' => __( 'This is an open forum that supports the Snow Monkey usage and customization.', 'snow-monkey' ),
		'content'     => sprintf(
			/* translators: 1: <a> tag, 2: </a> tag */
			__( '%1$sSupport Forum%2$s', 'snow-monkey' ),
			'<a class="button" href="https://snow-monkey.2inc.org/forums/" target="_blank" rel="noreferrer">',
			'</a>'
		),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'snow-monkey-community' );

$control = Framework::get_control( 'official-website' );
$control->join( $section );

$control = Framework::get_control( 'online-community' );
$control->join( $section );

$control = Framework::get_control( 'support-forum' );
$control->join( $section );
