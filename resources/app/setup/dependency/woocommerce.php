<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.7.1
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
		$columns = get_option( 'woocommerce_catalog_columns' );
		$columns = $columns ? $columns : 3;
		$args['posts_per_page'] = 6;
		$args['columns']        = $columns;
		return $args;
	}
);

/**
 * Enqueue Woocommerce style
 *
 * @return void
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
	'inc2734_wp_customizer_framework_load_styles',
	function() {
		Helper::load_theme_files( get_template_directory() . '/assets/css/dependency/woocommerce' );
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
		if ( class_exists( '\woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
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
		$html = str_replace( '<select id=', '<span class="c-select" aria-selected="false"><select id=', $html );
		$html = str_replace( '</select>', '</select><span class="c-select__label"></span></span>', $html );
		return $html;
	}
);

/**
 * Breadcrubs
 */
add_filter(
	'snow_monkey_breadcrumbs',
	function( $breadcrumbs ) {
		if ( is_product() ) {
			foreach ( $breadcrumbs as $key => $item ) {
				if ( false !== strpos( $item['link'], '?taxonomy=product_type' ) ) {
					unset( $breadcrumbs[ $key ] );
				}
			}
		}
		return $breadcrumbs;
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
