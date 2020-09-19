<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 *
 * renamed: template-parts/like-me-box.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_facebook_page_name' => get_option( 'mwt-facebook-page-name' ),
	]
);

if ( ! $args['_facebook_page_name'] ) {
	return;
}

echo do_shortcode(
	sprintf(
		'[wp_like_me_box facebook_page_name="%1$s"]',
		esc_attr( $args['_facebook_page_name'] )
	)
);
