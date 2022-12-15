<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 *
 * renamed: app/customizer/layout/sections/archive/controls/entries-layout.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'post-entries-layout',
	array(
		'label'    => __( 'Entries layout', 'snow-monkey' ),
		'priority' => 180,
		'default'  => 'rich-media',
		'choices'  => array(
			'rich-media'  => __( 'Rich media', 'snow-monkey' ),
			'simple'      => __( 'Simple', 'snow-monkey' ),
			'text'        => __( 'Text', 'snow-monkey' ),
			'text2'       => __( 'Text 2', 'snow-monkey' ),
			'panel'       => __( 'Panels', 'snow-monkey' ),
			'carousel'    => sprintf(
				// translators: %1$s: entries layout
				__( 'Carousel (%1$s)', 'snow-monkey' ),
				__( 'Rich media', 'snow-monkey' )
			),
			'large-image' => __( 'Large image', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'post-entries-layout' );
$control->join( $section )->join( $panel );
