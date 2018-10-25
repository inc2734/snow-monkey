<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Add google adsense to sidebar
 *
 * @return void
 */
function snow_monkey_sidebar_add_google_adsense() {
	wpvc_get_template_part(
		'template-parts/google-adsense',
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
		get_template_part( 'template-parts/woocommerce-sidebar-widget-area' );
	} elseif ( is_home() || is_archive() || is_search() ) {
		get_template_part( 'template-parts/archive-sidebar-widget-area' );
	} else {
		get_template_part( 'template-parts/sidebar-widget-area' );
		get_template_part( 'template-parts/sidebar-sticky-widget-area' );
	}
}
add_action( 'snow_monkey_sidebar', 'snow_monkey_sidebar_add_sidebar_widget_area', 20 );
