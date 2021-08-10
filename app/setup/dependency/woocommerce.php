<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.2.0
 */

use Framework\Helper;

if ( ! class_exists( '\woocommerce' ) ) {
	return;
}

/**
 * WooCommerce setup
 *
 * @var void
 */
add_action(
	'after_setup_theme',
	function() {
		add_theme_support(
			'woocommerce',
			[
				'product_grid' => [
					'default_rows'    => 3,
					'min_rows'        => 2,
					'max_rows'        => 8,
					'default_columns' => 3,
					'min_columns'     => 2,
					'max_columns'     => 4,
				],
			]
		);

		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
);

/**
 * WooCommerce related products settings
 *
 * @return array
 */
add_filter(
	'woocommerce_output_related_products_args',
	function( $args ) {
		$columns                = get_option( 'woocommerce_catalog_columns' );
		$columns                = $columns ? $columns : 3;
		$args['posts_per_page'] = 6;
		$args['columns']        = $columns;
		return $args;
	}
);

/**
 * Enqueue Woocommerce style
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-woocommerce',
			get_theme_file_uri( '/assets/css/dependency/woocommerce/woocommerce.min.css' ),
			[ Helper::get_main_style_handle() ],
			filemtime( get_theme_file_path( '/assets/css/dependency/woocommerce/woocommerce.min.css' ) )
		);
	}
);

add_action(
	'after_setup_theme',
	function() {
		add_editor_style(
			[
				'assets/css/dependency/woocommerce/woocommerce.min.css',
			]
		);
	}
);

add_action(
	'inc2734_wp_customizer_framework_load_styles',
	function() {
		Helper::load_files(
			'get_template_parts',
			get_template_directory() . '/assets/css/dependency/woocommerce'
		);
	}
);

/**
 * Output CSS in head
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'output-head-style' ) ) {
			return;
		}

		add_filter(
			'inc2734_wp_page_speed_optimization_output_head_styles',
			function( $handles ) {
				return array_merge(
					$handles,
					[
						Helper::get_main_style_handle() . '-woocommerce',
						'wc-block-style',
						'woocommerce-layout',
						'woocommerce-smallscreen',
						'woocommerce-general',
					]
				);
			}
		);
	}
);

/**
 * Register sidebars for Woocommerce
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'WooCommerce sidebar', 'snow-monkey' ),
				'description'   => __( 'These widgets are displayed in the sidebar on WooCommerce.', 'snow-monkey' ),
				'id'            => 'woocommerce-sidebar-widget-area',
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
 * On WooCommerce pages, the page header do not output
 *
 * @return boolean
 */
add_filter(
	'snow_monkey_is_output_page_header',
	function( $return ) {
		if ( is_cart() || is_checkout() || is_account_page() ) {
			return false;
		}
		return $return;
	},
	9
);

/**
 * The layout file for cart, checkout and my-account page
 *
 * @return string
 */
add_filter(
	'snow_monkey_layout',
	function( $layout ) {
		if ( class_exists( '\woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
			return 'one-column';
		}
		return $layout;
	},
	9
);

/**
 * The view file for cart, checkout and my-account page
 *
 * @return array
 */
add_filter(
	'snow_monkey_view',
	function( $view ) {
		if ( class_exists( '\woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
			return [
				'slug' => 'templates/view/woocommerce',
				'name' => 'content',
			];
		}
		return $view;
	},
	9
);

/**
 * Customize product search box html
 *
 * @return string
 */
add_filter(
	'get_product_search_form',
	function( $html ) {
		$html = str_replace( 'class="woocommerce-product-search"', 'class="woocommerce-product-search c-input-group"', $html );
		$html = str_replace( '<input type="search"', '<div class="c-input-group__field"><input type="search"', $html );
		$html = str_replace( '<button', '</div><button class="c-input-group__btn"', $html );
		return $html;
	}
);

add_filter(
	'woocommerce_dropdown_variation_attribute_options_html',
	function( $html ) {
		$html = str_replace( '<select id=', '<div class="c-select"><select class="c-select__control" style="margin-right: 0" id=', $html );
		$html = str_replace( '</select>', '</select><span class="c-select__toggle"></span></div>', $html );
		return $html;
	}
);

/**
 * Breadcrubs
 */
add_filter(
	'snow_monkey_breadcrumbs',
	function( $breadcrumbs ) {
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			return $breadcrumbs;
		}

		$wc_breadcrumbs = [];

		if ( is_product() || is_product_category() || is_product_tag() ) {
			$shop_page_id     = wc_get_page_id( 'shop' );
			$shop_url         = get_permalink( $shop_page_id );
			$shop_label       = get_the_title( $shop_page_id );
			$wc_breadcrumbs[] = [
				'title' => $shop_label,
				'link'  => $shop_url,
			];
		}

		$wc_breadcrumb     = new WC_Breadcrumb();
		$wc_breadcrumb_arr = $wc_breadcrumb->generate();
		foreach ( $wc_breadcrumb_arr as $value ) {
			$wc_breadcrumbs[] = [
				'title' => $value[0],
				'link'  => $value[1],
			];
		}

		if ( is_product_tag() ) {
			$_term = get_queried_object();
			$wc_breadcrumbs[ count( $wc_breadcrumbs ) - 1 ]['title'] = $_term->name;
		}

		/**
		 * @see https://github.com/inc2734/snow-monkey/issues/766
		 */
		if ( class_exists( '\WC_Subscriptions_Change_Payment_Gateway' ) ) {
			$is_request_to_change_payment = \WC_Subscriptions_Change_Payment_Gateway::$is_request_to_change_payment;

			if ( is_main_query() && is_page() && is_checkout_pay_page() && $is_request_to_change_payment ) {
				$page_on_front = get_option( 'page_on_front' );
				$home_label    = __( 'Home', 'snow-monkey' );
				if ( $page_on_front ) {
					$home_label = get_post( $page_on_front )->post_title;
				}

				$wc_breadcrumbs[0]['title'] = $home_label;
				$wc_breadcrumbs[1]['title'] = __( 'My account', 'snow-monkey' );
				return $wc_breadcrumbs;
			}
		}

		return array_merge(
			[
				$breadcrumbs[0],
			],
			$wc_breadcrumbs
		);
	}
);

/**
 * Sets up default fields html
 *
 * @param array $fields The default comment fields
 * @return array
 */
add_filter(
	'woocommerce_product_review_comment_form_args',
	function( $comment_form ) {
		foreach ( $comment_form as $key => $form ) {
			if ( 'fields' !== $key ) {
				continue;
			}

			foreach ( $comment_form[ $key ] as $field_key => $field ) {
				$comment_form[ $key ][ $field_key ] = wpbasis_add_class_attribute( $field );
			}
		}
		return $comment_form;
	}
);

add_action(
	'template_redirect',
	function() {
		if ( ! is_user_logged_in() ) {
			return;
		}

		if ( ! is_wc_endpoint_url( 'lost-password' ) ) {
			return;
		}

		wp_safe_redirect( wc_get_endpoint_url( 'edit-account' ) );
		exit;
	}
);

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );
