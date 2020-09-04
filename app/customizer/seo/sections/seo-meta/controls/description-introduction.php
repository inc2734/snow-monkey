<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/seo-meta/controls/description-introduction.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'content',
	'description-introduction',
	[
		'label'    => __( 'Meta description', 'snow-monkey' ),
		'priority' => 90,
		'content'  => __( 'The meta description is normally output only when "meta description" in the page edit screen is entered.', 'snow-monkey' ) . __( 'When "Automatically output meta description" is enabled, even if "meta description" is not entered, meta description is automatically generated from the excerpt etc. and output (excluding the archive page)', 'snow-monkey' ),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'seo-meta' );
$control = Framework::get_control( 'description-introduction' );
$control->join( $section )->join( $panel );
