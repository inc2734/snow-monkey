<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'checkbox',
	'display-site-branding-description',
	[
		'transport' => 'postMessage',
		'label'     => __( 'Display site description under the site logo', 'snow-monkey' ),
		'priority'  => 120,
		'default'   => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'base-design' );
$control = $customizer->get_control( 'display-site-branding-description' );
$control->join( $section )->join( $panel );
$control->partial(
	[
		'selector'            => '.c-site-branding__description',
		'container_inclusive' => true,
		'render_callback'     => function() {
			?>
			<?php if ( get_theme_mod( 'display-site-branding-description' ) && get_bloginfo( 'description' ) ) : ?>
				<div class="c-site-branding__description">
					<?php bloginfo( 'description' ); ?>
				</div>
			<?php endif; ?>
			<?php
		},
	]
);
