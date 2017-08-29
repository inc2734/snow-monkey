<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'share-buttons', [
	'title' => __( 'Share buttons', 'snow-monkey' ),
	'description' => sprintf(
		__( 'If you want to count of tweet then needs to register to %1$s.', 'snow-monkey' ),
		'<a href="https://opensharecount.com/" target="_blank">OpenShareCount</a>'
	),
] );

$customizer->control( 'multiple-checkbox', 'inc2734-theme-option-share-buttons-buttons', [
	'label'   => __( 'Display buttons', 'snow-monkey' ),
	'default' => '',
	'choices' => [
		'facebook' => __( 'Facebook', 'snow-monkey' ),
		'twitter'  => __( 'Twitter', 'snow-monkey' ),
		'hatena'   => __( 'Hatena Bookmark', 'snow-monkey' ),
		'feedly'   => __( 'Feedly', 'snow-monkey' ),
		'line'     => __( 'LINE', 'snow-monkey' ),
		'pocket'   => __( 'Pocket', 'snow-monkey' ),
		'feed'     => __( 'Feed', 'snow-monkey' ),
	],
	'type' => 'option',
] );

$customizer->control( 'select', 'inc2734-theme-option-share-buttons-type', [
	'label'   => __( 'Type', 'snow-monkey' ),
	'default' => 'balloon',
	'choices' => [
		'balloon'    => __( 'Balloon', 'snow-monkey' ),
		'horizontal' => __( 'Horizontal', 'snow-monkey' ),
		'icon'       => __( 'Icon', 'snow-monkey' ),
		'block'      => __( 'Block', 'snow-monkey' ),
		'official'   => __( 'Official', 'snow-monkey' ),
	],
	'type' => 'option',
] );

$customizer->control( 'select', 'inc2734-theme-option-share-buttons-display-position', [
	'label'   => __( 'Display position', 'snow-monkey' ),
	'default' => 'top',
	'choices' => [
		'top'    => __( 'Top of contents', 'snow-monkey' ),
		'bottom' => __( 'Bottom of contents', 'snow-monkey' ),
		'both'   => __( 'Both', 'snow-monkey' ),
	],
	'type' => 'option',
] );

$customizer->control( 'text', 'inc2734-theme-option-share-buttons-cache-seconds', [
	'label'   => __( 'Share counts cache time (seconds)', 'snow-monkey' ),
	'default' => 300,
	'type'    => 'option',
] );

$section = $customizer->get_section( 'share-buttons' );
$control = $customizer->get_control( 'inc2734-theme-option-share-buttons-buttons' );
$control->join( $section );
$control = $customizer->get_control( 'inc2734-theme-option-share-buttons-type' );
$control->join( $section );
$control = $customizer->get_control( 'inc2734-theme-option-share-buttons-display-position' );
$control->join( $section );
$control = $customizer->get_control( 'inc2734-theme-option-share-buttons-cache-seconds' );
$control->join( $section );
