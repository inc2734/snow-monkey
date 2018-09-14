<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'multiple-checkbox',
	'mwt-share-buttons-buttons',
	[
		'type'     => 'option',
		'label'    => __( 'Display buttons', 'snow-monkey' ),
		'priority' => 100,
		'default'  => '',
		'choices'  => [
			'facebook'    => __( 'Facebook', 'snow-monkey' ),
			'twitter'     => __( 'Twitter', 'snow-monkey' ),
			'hatena'      => __( 'Hatena Bookmark', 'snow-monkey' ),
			'google_plus' => __( 'Google+', 'snow-monkey' ),
			'feedly'      => __( 'Feedly', 'snow-monkey' ),
			'line'        => __( 'LINE', 'snow-monkey' ),
			'pocket'      => __( 'Pocket', 'snow-monkey' ),
			'feed'        => __( 'Feed', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'seo-sns' );
$section = $customizer->get_section( 'share-buttons' );
$control = $customizer->get_control( 'mwt-share-buttons-buttons' );
$control->join( $section )->join( $panel );
