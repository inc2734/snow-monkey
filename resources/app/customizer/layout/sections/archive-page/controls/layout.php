<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;
use Snow_Monkey\app\Helper;

$customizer = Customizer_Framework::init();

$customizer->control(
	'select',
	'archive-page-layout',
	[
		'label'   => __( 'Page layout', 'snow-monkey' ),
		'default' => 'one-column',
		'choices' => Helper::get_page_templates(),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'layout' );
$section = $customizer->get_section( 'archive-page' );
$control = $customizer->get_control( 'archive-page-layout' );
$control->join( $section )->join( $panel );
