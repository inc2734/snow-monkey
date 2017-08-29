<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Basis\App\Model\Global_Nav;
use Inc2734\WP_Basis\App\Model\Drawer_Nav;

/**
 * Registers wp_nav_menu() menus
 *
 * @return void
 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
 */
add_action( 'after_setup_theme', function() {
	register_nav_menus( [
		'global-nav' => esc_html__( 'Global Navigation (For PC)', 'snow-monkey' ),
		'drawer-nav' => esc_html__( 'Drawer Navigation (For Mobile)', 'snow-monkey' ),
		'social-nav' => esc_html__( 'Social Navigation', 'snow-monkey' ),
	] );
} );

new Global_Nav( 'global-nav' );
new Drawer_Nav( 'drawer-nav' );
new Global_Nav( 'social-nav' );
