<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$eyecatch_position    = get_theme_mod( get_post_type() . '-eyecatch' );
$display_entry_header = 'title-on-page-header' !== $eyecatch_position;
$display_eyecatch     = 'content-top' === $eyecatch_position;

// @see templates/view/content.php
$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_adsense'                     => false,
		'_display_article_bottom_widget_area'  => true,
		'_display_article_top_widget_area'     => true,
		'_display_bottom_share_buttons'        => false,
		'_display_contents_bottom_widget_area' => true,
		'_display_comments'                    => false,
		'_display_entry_footer'                => false,
		'_display_entry_header'                => $display_entry_header,
		'_display_eyecatch'                    => $display_eyecatch,
		'_display_profile_box'                 => false,
		'_display_tags'                        => false,
		'_display_top_share_buttons'           => false,
	]
);

if ( $args['_display_entry_header'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_display_title_top_widget_area' => true,
			'_display_entry_meta'            => false,
		]
	);
}

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
	'template-parts/content/entry/entry',
	$args['_name'],
	$args
);
