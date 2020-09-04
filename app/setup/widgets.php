<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

new \Inc2734\WP_Awesome_Widgets\Bootstrap();

add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
);

/**
 * Enqueue assets
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-custom-widgets',
			get_theme_file_uri( '/assets/css/custom-widgets.min.css' ),
			[ Helper::get_main_style_handle() ],
			filemtime( get_theme_file_path( '/assets/css/custom-widgets.min.css' ) )
		);
	}
);

add_action(
	'after_setup_theme',
	function() {
		add_editor_style( [ '/assets/css/custom-widgets.min.css' ] );
	}
);

/**
 * Add deprecated message in widget description
 */
add_filter(
	'inc2734_wp_awesome_widgets_widget_options',
	function( $widget_options, $classname ) {
		$deprecated_widgets = [
			'Inc2734_WP_Awesome_Widgets_Carousel_Any_Posts',
			'Inc2734_WP_Awesome_Widgets_Pickup_Slider',
			'Inc2734_WP_Awesome_Widgets_Slider',
		];
		if ( in_array( $classname, $deprecated_widgets ) ) {
			$widget_options['description'] = __( 'This widget is deprecated. It may slow down the page when used.', 'snow-monkey' );
		}
		return $widget_options;
	},
	10,
	2
);

/**
 * Add deprecated message in widget form
 */
add_action(
	'in_widget_form',
	function( $self, $return, $instance ) {
		$deprecated_widgets = [
			'inc2734_wp_awesome_widgets_carousel_any_posts',
			'inc2734_wp_awesome_widgets_pickup_slider',
			'inc2734_wp_awesome_widgets_slider',
		];
		if ( in_array( $self->id_base, $deprecated_widgets ) ) {
			?>
			<div style="background-color: #ffede6; padding: 1em; margin: 1em 0">
				<b><?php echo esc_html( $self->widget_options['description'] ); ?></b>
			</div>
			<?php
		}
	},
	10,
	3
);

/**
 * Customize the local nav widget html
 *
 * @param string $content
 * @param array $widget_args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $widget_args ) {
		if ( false === strpos( $widget_args['widget_id'], 'inc2734_wp_awesome_widgets_local_nav' ) ) {
			return $content;
		}

		return str_replace(
			'<li class="wpaw-local-nav__subitem">',
			'<li class="wpaw-local-nav__subitem"><span class="wpaw-local-nav__subitem__icon"><i class="fas fa-angle-right"></i></span>',
			$content
		);
	},
	10,
	2
);

/**
 * Customize the pickup slider widget html
 *
 * @param string $content
 * @param array $widget_args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $widget_args ) {
		if ( ! preg_match( '|id="wpaw-pickup-slider-[^"]+?|', $content )
		  && ! preg_match( '|id="inc2734_wp_awesome_widgets_pickup_slider-[^"]+?|', $content ) ) {
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
 * Customize the pickup slider widget html
 *
 * @param string $content
 * @param array $widget_args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $widget_args, $instance ) {
		if ( false === strpos( $widget_args['widget_id'], 'inc2734_wp_awesome_widgets_pr_box' ) ) {
			return $content;
		}

		$content = str_replace(
			'wpaw-pr-box__inner',
			'wpaw-pr-box__inner c-container',
			$content
		);

		if ( ! empty( $instance['title'] ) ) {
			$content_widget_areas = [
				'front-page-top-widget-area',
				'front-page-bottom-widget-area',
				'posts-page-top-widget-area',
				'posts-page-bottom-widget-area',
				'archive-top-widget-area',
			];
			if ( ! in_array( $widget_args['id'], $content_widget_areas ) ) {
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
 * Customize the carousel widget html
 *
 * @param string $content
 * @param array $widget_args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $widget_args ) {
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
 * Customize the carousel widget html
 *
 * @param string $content
 * @param array $widget_args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $content, $widget_args ) {
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
 * Add .alignfull to specific widgets in [data-is-content-widget-area="true"]
 *
 * @param string $content
 * @param array $widget_args
 * @return string
 */
add_filter(
	'inc2734_wp_awesome_widgets_render_widget',
	function( $widget, $widget_args ) {
		$content_widget_areas = [
			'archive-top-widget-area',
			'front-page-top-widget-area',
			'front-page-bottom-widget-area',
			'posts-page-bottom-widget-area',
			'posts-page-top-widget-area',
		];

		if ( ! isset( $widget_args['id'] ) || in_array( $widget_args['id'], $content_widget_areas ) ) {
			if ( false !== strpos( $widget, 'class="wpaw-pickup-slider ' ) ) {
				return str_replace( 'class="wpaw-pickup-slider ', 'class="wpaw-pickup-slider alignfull ', $widget );
			}

			if ( false !== strpos( $widget, 'class="wpaw-showcase ' ) ) {
				return str_replace( 'class="wpaw-showcase ', 'class="wpaw-showcase alignfull ', $widget );
			}

			if ( false !== strpos( $widget, 'class="wpaw-pr-box ' ) ) {
				return str_replace( 'class="wpaw-pr-box ', 'class="wpaw-pr-box alignfull ', $widget );
			}

			if ( false !== strpos( $widget, 'class="wpaw-slider ' ) ) {
				return str_replace( 'class="wpaw-slider ', 'class="wpaw-slider alignfull ', $widget );
			}
		}

		return $widget;
	},
	10,
	2
);

/**
 * Update showcase widget background image size
 */
add_filter(
	'inc2734_wp_awesome_widgets_showcase_backgroud_image_size',
	function( $thumbnail_size ) {
		return 'xlarge';
	}
);

/**
 * Update showcase widget thumbnail image size
 */
add_filter(
	'inc2734_wp_awesome_widgets_showcase_image_size',
	function( $thumbnail_size ) {
		return 'xlarge';
	}
);
