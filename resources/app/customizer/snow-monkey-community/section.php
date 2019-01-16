<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'snow-monkey-community',
	[
		'title'    => sprintf( __( '%1$s Snow Monkey Community %1$s', 'snow-monkey' ), '🐒' ),
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
			__( '%1$sOfficial Web Site%2$s' ),
			'<a class="button" href="https://snow-monkey.2inc.org" target="_blank">',
			'</a>'
		),
	]
);

Framework::control(
	'content',
	'online-community',
	[
		'label'       => __( 'Online Community', 'snow-monkey' ),
		'description' => __( 'This is an online community that only purchasers of the Snow Monkey can participate. It is a place to share information and discuss about future function development etc.', 'snow-monkey' ),
		'content'     => sprintf(
			__( '%1$sOnline Community%2$s' ),
			'<a class="button" href="https://snow-monkey.2inc.org/community/online-community/" target="_blank">',
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
			__( '%1$sSupport Forum%2$s' ),
			'<a class="button" href="https://snow-monkey.2inc.org/forums/" target="_blank">',
			'</a>'
		),
	]
);

Framework::control(
	'content',
	'job-board',
	[
		'label'       => __( 'Job Board', 'snow-monkey' ),
		'description' => __( 'This is a job board that only purchasers of the Snow Monkey can participate. People who wants to work or wants to request work can register information.', 'snow-monkey' ),
		'content'     => sprintf(
			__( '%1$sJob Board%2$s' ),
			'<a class="button" href="https://snow-monkey.2inc.org/jobboard/" target="_blank">',
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

$control = Framework::get_control( 'job-board' );
$control->join( $section );
