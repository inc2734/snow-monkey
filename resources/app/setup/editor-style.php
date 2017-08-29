<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Use main stylesheet for visual editor
 *
 * @return void
 */
add_action( 'after_setup_theme', function() {
	add_editor_style( [
		'assets/css/editor-style.min.css',
	] );
} );
