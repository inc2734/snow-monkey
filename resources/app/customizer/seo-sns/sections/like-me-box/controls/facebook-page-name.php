<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;
use Inc2734\Mimizuku_Core\Helper;

$customizer = Customizer_Framework::init();

$customizer->control(
	'text',
	'mwt-facebook-page-name',
	[
		'transport'   => 'postMessage',
		'type'        => 'option',
		'label'       => __( 'Facebook page name', 'snow-monkey' ),
		'description' => sprintf(
			_x( 'Please enter %1$s of %2$s', 'facebook-page-name', 'snow-monkey' ),
			'<code>xxxxx</code>',
			'<code>https://www.facebook.com/xxxxx</code>'
		),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'seo-sns' );
$section = $customizer->get_section( 'like-me-box' );
$control = $customizer->get_control( 'mwt-facebook-page-name' );
$control->join( $section )->join( $panel );
$control->partial(
	[
		'selector'            => '.wp-like-me-box',
		'container_inclusive' => true,
		'render_callback'     => function() {
			if ( get_option( 'mwt-facebook-page-name' ) ) {
				Helper\get_template_part( 'template-parts/profile-box' );
			}
		},
	]
);
