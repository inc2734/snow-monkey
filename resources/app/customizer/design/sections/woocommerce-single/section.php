<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/layout/sections/woocommerce-single/section.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-woocommerce-single',
	[
		'title'           => __( 'WooCommerce product page settings', 'snow-monkey' ),
		'priority'        => 130,
		'active_callback' => function() {
			if ( ! class_exists( '\woocommerce' ) ) {
				return false;
			}
			return is_product();
		},
	]
);
