<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

$wp_post_type = get_post_type_object( 'page' );

Framework::control(
	'select',
	'page-eyecatch',
	array(
		'label'       => __( 'Featured image position', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: Post type label */
			__( 'Select how to display the featured image in %1$s page.', 'snow-monkey' ),
			$wp_post_type->label
		),
		'priority'    => 110,
		'default'     => 'page-header',
		'choices'     => Helper::eyecatch_position_choices(),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-page' );
$control = Framework::get_control( 'page-eyecatch' );
$control->join( $section )->join( $panel );
