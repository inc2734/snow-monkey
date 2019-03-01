<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

/**
 * Enqueue main style
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$relative_path = '/assets/css/style.min.css';

		$dependencies = Helper::generate_style_dependencies(
			[
				'wp-block-library',
				'wp-share-buttons',
				'wp-like-me-box',
				'wp-oembed-blog-card',
				'wp-pure-css-gallery',
				'wp-awesome-widgets',
			]
		);

		wp_enqueue_style(
			Helper::get_main_style_handle(),
			get_theme_file_uri( $relative_path ),
			$dependencies,
			filemtime( get_theme_file_path( $relative_path ) )
		);
	},
	11
);

/**
 * Enqueue main script
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$relative_path = '/assets/js/app.min.js';
		wp_enqueue_script(
			Helper::get_main_script_handle(),
			get_theme_file_uri( $relative_path ),
			Helper::generate_script_dependencies(
				[
					'jquery',
					'wp-awesome-widgets',
				]
			),
			filemtime( get_theme_file_path( $relative_path ) ),
			true
		);

		if ( is_user_logged_in() ) {
			$relative_path = '/assets/js/fix-adminbar.min.js';
			wp_enqueue_script(
				Helper::get_main_script_handle() . '-fix-adminbar',
				get_theme_file_uri( $relative_path ),
				[ 'jquery' ],
				filemtime( get_theme_file_path( $relative_path ) ),
				true
			);
		}

		if ( get_theme_mod( 'header-position-only-mobile' ) ) {
			if ( in_array( Helper::get_default_header_position(), [ 'sticky', 'overlay' ] ) ) {
				$relative_path = '/assets/js/header.min.js';
				wp_enqueue_script(
					Helper::get_main_script_handle() . '-header',
					get_theme_file_uri( $relative_path ),
					[ 'jquery', Helper::get_main_script_handle() ],
					filemtime( get_theme_file_path( $relative_path ) ),
					true
				);
			}
		}

		if ( get_theme_mod( 'header-position-only-mobile' ) ) {
			if ( has_nav_menu( 'global-nav' ) ) {
				$relative_path = '/assets/js/drop-nav.min.js';
				wp_enqueue_script(
					Helper::get_main_script_handle() . '-drop-nav',
					get_theme_file_uri( $relative_path ),
					[ 'jquery' ],
					filemtime( get_theme_file_path( $relative_path ) ),
					true
				);
			}
		}

		if ( has_nav_menu( 'footer-sticky-nav' ) ) {
			$relative_path = '/assets/js/footer-sticky-nav.min.js';
			wp_enqueue_script(
				Helper::get_main_script_handle() . '-footer-sticky-nav',
				get_theme_file_uri( $relative_path ),
				[ 'jquery' ],
				filemtime( get_theme_file_path( $relative_path ) ),
				true
			);
		}

		if ( has_nav_menu( 'global-nav' ) ) {
			$relative_path = '/assets/js/global-nav.min.js';
			wp_enqueue_script(
				Helper::get_main_script_handle() . '-global-nav',
				get_theme_file_uri( $relative_path ),
				[ 'jquery' ],
				filemtime( get_theme_file_path( $relative_path ) ),
				true
			);
		}

		$sidebar_id = 'sidebar-sticky-widget-area';
		if ( is_active_sidebar( $sidebar_id ) && is_registered_sidebar( $sidebar_id ) ) {
			$relative_path = '/assets/js/sidebar-sticky-widget-area.min.js';
			wp_enqueue_script(
				Helper::get_main_script_handle() . '-sidebar-sticky-widget-area',
				get_theme_file_uri( $relative_path ),
				[ 'jquery' ],
				filemtime( get_theme_file_path( $relative_path ) ),
				true
			);
		}
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
			$relative_path = '/assets/packages/fontawesome-free/js/all.min.js';
			wp_enqueue_script(
				'fontawesome5',
				get_theme_file_uri( $relative_path ),
				[],
				filemtime( get_theme_file_path( $relative_path ) ),
				true
			);
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
		$relative_path = '/assets/js/customize-preview.js';

		wp_enqueue_script(
			Helper::get_main_script_handle() . '-customize-preview',
			get_theme_file_uri( $relative_path ),
			[ 'jquery', 'customize-preview', Helper::get_main_script_handle() ],
			filemtime( get_theme_file_path( $relative_path ) ),
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
				'header_position_only_mobile' => get_theme_mod( 'header-position-only-mobile' ) ? 'true' : 'false',
			]
		);
	}
);
