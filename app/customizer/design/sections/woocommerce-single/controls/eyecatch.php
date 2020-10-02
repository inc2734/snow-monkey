<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.3
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

$eyecatch_position_choices = Helper::eyecatch_position_choices();
unset( $eyecatch_position_choices['content-top'] );

Framework::control(
	'select',
	'woocommerce-single-eyecatch',
	[
		'label'       => __( 'Featured image position', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: WooCommerce product */
			__( 'Select how to display the featured image in %1$s page.', 'snow-monkey' ),
			__( 'WooCommerce product', 'snow-monkey' )
		),
		'priority'    => 110,
		'default'     => 'none',
		'choices'     => $eyecatch_position_choices,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-woocommerce-single' );
$control = Framework::get_control( 'woocommerce-single-eyecatch' );
$control->join( $section )->join( $panel );
