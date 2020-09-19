<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.4.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'textarea',
	'mwt-google-adsense',
	[
		'label'             => __( 'Google Adsense', 'snow-monkey' ),
		'description'       => __( 'When pasting the code of the responsive ad unit, the advertisement is displayed in the prescribed part of the theme. If you want to display at arbitrary position, please use widgets etc.', 'snow-monkey' ) . __( 'Paste only the ins tag for ad units.', 'snow-monkey' ),
		'type'              => 'option',
		'priority'          => 110,
		'sanitize_callback' => function( $value ) {
			if ( ! preg_match( '/<ins /s', $value ) ) {
				// Auto ads (Old version).
				$value = strip_tags( $value );
				return $value;
			} else {
				// Not auto ads.
				$value = preg_replace( '@<script>[^<]*<\/script>@s', '', $value );
				$value = strip_tags( $value, '<ins>' );
				return $value;
			}
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'advertisement' );
$control = Framework::get_control( 'mwt-google-adsense' );
$control->join( $section );
