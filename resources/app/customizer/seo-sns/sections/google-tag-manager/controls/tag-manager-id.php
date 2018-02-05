<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'seo-sns' );
$section    = $customizer->get_section( 'google-tag-manager' );

$customizer->control( 'text', 'mwt-google-tag-manager-id', array(
	'label'       => __( 'Tag Manager ID', 'snow-monkey' ),
	'description' => __( 'e.g. GTM-X11X1XX', 'snow-monkey' ),
	'type'        => 'option',
) );

$control = $customizer->get_control( 'mwt-google-tag-manager-id' );
$control->join( $section )->join( $panel );
