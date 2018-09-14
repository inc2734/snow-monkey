<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'textarea',
	'mwt-google-infeed-ads',
	[
		'label'             => __( 'Google Infeed Ads', 'snow-monkey' ),
		'description'       => __( 'When pasting the code of the infeed ads, the advertisement is displayed in posts list.', 'snow-monkey' ) . __( 'Paste only the ins tag.', 'snow-monkey' ),
		'type'              => 'option',
		'priority'          => 110,
		'sanitize_callback' => function( $value ) {
			$value = preg_replace( '@<script>[^<]*<\/script>@s', '', $value );
			$value = strip_tags( $value, '<ins>' );
			return $value;
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'advertisement' );
$control = $customizer->get_control( 'mwt-google-infeed-ads' );
$control->join( $section );
