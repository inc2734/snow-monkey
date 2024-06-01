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
		'_display_adsense'                     => false,
		'_display_article_bottom_widget_area'  => false,
		'_display_article_top_widget_area'     => false,
		'_display_bottom_share_buttons'        => false,
		'_display_contents_bottom_widget_area' => false,
		'_display_comments'                    => false,
		'_display_entry_footer'                => false,
		'_display_entry_header'                => true,
		'_display_eyecatch'                    => false,
		'_display_profile_box'                 => false,
		'_display_tags'                        => false,
		'_display_top_share_buttons'           => false,
	)
);

if ( $args['_display_entry_header'] ) {
	$args = wp_parse_args(
		$args,
		array(
			'_display_title_top_widget_area' => false,
			'_display_entry_meta'            => false,
		)
	);
}

Helper::get_template_part(
	'template-parts/content/entry/entry',
	'woocommerce',
	$args
);
