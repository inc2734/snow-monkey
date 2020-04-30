<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.2
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Inc2734\WP_Page_Speed_Optimization;
use Framework\Helper;

Framework::control(
	'checkbox',
	'set-browser-cache',
	[
		'label'       => __( 'Use browser cache', 'snow-monkey' ),
		'description' => __( 'The server must support htaccess, IfModule and mod_expires. If you get the Internal Server Error (500), delete the characters added to .htaccess.', 'snow-monkey' ),
		'type'        => 'option',
		'priority'    => 140,
		'default'     => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'set-browser-cache' );
$control->join( $section );

/**
 * Write cache control setting into .htaccess
 *
 * @param WP_Customize_Setting
 */
add_action(
	'customize_save_set-browser-cache',
	function( $customize_setting ) {
		if ( $customize_setting->post_value() === $customize_setting->value() ) {
			return;
		}

		WP_Page_Speed_Optimization\Helper\write_cache_control_setting( (bool) $customize_setting->post_value() );
	}
);
