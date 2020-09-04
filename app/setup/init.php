<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

/**
 * Enable plugins to manage the document title
 *
 * @return void
 * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'title-tag' );
	}
);

/**
 * Enable post thumbnails
 *
 * @return void
 * @see http://codex.wordpress.org/Post_Thumbnails
 * @see http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
 * @see http://codex.wordpress.org/Function_Reference/add_image_size
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'post-thumbnails' );
	}
);

/**
 * Enable HTML5 markup support
 *
 * @return void
 * @see http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );
	}
);

/**
 * Add default posts and comments RSS feed links to head.
 *
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'automatic-feed-links' );
	}
);

/**
 * Add theme support for selective refresh for widgets.
 *
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
);
