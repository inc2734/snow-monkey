<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;
use Snow_Monkey\App\Helper;

$customizer = Customizer_Framework::init();

$customizer->control(
	'checkbox',
	'mwt-display-child-pages',
	[
		'transport'       => 'postMessage',
		'label'           => __( 'Display child pages in page', 'snow-monkey' ),
		'priority'        => 110,
		'type'            => 'option',
		'default'         => true,
		'active_callback' => function() {
			return Helper::get_child_pages_query( get_the_ID() )->have_posts();
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'page' );
$control = $customizer->get_control( 'mwt-display-child-pages' );
$control->join( $section )->join( $panel );
$control->partial(
	[
		'selector'            => '.p-child-pages',
		'container_inclusive' => true,
		'render_callback'     => function() {
			if ( get_option( 'mwt-display-child-pages' ) ) {
				Helper::get_template_part( 'template-parts/content/child-pages' );
			}
		},
	]
);
