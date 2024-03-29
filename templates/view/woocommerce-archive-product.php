<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_display_archive_top_widget_area' => false,
	)
);

Helper::get_template_part(
	'template-parts/archive/entry/woocommerce-archive-product',
	null,
	$args
);
