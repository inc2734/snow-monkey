<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'select',
	'related-posts-layout',
	array(
		'transport'       => 'postMessage',
		'label'           => __( 'Related posts layout', 'snow-monkey' ),
		'priority'        => 140,
		'default'         => '',
		'choices'         => array(
			''            => __( 'Default', 'snow-monkey' ),
			'rich-media'  => __( 'Rich media', 'snow-monkey' ),
			'simple'      => __( 'Simple', 'snow-monkey' ),
			'text'        => __( 'Text', 'snow-monkey' ),
			'text2'       => __( 'Text 2', 'snow-monkey' ),
			'panel'       => __( 'Panels', 'snow-monkey' ),
			'carousel'    => sprintf(
				// translators: %1$s: entries layout
				__( 'Carousel (%1$s)', 'snow-monkey' ),
				__( 'Rich media', 'snow-monkey' )
			),
			'large-image' => __( 'Large image', 'snow-monkey' ),
		),
		'active_callback' => function() {
			return get_option( 'mwt-display-related-posts' );
		},
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-post' );
$control = Framework::get_control( 'related-posts-layout' );
$control->join( $section )->join( $panel );
$control->partial(
	array(
		'selector'            => '.p-related-posts',
		'container_inclusive' => true,
		'active_callback'     => function() {
			return get_option( 'mwt-display-related-posts' );
		},
		'render_callback'     => function() {
			if ( get_option( 'mwt-display-related-posts' ) ) {
				$related_posts_query = Helper::get_related_posts_query( get_the_ID() );
				if ( get_option( 'mwt-google-matched-content' ) || $related_posts_query->have_posts() ) {
					Helper::get_template_part(
						'template-parts/content/related-posts',
						null,
						array(
							'_code' => get_option( 'mwt-google-matched-content' ),
						)
					);
				}
			}
		},
	)
);
