<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.4.0
 *
 * renamed: app/customizer/seo-sns/sections/share-buttons/controls/buttons.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'multiple-checkbox',
	'mwt-share-buttons-buttons',
	array(
		'type'     => 'option',
		'label'    => __( 'Display buttons', 'snow-monkey' ),
		'priority' => 100,
		'default'  => '',
		'choices'  => array(
			'facebook'  => __( 'Facebook', 'snow-monkey' ),
			'twitter'   => __( 'Twitter', 'snow-monkey' ),
			'x'         => __( 'X', 'snow-monkey' ),
			'threads'   => __( 'Threads', 'snow-monkey' ),
			'hatena'    => __( 'Hatena Bookmark', 'snow-monkey' ),
			'feedly'    => __( 'Feedly', 'snow-monkey' ),
			'line'      => __( 'LINE', 'snow-monkey' ),
			'pocket'    => __( 'Pocket', 'snow-monkey' ),
			'pinterest' => __( 'Pinterest', 'snow-monkey' ),
			'feed'      => __( 'Feed', 'snow-monkey' ),
			'copy'      => __( 'Copy', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'sns' );
$section = Framework::get_section( 'share-buttons' );
$control = Framework::get_control( 'mwt-share-buttons-buttons' );
$control->join( $section )->join( $panel );
