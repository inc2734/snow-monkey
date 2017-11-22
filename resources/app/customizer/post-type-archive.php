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
	if ( 'post' === $post_type_object->name ) {
		// @codingStandardsIgnoreStart
		$description = sprintf( __( 'Applies to archive of %1$s, category archice, tag archive and search page.', 'snow-monkey' ), __( $post_type_object->label ) );
		// @codingStandardsIgnoreEnd
	} else {
		// @codingStandardsIgnoreStart
		$description = sprintf( __( 'Applies to archive of %1$s and taxonomy archive of %1$s.', 'snow-monkey' ), __( $post_type_object->label ) );
		// @codingStandardsIgnoreEnd
	}

	$customizer->section( $post_type_object->name . '-archive', [
		// @codingStandardsIgnoreStart
		'title'           => sprintf( __( 'Settings of %1$s archive', 'snow-monkey' ), __( $post_type_object->label ) ),
		// @codingStandardsIgnoreEnd
		'description'     => $description,
		'priority'        => 1110,
		'active_callback' => function() use ( $post_type_object ) {
			return ( get_post_type() === $post_type_object->name && ! is_singular() );
		},
	] );

	$section = $customizer->get_section( $post_type_object->name . '-archive' );

	/**
	 * Layout
	 */
	if ( 'post' === $post_type_object->name || ! empty( $post_type_object->has_archive ) ) {
		$customizer->control( 'select', $post_type_object->name . '-archive-layout', [
			'label'       => __( 'Page layout', 'snow-monkey' ),
			'default'     => 'one-column',
			'choices'     => snow_monkey_get_page_templates(),
		] );

		$control = $customizer->get_control( $post_type_object->name . '-archive-layout' );
		$control->join( $section );
	}
}
