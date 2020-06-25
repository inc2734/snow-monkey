<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.10.3
 */

use Inc2734\WP_Google_Fonts;
use Framework\Helper;

/**
 * Apply Google Fonts asset url
 */
new WP_Google_Fonts\Bootstrap();

/**
 * Enqueue slick-carousel
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_script(
			'slick-carousel',
			get_theme_file_uri( '/assets/packages/slick-carousel/slick/slick.min.js' ),
			[ 'jquery' ],
			filemtime( get_theme_file_path( '/assets/packages/slick-carousel/slick/slick.min.js' ) ),
			true
		);

		wp_enqueue_style(
			'slick-carousel',
			get_theme_file_uri( '/assets/packages/slick-carousel/slick/slick.css' ),
			[],
			filemtime( get_theme_file_path( '/assets/packages/slick-carousel/slick/slick.css' ) )
		);

		wp_enqueue_style(
			'slick-carousel-theme',
			get_theme_file_uri( '/assets/packages/slick-carousel/slick/slick-theme.css' ),
			[ 'slick-carousel' ],
			filemtime( get_theme_file_path( '/assets/packages/slick-carousel/slick/slick-theme.css' ) )
		);
	}
);

/**
 * Enqueue main style
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$dependencies = Helper::generate_style_dependencies(
			[
				'wp-block-library',
				'wp-share-buttons',
				'wp-like-me-box',
				'wp-oembed-blog-card',
				'wp-pure-css-gallery',
				'wp-awesome-widgets',
				'slick-carousel',
			]
		);

		wp_enqueue_style(
			Helper::get_main_style_handle(),
			get_theme_file_uri( '/assets/css/style.min.css' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/css/style.min.css' ) )
		);

		do_action( 'snow_monkey_enqueued_main_style' );
	}
);

/**
 * Enqueue main script
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_script(
			Helper::get_main_script_handle(),
			get_theme_file_uri( '/assets/js/app.min.js' ),
			Helper::generate_script_dependencies(
				[
					'wp-awesome-widgets',
					'slick-carousel',
				]
			),
			filemtime( get_theme_file_path( '/assets/js/app.min.js' ) ),
			true
		);

		do_action( 'snow_monkey_enqueued_main_script' );
	}
);

/**
 * Enqueue script for adminbar
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if ( ! is_user_logged_in() ) {
			return;
		}

		wp_enqueue_script(
			Helper::get_main_script_handle() . '-fix-adminbar',
			get_theme_file_uri( '/assets/js/fix-adminbar.min.js' ),
			[],
			filemtime( get_theme_file_path( '/assets/js/fix-adminbar.min.js' ) ),
			true
		);
	}
);

/**
 * Enqueue FontAwesome
 *
 * @return void
 */
foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts' ] as $action_hook ) {
	add_action(
		$action_hook,
		function() {
			if ( ! get_theme_mod( 'use-lightweight-fontawesome' ) ) {
				wp_enqueue_script(
					'fontawesome5',
					get_theme_file_uri( '/assets/packages/fontawesome-free/js/all.min.js' ),
					[],
					filemtime( get_theme_file_path( '/assets/packages/fontawesome-free/js/all.min.js' ) ),
					true
				);
			} else {
				wp_enqueue_script(
					Helper::get_main_script_handle() . '-fontawesome',
					get_theme_file_uri( '/assets/js/fontawesome.min.js' ),
					[],
					filemtime( get_theme_file_path( '/assets/js/fontawesome.min.js' ) ),
					true
				);
			}
		}
	);
}

/**
 * Enqueue script for comment
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
);

/**
 * Enqueue jquery.easing
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_script(
			'jquery.easing',
			'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js',
			[ 'jquery' ],
			'1.4.1',
			true
		);
	}
);

/**
 * Enqueue script for customize preview
 *
 * @return void
 */
add_action(
	'customize_preview_init',
	function() {
		wp_enqueue_script(
			Helper::get_main_script_handle() . '-customize-preview',
			get_theme_file_uri( '/assets/js/customize-preview.min.js' ),
			[
				'customize-preview',
				'customize-selective-refresh',
				'wp-awesome-widgets-customize-preview',
				Helper::get_main_script_handle(),
			],
			filemtime( get_theme_file_path( '/assets/js/customize-preview.min.js' ) ),
			true
		);
	}
);

/**
 * Enqueue script for global navigation
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_localize_script(
			Helper::get_main_script_handle(),
			'snow_monkey',
			[
				'home_url' => home_url(),
			]
		);
	}
);

/**
 * Enqueue admin screen CSS
 *
 * @return void
 */
add_action(
	'admin_enqueue_scripts',
	function() {
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-admin',
			get_theme_file_uri( '/assets/css/admin.min.css' ),
			[],
			filemtime( get_theme_file_path( '/assets/css/admin.min.css' ) )
		);
	}
);
