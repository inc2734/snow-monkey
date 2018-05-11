<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_image_size( 'xlarge', 1920, 1920 );

/**
 * Update pickup slider widget image size
 */
add_filter( 'inc2734_wp_awesome_widgets_pickup_slider_image_size', function( $thumbnail_size, $is_mobile ) {
	if ( $is_mobile ) {
		return 'large';
	}

	return 'xlarge';
}, 10, 2 );

/**
 * Update slider widget image size
 */
add_filter( 'inc2734_wp_awesome_widgets_slider_image_size', function( $thumbnail_size, $is_mobile ) {
	if ( $is_mobile ) {
		return 'large';
	}

	return 'xlarge';
}, 10, 2 );

/**
 * Update showcase widget background image size
 */
add_filter( 'inc2734_wp_awesome_widgets_showcase_backgroud_image_size', function( $thumbnail_size, $is_mobile ) {
	if ( $is_mobile ) {
		return 'large';
	}

	return 'xlarge';
}, 10, 2 );

/**
 * Update showcase widget thumbnail image size
 */
add_filter( 'inc2734_wp_awesome_widgets_showcase_image_size', function( $thumbnail_size, $is_mobile ) {
	if ( $is_mobile ) {
		return 'large';
	}

	return 'xlarge';
}, 10, 2 );
