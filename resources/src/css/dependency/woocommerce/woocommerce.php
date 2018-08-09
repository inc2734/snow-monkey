<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! class_exists( 'woocommerce' ) ) {
	return;
}

snow_monkey_entry_content_styles( [ '.woocommerce-Tabs-panel' ] );
snow_monkey_entry_content_styles( [ '.related.products' ] );
