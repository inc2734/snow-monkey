<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'checkbox', 'display-site-branding-description', [
	'transport' => 'postMessage',
	'label'     => __( 'Display site description under the site logo', 'snow-monkey' ),
	'priority'  => 140,
	'default'   => false,
] );

$control = $customizer->get_control( 'display-site-branding-description' );
$control->join( $section );
$control->partial( [
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
] );
