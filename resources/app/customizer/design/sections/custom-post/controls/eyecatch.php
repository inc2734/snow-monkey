<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <unversion>
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	$custom_post_type_object = get_post_type_object( $custom_post_type );
	$choices = Helper::eyecatch_position_choices();
	unset( $choices['content-top'] );

	Framework::control(
		'select',
		$custom_post_type . '-eyecatch',
		[
			'label'       => __( 'Eyecatch image', 'snow-monkey' ),
			'description' => sprintf(
				/* translators: 1: Custom post type label */
				__( 'Select how to display the eyecatch image in %1$s page.', 'snow-monkey' ),
				$custom_post_type_object->label
			),
			'priority'    => 110,
			'default'     => 'none',
			'choices'     => $choices,
		]
	);

	if ( ! is_customize_preview() ) {
		return;
	}

	$panel   = Framework::get_panel( 'design' );
	$section = Framework::get_section( 'design-' . $custom_post_type );
	$control = Framework::get_control( $custom_post_type . '-eyecatch' );
	$control->join( $section )->join( $panel );
}
