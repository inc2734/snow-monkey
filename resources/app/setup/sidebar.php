<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

use Framework\Helper;

/**
 * Add woocommerce sidebar widget area to sidebar
 *
 * @return void
 */
function snow_monkey_the_woocommerce_sidebar_widget_area() {
	if ( ! Helper::is_active_sidebar( 'woocommerce-sidebar-widget-area' ) ) {
		return;
	}

	Helper::get_template_part( 'template-parts/widget-area/woocommerce-sidebar' );
}

/**
 * Add archive sidebar widget area to sidebar
 *
 * @return void
 */
function snow_monkey_the_archive_sidebar_widget_area() {
	if ( ! Helper::is_active_sidebar( 'archive-sidebar-widget-area' ) ) {
		return;
	}

	Helper::get_template_part( 'template-parts/widget-area/archive-sidebar' );
}

/**
 * Add sidebar widget area to sidebar
 *
 * @return void
 */
function snow_monkey_the_sidebar_widget_area() {
	if ( ! Helper::is_active_sidebar( 'sidebar-widget-area' ) ) {
		return;
	}

	Helper::get_template_part( 'template-parts/widget-area/sidebar' );
}

/**
 * Add sidebar sticky widget area to sidebar
 *
 * @return void
 */
function snow_monkey_the_sidebar_sticky_widget_area() {
	if ( ! Helper::is_active_sidebar( 'sidebar-sticky-widget-area' ) ) {
		return;
	}

	Helper::get_template_part( 'template-parts/widget-area/sidebar-sticky' );
}

/**
 * Add widget area to sidebar
 *
 * @return void
 */
function snow_monkey_sidebar_add_sidebar_widget_area() {
	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		snow_monkey_the_woocommerce_sidebar_widget_area();
	} elseif ( is_home() || is_archive() || is_search() ) {
		snow_monkey_the_archive_sidebar_widget_area();
	} else {
		snow_monkey_the_sidebar_widget_area();
		snow_monkey_the_sidebar_sticky_widget_area();
	}
}
add_action( 'snow_monkey_sidebar', 'snow_monkey_sidebar_add_sidebar_widget_area', 20 );
