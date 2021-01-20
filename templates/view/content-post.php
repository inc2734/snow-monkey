<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$_post_type                   = get_post_type();
$eyecatch_position            = get_theme_mod( $_post_type . '-eyecatch' );
$share_buttons_position       = get_option( 'mwt-share-buttons-display-position' );
$display_adsense              = ! empty( get_option( 'mwt-google-adsense' ) );
$display_bottom_share_buttons = in_array( $share_buttons_position, [ 'bottom', 'both' ], true );
$display_entry_header         = 'title-on-page-header' !== $eyecatch_position;
$display_eyecatch             = 'content-top' === $eyecatch_position;
$display_profile_box          = get_option( 'mwt-display-profile-box' );
$display_top_share_buttons    = in_array( $share_buttons_position, [ 'top', 'both' ], true );

// @see templates/view/content.php
$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_adsense'                     => $display_adsense,
		'_display_article_bottom_widget_area'  => true,
		'_display_article_top_widget_area'     => true,
		'_display_bottom_share_buttons'        => $display_bottom_share_buttons,
		'_display_contents_bottom_widget_area' => true,
		'_display_comments'                    => true,
		'_display_entry_footer'                => true,
		'_display_entry_header'                => $display_entry_header,
		'_display_eyecatch'                    => $display_eyecatch,
		'_display_profile_box'                 => $display_profile_box,
		'_display_tags'                        => true,
		'_display_top_share_buttons'           => $display_top_share_buttons,
	]
);

if ( $args['_display_entry_header'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_display_title_top_widget_area' => true,
			'_display_entry_meta'            => true,
		]
	);
}

if ( $args['_display_entry_footer'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_display_follow_box'    => has_nav_menu( 'follow-box' ),
			'_display_like_me_box'   => get_option( 'mwt-facebook-page-name' ),
			'_display_prev_next_nav' => true,
			'_display_related_posts' => get_option( 'mwt-display-related-posts' ),
		]
	);
}

Helper::get_template_part(
	'template-parts/content/entry/entry',
	$args['_name'],
	$args
);
