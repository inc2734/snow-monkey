<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

/**
 * Use main stylesheet for visual editor
 *
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'editor-styles' );

		if ( function_exists( 'is_gutenberg_page' ) && ! isset( $_GET['classic-editor'] ) ) {
			$stylesheet = [ 'assets/css/gutenberg.min.css' ];
		} else {
			$stylesheet = [ 'assets/css/editor-style.min.css' ];
		}

		add_editor_style( $stylesheet );
	}
);
