<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.1.0
 *
 * renamed: templates/view/woocommerce-content-product.php
 */

use Framework\Helper;

// @see templates/view/content.php
$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_article_bottom_widget_area'  => false,
		'_display_article_top_widget_area'     => false,
		'_display_bottom_share_buttons'        => false,
		'_display_contents_bottom_widget_area' => false,
		'_display_entry_footer'                => false,
		'_display_profile_box'                 => false,
		'_display_top_share_buttons'           => false,
	]
);

if ( $args['_display_entry_footer'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_display_follow_box'    => has_nav_menu( 'follow-box' ),
			'_display_like_me_box'   => get_option( 'mwt-facebook-page-name' ),
			'_display_prev_next_nav' => false,
			'_display_related_posts' => get_option( 'mwt-display-related-posts' ),
		]
	);
}

Helper::get_template_part(
	'template-parts/content/entry/woocommerce-single-product',
	null,
	$args
);
