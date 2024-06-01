<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'text',
	'infobar-content',
	array(
		'label'     => __( 'Infobar content', 'snow-monkey' ),
		'transport' => 'postMessage',
		'priority'  => 100,
	)
);

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-content' );
$control->join( $section );
$control->partial(
	array(
		'selector'            => '.p-infobar',
		'container_inclusive' => true,
		'render_callback'     => function () {
			if ( get_theme_mod( 'infobar-content' ) ) {
				Helper::get_template_part(
					'template-parts/common/infobar',
					null,
					array(
						'_content' => get_theme_mod( 'infobar-content' ),
						'_url'     => get_theme_mod( 'infobar-url' ),
						'_target'  => get_theme_mod( 'infobar-link-target' ),
						'_align'   => get_theme_mod( 'infobar-align' ),
					)
				);
			}
		},
	)
);
