<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;
use Inc2734\Mimizuku_Core\Helper;

$customizer = Customizer_Framework::init();

$theme_link = sprintf(
	'<a href="https://2inc.org" target="_blank">%s</a>',
	__( 'Monkey Wrench', 'snow-monkey' )
);

$wordpress_link = sprintf(
	'<a href="https://wordpress.org/" target="_blank">%s</a>',
	__( 'WordPress', 'snow-monkey' )
);

$theme_by   = sprintf( __( 'Snow Monkey theme by %s', 'snow-monkey' ), $theme_link );
$powered_by = sprintf( __( 'Powered by %s', 'snow-monkey' ), $wordpress_link );
$copyright  = $theme_by . ' ' . $powered_by;

$customizer->control(
	'text',
	'mwt-copyright',
	[
		'transport'   => 'postMessage',
		'label'       => __( 'Copyright', 'snow-monkey' ),
		'description' => __( 'HTML usable', 'snow-monkey' ),
		'default'     => $copyright,
		'type'        => 'option',
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'title_tagline' );
$control = $customizer->get_control( 'mwt-copyright' );
$control->join( $section );
$control->partial(
	[
		'selector'        => '.c-copyright',
		'render_callback' => function() {
			Helper\get_template_part( 'template-parts/footer/copyright' );
		},
	]
);
