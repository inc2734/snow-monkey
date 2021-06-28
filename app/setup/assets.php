<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

use Inc2734\WP_Google_Fonts;
use Framework\Helper;

/**
 * Apply Google Fonts asset url
 */
new WP_Google_Fonts\Bootstrap();

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
				'slick-carousel-theme',
			]
		);

		wp_enqueue_style(
			Helper::get_main_style_handle(),
			get_theme_file_uri( '/assets/css/style.min.css' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/css/style.min.css' ) )
		);

		wp_enqueue_style(
			Helper::get_main_style_handle() . '-block-library',
			get_theme_file_uri( '/assets/css/block-library.min.css' ),
			[ 'wp-block-library' ],
			filemtime( get_theme_file_path( '/assets/css/block-library.min.css' ) )
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
			get_theme_file_uri( '/assets/js/app.js' ),
			[ 'spider' ],
			filemtime( get_theme_file_path( '/assets/js/app.js' ) ),
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
			get_theme_file_uri( '/assets/js/fix-adminbar.js' ),
			[],
			filemtime( get_theme_file_path( '/assets/js/fix-adminbar.js' ) ),
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
					get_theme_file_uri( '/assets/js/fontawesome.js' ),
					[],
					filemtime( get_theme_file_path( '/assets/js/fontawesome.js' ) ),
					true
				);
			}
		}
	);
}

/**
 * Enqueue spider.
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if ( ! wp_style_is( 'spider', 'registered' ) ) {
			wp_enqueue_style(
				'spider',
				get_theme_file_uri( '/assets/packages/spider/dist/css/spider.css' ),
				[],
				filemtime( get_theme_file_path( '/assets/packages/spider/dist/css/spider.css' ) )
			);
		}

		if ( ! wp_script_is( 'spider', 'registered' ) ) {
			wp_enqueue_script(
				'spider',
				get_theme_file_uri( '/assets/packages/spider/dist/js/spider.js' ),
				[],
				filemtime( get_theme_file_path( '/assets/packages/spider/dist/js/spider.js' ) ),
				true
			);
		}
	}
);

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
 * Enqueue script for customize preview
 *
 * @return void
 */
add_action(
	'customize_preview_init',
	function() {
		wp_enqueue_script(
			Helper::get_main_script_handle() . '-customize-preview',
			get_theme_file_uri( '/assets/js/customize-preview.js' ),
			[
				'customize-preview',
				'customize-selective-refresh',
				'wp-awesome-widgets-customize-preview',
				Helper::get_main_script_handle(),
			],
			filemtime( get_theme_file_path( '/assets/js/customize-preview.js' ) ),
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
