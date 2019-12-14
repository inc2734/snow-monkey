<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.4.0
 */

use Inc2734\WP_Basis\App\Model\Navbar;
use Inc2734\WP_Basis\App\Model\Drawer;
use Framework\Helper;

/**
 * Registers wp_nav_menu() menus
 *
 * @return void
 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
 */
add_action(
	'after_setup_theme',
	function() {
		register_nav_menus(
			[
				'global-nav'        => esc_html__( 'Global Navigation (For PC)', 'snow-monkey' ),
				'drawer-nav'        => esc_html__( 'Drawer Navigation (For Mobile)', 'snow-monkey' ),
				'social-nav'        => esc_html__( 'Social Navigation', 'snow-monkey' ),
				'header-sub-nav'    => esc_html__( 'Header Sub Navigation', 'snow-monkey' ),
				'footer-sub-nav'    => esc_html__( 'Footer Sub Navigation', 'snow-monkey' ),
				'drawer-sub-nav'    => esc_html__( 'Drawer Sub Navigation (For Mobile)', 'snow-monkey' ),
				'footer-sticky-nav' => esc_html__( 'Footer Sticky Navigation (For Mobile)', 'snow-monkey' ),
			]
		);
	}
);

/**
 * Enqueue scripts
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_register_script(
			Helper::get_main_script_handle() . '-drop-nav',
			get_theme_file_uri( '/assets/js/drop-nav.min.js' ),
			[ 'jquery' ],
			filemtime( get_theme_file_path( '/assets/js/drop-nav.min.js' ) ),
			true
		);

		wp_register_script(
			Helper::get_main_script_handle() . '-footer-sticky-nav',
			get_theme_file_uri( '/assets/js/footer-sticky-nav.min.js' ),
			[ 'jquery' ],
			filemtime( get_theme_file_path( '/assets/js/footer-sticky-nav.min.js' ) ),
			true
		);

		wp_register_script(
			Helper::get_main_script_handle() . '-global-nav',
			get_theme_file_uri( '/assets/js/global-nav.min.js' ),
			[ 'jquery' ],
			filemtime( get_theme_file_path( '/assets/js/global-nav.min.js' ) ),
			true
		);

		if ( '' === Helper::get_default_header_position() || get_theme_mod( 'header-position-only-mobile' ) ) {
			if ( has_nav_menu( 'global-nav' ) ) {
				wp_enqueue_script( Helper::get_main_script_handle() . '-drop-nav' );
			}
		}

		if ( has_nav_menu( 'footer-sticky-nav' ) ) {
			wp_enqueue_script( Helper::get_main_script_handle() . '-footer-sticky-nav' );
		}

		if ( has_nav_menu( 'global-nav' ) ) {
			wp_enqueue_script( Helper::get_main_script_handle() . '-global-nav' );
		}
	}
);

/**
 * Display description of nav item under it.
 *
 * @param string $title HTML
 * @param object $item
 * @param object $args
 * @param int $depth
 * @return string
 */
add_filter(
	'nav_menu_item_title',
	function( $title, $item, $args, $depth ) {
		$show_description = 0 == $depth && 'global-nav' === $args->theme_location;
		$show_description = apply_filters( 'snow_monkey_nav_menu_item_title_show_description', $show_description, $depth, $args->theme_location );

		if ( ! $show_description ) {
			return $title;
		}

		$title = sprintf( '<span>%1$s</span>', $title );

		if ( $item->description ) {
			$title = $title . sprintf( '<small>%1$s</small>', esc_html( $item->description ) );
		}

		return $title;
	},
	10,
	4
);
