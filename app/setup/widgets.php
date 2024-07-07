<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 26.0.0
 */

use Framework\Helper;

new \Inc2734\WP_Awesome_Widgets\Bootstrap();

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
);

/**
 * Enqueue assets
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style(
			Helper::get_main_style_handle() . '-custom-widgets',
			false,
			array(
				Helper::get_main_style_handle() . '-custom-widgets-app',
				Helper::get_main_style_handle() . '-custom-widgets-theme',
			)
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-custom-widgets-app',
			get_theme_file_uri( '/assets/css/custom-widgets/app.css' ),
			array( Helper::get_main_style_handle() ),
			filemtime( get_theme_file_path( '/assets/css/custom-widgets/app.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-custom-widgets-theme',
			get_theme_file_uri( '/assets/css/custom-widgets/app-theme.css' ),
			array( Helper::get_main_style_handle() . '-custom-widgets-app' ),
			filemtime( get_theme_file_path( '/assets/css/custom-widgets/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-custom-widgets' );
	}
);

/**
 * Enqueue assets in block editor.
 */
add_action(
	'enqueue_block_assets',
	function () {
		if ( ! is_admin() ) {
			return;
		}

		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style(
			Helper::get_main_style_handle() . '-custom-widgets',
			false,
			array(
				Helper::get_main_style_handle() . '-custom-widgets-app',
				Helper::get_main_style_handle() . '-custom-widgets-theme',
			)
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-custom-widgets-app',
			get_theme_file_uri( '/assets/css/custom-widgets/editor.css' ),
			array( Helper::get_main_style_handle() ),
			filemtime( get_theme_file_path( '/assets/css/custom-widgets/editor.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-custom-widgets-theme',
			get_theme_file_uri( '/assets/css/custom-widgets/editor-theme.css' ),
			array( Helper::get_main_style_handle() . '-custom-widgets-app' ),
			filemtime( get_theme_file_path( '/assets/css/custom-widgets/editor-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-custom-widgets' );
	}
);

/**
 * Add deprecated message in widget description.
 *
 * @param array  $widget_options The widget options.
 * @param string $classname The widget classname.
 * @return array
 */
add_filter(
	'inc2734_wp_awesome_widgets_widget_options',
	function ( $widget_options, $classname ) {
		$deprecated_widgets = array(
			'Inc2734_WP_Awesome_Widgets_Carousel_Any_Posts',
			'Inc2734_WP_Awesome_Widgets_Pickup_Slider',
			'Inc2734_WP_Awesome_Widgets_Slider',
		);
		if ( in_array( $classname, $deprecated_widgets, true ) ) {
			$widget_options['description'] = __( 'This widget is deprecated. It may slow down the page when used.', 'snow-monkey' );
		}
		return $widget_options;
	},
	10,
	2
);

/**
 * Add deprecated message in widget form.
 *
 * @param $me The widget instance.
 */
add_action(
	'in_widget_form',
	function ( $me ) {
		$deprecated_widgets = array(
			'inc2734_wp_awesome_widgets_carousel_any_posts',
			'inc2734_wp_awesome_widgets_pickup_slider',
			'inc2734_wp_awesome_widgets_slider',
		);
		if ( in_array( $me->id_base, $deprecated_widgets, true ) ) {
			?>
			<div style="background-color: #ffede6; padding: 1em; margin: 1em 0">
				<b><?php echo esc_html( $me->widget_options['description'] ); ?></b>
			</div>
			<?php
		}
	},
	10,
	3
);

/**
 * Customize the local nav widget HTML
 *
 * @param string $content The widget HTML.
 * @param array  $widget_args The widget args.
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function ( $content, $widget_args ) {
		if ( false === strpos( $widget_args['widget_id'], 'inc2734_wp_awesome_widgets_local_nav' ) ) {
			return $content;
		}

		return str_replace(
			'<li class="wpaw-local-nav__subitem">',
			'<li class="wpaw-local-nav__subitem"><span class="wpaw-local-nav__subitem__icon"><i class="fa-solid fa-angle-right"></i></span>',
			$content
		);
	},
	10,
	2
);

/**
 * Customize the pickup slider widget HTML.
 *
 * @param string $content The widget HTML.
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function ( $content ) {
		if (
			! preg_match( '|id="wpaw-pickup-slider-[^"]+?|', $content )
			&& ! preg_match( '|id="inc2734_wp_awesome_widgets_pickup_slider-[^"]+?|', $content )
		) {
			return $content;
		}

		return str_replace(
			'wpaw-pickup-slider__item-more',
			'wpaw-pickup-slider__item-more c-btn',
			$content
		);
	},
	10,
	2
);

/**
 * Customize the pickup slider widget HTML
 *
 * @param string $content The widget HTML.
 * @param array  $widget_args The widget args.
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function ( $content, $widget_args, $instance ) {
		if ( false === strpos( $widget_args['widget_id'], 'inc2734_wp_awesome_widgets_pr_box' ) ) {
			return $content;
		}

		$content = str_replace(
			'wpaw-pr-box__inner',
			'wpaw-pr-box__inner c-container',
			$content
		);

		if ( ! empty( $instance['title'] ) ) {
			$content_widget_areas = array(
				'front-page-top-widget-area',
				'front-page-bottom-widget-area',
				'posts-page-top-widget-area',
				'posts-page-bottom-widget-area',
				'archive-top-widget-area',
			);
			if ( ! in_array( $widget_args['id'], $content_widget_areas, true ) ) {
				$content = str_replace( 'wpaw-pr-box__title', 'c-widget__title', $content );
			}
		}

		$content = str_replace(
			'wpaw-pr-box__row',
			'wpaw-pr-box__row c-row c-row--margin',
			$content
		);

		$content = str_replace(
			'"wpaw-pr-box__item"',
			'"wpaw-pr-box__item c-row__col c-row__col--1-' . esc_attr( $instance['sm-columns'] ) . ' c-row__col--md-1-' . esc_attr( $instance['md-columns'] ) . ' c-row__col--lg-1-' . esc_attr( $instance['lg-columns'] ) . '"',
			$content
		);

		$content = str_replace(
			'wpaw-pr-box__item-more',
			'wpaw-pr-box__item-more c-btn',
			$content
		);

		$content = str_replace(
			'wpaw-pr-box__more',
			'wpaw-pr-box__more c-btn',
			$content
		);

		return $content;
	},
	10,
	3
);

/**
 * Customize the carousel widget HTML.
 *
 * @param string $content The widget HTML.
 * @param array  $widget_args The widget args.
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function ( $content, $widget_args ) {
		if ( false === strpos( $widget_args['widget_id'], 'inc2734_wp_awesome_widgets_showcase' ) ) {
			return $content;
		}

		$content = str_replace(
			'wpaw-showcase__more',
			'wpaw-showcase__more c-btn',
			$content
		);

		$content = str_replace(
			'wpaw-showcase__inner',
			'c-container wpaw-showcase__inner',
			$content
		);

		return $content;
	},
	10,
	2
);

/**
 * Customize the carousel widget HTML.
 *
 * @param string $content The widget HTML.
 * @param array  $widget_args The widget args.
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function ( $content, $widget_args ) {
		if ( false === strpos( $widget_args['widget_id'], 'inc2734_wp_awesome_widgets_slider' ) ) {
			return $content;
		}

		return str_replace(
			'wpaw-slider__item-more',
			'c-btn wpaw-slider__item-more',
			$content
		);
	},
	10,
	2
);

/**
 * Add .alignfull to specific widgets in [data-is-content-widget-area="true"].
 *
 * @param string $widget The widget HTML.
 * @param array  $widget_args The widget args.
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function ( $widget, $widget_args ) {
		$content_widget_areas = array(
			'archive-top-widget-area',
			'front-page-top-widget-area',
			'front-page-bottom-widget-area',
			'posts-page-bottom-widget-area',
			'posts-page-top-widget-area',
		);

		if ( ! isset( $widget_args['id'] ) || in_array( $widget_args['id'], $content_widget_areas, true ) ) {
			if (
				false !== strpos( $widget, 'class="wpaw-pickup-slider ' )
				|| false !== strpos( $widget, 'class="wpaw-showcase ' )
				|| false !== strpos( $widget, 'class="wpaw-pr-box ' )
				|| false !== strpos( $widget, 'class="wpaw-slider ' )
			) {
				return str_replace( 'class="c-section ', 'class="c-section alignfull ', $widget );
			}
		}

		return $widget;
	},
	10,
	2
);

/**
 * Update showcase widget background image size.
 *
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_showcase_backgroud_image_size',
	function () {
		return 'xlarge';
	}
);

/**
 * Update showcase widget thumbnail image size.
 *
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_showcase_image_size',
	function () {
		return 'xlarge';
	}
);

/**
 * Hides custom widgets from the block widget editor.
 *
 * @param array $widget_types Legacy widget settings.
 * @return array
 */
add_filter(
	'widget_types_to_hide_from_legacy_widget_block',
	function ( $widget_types ) {
		$widget_types[] = 'inc2734_wp_awesome_widgets_any_posts';
		$widget_types[] = 'inc2734_wp_awesome_widgets_carousel_any_posts';
		$widget_types[] = 'inc2734_wp_awesome_widgets_contents_outline';
		$widget_types[] = 'inc2734_wp_awesome_widgets_google_adsense';
		$widget_types[] = 'inc2734_wp_awesome_widgets_local_nav';
		$widget_types[] = 'inc2734_wp_awesome_widgets_pickup_slider';
		$widget_types[] = 'inc2734_wp_awesome_widgets_pr_box';
		$widget_types[] = 'inc2734_wp_awesome_widgets_profile_box';
		$widget_types[] = 'inc2734_wp_awesome_widgets_ranking';
		$widget_types[] = 'inc2734_wp_awesome_widgets_recent_posts';
		$widget_types[] = 'inc2734_wp_awesome_widgets_showcase';
		$widget_types[] = 'inc2734_wp_awesome_widgets_site_branding';
		$widget_types[] = 'inc2734_wp_awesome_widgets_slider';
		$widget_types[] = 'inc2734_wp_awesome_widgets_taxonomy_posts';
		$widget_types[] = 'snow_monkey_recent_posts_widget';
		$widget_types[] = 'snow_monkey_rss_widget';
		$widget_types[] = 'snow_monkey_taxonomy_posts_widget';
		return $widget_types;
	}
);
