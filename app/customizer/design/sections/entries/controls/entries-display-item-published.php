<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.2.1
 *
 * renamed: app/customizer/design/sections/base-design/controls/entries-display-item-published.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'post-entries-display-item-published',
	array(
		'label'    => __( 'Display the published date for each item in the entries', 'snow-monkey' ),
		'priority' => 130,
		'default'  => true,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'entries' );
$control = Framework::get_control( 'post-entries-display-item-published' );
$control->join( $section )->join( $panel );
