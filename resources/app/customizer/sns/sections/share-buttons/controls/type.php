<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/share-buttons/controls/type.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'mwt-share-buttons-type',
	[
		'type'     => 'option',
		'label'    => __( 'Type', 'snow-monkey' ),
		'priority' => 110,
		'default'  => 'balloon',
		'choices'  => [
			'balloon'    => __( 'Balloon', 'snow-monkey' ),
			'horizontal' => __( 'Horizontal', 'snow-monkey' ),
			'icon'       => __( 'Icon', 'snow-monkey' ),
			'block'      => __( 'Block', 'snow-monkey' ),
			'official'   => __( 'Official', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'sns' );
$section = Framework::get_section( 'share-buttons' );
$control = Framework::get_control( 'mwt-share-buttons-type' );
$control->join( $section )->join( $panel );
