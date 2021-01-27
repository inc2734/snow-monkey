<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 *
 * renamed: app/customizer/layout/sections/woocommerce-archive-page/section.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-woocommerce-archive-page',
	[
		'title'           => __( 'WooCommerce products page settings', 'snow-monkey' ),
		'priority'        => 130,
		'active_callback' => function() {
			if ( ! class_exists( '\woocommerce' ) ) {
				return false;
			}
			return is_shop() || is_product_category() || is_product_tag();
		},
	]
);
