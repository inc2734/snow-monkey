<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.1
 */

use Framework\Helper;

/**
 * Enqueue main style
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		$dependencies = Helper::generate_style_dependencies(
			array(
				'wp-block-library',
				'wp-share-buttons',
				'wp-like-me-box',
				'wp-oembed-blog-card',
				'wp-pure-css-gallery',
				'wp-awesome-widgets',
				'slick-carousel',
				'slick-carousel-theme',
			)
		);

		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style(
			Helper::get_main_style_handle(),
			false,
			array(
				Helper::get_main_style_handle() . '-app',
				Helper::get_main_style_handle() . '-theme',
			)
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-app',
			get_theme_file_uri( '/assets/css/app/app.css' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/css/app/app.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-theme',
			get_theme_file_uri( '/assets/css/app/app-theme.css' ),
			array( Helper::get_main_style_handle() . '-app' ),
			filemtime( get_theme_file_path( '/assets/css/app/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() );

		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style(
			Helper::get_main_style_handle() . '-block-library',
			false,
			array(
				Helper::get_main_style_handle() . '-block-library-app',
				Helper::get_main_style_handle() . '-block-library-theme',
			)
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-block-library-app',
			get_theme_file_uri( '/assets/css/block-library/app.css' ),
			array( 'wp-block-library' ),
			filemtime( get_theme_file_path( '/assets/css/block-library/app.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-block-library-theme',
			get_theme_file_uri( '/assets/css/block-library/app-theme.css' ),
			array( Helper::get_main_style_handle() . '-block-library-app' ),
			filemtime( get_theme_file_path( '/assets/css/block-library/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-block-library' );

		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style(
			Helper::get_main_style_handle() . '-global-styles',
			false,
			array(
				Helper::get_main_style_handle() . '-global-styles-app',
				Helper::get_main_style_handle() . '-global-styles-theme',
			)
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-global-styles-app',
			get_theme_file_uri( '/assets/css/global-styles/app.css' ),
			array( 'global-styles' ),
			filemtime( get_theme_file_path( '/assets/css/global-styles/app.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-global-styles-theme',
			get_theme_file_uri( '/assets/css/global-styles/app-theme.css' ),
			array( Helper::get_main_style_handle() . '-global-styles-app' ),
			filemtime( get_theme_file_path( '/assets/css/global-styles/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-global-styles' );

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
	function () {
		wp_enqueue_script(
			Helper::get_main_script_handle(),
			get_theme_file_uri( '/assets/js/app.js' ),
			array( 'spider' ),
			filemtime( get_theme_file_path( '/assets/js/app.js' ) ),
			array(
				'strategy'  => 'defer',
				'in_footer' => false,
			)
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
	function () {
		if ( ! is_user_logged_in() ) {
			return;
		}

		wp_enqueue_script(
			Helper::get_main_script_handle() . '-fix-adminbar',
			get_theme_file_uri( '/assets/js/fix-adminbar.js' ),
			array(),
			filemtime( get_theme_file_path( '/assets/js/fix-adminbar.js' ) ),
			array(
				'strategy'  => 'defer',
				'in_footer' => false,
			)
		);
	}
);

/**
 * Enqueue FontAwesome
 *
 * @return void
 */
foreach ( array( 'wp_enqueue_scripts', 'admin_enqueue_scripts' ) as $action_hook ) {
	add_action(
		$action_hook,
		function () {
			if ( ! get_theme_mod( 'use-lightweight-fontawesome' ) ) {
				wp_enqueue_script(
					'fontawesome6',
					get_theme_file_uri( '/assets/js/fontawesome-all.js' ),
					array(),
					filemtime( get_theme_file_path( '/assets/js/fontawesome-all.js' ) ),
					array(
						'strategy'  => 'defer',
						'in_footer' => false,
					)
				);
			} else {
				wp_enqueue_script(
					Helper::get_main_script_handle() . '-fontawesome',
					get_theme_file_uri( '/assets/js/fontawesome.js' ),
					array(),
					filemtime( get_theme_file_path( '/assets/js/fontawesome.js' ) ),
					array(
						'strategy'  => 'defer',
						'in_footer' => false,
					)
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
	function () {
		if ( ! wp_style_is( 'spider', 'registered' ) ) {
			wp_enqueue_style(
				'spider',
				get_theme_file_uri( '/assets/css/app/spider.css' ),
				array(),
				filemtime( get_theme_file_path( '/assets/css/app/spider.css' ) )
			);
		}

		if ( ! wp_script_is( 'spider', 'registered' ) ) {
			wp_enqueue_script(
				'spider',
				get_theme_file_uri( '/assets/packages/spider/dist/js/spider.js' ),
				array(),
				filemtime( get_theme_file_path( '/assets/packages/spider/dist/js/spider.js' ) ),
				array(
					'strategy'  => 'defer',
					'in_footer' => false,
				)
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
	function () {
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
	function () {
		wp_enqueue_script(
			Helper::get_main_script_handle() . '-customize-preview',
			get_theme_file_uri( '/assets/js/customize-preview.js' ),
			array(
				'customize-preview',
				'customize-selective-refresh',
				'wp-awesome-widgets-customize-preview',
				Helper::get_main_script_handle(),
			),
			filemtime( get_theme_file_path( '/assets/js/customize-preview.js' ) ),
			array(
				'strategy'  => 'defer',
				'in_footer' => false,
			)
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
	function () {
		wp_localize_script(
			Helper::get_main_script_handle(),
			'snow_monkey',
			array(
				'home_url'                      => home_url(),
				'children_expander_open_label'  => __( 'Open submenu', 'snow-monkey' ),
				'children_expander_close_label' => __( 'Close submenu', 'snow-monkey' ),
			)
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
	function () {
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-admin',
			get_theme_file_uri( '/assets/css/admin/app.css' ),
			array(),
			filemtime( get_theme_file_path( '/assets/css/admin/app.css' ) )
		);
	}
);
