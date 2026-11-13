<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

$wp_post_type = get_post_type_object( 'post' );

Framework::control(
	'select',
	'post-eyecatch',
	array(
		'default'          => 'page-header',
		'ui_args_callback' => function () use ( $wp_post_type ) {
			return array(
				'label'       => __( 'Featured image position', 'snow-monkey' ),
				'description' => sprintf(
					/* translators: 1: Post type label */
					__( 'Select how to display the featured image in %1$s page.', 'snow-monkey' ),
					$wp_post_type->label
				),
				'priority'    => 110,
				'choices'     => Helper::eyecatch_position_choices(),
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-post' );
$control = Framework::get_control( 'post-eyecatch' );
$control->join( $section )->join( $panel );
