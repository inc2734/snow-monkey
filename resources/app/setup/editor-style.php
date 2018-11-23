<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

/**
 * Support editor styles
 *
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'editor-styles' );
	}
);

/**
 * Use main stylesheet for visual editor
 *
 * @return void
 */
add_action(
	'admin_enqueue_scripts',
	function() {
		if ( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) {
			$stylesheet = [ 'assets/css/gutenberg.min.css' ];
		} else {
			$stylesheet = [ 'assets/css/editor-style.min.css' ];
		}

		add_editor_style( $stylesheet );
	}
);
