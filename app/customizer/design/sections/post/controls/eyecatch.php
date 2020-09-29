<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

$post_type_object = get_post_type_object( 'post' );

Framework::control(
	'select',
	'post-eyecatch',
	[
		'label'       => __( 'Eyecatch image', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: Post type label */
			__( 'Select how to display the eyecatch image in %1$s page.', 'snow-monkey' ),
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
$section = Framework::get_section( 'design-post' );
$control = Framework::get_control( 'post-eyecatch' );
$control->join( $section )->join( $panel );
