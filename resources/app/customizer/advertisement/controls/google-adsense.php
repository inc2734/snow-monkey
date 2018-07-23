<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control( 'textarea', 'mwt-google-adsense', [
	'label'             => __( 'Google Adsense', 'snow-monkey' ),
	'description'       => __( 'When pasting the code of the responsive ad unit or auto ads code, the advertisement is displayed in the prescribed part of the theme. If you want to display at arbitrary position, please use widgets etc.', 'snow-monkey' ) . __( 'Paste only the ins tag for ad units, only the contents of script tag for auto ads.', 'snow-monkey' ),
	'type'              => 'option',
	'priority'          => 100,
	'sanitize_callback' => function( $value ) {
		if ( ! preg_match( '/<ins /s', $value ) ) {
			// Auto ads.
			$value = strip_tags( $value );
			return $value;
		} else {
			// Not auto ads.
			$value = preg_replace( '@<script>[^<]*<\/script>@s', '', $value );
			$value = strip_tags( $value, '<ins>' );
			return $value;
		}
	},
] );

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'advertisement' );
$control = $customizer->get_control( 'mwt-google-adsense' );
$control->join( $section );
