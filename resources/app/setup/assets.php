<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Enqueue main style
 *
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	$relative_path = '/assets/css/style.min.css';
	$src  = get_theme_file_uri( $relative_path );
	$path = get_theme_file_path( $relative_path );

	if ( ! file_exists( $path ) ) {
		return;
	}

	wp_enqueue_style(
		snow_monkey_get_main_style_handle(),
		$src,
		[],
		filemtime( $path )
	);
} );

/**
 * Enqueue main script
 *
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	$relative_path = '/assets/js/app.min.js';
	$src  = get_theme_file_uri( $relative_path );
	$path = get_theme_file_path( $relative_path );

	if ( ! file_exists( $path ) ) {
		return;
	}

	wp_enqueue_script(
		snow_monkey_get_main_script_handle(),
		$src,
		[ 'jquery' ],
		filemtime( $path ),
		true
	);
} );

/**
 * Enqueue FontAwesome
 *
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script(
		'fontawesome5',
		'https://use.fontawesome.com/releases/v5.0.9/js/all.js',
		[ snow_monkey_get_main_script_handle() ],
		false,
		true
	);

	wp_enqueue_script(
		'fontawesome5-v4-shims',
		'https://use.fontawesome.com/releases/v5.0.9/js/v4-shims.js',
		[ 'fontawesome5' ],
		false,
		true
	);
} );

/**
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );

/**
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script(
		'jquery.easing',
		'//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
		[ 'jquery' ],
		false,
		true
	);
} );

/**
 * Add defer
 *
 * @param string $tag
 * @param string handle
 * @param string src
 * @return string
 */
add_filter('script_loader_tag', function( $tag, $handle, $src ) {
	$defer_handles = [
		get_template(),
		get_stylesheet(),
		'fontawesome5',
		'fontawesome5-v4-shims',
	];

	if ( ! in_array( $handle, $defer_handles ) ) {
		return $tag;
	}

	return str_replace( ' src', ' defer="defer" src', $tag );
}, 10, 3 );
