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
 * Enqueue script for header position
 *
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
	global $wp_scripts;
	$header_position_only_mobile = get_theme_mod( 'header-position-only-mobile' );
	$header_position_only_mobile = ( $header_position_only_mobile ) ? 'true' : 'false';
	$data = 'var snow_monkey_header_position_only_mobile = ' . $header_position_only_mobile;
	wp_add_inline_script( snow_monkey_get_main_script_handle(), $data, 'before' );
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
		'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
		[ 'jquery' ],
		false,
		true
	);
} );

/**
 * Enqueue script for customize preview
 *
 * @return void
 */
add_action( 'customize_preview_init', function() {
	$relative_path = '/assets/js/customize-preview.js';
	$src  = get_theme_file_uri( $relative_path );
	$path = get_theme_file_path( $relative_path );

	if ( ! file_exists( $path ) ) {
		return;
	}

	wp_enqueue_script(
		snow_monkey_get_main_script_handle() . '-customize-preview',
		$src,
		[ 'jquery','customize-preview', snow_monkey_get_main_script_handle() ],
		filemtime( $path ),
		true
	);
} );
