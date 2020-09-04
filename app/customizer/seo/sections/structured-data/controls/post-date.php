<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/structured-data/controls/post-date.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'radio',
	'post-date',
	[
		'label'       => __( 'Date for the search engine', 'snow-monkey' ),
		'description' => __( 'This feature is a beta version.', 'snow-monkey' ),
		'priority'    => 110,
		'default'     => 'published-date',
		'choices'     => [
			'published-date'     => __( 'Published date', 'snow-monkey' ) . __( '(Display published date and modifiled date)', 'snow-monkey' ),
			'modified-date'      => __( 'Only modified date', 'snow-monkey' ) . __( '(Only modified date displayed when updating post)', 'snow-monkey' ),
			'modified-date-high' => __( 'Prioritize display of modified date', 'snow-monkey' ) . __( '(Display modifiled date and published date)', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'json-ld' );
$control = Framework::get_control( 'post-date' );
$control->join( $section )->join( $panel );
