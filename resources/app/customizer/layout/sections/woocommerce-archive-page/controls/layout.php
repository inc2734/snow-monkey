<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;
use Inc2734\Mimizuku_Core\Helper;

$customizer = Customizer_Framework::init();

$customizer->control(
	'select',
	'woocommerce-archive-page-layout',
	[
		'label'   => __( 'Page layout', 'snow-monkey' ),
		'default' => 'right-sidebar',
		'choices' => Helper\get_page_templates(),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'layout' );
$section = $customizer->get_section( 'woocommerce-archive-page' );
$control = $customizer->get_control( 'woocommerce-archive-page-layout' );
$control->join( $section )->join( $panel );
