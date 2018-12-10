<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;
use Snow_Monkey\App\Helper;

$customizer = Customizer_Framework::init();

$customizer->control(
	'textarea',
	'header-content',
	[
		'transport'   => 'postMessage',
		'label'       => __( 'Header contents', 'snow-monkey' ),
		'description' => __( 'Displayed at only PC size.', 'snow-monkey' ),
		'priority'    => 130,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'layout' );
$section = $customizer->get_section( 'header' );
$control = $customizer->get_control( 'header-content' );
$control->join( $section )->join( $panel );
$control->partial(
	[
		'selector'            => '#js-selective-refresh-header-content',
		'container_inclusive' => true,
		'render_callback'     => function() {
			Helper::get_template_part( 'template-parts/header/content' );
		},
	]
);
