<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'textarea',
	'mwt-google-infeed-ads',
	array(
		'label'             => __( 'Google Adsense Infeed Ads', 'snow-monkey' ),
		'description'       => __( 'When pasting the code of the infeed ads, the advertisement is displayed in posts list.', 'snow-monkey' ) . __( 'Paste only the ins tag.', 'snow-monkey' ),
		'type'              => 'option',
		'priority'          => 120,
		'active_callback'   => function() {
			return get_theme_mod( 'expand-get-template-part' );
		},
		'sanitize_callback' => function( $value ) {
			$value = preg_replace( '@<script>[^<]*<\/script>@s', '', $value );
			$value = strip_tags( $value, '<ins>' );
			return $value;
		},
	)
);

$section = Framework::get_section( 'advertisement' );
$control = Framework::get_control( 'mwt-google-infeed-ads' );
$control->join( $section );
