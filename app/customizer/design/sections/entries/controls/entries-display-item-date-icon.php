<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'post-entries-display-item-date-icon',
	array(
		'label'           => __( 'Display the icons for each item in the entries publish date / modified date', 'snow-monkey' ),
		'priority'        => 150,
		'default'         => false,
		'active_callback' => function () {
			$display_published_date = get_theme_mod( 'post-entries-display-item-published' );
			$display_modified_date  = get_theme_mod( 'post-entries-display-item-modified' );

			return $display_published_date || $display_modified_date;
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'entries' );
$control = Framework::get_control( 'post-entries-display-item-date-icon' );
$control->join( $section )->join( $panel );
