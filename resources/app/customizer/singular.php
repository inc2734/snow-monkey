<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$post_types = snow_monkey_get_public_post_types();
foreach ( $post_types as $post_type => $post_type_object ) {
	$customizer->section( $post_type_object->name . '-page', [
		// @codingStandardsIgnoreStart
		'title'           => sprintf( __( 'Settings of %1$s page', 'snow-monkey' ), __( $post_type_object->label ) ),
		'description'     => sprintf( __( 'Applies to singular page of %1$s.', 'snow-monkey' ), __( $post_type_object->label ) ),
			// @codingStandardsIgnoreEnd
		'priority'        => 1110,
		'active_callback' => function() use ( $post_type_object ) {
			return ( get_post_type() === $post_type_object->name && is_singular() && ! is_front_page() );
		},
	] );

	$section = $customizer->get_section( $post_type_object->name . '-page' );

	/**
	 * Layout
	 */
	$customizer->control( 'select', $post_type_object->name . '-layout', [
		'label'   => __( 'Page layout', 'snow-monkey' ),
		'default' => 'right-sidebar',
		'choices' => snow_monkey_get_page_templates(),
	] );

	$control = $customizer->get_control( $post_type_object->name . '-layout' );
	$control->join( $section );

	/**
	 * Only post
	 */
	if ( 'post' === $post_type_object->name ) {
		/**
		 * Contents outline
		 */
		$customizer->control( 'checkbox', 'mwt-display-contents-outline', [
			'label'   => __( 'Display contents outline in posts', 'snow-monkey' ),
			'type'    => 'option',
			'default' => true,
			'active_callback' => function() {
				return is_single();
			},
		] );

		$control = $customizer->get_control( 'mwt-display-contents-outline' );
		$control->join( $section );
		$control->partial( [
			'selector' => '.wp-like-me-box',
		] );

		/**
		 * Profile Box
		 */
		$customizer->control( 'checkbox', 'mwt-display-profile-box', [
			'label'   => __( 'Display profile box in posts', 'snow-monkey' ),
			'type'    => 'option',
			'default' => true,
			'active_callback' => function() {
				return is_single();
			},
		] );

		$control = $customizer->get_control( 'mwt-display-profile-box' );
		$control->join( $section );
		$control->partial( [
			'selector' => '.wp-profile-box',
		] );
	}
}
