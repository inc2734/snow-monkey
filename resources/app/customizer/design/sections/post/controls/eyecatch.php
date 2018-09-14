<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'select',
	'post-eyecatch',
	[
		'label'       => __( 'Eyecatch image', 'snow-monkey' ),
		'description' => __( 'Select how to display the eyecatch image in post.', 'snow-monkey' ),
		'priority'    => 100,
		'default'     => 'page-header',
		'choices'     => snow_monkey_eyecatch_position_choices(),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'post' );
$control = $customizer->get_control( 'post-eyecatch' );
$control->join( $section )->join( $panel );
