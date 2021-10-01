<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.9.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'gnav-current-effect',
	[
		'label'    => __( 'Global navigation current view effect', 'snow-monkey' ),
		'priority' => 165,
		'default'  => 'same-hover-effect',
		'choices'  => [
			'same-hover-effect' => __( 'Same as hover effect', 'snow-monkey' ),
			'text-color'        => __( 'Text color reversal', 'snow-monkey' ),
			'underline'         => __( 'Underline', 'snow-monkey' ),
			''                  => __( 'None', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'gnav-current-effect' );
$control->join( $section )->join( $panel );
