<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 *
 * renamed: app/customizer/layout/sections/archive-page/controls/layout.php
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'archive-page-layout',
	[
		'label'    => __( 'Archive page layout', 'snow-monkey' ),
		'default'  => 'one-column',
		'choices'  => is_customize_preview() ? Helper::get_wrapper_templates() : [],
		'priority' => 100,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-archive' );
$control = Framework::get_control( 'archive-page-layout' );
$control->join( $section )->join( $panel );
