<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'bbpress-archive-eyecatch',
	array(
		'default'          => 'none',
		'ui_args_callback' => function () {
			$eyecatch_position_choices = Helper::eyecatch_position_choices();
			unset( $eyecatch_position_choices['content-top'] );

			return array(
				'label'       => __( 'Featured image position', 'snow-monkey' ),
				'description' => sprintf(
					/* translators: 1: bbPress archive */
					__( 'Select how to display the featured image in %1$s page.', 'snow-monkey' ),
					__( 'bbPress archive', 'snow-monkey' )
				),
				'priority'    => 120,
				'choices'     => $eyecatch_position_choices,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-bbpress-archive-page' );
$control = Framework::get_control( 'bbpress-archive-eyecatch' );
$control->join( $section )->join( $panel );
