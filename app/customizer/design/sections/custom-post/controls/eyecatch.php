<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	$custom_post_type_object = get_post_type_object( $custom_post_type );

	Framework::control(
		'select',
		$custom_post_type . '-eyecatch',
		array(
			'label'       => __( 'Featured image position', 'snow-monkey' ),
			'description' => sprintf(
				/* translators: 1: Custom post type label */
				__( 'Select how to display the featured image in %1$s page.', 'snow-monkey' ),
				$custom_post_type_object->label
			),
			'priority'    => 120,
			'default'     => 'none',
			'choices'     => Helper::eyecatch_position_choices(),
		)
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type );
	$control = Framework::get_control( $custom_post_type . '-eyecatch' );
	$control->join( $section )->join( $panel );
}
