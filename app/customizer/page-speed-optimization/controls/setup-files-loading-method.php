<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.8.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'setup-files-loading-method',
	[
		'label'       => __( 'Setup files loading method.', 'snow-monkey' ),
		'description' => __( 'You can select the method of loading the setup files. Depending on the method you select, customization by code may not be reflected. For details, please refer to the manual on the official website.', 'snow-monkey' ),
		'default'     => 'get_template_parts',
		'priority'    => 250,
		'choices'     => [
			'get_template_parts' => __( 'get_template_parts (Default)', 'snow-monkey' ),
			'load_theme_files'   => __( 'load_theme_files', 'snow-monkey' ),
			'concat'             => __( 'concat', 'snow-monkey' ),
			'include'            => __( 'include', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'setup-files-loading-method' );
$control->join( $section );
