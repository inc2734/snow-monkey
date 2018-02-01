<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'protected', [
	'title'    => __( 'Password protected settings', 'snow-monkey' ),
	'priority' => 950,
] );

$section = $customizer->get_section( 'protected' );

/**
 * Protected more content
 */
$customizer->control( 'checkbox', 'mwt-protected-more', [
	'label'   => __( 'If the post using more tag and password protect at the same time, display contents before more tag', 'snow-monkey' ),
	'type'    => 'option',
	'default' => true,
] );

$control = $customizer->get_control( 'mwt-protected-more' );
$control->join( $section );
