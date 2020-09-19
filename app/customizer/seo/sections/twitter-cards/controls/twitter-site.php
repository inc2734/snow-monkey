<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 *
 * renamed: app/customizer/seo-sns/sections/twitter-cards/controls/twitter-site.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'mwt-twitter-site',
	array(
		'label'       => __( 'twitter:site', 'snow-monkey' ),
		'priority'    => 110,
		'description' => sprintf(
			/* translators: 1: @username */
			__( 'The Twitter account name of the site. Please enter in the form %1$s.', 'snow-monkey' ),
			'<code>@username</code>'
		),
		'default'     => '@',
		'type'        => 'option',
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'twitter-cards' );
$control = Framework::get_control( 'mwt-twitter-site' );
$control->join( $section )->join( $panel );
