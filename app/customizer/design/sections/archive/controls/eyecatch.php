<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'archive-eyecatch',
	[
		'label'       => __( 'Featured image position', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: archive */
			__( 'Select how to display the featured image in %1$s page.', 'snow-monkey' ),
			__( 'archive', 'snow-monkey' )
		),
		'priority'    => 110,
		'default'     => 'page-header',
		'choices'     => Helper::eyecatch_position_choices(),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-archive' );
$control = Framework::get_control( 'archive-eyecatch' );
$control->join( $section )->join( $panel );
