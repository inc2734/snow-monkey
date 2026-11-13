<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 *
 * renamed: app/customizer/seo-sns/sections/google-tag-manager/controls/for-logged-in.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'mwt-google-tag-manager-for-loggedin',
	array(
		'default'          => true,
		'type'             => 'option',
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Don\'t output tags to logged-in users', 'snow-monkey' ),
				'priority' => 110,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'google-tag-manager' );
$control = Framework::get_control( 'mwt-google-tag-manager-for-loggedin' );
$control->join( $section )->join( $panel );
