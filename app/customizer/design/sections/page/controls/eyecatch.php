<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.3
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

$post_type_object = get_post_type_object( 'page' );

Framework::control(
	'select',
	'page-eyecatch',
	[
		'label'       => __( 'Featured image position', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: Post type label */
			__( 'Select how to display the featured image in %1$s page.', 'snow-monkey' ),
			$post_type_object->label
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
$section = Framework::get_section( 'design-page' );
$control = Framework::get_control( 'page-eyecatch' );
$control->join( $section )->join( $panel );
