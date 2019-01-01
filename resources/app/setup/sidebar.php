<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

/**
 * Add google adsense to sidebar
 *
 * @return void
 */
function snow_monkey_sidebar_add_google_adsense() {
	Helper::get_template_part(
		'template-parts/common/google-adsense',
		null,
		[
			'position' => 'sidebar-top',
		]
	);
}
add_action( 'snow_monkey_sidebar', 'snow_monkey_sidebar_add_google_adsense', 10 );

/**
 * Add widget area to sidebar
 *
 * @return void
 */
function snow_monkey_sidebar_add_sidebar_widget_area() {
	if ( class_exists( '\woocommerce' ) && is_woocommerce() ) {
		Helper::get_template_part( 'template-parts/widget-area/woocommerce-sidebar' );
	} elseif ( is_home() || is_archive() || is_search() ) {
		Helper::get_template_part( 'template-parts/widget-area/archive-sidebar' );
	} else {
		Helper::get_template_part( 'template-parts/widget-area/sidebar' );
		Helper::get_template_part( 'template-parts/widget-area/sidebar-sticky' );
	}
}
add_action( 'snow_monkey_sidebar', 'snow_monkey_sidebar_add_sidebar_widget_area', 20 );
