<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 *
 * renamed: template-parts/profile-box.php
 */

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_title'             => __( 'Bio', 'snow-monkey' ),
		'_in_same_post_type' => false,
	)
);

echo do_shortcode(
	sprintf(
		'[wp_profile_box title="%1$s" in_same_post_type="%2$s"]',
		$args['_title'],
		$args['_in_same_post_type']
	)
);
