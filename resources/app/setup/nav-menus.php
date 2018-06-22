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
		'global-nav'        => esc_html__( 'Global Navigation (For PC)', 'snow-monkey' ),
		'drawer-nav'        => esc_html__( 'Drawer Navigation (For Mobile)', 'snow-monkey' ),
		'social-nav'        => esc_html__( 'Social Navigation', 'snow-monkey' ),
		'footer-sticky-nav' => esc_html__( 'Footer Sticky Navigation (For Mobile)', 'snow-monkey' ),
	] );
} );

new Global_Nav( 'global-nav' );
new Drawer_Nav( 'drawer-nav' );
new Global_Nav( 'social-nav' );
new Global_Nav( 'footer-sticky-nav' );

/**
 * Display description of nav item under it.
 *
 * @param string $output HTML
 * @param object $item
 * @param int $depth
 * @param object $args
 * @return string
 */
add_filter( 'walker_nav_menu_start_el', function( $output, $item, $depth, $args ) {
	if ( 0 != $depth || 'global-nav' !== $args->theme_location || empty( $item->description ) ) {
		return $output;
	}

	$pattern     = '/(<a.*?>)([^<]*?)(<\/a>)/';
	$replacement = '$1$2<small>' . esc_html( $item->description ) . '</small>$3';

	return preg_replace( $pattern, $replacement, $output );
}, 10, 4 );
