<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.6
 *
 * renamed: template-parts/profile-box.php
 */

$args = wp_parse_args(
	$args,
	[
		'_title' => __( 'Bio', 'snow-monkey' ),
	]
);

echo do_shortcode( '[wp_profile_box title="' . $args['_title'] . '"]' );
